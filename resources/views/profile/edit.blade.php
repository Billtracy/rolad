@extends('layouts.app')

@section('title', 'Complete Profile - ROLAD Properties')

@section('content')
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Complete Your Profile</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Personal Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="address" class="block text-sm font-medium text-gray-700">Residential
                                Address</label>
                            <input type="text" name="address" id="address"
                                value="{{ old('address', $profile->address) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="sm:col-span-3">
                            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date" name="dob" id="dob"
                                value="{{ old('dob', optional($profile->dob)->format('Y-m-d')) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="sm:col-span-3">
                            <label for="occupation"
                                class="block text-sm font-medium text-gray-700">Occupation/Discipline</label>
                            <input type="text" name="occupation" id="occupation"
                                value="{{ old('occupation', $profile->occupation) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="sm:col-span-3">
                            <label for="state_of_origin" class="block text-sm font-medium text-gray-700">State of
                                Origin</label>
                            <input type="text" name="state_of_origin" id="state_of_origin"
                                value="{{ old('state_of_origin', $profile->state_of_origin) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="sm:col-span-3">
                            <label for="lga" class="block text-sm font-medium text-gray-700">Local Government
                                Area</label>
                            <input type="text" name="lga" id="lga" value="{{ old('lga', $profile->lga) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <!-- Bank Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Bank Information</h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="bank_name" class="block text-sm font-medium text-gray-700">Bank Name</label>
                            <input type="text" name="bank_name" id="bank_name"
                                value="{{ old('bank_name', $profile->bank_name) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="account_number" class="block text-sm font-medium text-gray-700">Account
                                Number</label>
                            <input type="text" name="account_number" id="account_number"
                                value="{{ old('account_number', $profile->account_number) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="account_name" class="block text-sm font-medium text-gray-700">Account Name</label>
                            <input type="text" name="account_name" id="account_name"
                                value="{{ old('account_name', $profile->account_name) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <!-- Uploads -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Documents</h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="passport" class="block text-sm font-medium text-gray-700">Passport
                                Photograph</label>
                            <input type="file" name="passport" id="passport"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>

                        <div class="sm:col-span-3">
                            <label for="valid_id" class="block text-sm font-medium text-gray-700">Valid ID Card</label>
                            <input type="file" name="valid_id" id="valid_id"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                    </div>
                </div>

                <!-- Next of Kin -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Next of Kin</h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="nok_name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="nok_name" id="nok_name"
                                value="{{ old('nok_name', $profile->nok_name) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="sm:col-span-3">
                            <label for="nok_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="nok_phone" id="nok_phone"
                                value="{{ old('nok_phone', $profile->nok_phone) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="sm:col-span-3">
                            <label for="nok_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="nok_email" id="nok_email"
                                value="{{ old('nok_email', $profile->nok_email) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="sm:col-span-6">
                            <label for="nok_address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="nok_address" id="nok_address"
                                value="{{ old('nok_address', $profile->nok_address) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <!-- About Us -->
                <div class="pb-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="referral_source" class="block text-sm font-medium text-gray-700">How did you hear
                                about us?</label>
                            <input type="text" name="referral_source" id="referral_source"
                                value="{{ old('referral_source', $profile->referral_source) }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
