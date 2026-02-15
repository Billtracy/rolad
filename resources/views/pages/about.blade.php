@extends('layouts.app')

@section('title', 'About Us - ROLAD Properties')

@section('content')
    <!-- Hero -->
    <section class="bg-primary py-20 text-center text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pattern-dots"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4">
            <h1 class="font-heading text-4xl md:text-5xl font-bold mb-4">About ROLAD Properties</h1>
            <p class="text-xl text-gray-300">Building wealth through strategic real estate investments.</p>
        </div>
    </section>

    <!-- Mission/Vision -->
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                    alt="Team" class="rounded-xl shadow-lg">
            </div>
            <div class="space-y-6">
                <div>
                    <h2 class="font-heading text-3xl font-bold text-primary mb-2">Our Mission</h2>
                    <p class="text-gray-600">To provide affordable, genuine, and high-appreciating real estate assets to
                        average income earners, helping them build sustainable wealth.</p>
                </div>
                <div>
                    <h2 class="font-heading text-3xl font-bold text-primary mb-2">Our Vision</h2>
                    <p class="text-gray-600">To be the most reliable and trusted real estate company in Africa, known for
                        integrity and excellence.</p>
                </div>
                <div>
                    <h2 class="font-heading text-3xl font-bold text-primary mb-2">Why Choose Us?</h2>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center"><svg class="w-5 h-5 text-secondary mr-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg> Verified Documentation</li>
                        <li class="flex items-center"><svg class="w-5 h-5 text-secondary mr-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg> Instant Allocation</li>
                        <li class="flex items-center"><svg class="w-5 h-5 text-secondary mr-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg> Flexible Payment Plans</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection