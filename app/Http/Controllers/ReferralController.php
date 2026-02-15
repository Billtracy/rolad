<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $referrals = $user->referrals()->with('user.profile')->latest()->paginate(10);

        return view('community.index', compact('referrals'));
    }
}
