@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16" x-data="{ timeLeft: 600, checkStatus: function() { window.location.reload(); } }">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden text-center p-12">
            <div class="mb-8">
                <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-secondary mx-auto"></div>
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-4">Payment Verification in Progress</h2>
            <p class="text-gray-600 mb-8">We have received your payment notification. Please wait while we verify your
                transaction. This usually takes a few minutes.</p>

            <div class="bg-gray-100 rounded-lg p-6 mb-8 inline-block">
                <p class="text-sm text-gray-500 mb-2">Estimated Time Remaining</p>
                <div class="text-4xl font-mono font-bold text-secondary" x-init="setInterval(() => { if (timeLeft > 0) timeLeft--;
                    else checkStatus(); }, 1000)">
                    <span x-text="Math.floor(timeLeft / 60).toString().padStart(2, '0')">10</span>:<span
                        x-text="(timeLeft % 60).toString().padStart(2, '0')">00</span>
                </div>
            </div>

            <div class="text-sm text-gray-500">
                <p>Transaction ID: <span
                        class="font-mono text-gray-900">{{ $pendingTransaction->reference ?? $transaction->reference }}</span>
                </p>
                <p class="mt-2">If you have any issues, please contact support.</p>
            </div>

            <div class="mt-8">
                <button @click="checkStatus()" class="text-primary underline hover:text-primary-dark cursor-pointer">Check
                    Status Now</button>
            </div>
        </div>
    </div>
@endsection
