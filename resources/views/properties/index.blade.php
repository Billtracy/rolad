@extends('layouts.app')

@section('title', 'Our Properties - ROLAD Properties')

@section('content')
    <section class="bg-primary py-20 text-center text-white relative">
        <div class="relative z-10 max-w-4xl mx-auto px-4">
            <h1 class="font-heading text-4xl md:text-5xl font-bold mb-4">Our Properties</h1>
            <p class="text-xl text-gray-300">Find your perfect plot or home in our exclusive locations.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($properties->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($properties as $property)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-shadow duration-300">
                        <div class="relative h-64 overflow-hidden">
                            @php
                                $images = $property->images ?? [];
                                $coverImage = !empty($images) ? $images[0] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                            @endphp
                            <img src="{{ $coverImage }}" alt="{{ $property->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @if($property->status === 'sold_out')
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                    <span class="text-white font-bold border-2 border-white px-4 py-2 uppercase tracking-widest">Sold
                                        Out</span>
                                </div>
                            @elseif($property->is_featured)
                                <div class="absolute top-4 right-4 bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full">
                                    FEATURED</div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-heading text-xl font-bold text-primary mb-2">{{ $property->title }}</h3>
                            <p class="text-gray-500 text-sm mb-4">{{ $property->location }}</p>
                            <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                                <span class="text-primary font-bold text-lg">₦{{ number_format($property->price) }}</span>
                                <a href="{{ route('properties.show', $property->slug) }}"
                                    class="text-sm text-secondary font-semibold hover:underline">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <h3 class="text-2xl font-bold text-gray-400">No properties available at the moment.</h3>
                <p class="text-gray-500 mt-2">Please check back later.</p>
            </div>
        @endif
    </div>
@endsection