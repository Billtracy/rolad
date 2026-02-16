@extends('layouts.app')

@section('title', 'FAQs - Rolad Properties')

@section('content')
    <!-- Page Header -->
    <section class="relative pt-32 pb-20 bg-primary">
        <div class="absolute inset-0 opacity-10 pattern-dots"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-white mb-4">Frequently Asked Questions</h1>
            <p class="text-gray-200 text-lg max-w-2xl mx-auto">Got questions? We've got answers. Find everything you need to
                know about buying property with Rolad Properties.</p>
        </div>
    </section>

    <!-- FAQs Section -->
    <section class="py-20 bg-accent">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openFaq === {{ $index }}" x-transition:enter="transition ease-out duration-200"
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

            <!-- Contact CTA -->
            <div class="mt-16 text-center bg-white rounded-2xl shadow-lg p-8">
                <h3 class="font-heading text-2xl font-bold text-primary mb-4">Still have questions?</h3>
                <p class="text-gray-600 mb-6">Can't find the answer you're looking for? Our team is here to help.</p>
                <a href="{{ route('contact') }}" class="btn-primary inline-block">Contact Us</a>
            </div>
        </div>
    </section>
@endsection
