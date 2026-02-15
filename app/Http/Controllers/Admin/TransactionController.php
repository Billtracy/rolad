<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = \App\Models\Transaction::latest()->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function update(Request $request, $id)
    {
        $transaction = \App\Models\Transaction::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        if ($validated['status'] === 'approved') {
            $transaction->update(['status' => 'successful']);

            // Mark property as sold out
            if ($transaction->property) {
                $transaction->property->update(['status' => 'sold_out']);
            }
        } else {
            $transaction->update(['status' => 'failed']);
        }

        return back()->with('success', 'Transaction status updated successfully.');
    }
}
