@extends('layouts.admin')

@section('header')
    Dashboard
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900">Welcome, {{ Auth::user()->name }}!</h3>
                <p class="mt-1 text-sm text-gray-600">You are logged in as {{ Auth::user()->role->name }}.</p>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Stats Cards -->
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <h4 class="text-blue-800 font-semibold">Properties</h4>
                        <p class="text-2xl font-bold text-blue-900 mt-2">0</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <h4 class="text-green-800 font-semibold">Users</h4>
                        <p class="text-2xl font-bold text-green-900 mt-2">0</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <h4 class="text-yellow-800 font-semibold">Sales</h4>
                        <p class="text-2xl font-bold text-yellow-900 mt-2">0</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                        <h4 class="text-purple-800 font-semibold">Blogs</h4>
                        <p class="text-2xl font-bold text-purple-900 mt-2">0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
