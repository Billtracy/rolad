@extends('layouts.app')

@section('title', 'Welcome to ROLAD Properties')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
        <!-- Background Image/Video Placeholder -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero.png') }}" alt="Luxury Real Estate" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="font-heading text-4xl md:text-6xl lg:text-7xl font-bold mb-6 animate-fade-in-up">
                Experience Luxury <br> <span class="text-secondary">Without Limits</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-2xl mx-auto animate-fade-in-up"
                style="animation-delay: 0.2s;">
                Secure your future with ROLAD Properties. From premium land to finished homes, we help you build wealth
                through real estate.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in-up" style="animation-delay: 0.4s;">
                <a href="{{ route('properties.index') }}" class="btn-primary">View Properties</a>
                <a href="{{ route('properties.index') }}"
                    class="px-6 py-3 rounded-lg border-2 border-white hover:bg-white hover:text-primary transition-colors duration-300 font-semibold">Book
                    Inspection</a>
            </div>
        </div>
    </section>

    <!-- Trust/Stats Section -->
    <section class="py-12 bg-white -mt-10 relative z-20 max-w-6xl mx-auto shadow-xl rounded-xl">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-gray-100">
            <div>
                <div class="text-4xl font-bold text-primary mb-2">5+</div>
                <div class="text-sm text-gray-500 uppercase tracking-wide">Years Experience</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-primary mb-2">100+</div>
                <div class="text-sm text-gray-500 uppercase tracking-wide">Projects Delivered</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-primary mb-2">500+</div>
                <div class="text-sm text-gray-500 uppercase tracking-wide">Happy Clients</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-primary mb-2">1000+</div>
                <div class="text-sm text-gray-500 uppercase tracking-wide">Acres Sold</div>
            </div>
        </div>
    </section>

    <!-- Featured Properties Preview -->
    <section class="py-20 bg-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-primary mb-4">Featured Properties</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Explore our hand-picked selection of premium properties available
                    for immediate purchase.</p>
            </div>

            <!-- Property Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($featuredProperties as $property)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-shadow duration-300">
                        <div class="relative h-64 overflow-hidden">
                            @php
                                $images = $property->images ?? [];
                                $image = $images[0] ?? 'https://via.placeholder.com/800x600?text=No+Image';
                            @endphp
                            <img src="{{ $image }}" alt="{{ $property->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                            @if ($property->status === 'sold_out')
                                <div
                                    class="absolute top-4 right-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    SOLD OUT</div>
                            @elseif($property->status === 'reserved')
                                <div
                                    class="absolute top-4 right-4 bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    RESERVED</div>
                            @else
                                <div
                                    class="absolute top-4 right-4 bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full">
                                    SELLING FAST</div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-heading text-xl font-bold text-primary mb-2">{{ $property->title }}</h3>
                            <p class="text-gray-500 text-sm mb-4">{{ $property->location }}</p>
                            <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                                <span
                                    class="text-primary font-bold text-lg">₦{{ number_format($property->price / 1000000, 1) }}M
                                    <span
                                        class="text-sm font-normal text-gray-500">{{ $property->type == 'land' ? '/ plot' : '' }}</span></span>
                                <a href="{{ route('properties.show', $property->slug) }}"
                                    class="text-sm text-secondary font-semibold hover:underline">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('properties.index') }}" class="btn-primary">View All Properties</a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pattern-dots"></div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="font-heading text-3xl md:text-5xl font-bold text-white mb-6">Ready to Invest in Your Future?</h2>
            <p class="text-gray-200 text-lg mb-8">Join over 100+ homeowners who have secured their wealth with ROLAD
                Properties. Book a free inspection today.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('properties.index') }}"
                    class="px-8 py-4 bg-secondary text-white rounded-lg font-bold hover:bg-secondary-light transition duration-300">Book
                    an Inspection</a>
                <a href="#" x-data
                    @click.prevent="window.scrollTo({top: document.body.scrollHeight, behavior: 'smooth'}); setTimeout(() => { document.querySelector('[x-data]').__x.$data.open = true }, 500)"
                    class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-primary transition duration-300">Chat
                    with Agent</a>
            </div>
        </div>
    </section>
@endsection
