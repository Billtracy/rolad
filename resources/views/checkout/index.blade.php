@extends('layouts.app')

@section('title', 'Checkout - ROLAD Properties')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-3xl font-bold text-primary mb-8">Secure Checkout</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Order Details -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Personal Info -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h2 class="font-bold text-lg text-dark mb-4">1. Personal Information</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Name</label>
                                <div class="font-medium text-dark">{{ Auth::user()->name ?? 'Guest User' }}</div>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Email</label>
                                <div class="font-medium text-dark">{{ Auth::user()->email ?? 'guest@example.com' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h2 class="font-bold text-lg text-dark mb-4">2. Payment Method</h2>
                        <form id="checkout-form" action="{{ route('checkout.process', $property->slug) }}" method="POST">
                            @csrf
                            <div class="space-y-3">
                                <label
                                    class="flex items-center p-4 border border-secondary bg-secondary/5 rounded-lg cursor-pointer">
                                    <input type="radio" name="payment_method" value="card" checked
                                        class="text-primary focus:ring-primary">
                                    <span class="ml-3 font-medium text-dark">Pay with Card / Bank Transfer (Paystack)</span>
                                    <span
                                        class="ml-auto text-xs font-bold text-green-600 bg-green-100 px-2 py-1 rounded">Instant</span>
                                </label>
                                <label
                                    class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="wallet"
                                        class="text-primary focus:ring-primary">
                                    <span class="ml-3 font-medium text-dark">Pay from Wallet</span>
                                    <span class="ml-auto text-xs text-gray-500">Balance: ₦0.00</span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="md:col-span-1">
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 sticky top-24">
                        <h2 class="font-bold text-lg text-dark mb-4">Order Summary</h2>
                        <div class="flex items-start mb-4">
                            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                                class="w-16 h-16 object-cover rounded-md mr-3">
                            <div>
                                <h3 class="font-bold text-primary text-sm">{{ $property->title }}</h3>
                                <p class="text-xs text-gray-500">{{ $property->location }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 py-4 space-y-2">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Subtotal</span>
                                <span>₦{{ number_format($property->price) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Documentation</span>
                                <span>₦250,000</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>VAT (7.5%)</span>
                                <span>₦{{ number_format($property->price * 0.075) }}</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mb-6">
                            <div class="flex justify-between font-bold text-lg text-dark">
                                <span>Total</span>
                                <span>₦{{ number_format($property->price * 1.075 + 250000) }}</span>
                            </div>
                        </div>

                        <button onclick="document.getElementById('checkout-form').submit()"
                            class="w-full btn-secondary py-3 flex justify-center items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            Pay Securely
                        </button>
                        <p class="text-xs text-center text-gray-400 mt-4">Transactions are secured by Paystack</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection