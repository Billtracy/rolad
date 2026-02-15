@extends('layouts.app')

@section('title', 'My Wallet - ROLAD Properties')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Wallet Overview</h3>
                    <p class="mt-1 text-sm text-gray-600">Manage your earnings and request withdrawals.</p>

                    <div class="mt-6 bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Current Balance</dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                ₦{{ number_format($wallet->balance, 2) }}</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 bg-white overflow-hidden shadow rounded-lg p-5">
                        <h4 class="text-md font-medium leading-6 text-gray-900 mb-4">Request Withdrawal</h4>
                        <form action="{{ route('wallet.withdraw') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="amount" class="block text-sm font-medium text-gray-700">Amount (₦)</label>
                                <input type="number" name="amount" id="amount" min="1000"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    placeholder="1000">
                            </div>
                            <button type="submit"
                                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Withdraw
                            </button>
                        </form>
                        @if (session('success'))
                            <p class="mt-2 text-sm text-green-600">{{ session('success') }}</p>
                        @endif
                        @if ($errors->any())
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('amount') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md bg-white">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Transaction History</h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <p class="text-gray-500 p-6 text-center">No transaction history available yet.</p>
                        <!-- Iterate over $transactions here when implemented -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
