@extends('layouts.app')

@section('title', 'Rolad Properties - Your Trusted Real Estate Partner')

@section('content')

    <!-- Hero Section -->
    <section class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero.webp') }}" alt="Luxury Real Estate" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/70"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <!-- Core Values Badge -->
            <div
                class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-6 py-2 mb-8 animate-fade-in-up">
                <span class="w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
                <span class="text-sm font-medium tracking-widest uppercase">Respect &bull; Integrity &bull; Speed</span>
            </div>
            <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in-up leading-tight">
                Stay Ahead of Inflation with <br> <span class="text-white">Rolad Provest:</span> <br
                    class="hidden md:block">
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto animate-fade-in-up"
                style="animation-delay: 0.2s;">
                Your Trusted Real Estate Partner!
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in-up" style="animation-delay: 0.4s;">
                <a href="{{ route('properties.index') }}" class="btn-primary text-lg px-8 py-4">View Properties</a>
                <a href="{{ route('properties.index') }}"
                    class="px-8 py-4 rounded-lg border-2 border-white hover:bg-white hover:text-primary transition-colors duration-300 font-semibold text-lg">Book
                    Inspection</a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
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

    <!-- Founder Quote Section -->
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-accent rounded-2xl p-8 md:p-12 lg:p-16 shadow-lg">
                <!-- Decorative accent line -->
                <div class="absolute top-0 left-8 md:left-12 lg:left-16 w-16 h-1 bg-secondary rounded-full"></div>

                <div class="flex flex-col md:flex-row items-start gap-8">
                    <!-- Quote Icon -->
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-primary rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-secondary" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <blockquote
                            class="font-heading text-xl md:text-2xl lg:text-3xl text-primary leading-relaxed mb-6 italic">
                            Our biggest dream is reducing the housing deficit in Nigeria so that individuals from different
                            walks of life can comfortably afford a basic need… <span
                                class="text-secondary font-bold not-italic">SHELTER.</span>
                        </blockquote>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg">
                                DO
                            </div>
                            <div>
                                <p class="font-bold text-primary text-lg">Dotun Oloyede</p>
                                <p class="text-gray-500 text-sm">Founder & CEO, Rolad Properties</p>
                            </div>
                        </div>
                    </div>
                </div>
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

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span
                    class="inline-block text-secondary font-semibold text-sm uppercase tracking-widest mb-2">Testimonials</span>
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-primary mb-4">What Our Clients Say</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Hear from real people who trusted Rolad Properties with their
                    real estate dreams.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($testimonials as $testimonial)
                    <div class="bg-accent rounded-2xl p-8 hover:shadow-xl transition-all duration-300 relative group">
                        <!-- Quote Icon -->
                        <div
                            class="absolute top-6 right-6 text-secondary/20 group-hover:text-secondary/40 transition-colors">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>

                        <!-- Stars -->
                        <div class="flex items-center mb-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>

                        <!-- Content -->
                        <p class="text-gray-600 leading-relaxed mb-6">"{{ Str::limit($testimonial->content, 180) }}"</p>

                        <!-- Client Info -->
                        <div class="flex items-center">
                            <div
                                class="w-11 h-11 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($testimonial->client_name, 0, 2)) }}
                            </div>
                            <div class="ml-3">
                                <h4 class="font-semibold text-primary text-sm">{{ $testimonial->client_name }}</h4>
                                @if ($testimonial->client_title)
                                    <p class="text-xs text-gray-500">{{ $testimonial->client_title }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($testimonials->count() >= 6)
                <div class="text-center mt-12">
                    <a href="{{ route('testimonials') }}"
                        class="inline-flex items-center gap-2 text-primary font-semibold hover:text-secondary transition-colors">
                        View All Testimonials
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- FAQs Section -->
    <section class="py-20 bg-accent">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block text-secondary font-semibold text-sm uppercase tracking-widest mb-2">FAQ</span>
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-primary mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Quick answers to common questions about buying property with
                    Rolad Properties.</p>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                @foreach ($faqs as $index => $faq)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300"
                        :class="{ 'ring-2 ring-secondary shadow-lg': openFaq === {{ $index }} }">
                        <button @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors duration-200">
                            <span class="font-semibold text-primary pr-4">{{ $faq->question }}</span>
                            <svg class="w-5 h-5 text-secondary flex-shrink-0 transition-transform duration-300"
                                :class="{ 'rotate-180': openFaq === {{ $index }} }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openFaq === {{ $index }}"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2" class="px-6 pb-6">
                            <div class="border-t border-gray-100 pt-4">
                                <p class="text-gray-600 leading-relaxed">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($faqs->count() >= 8)
                <div class="text-center mt-10">
                    <a href="{{ route('faqs') }}"
                        class="inline-flex items-center gap-2 text-primary font-semibold hover:text-secondary transition-colors">
                        View All FAQs
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pattern-dots"></div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="font-heading text-3xl md:text-5xl font-bold text-white mb-6">Ready to Invest in Your Future?</h2>
            <p class="text-gray-200 text-lg mb-8">Join over 500+ homeowners who have secured their wealth with Rolad
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
