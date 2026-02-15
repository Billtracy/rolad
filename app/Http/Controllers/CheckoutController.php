<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Installment;
use App\Models\InstallmentPlan;
use App\Models\Property;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function createInstallmentPlan(Request $request, $propertySlug)
    {
        $property = Property::where('slug', $propertySlug)->firstOrFail();

        $request->validate([
            'duration' => 'required|integer|min:2|max:36', // Example limits
        ]);

        $duration = (int) $request->input('duration');
        $totalAmount = $property->price; // Could add interest here
        $monthlyAmount = $totalAmount / $duration;

        // Create Plan
        $plan = InstallmentPlan::create([
            'user_id' => auth()->id(),
            'property_id' => $property->id,
            'total_amount' => $totalAmount,
            'balance_due' => $totalAmount,
            'duration_months' => $duration,
            'start_date' => now(),
            'end_date' => now()->addMonths($duration),
            'status' => 'active',
        ]);

        // Create Installments
        for ($i = 0; $i < $duration; $i++) {
            Installment::create([
                'installment_plan_id' => $plan->id,
                'due_date' => now()->addMonths($i),
                'amount_due' => $monthlyAmount,
                'amount_paid' => 0,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('installments.show', $plan->id)->with('success', 'Installment plan created successfully.');
    }
    public function show($propertySlug)
    {
        $property = Property::where('slug', $propertySlug)->firstOrFail();

        $settings = Setting::all()->pluck('value', 'key');
        $enableCard = ($settings['enable_card_payment'] ?? '0') == '1';
        $enableBank = ($settings['enable_bank_transfer'] ?? '0') == '1';

        // Check if user has initialized a transaction for this property
        $pendingTransaction = Transaction::where('user_id', auth()->id())
            ->where('property_id', $property->id)
            ->whereIn('status', ['pending', 'waiting_verification'])
            ->latest()
            ->first();

        // If waiting for verification, show verification page directly
        if ($pendingTransaction && $pendingTransaction->status == 'waiting_verification') {
            return view('checkout.verify', compact('property', 'pendingTransaction'));
        }

        return view('checkout.show', compact('property', 'enableCard', 'enableBank', 'pendingTransaction'));
    }

    public function bankTransfer($propertySlug)
    {
        $property = Property::where('slug', $propertySlug)->firstOrFail();
        $bankAccounts = BankAccount::where('is_active', true)->get();

        return view('checkout.bank_transfer', compact('property', 'bankAccounts'));
    }

    public function processBankTransfer(Request $request, $propertySlug)
    {
        $property = Property::where('slug', $propertySlug)->firstOrFail();

        $request->validate([
            'proof_of_payment' => 'required|image|max:2048', // Max 2MB
        ]);

        $path = null;
        if ($request->hasFile('proof_of_payment')) {
            $path = $request->file('proof_of_payment')->store('proofs', 'public');
        }

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'property_id' => $property->id,
            'amount' => $property->price,
            'reference' => 'TRX-' . strtoupper(Str::random(10)),
            'status' => 'waiting_verification',
            'payment_method' => 'bank_transfer',
            'description' => 'Bank Transfer Payment',
            'proof_of_payment' => $path,
        ]);

        return redirect()->route('checkout.verify', ['transactionId' => $transaction->id]);
    }

    public function verify($transactionId)
    {
        $transaction = Transaction::with('property')->findOrFail($transactionId);

        if ($transaction->status == 'successful') {
            return redirect()->route('checkout.success', $transaction->id);
        }

        if ($transaction->status == 'failed') {
             return redirect()->route('checkout.failed', $transaction->id);
        }

        return view('checkout.verify', compact('transaction'));
    }

    public function success($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        return view('checkout.success', compact('transaction'));
    }

    public function failed($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        return view('checkout.failed', compact('transaction'));
    }
}
