@extends('layouts.app')

@section('title', 'Payment Confirmation - ROLAD Properties')

@section('content')
    <div class="max-w-md mx-auto my-20 bg-white p-8 rounded-lg shadow-md border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-primary mb-2">Confirm Inspection Payment</h1>
            <p class="text-gray-600">Please review the details below to proceed.</p>
        </div>

        <div class="space-y-4 mb-8">
            <div class="flex justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-600">Property</span>
                <span class="font-medium text-right">{{ $property->title }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-600">Client Name</span>
                <span class="font-medium text-right">{{ $lead->name }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-600">Inspection Date</span>
                <span class="font-medium text-right">{{ $lead->preferred_date->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between items-center pt-2">
                <span class="text-gray-800 font-bold text-lg">Total Amount</span>
                <span class="text-primary font-bold text-xl">₦{{ number_format($property->inspection_fee, 2) }}</span>
            </div>
        </div>

        <form action="{{ route('booking.payment.process', $lead->id) }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full btn-primary py-3 rounded-lg font-bold text-center block hover:opacity-90 transition shadow-lg transform hover:-translate-y-1">
                Simulate Payment & Confirm
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('properties.show', $property->slug) }}"
                class="text-sm text-gray-500 hover:text-primary">Cancel and return to property</a>
        </div>
    </div>
@endsection
