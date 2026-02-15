@extends('layouts.app')

@section('title', 'Contact Us - ROLAD Properties')

@section('content')
    <section class="bg-primary py-20 text-center text-white relative">
        <div class="relative z-10 max-w-4xl mx-auto px-4">
            <h1 class="font-heading text-4xl md:text-5xl font-bold mb-4">Get in Touch</h1>
            <p class="text-xl text-gray-300">We are always happy to hear from you.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div>
                <h2 class="font-heading text-2xl font-bold text-primary mb-6">Contact Information</h2>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-secondary/10 p-3 rounded-lg text-secondary mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-dark">Head Office</h3>
                            <p class="text-gray-600">123 Real Estate Avenue, Ikeja, Lagos, Nigeria.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-secondary/10 p-3 rounded-lg text-secondary mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-dark">Email Us</h3>
                            <p class="text-gray-600">info@roladproperties.com</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-secondary/10 p-3 rounded-lg text-secondary mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-dark">Call Us</h3>
                            <p class="text-gray-600">+234 800 000 0000</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                <h2 class="font-heading text-2xl font-bold text-primary mb-6">Send us a Message</h2>
                <form class="space-y-4">
                    <input type="text" placeholder="Your Name"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-secondary">
                    <input type="email" placeholder="Your Email"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-secondary">
                    <textarea rows="4" placeholder="Your Message"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-secondary"></textarea>
                    <button class="w-full btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
@endsection