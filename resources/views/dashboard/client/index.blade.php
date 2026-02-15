@extends('layouts.app')

@section('title', 'My Dashboard - ROLAD Properties')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <h1 class="font-heading text-3xl font-bold text-primary">Welcome, {{ Auth::user()->name }}</h1>
                <div class="mt-4 md:mt-0">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Stats/Balance -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Wallet Balance (Was Outstanding Balance) -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Wallet Balance</h3>
                    <p class="text-3xl font-bold text-primary mt-2">₦{{ number_format($walletBalance, 2) }}</p>
                    <p class="text-xs text-gray-400 mt-1">Available funds</p>
                    <a href="{{ route('wallet.index') }}"
                        class="block mt-4 w-full btn-secondary py-2 text-sm text-center">Fund Wallet</a>
                </div>

                <!-- Properties Owned -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 uppercase">My Properties</h3>
                    <p class="text-3xl font-bold text-dark mt-2">{{ $purchasedPropertiesCount }}</p>
                    <p class="text-xs text-gray-400 mt-1">Acquired properties</p>
                    <button
                        class="mt-4 w-full text-primary border border-primary rounded-lg py-2 text-sm hover:bg-primary hover:text-white transition">
                        View Documents
                    </button>
                </div>

                <!-- Support Ticket -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 bg-secondary/5">
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Need Help?</h3>
                    <p class="text-gray-600 mt-2 text-sm">Have a question about your allocation or payments?</p>
                    <button
                        class="mt-6 w-full text-dark bg-white border border-gray-200 rounded-lg py-2 text-sm hover:bg-gray-50 transition">Raise
                        a Ticket</button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Transactions -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="font-heading text-lg font-bold text-primary">Recent Transactions</h2>
                        <a href="{{ route('wallet.index') }}" class="text-sm text-secondary hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                                <tr>
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Description</th>
                                    <th class="px-6 py-3">Reference</th>
                                    <th class="px-6 py-3 text-right">Amount</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($transactions as $transaction)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $transaction->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-dark">
                                            {{ $transaction->description ?? 'Transaction' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $transaction->reference }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-right font-medium text-dark">
                                            ₦{{ number_format($transaction->amount, 2) }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full
                                                {{ $transaction->status == 'successful' ? 'bg-green-100 text-green-700' : '' }}
                                                {{ $transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                {{ $transaction->status == 'failed' ? 'bg-red-100 text-red-700' : '' }}
                                            ">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No transactions
                                            found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- My Property Preview -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="font-heading text-lg font-bold text-primary mb-4">Your Property</h2>

                    @if ($latestProperty)
                        <div class="rounded-lg overflow-hidden mb-4 relative">
                            <img src="{{ $latestProperty->images[0] ?? 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                                alt="Property" class="w-full h-40 object-cover">
                            <div
                                class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded">
                                Owned</div>
                        </div>
                        <h3 class="font-bold text-dark">{{ $latestProperty->title }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $latestProperty->location }}</p>

                        <a href="{{ route('properties.show', $latestProperty->slug) }}"
                            class="block w-full text-center text-primary border border-primary rounded-lg py-2 text-sm hover:bg-primary hover:text-white transition mt-4">
                            View Details
                        </a>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">You haven't purchased any properties yet.</p>
                            <a href="{{ route('properties.index') }}"
                                class="btn-primary px-4 py-2 rounded-lg text-sm">Browse Properties</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
