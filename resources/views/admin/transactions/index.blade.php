@extends('layouts.admin')

@section('header', 'Transactions')

@section('content')
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($transactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $transaction->user->name ?? 'N/A' }}</div>
                            <div class="text-sm text-gray-500">{{ $transaction->user->email ?? '' }}</div>
                            @if ($transaction->proof_of_payment)
                                <div class="mt-1">
                                    <a href="{{ Storage::url($transaction->proof_of_payment) }}" target="_blank"
                                        class="text-xs text-primary underline">View Proof</a>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-bold">₦{{ number_format($transaction->amount, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
                            {{ $transaction->reference }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $transaction->status === 'successful' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $transaction->status === 'failed' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            ">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transaction->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @if ($transaction->status === 'pending' || $transaction->status === 'waiting_verification')
                                <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-2"
                                        onclick="return confirm('Approve this transaction?')">Approve</button>
                                </form>
                                <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Reject this transaction?')">Reject</button>
                                </form>
                            @else
                                <span class="text-gray-400">No actions</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No transactions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
