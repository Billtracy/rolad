@extends('layouts.app')

@section('title', 'Register - ROLAD Properties')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-accent py-12 px-4 sm:px-6 lg:px-8"
        x-data="{ role: 'client' }">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <div class="text-center">
                <h2 class="font-heading text-3xl font-bold text-primary">Create Account</h2>
                <p class="mt-2 text-sm text-gray-600">Join the ROLAD family</p>
            </div>

            <!-- Role Toggle -->
            <div class="flex justify-center space-x-4 mb-6">
                <button @click="role = 'client'"
                    :class="role === 'client' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600'"
                    class="px-6 py-2 rounded-full text-sm font-medium transition duration-300">Client</button>
                <button @click="role = 'affiliate'"
                    :class="role === 'affiliate' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600'"
                    class="px-6 py-2 rounded-full text-sm font-medium transition duration-300">Affiliate / Realtor</button>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('register.post') }}" method="POST">
                @csrf
                <input type="hidden" name="role" x-model="role">

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input id="name" name="name" type="text" required
                            class="appearance-none block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-secondary focus:border-secondary sm:text-sm"
                            placeholder="John Doe">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input id="email" name="email" type="email" required
                            class="appearance-none block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-secondary focus:border-secondary sm:text-sm"
                            placeholder="you@example.com">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input id="phone" name="phone" type="tel" required
                            class="appearance-none block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-secondary focus:border-secondary sm:text-sm"
                            placeholder="+234...">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password" name="password" type="password" required
                            class="appearance-none block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-secondary focus:border-secondary sm:text-sm"
                            placeholder="••••••••">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                            Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="appearance-none block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-secondary focus:border-secondary sm:text-sm"
                            placeholder="••••••••">
                    </div>
                    <div>
                        <label for="referral_code" class="block text-sm font-medium text-gray-700 mb-1">Referral Code (Optional)</label>
                        <input id="referral_code" name="referral_code" type="text"
                            class="appearance-none block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-secondary focus:border-secondary sm:text-sm"
                            placeholder="RF123456" value="{{ request('ref') }}">
                    </div>
                </div>

                <div x-show="role === 'affiliate'" class="bg-blue-50 p-4 rounded-lg text-sm text-blue-700">
                    <strong>Note:</strong> As an affiliate, you will get a unique referral code and dashboard to track your
                    commissions after registration.
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-300">
                        Register
                    </button>
                </div>
            </form>
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}"
                        class="font-medium text-secondary hover:text-secondary-light">Sign in</a></p>
            </div>
        </div>
    </div>
@endsection
