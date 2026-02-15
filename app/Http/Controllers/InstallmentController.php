<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\InstallmentPlan;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function index()
    {
        $plans = InstallmentPlan::where('user_id', auth()->id())
            ->with('property')
            ->latest()
            ->paginate(10);

        return view('installments.index', compact('plans'));
    }

    public function show(InstallmentPlan $plan)
    {
        if ($plan->user_id !== auth()->id()) {
            abort(403);
        }

        $plan->load(['property', 'installments' => function ($query) {
            $query->orderBy('due_date', 'asc');
        }]);

        return view('installments.show', compact('plan'));
    }

    public function pay(Installment $installment)
    {
        $plan = $installment->plan;

        if ($plan->user_id !== auth()->id()) {
            abort(403);
        }

        if ($installment->status === 'paid') {
             return back()->with('error', 'This installment is already paid.');
        }

        // Logic to redirect to payment gateway or show payment options for this specific installment
        // For now, we can reuse the checkout flow or a specific payment page
        // Let's assume we redirect to a payment page similar to booking payment
        // But we need to update CheckoutController or create a new method here.

        // Simpler for now: redirect to a payment confirmation page for this installment
        return view('installments.pay', compact('installment', 'plan'));
    }
}
