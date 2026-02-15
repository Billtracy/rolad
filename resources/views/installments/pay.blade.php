@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Pay Installment</h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="mb-4">You are about to pay an installment for <strong>{{ $plan->property->title }}</strong>.
                    </p>

                    <div class="mb-4">
                        <p class="font-bold">Amount Due: ${{ number_format($installment->amount_due, 2) }}</p>
                        <p class="text-sm text-gray-600">Due Date: {{ $installment->due_date->format('M d, Y') }}</p>
                    </div>

                    <form action="#" method="POST">
                        @csrf
                        <!-- Payment Gateway Integration would go here -->
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                disabled>
                                Pay with Card (Coming Soon)
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 border-t pt-4">
                        <h3 class="font-bold text-lg mb-2">Bank Transfer</h3>
                        <p class="text-gray-700 mb-2">Please transfer the amount to the following account and upload proof
                            of payment.</p>
                        <!-- Bank details would be fetched from settings -->
                        <ul class="list-disc ml-5 mb-4 text-gray-600">
                            <li>Bank Name: Example Bank</li>
                            <li>Account Number: 1234567890</li>
                            <li>Account Name: Rolad Properties</li>
                        </ul>

                        <!-- Upload proof form -->
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="proof">
                                    Upload Proof of Payment
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="proof" type="file" name="proof_of_payment">
                            </div>
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="button"
                                onclick="alert('This feature is for demonstration. Payment logic to be implemented.')">
                                Submit Proof
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
