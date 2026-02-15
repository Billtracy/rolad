@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden" x-data="{
            selectedBank: '{{ $bankAccounts->first()->id ?? '' }}',
            copied: false,
            copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(() => {
                    this.copied = true;
                    setTimeout(() => this.copied = false, 2000);
                });
            }
        }">
            <div class="bg-primary py-4 px-6">
                <h2 class="text-2xl font-bold text-white">Bank Transfer Payment</h2>
            </div>

            <div class="p-8">
                <p class="text-gray-600 mb-6">Select a bank to proceed with the payment for
                    <strong>{{ $property->title }}</strong>.
                </p>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Bank</label>
                    <select x-model="selectedBank"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-secondary focus:ring focus:ring-secondary">
                        @foreach ($bankAccounts as $account)
                            <option value="{{ $account->id }}">
                                {{ $account->bank_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Bank Details Card -->
                <template x-if="selectedBank">
                    <div class="bg-gray-50 border rounded-lg p-6 mb-8 text-center">
                        @foreach ($bankAccounts as $account)
                            <div x-show="selectedBank == '{{ $account->id }}'">
                                <p class="text-sm text-gray-500 mb-1">Bank Name</p>
                                <p class="text-lg font-bold text-gray-800 mb-4">{{ $account->bank_name }}</p>

                                <p class="text-sm text-gray-500 mb-1">Account Name</p>
                                <p class="text-lg font-bold text-gray-800 mb-4">{{ $account->account_name }}</p>

                                <p class="text-sm text-gray-500 mb-1">Account Number</p>
                                <div class="flex items-center justify-center space-x-2 mb-4">
                                    <span
                                        class="text-2xl font-mono font-bold text-secondary">{{ $account->account_number }}</span>
                                    <button @click="copyToClipboard('{{ $account->account_number }}')"
                                        class="text-gray-400 hover:text-secondary focus:outline-none" title="Copy">
                                        <!-- Copy Icon -->
                                        <svg x-show="!copied" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <!-- Check Icon (Success) -->
                                        <svg x-show="copied" class="w-5 h-5 text-green-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                </div>
                                <span x-show="copied" x-transition class="text-xs text-green-600 font-medium">Copied!</span>
                            </div>
                        @endforeach
                    </div>
                </template>

                <form action="{{ route('checkout.bank-transfer.process', $property->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Proof of Payment</label>
                        <input type="file" name="proof_of_payment" required accept="image/*"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-primary file:text-white
                                hover:file:bg-primary-dark
                            " />
                        <p class="mt-1 text-xs text-gray-500">Allowed formats: JPG, PNG. Max size: 2MB.</p>
                    </div>

                    <button type="submit" :disabled="!selectedBank"
                        :class="!selectedBank ? 'opacity-50 cursor-not-allowed' : 'hover:bg-opacity-90'"
                        class="w-full btn-secondary font-bold py-3 rounded-lg transition">
                        I Have Made Payment
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('checkout.show', $property->slug) }}"
                        class="text-sm text-gray-500 hover:text-gray-700">Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
