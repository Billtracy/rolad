@extends('layouts.app')

@section('title', 'Login - ROLAD Properties')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-accent py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <div class="text-center">
                <h2 class="font-heading text-3xl font-bold text-primary">Welcome Back</h2>
                <p class="mt-2 text-sm text-gray-600">Sign in to your account</p>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="mb-4">
                        <label for="email-address" class="block text-sm font-medium text-gray-700 mb-1">Email
                            address</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-secondary focus:border-secondary focus:z-10 sm:text-sm"
                            placeholder="you@example.com">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-secondary focus:border-secondary focus:z-10 sm:text-sm"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-primary focus:ring-secondary border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-secondary hover:text-secondary-light">Forgot password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-300">
                        Sign in
                    </button>
                </div>
            </form>
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">Don't have an account? <a href="{{ route('register') }}"
                        class="font-medium text-secondary hover:text-secondary-light">Register here</a></p>
            </div>
        </div>
    </div>
@endsection