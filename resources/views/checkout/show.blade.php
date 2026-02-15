@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-primary py-4 px-6">
                <h2 class="text-2xl font-bold text-white">Checkout: {{ $property->title }}</h2>
            </div>

            <div class="p-8">
                <div class="mb-8">
                    <p class="text-gray-600 mb-2">Total Amount:</p>
                    <div class="text-3xl font-bold text-secondary">₦{{ number_format($property->price, 2) }}</div>
                </div>

                <div class="space-y-4">
                    @if ($enableCard)
                        <div class="border rounded-lg p-4 hover:border-secondary transition cursor-pointer">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="card"
                                    class="form-radio text-secondary h-5 w-5">
                                <span class="text-lg font-medium text-gray-800">Pay with Card (Paystack)</span>
                            </label>
                            <p class="text-sm text-gray-500 ml-8 mt-1">Secure payment via Paystack.</p>
                            <div class="ml-8 mt-4 hidden" id="card-payment-details">
                                <!-- Paystack Button or Form would go here -->
                                <button class="btn-secondary px-6 py-2 rounded-lg">Proceed with Paystack</button>
                            </div>
                        </div>
                    @endif

                    @if ($enableBank)
                        <a href="{{ route('checkout.bank-transfer', $property->slug) }}" class="block">
                            <div class="border rounded-lg p-4 hover:border-secondary transition cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <div class="rounded-full border border-gray-300 p-1">
                                        <div class="h-3 w-3 rounded-full bg-gray-300"></div>
                                    </div>
                                    <span class="text-lg font-medium text-gray-800">Bank Transfer</span>
                                </div>
                                <p class="text-sm text-gray-500 ml-8 mt-1">Transfer directly to our bank account.</p>
                            </div>
                        </a>
                    @endif

                    <div x-data="{ open: false }">
                        <div @click="open = !open"
                            class="border rounded-lg p-4 hover:border-secondary transition cursor-pointer">
                            <div class="flex items-center space-x-3">
                                <div class="rounded-full border border-gray-300 p-1">
                                    <div class="h-3 w-3 rounded-full bg-gray-300"></div>
                                </div>
                                <span class="text-lg font-medium text-gray-800">Pay with Installments</span>
                            </div>
                            <p class="text-sm text-gray-500 ml-8 mt-1">Spread the cost over several months.</p>
                        </div>

                        <div x-show="open" class="mt-4 ml-8 border-l-2 border-secondary pl-4">
                            <form action="{{ route('checkout.installment.create', $property->slug) }}" method="POST">
                                @csrf
                                <label class="block mb-2 text-sm font-bold text-gray-700">Select Duration (Months)</label>
                                <select name="duration"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="3">3 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="12">12 Months</option>
                                    <option value="24">24 Months</option>
                                </select>
                                <button type="submit"
                                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Start Installment Plan
                                </button>
                            </form>
                        </div>
                    </div>

                    @if (!$enableCard && !$enableBank)
                        <div class="text-center text-red-500 font-medium">
                            No payment methods are currently available. Please contact support.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
