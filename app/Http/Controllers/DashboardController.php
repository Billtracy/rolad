<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalAgents = \App\Models\User::where('role', 'affiliate')->count();
            $activeAgents = \App\Models\User::where('role', 'affiliate')->where('is_active', true)->count();
            $totalWalletBalance = \App\Models\Wallet::sum('balance');
            $recentAgents = \App\Models\User::where('role', 'affiliate')->latest()->take(5)->get();

            return view('dashboard.admin.index', compact('totalAgents', 'activeAgents', 'totalWalletBalance', 'recentAgents'));
        } elseif ($user->role === 'affiliate') {
            $user->load(['wallet', 'rank', 'profile']);
            $referralsCount = $user->referrals()->count();
            // $recentSales = ... // Implement later

            return view('dashboard.affiliate.index', compact('user', 'referralsCount'));
        } else {
            $user->load(['wallet']);
            $walletBalance = $user->wallet ? $user->wallet->balance : 0;

            $transactions = \App\Models\Transaction::where('user_id', $user->id)->latest()->take(5)->get();

            // Get unique properties purchased by user (successful transactions)
            $purchasedPropertiesCount = \App\Models\Transaction::where('user_id', $user->id)
                ->where('status', 'successful')
                ->distinct('property_id')
                ->count('property_id');

            // Get latest property for preview
            $latestTransaction = \App\Models\Transaction::with('property')
                ->where('user_id', $user->id)
                ->where('status', 'successful')
                ->whereNotNull('property_id')
                ->latest()
                ->first();

            $latestProperty = $latestTransaction ? $latestTransaction->property : null;

            return view('dashboard.client.index', compact('user', 'walletBalance', 'transactions', 'purchasedPropertiesCount', 'latestProperty'));
        }
    }
}
