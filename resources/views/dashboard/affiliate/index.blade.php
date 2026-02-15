@extends('layouts.app')

@section('title', 'Affiliate Dashboard - ROLAD Properties')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <div>
                    <h1 class="font-heading text-3xl font-bold text-primary">Affiliate Partner</h1>
                    <p class="text-gray-500">Welcome back, {{ Auth::user()->name }}</p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Profile Completion Warning -->
            @if (!Auth::user()->is_active)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: solid/exclamation -->
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Your account is currently inactive. Please <a href="{{ route('profile.edit') }}"
                                    class="font-medium underline text-yellow-700 hover:text-yellow-600">complete your
                                    profile</a> to generate your referral link and start earning.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Referral Link -->
            @if (Auth::user()->is_active)
                <div
                    class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8 flex flex-col md:flex-row items-center justify-between">
                    <div>
                        <h3 class="font-bold text-dark mb-1">Your Unique Referral Link</h3>
                        <p class="text-sm text-gray-500">Share this link to earn commission on every sale.</p>
                    </div>
                    <div class="mt-4 md:mt-0 flex items-center w-full md:w-auto">
                        <input type="text" readonly
                            value="{{ route('register', ['ref' => Auth::user()->referral_code]) }}"
                            class="bg-gray-100 border border-gray-300 rounded-l-lg px-4 py-2 text-gray-600 w-full md:w-64 focus:outline-none">
                        <button
                            onclick="navigator.clipboard.writeText('{{ route('register', ['ref' => Auth::user()->referral_code]) }}'); alert('Copied!')"
                            class="bg-secondary text-white font-bold px-4 py-2 rounded-r-lg hover:bg-secondary-light transition">Copy</button>
                    </div>
                </div>
            @endif

            <!-- Stats/Wallet -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Wallet Balance -->
                <div
                    class="md:col-span-2 bg-gradient-to-r from-primary to-primary-light p-6 rounded-xl shadow-lg text-white">
                    <h3 class="text-sm font-medium opacity-80 uppercase">Wallet Balance</h3>
                    <p class="text-4xl font-bold mt-2">₦{{ number_format($user->wallet->balance ?? 0, 2) }}</p>
                    <div class="flex space-x-4 mt-6">
                        <a href="{{ route('wallet.index') }}"
                            class="bg-white text-primary font-bold px-6 py-2 rounded-lg hover:bg-gray-100 transition">Wallet</a>
                        <a href="{{ route('community.index') }}"
                            class="bg-primary-light border border-white text-white font-bold px-6 py-2 rounded-lg hover:bg-green-700 transition">My
                            Community</a>
                    </div>
                </div>

                <!-- Total Sales -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Rank</h3>
                    <div class="flex items-end mt-2">
                        <span class="text-3xl font-bold text-dark">{{ $user->rank->name ?? 'Newbie' }}</span>
                    </div>
                </div>

                <!-- Total Referrals -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Referrals</h3>
                    <div class="flex items-end mt-2">
                        <span class="text-3xl font-bold text-dark">{{ $referralsCount ?? 0 }}</span>
                        <span class="text-gray-400 text-sm ml-2 mb-1">Users</span>
                    </div>
                </div>
            </div>

            <!-- Commission History -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-heading text-lg font-bold text-primary">Commission History</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Property</th>
                                <th class="px-6 py-3">Client</th>
                                <th class="px-6 py-3 text-right">Commission</th>
                                <th class="px-6 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-600">Oct 20, 2025</td>
                                <td class="px-6 py-4 text-sm font-medium text-dark">Rolad Heights - Plot 12</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Mr. Tunde Bakare</td>
                                <td class="px-6 py-4 text-sm text-right font-medium text-green-600">+₦1,200,000</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full">Pending</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-600">Sep 15, 2025</td>
                                <td class="px-6 py-4 text-sm font-medium text-dark">OAK Farms - 5 Acres</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Chief Obi</td>
                                <td class="px-6 py-4 text-sm text-right font-medium text-green-600">+₦450,000</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Paid</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
