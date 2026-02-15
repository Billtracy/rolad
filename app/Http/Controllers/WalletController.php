<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallet = $user->wallet()->firstOrCreate(['user_id' => $user->id]);
        $transactions = []; // Fetch transactions relation if it existed linked to wallet

        return view('wallet.index', compact('user', 'wallet', 'transactions'));
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $user = Auth::user();
        $wallet = $user->wallet;

        if ($wallet->balance < $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient balance.']);
        }

        // Logic to process withdrawal (e.g. create transaction record, deduct balance temporarily or hold it)
        // For now, just a flash message.

        return back()->with('success', 'Withdrawal request submitted successfully.');
    }
}
