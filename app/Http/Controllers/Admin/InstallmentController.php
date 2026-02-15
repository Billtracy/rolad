<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstallmentPlan;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function index()
    {
        $plans = InstallmentPlan::with(['user', 'property'])
            ->latest()
            ->paginate(20);

        return view('admin.installments.index', compact('plans'));
    }

    public function show(InstallmentPlan $plan)
    {
        $plan->load(['user', 'property', 'installments', 'transactions']);
        return view('admin.installments.show', compact('plan'));
    }
}
