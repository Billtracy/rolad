@extends('layouts.app')

@section('title', 'My Community - ROLAD Properties')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">My Community</h2>
            <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-900">Back to Dashboard</a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Referrals List</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">People you have invited to the platform.</p>
            </div>
            <div class="border-t border-gray-200">
                @if ($referrals->isEmpty())
                    <p class="text-gray-500 p-6 text-center">You haven't referred anyone yet.</p>
                @else
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach ($referrals as $referral)
                            <li class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if ($referral->user->profile && $referral->user->profile->passport_path)
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ asset('storage/' . $referral->user->profile->passport_path) }}"
                                                    alt="">
                                            @else
                                                <span
                                                    class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center text-white font-bold">
                                                    {{ substr($referral->user->name, 0, 1) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-indigo-600 truncate">
                                                {{ $referral->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $referral->user->email }}</div>
                                        </div>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex flex-col items-end">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $referral->user->is_active ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $referral->user->is_active ? 'Active' : 'Pending KYC' }}
                                        </span>
                                        <span class="text-sm text-gray-500 mt-1">Joined
                                            {{ $referral->created_at->diffForHumans() }}</span>
                                        @if ($referral->user->phone)
                                            <a href="tel:{{ $referral->user->phone }}"
                                                class="text-xs text-gray-400 hover:text-gray-600 mt-1">{{ $referral->user->phone }}</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                        {{ $referrals->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
