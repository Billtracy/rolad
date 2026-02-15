@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Installment Plan: {{ $plan->property->title }}</h2>
                <a href="{{ route('installments.index') }}" class="text-blue-600 hover:text-blue-900">Back to Plans</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Total Amount</p>
                            <p class="text-lg font-bold">${{ number_format($plan->total_amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Balance Due</p>
                            <p class="text-lg font-bold text-red-600">${{ number_format($plan->balance_due, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Duration</p>
                            <p class="text-lg font-bold">{{ $plan->duration_months }} Months</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <span
                                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium
                            {{ $plan->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($plan->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold mb-4">Payment Schedule</h3>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Due Date
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Amount Due
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Amount Paid
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plan->installments as $installment)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{ $installment->due_date->format('M d, Y') }}
                                            @if ($installment->status === 'pending' && $installment->due_date < now())
                                                <span class="text-red-500 text-xs ml-1">(Overdue)</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            ${{ number_format($installment->amount_due, 2) }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            ${{ number_format($installment->amount_paid, 2) }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold leading-tight
                                            {{ $installment->status === 'paid' ? 'text-green-900' : 'text-yellow-900' }}">
                                                <span aria-hidden="true"
                                                    class="absolute inset-0 opacity-50 rounded-full
                                                {{ $installment->status === 'paid' ? 'bg-green-200' : 'bg-yellow-200' }}">
                                                </span>
                                                <span class="relative">{{ ucfirst($installment->status) }}</span>
                                            </span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if ($installment->status !== 'paid')
                                                <a href="{{ route('installments.pay', $installment->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                    Pay Now
                                                </a>
                                            @else
                                                <span class="text-green-600 font-bold">Paid</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
