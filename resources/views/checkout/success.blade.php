@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden text-center p-12">
            <div class="mb-8 flex justify-center">
                <div class="rounded-full bg-green-100 p-4">
                    <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-4">Payment Successful!</h2>
            <p class="text-gray-600 mb-8">Thank you for your payment. Your transaction has been successfully verified.</p>

            <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Total Amount:</span>
                    <span class="font-bold text-gray-900">₦{{ number_format($transaction->amount, 2) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Reference:</span>
                    <span class="font-mono text-gray-900">{{ $transaction->reference }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Date:</span>
                    <span class="text-gray-900">{{ $transaction->created_at->format('M d, Y H:i') }}</span>
                </div>
            </div>

            <a href="{{ route('properties.show', $transaction->property->slug) }}"
                class="btn-primary px-8 py-3 rounded-lg font-bold">Return to Property</a>
        </div>
    </div>
@endsection
