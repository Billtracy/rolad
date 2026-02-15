@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden text-center p-12">
            <div class="mb-8 flex justify-center">
                <div class="rounded-full bg-red-100 p-4">
                    <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-4">Payment Failed</h2>
            <p class="text-gray-600 mb-8">Unfortunately, your payment could not be processed or was rejected.</p>

            <div class="text-sm text-gray-500 mb-8">
                <p>Reference: <span class="font-mono text-gray-900">{{ $transaction->reference }}</span></p>
            </div>

            <div class="space-x-4">
                <a href="{{ route('checkout.show', $transaction->property->slug) }}"
                    class="btn-primary px-6 py-3 rounded-lg font-bold">Try Again</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-gray-900 underline">Contact Support</a>
            </div>
        </div>
    </div>
@endsection
