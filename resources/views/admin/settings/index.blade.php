@extends('layouts.admin')

@section('header', 'General Settings')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Methods</h3>
            <div class="space-y-4 mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="enable_card_payment" id="enable_card_payment" value="1"
                        {{ ($settings['enable_card_payment'] ?? '0') == '1' ? 'checked' : '' }}
                        class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <label for="enable_card_payment" class="ml-2 block text-sm text-gray-900">Enable Card Payment
                        (Paystack)</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="enable_bank_transfer" id="enable_bank_transfer" value="1"
                        {{ ($settings['enable_bank_transfer'] ?? '0') == '1' ? 'checked' : '' }}
                        class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <label for="enable_bank_transfer" class="ml-2 block text-sm text-gray-900">Enable Bank Transfer</label>
                </div>
            </div>

            <hr class="my-6">

            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
@endsection
