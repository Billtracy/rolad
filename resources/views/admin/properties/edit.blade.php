@extends('layouts.admin')

@section('header', 'Edit Property: ' . $property->title)

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700">Property Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $property->title) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Property Type</label>
                    <select name="type" id="type" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <option value="land" {{ old('type', $property->type) == 'land' ? 'selected' : '' }}>Land</option>
                        <option value="house" {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>House
                        </option>
                        <option value="apartment" {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>
                            Apartment</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <option value="available" {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>
                            Available</option>
                        <option value="sold_out" {{ old('status', $property->status) == 'sold_out' ? 'selected' : '' }}>Sold
                            Out</option>
                        <option value="reserved" {{ old('status', $property->status) == 'reserved' ? 'selected' : '' }}>
                            Reserved</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price (₦)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $property->price) }}"
                        required min="0" step="0.01"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Inspection Fee -->
                <div>
                    <label for="inspection_fee" class="block text-sm font-medium text-gray-700">Inspection Fee (₦)
                        (Optional)</label>
                    <input type="number" name="inspection_fee" id="inspection_fee"
                        value="{{ old('inspection_fee', $property->inspection_fee ?? 0) }}" min="0" step="0.01"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <p class="text-xs text-gray-500 mt-1">Leave as 0 for free inspection.</p>
                    @error('inspection_fee')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $property->location) }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    @error('location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('description', $property->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Features -->
                <div class="col-span-2">
                    <label for="features" class="block text-sm font-medium text-gray-700">Features (comma separated)</label>
                    <input type="text" name="features" id="features"
                        value="{{ old('features', is_array($property->features) ? implode(', ', $property->features) : '') }}"
                        placeholder="e.g. C of O, Dry Land, Fenced"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    @error('features')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Images -->
                @php
                    $propertyImages = is_array($property->images)
                        ? $property->images
                        : json_decode($property->images ?? '[]', true);
                @endphp
                @if ($propertyImages && count($propertyImages) > 0)
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($propertyImages ?? [] as $image)
                                <div class="relative">
                                    <img src="{{ $image }}" class="w-full h-24 object-cover rounded-lg">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Images -->
                <div class="col-span-2">
                    <label for="images" class="block text-sm font-medium text-gray-700">Add/Update Images (Will append to
                        existing)</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-primary file:text-white
                        hover:file:bg-primary-dark">
                    @error('images.*')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Featured -->
                <div class="col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1"
                            {{ old('is_featured', $property->is_featured) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">Mark as Featured
                            Property</label>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('admin.properties.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary mr-3">
                    Cancel
                </a>
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Update Property
                </button>
            </div>
        </form>
    </div>
@endsection
