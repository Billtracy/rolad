@extends('layouts.app')

@section('title', 'Testimonials - Rolad Properties')

@section('content')
    <!-- Page Header -->
    <section class="relative pt-32 pb-20 bg-primary">
        <div class="absolute inset-0 opacity-10 pattern-dots"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-white mb-4">What Our Clients Say</h1>
            <p class="text-gray-200 text-lg max-w-2xl mx-auto">Real stories from real people who trusted Rolad Properties
                with their real estate journey.</p>
        </div>
    </section>

    <!-- Testimonials Grid -->
    <section class="py-20 bg-accent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($testimonials as $testimonial)
                    <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300 relative">
                        <!-- Quote Icon -->
                        <div class="absolute top-6 right-6 text-secondary/20">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
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
                        <p class="text-gray-600 leading-relaxed mb-6 italic">"{{ $testimonial->content }}"</p>

                        <!-- Client Info -->
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg">
                                {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-primary">{{ $testimonial->client_name }}</h4>
                                @if ($testimonial->client_title)
                                    <p class="text-sm text-gray-500">{{ $testimonial->client_title }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $testimonials->links() }}
            </div>
        </div>
    </section>
@endsection
