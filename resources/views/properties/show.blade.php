@extends('layouts.app')

@section('title', $property->title . ' - ROLAD Properties')

@section('content')
    <!-- Property Hero -->
    <section class="relative h-[70vh] min-h-[500px]">
        @php
            $images = $property->images ?? [];
            $heroImage = $images[0] ?? 'https://via.placeholder.com/2000x1200?text=No+Image';
        @endphp
        <img src="{{ $heroImage }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8 text-white max-w-7xl mx-auto">
            <div class="mb-4">
                <span
                    class="bg-secondary text-dark font-bold px-4 py-1 rounded-full text-sm uppercase tracking-wider">{{ $property->status === 'available' ? 'Selling Fast' : ucwords(str_replace('_', ' ', $property->status)) }}</span>
            </div>
            <h1 class="font-heading text-4xl md:text-6xl font-bold mb-2">{{ $property->title }}</h1>
            <p class="text-xl md:text-2xl text-gray-200 mb-6">{{ Str::limit($property->description, 100) }}</p>
            <div class="flex flex-wrap gap-6 text-sm md:text-base font-medium">
                <div class="flex items-center"><span class="w-2 h-2 bg-secondary rounded-full mr-2"></span>
                    {{ $property->location }}</div>
                <div class="flex items-center"><span class="w-2 h-2 bg-secondary rounded-full mr-2"></span> From
                    ₦{{ number_format($property->price / 1000000, 2) }}M {{ $property->type === 'land' ? '/ plot' : '' }}
                </div>
                <div class="flex items-center"><span class="w-2 h-2 bg-secondary rounded-full mr-2"></span>
                    {{ ucfirst($property->type) }}
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ activeTab: 'overview' }">
        <div class="lg:grid lg:grid-cols-3 lg:gap-12">

            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-12">

                <!-- Navigation Tabs (Sticky) -->
                <div
                    class="sticky top-20 bg-accent/95 backdrop-blur z-30 py-4 border-b border-gray-200 mb-8 overflow-x-auto whitespace-nowrap">
                    <button @click="document.getElementById('overview').scrollIntoView({behavior: 'smooth'})"
                        class="px-4 py-2 font-medium text-dark hover:text-primary border-b-2 border-transparent hover:border-primary transition">Overview</button>
                    <button @click="document.getElementById('gallery').scrollIntoView({behavior: 'smooth'})"
                        class="px-4 py-2 font-medium text-dark hover:text-primary border-b-2 border-transparent hover:border-primary transition">Gallery</button>
                    <button @click="document.getElementById('features').scrollIntoView({behavior: 'smooth'})"
                        class="px-4 py-2 font-medium text-dark hover:text-primary border-b-2 border-transparent hover:border-primary transition">Features</button>
                    <button @click="document.getElementById('pricing').scrollIntoView({behavior: 'smooth'})"
                        class="px-4 py-2 font-medium text-dark hover:text-primary border-b-2 border-transparent hover:border-primary transition">Pricing</button>
                    <button @click="document.getElementById('location').scrollIntoView({behavior: 'smooth'})"
                        class="px-4 py-2 font-medium text-dark hover:text-primary border-b-2 border-transparent hover:border-primary transition">Location</button>
                </div>

                <!-- Overview Section -->
                <div id="overview" class="prose max-w-none text-gray-600">
                    <h2 class="font-heading text-3xl font-bold text-primary mb-4">Property Overview</h2>
                    <p class="leading-relaxed mb-6">
                        {{ $property->description }}
                    </p>
                    <ul class="grid grid-cols-2 gap-4 list-none p-0">
                        @if ($property->type === 'land')
                            <li class="flex items-center"><svg class="w-5 h-5 text-secondary mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7">
                                    </path>
                                </svg> 600sqm & 300sqm Plots</li>
                        @endif
                        <li class="flex items-center"><svg class="w-5 h-5 text-secondary mr-3" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg> {{ ucwords(str_replace('_', ' ', $property->status)) }}</li>
                        <li class="flex items-center"><svg class="w-5 h-5 text-secondary mr-3" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg> {{ $property->location }}</li>
                    </ul>
                </div>

                <!-- Gallery Section -->
                <div id="gallery">
                    <h2 class="font-heading text-3xl font-bold text-primary mb-6">Gallery & Virtual Tour</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @if (is_array($images))
                            @forelse($images as $img)
                                <img src="{{ $img }}"
                                    class="rounded-lg shadow-md hover:opacity-90 transition cursor-pointer object-cover h-48 w-full"
                                    alt="{{ $property->title }} image">
                            @empty
                                <p class="col-span-3 text-gray-500">No additional images available.</p>
                            @endforelse
                        @else
                            <p class="col-span-3 text-gray-500">No additional images available.</p>
                        @endif
                    </div>
                </div>

                <!-- Features & Amenities -->
                <div id="features" class="bg-accent/50 p-8 rounded-xl border border-gray-100">
                    <h2 class="font-heading text-3xl font-bold text-primary mb-6">Features & Amenities</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                        @php
                            $features = $property->features ?? [];
                        @endphp
                        @if (is_array($features))
                            @forelse($features as $feature)
                                <div class="flex items-start">
                                    <div class="bg-white p-2 rounded shadow-sm mr-4 text-secondary">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-dark">{{ $feature }}</h4>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">No specific features listed.</p>
                            @endforelse
                        @else
                            <p class="text-gray-500">No specific features listed.</p>
                        @endif
                    </div>
                </div>

                <!-- Pricing -->
                <div id="pricing">
                    <h2 class="font-heading text-3xl font-bold text-primary mb-6">Pricing & Payment Plans</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th class="p-4 rounded-tl-lg">Duration</th>
                                    <th class="p-4">Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 border border-gray-200">
                                <tr>
                                    <td class="p-4 font-bold text-dark">Outright (0-3 Months)</td>
                                    <td class="p-4">₦{{ number_format($property->price, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-4 text-sm text-gray-500 italic">* Initial deposit and documentation fees may apply.</p>
                </div>

            </div>

            <!-- Right Column: Conversion Zone (Sticky) -->
            <div class="lg:col-span-1 mt-12 lg:mt-0">
                <div class="sticky top-24 bg-white p-6 rounded-xl shadow-xl border border-gray-100">
                    <div class="text-center mb-6">
                        <span class="text-gray-500 text-sm uppercase tracking-wide">Starting from</span>
                        <div class="text-3xl font-bold text-primary">₦{{ number_format($property->price, 0) }}</div>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('checkout.show', $property->slug) }}"
                            class="w-full btn-secondary text-center block py-3 rounded-lg font-bold hover:bg-secondary-dark transition">
                            Buy Now
                        </a>
                        <button @click="$refs.inspectionForm.scrollIntoView({behavior: 'smooth'})"
                            class="w-full btn-primary text-center block py-3 rounded-lg font-bold hover:bg-primary-dark transition">
                            Book Inspection
                        </button>
                        <a href="https://wa.me/2348000000000?text=I'm%20interested%20in%20{{ urlencode($property->title) }}"
                            target="_blank"
                            class="w-full flex justify-center items-center py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <span class="mr-2 text-green-600 font-bold">WhatsApp Agent</span>
                        </a>
                    </div>

                    <hr class="my-6 border-gray-100">

                    <div class="text-center">
                        <h4 class="font-heading font-bold text-dark mb-2">Need more info?</h4>
                        <p class="text-sm text-gray-500 mb-4">Download our detailed brochure for this property.</p>
                        <a href="#"
                            class="text-primary font-semibold text-sm hover:underline flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download Brochure
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Form Section -->
    <section x-ref="inspectionForm" class="bg-primary py-16 text-white">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="font-heading text-3xl font-bold text-center mb-8">
                Schedule a {{ $property->inspection_fee > 0 ? 'Verified' : 'Free' }} Inspection for {{ $property->title }}
            </h2>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-2">Full Name</label>
                        <input type="text" name="name" required
                            class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 focus:border-secondary focus:ring-1 focus:ring-secondary outline-none text-white placeholder-gray-400"
                            placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Phone Number</label>
                        <input type="tel" name="phone" required
                            class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 focus:border-secondary focus:ring-1 focus:ring-secondary outline-none text-white placeholder-gray-400"
                            placeholder="+234...">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Email Address</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 focus:border-secondary focus:ring-1 focus:ring-secondary outline-none text-white placeholder-gray-400"
                        placeholder="john@example.com">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-2">Preferred Date</label>
                        <input type="date" name="preferred_date" required
                            class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 focus:border-secondary focus:ring-1 focus:ring-secondary outline-none text-white placeholder-gray-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Message (Optional)</label>
                        <textarea name="message" rows="1"
                            class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 focus:border-secondary focus:ring-1 focus:ring-secondary outline-none text-white placeholder-gray-400"></textarea>
                    </div>
                </div>

                @if ($property->inspection_fee > 0)
                    <div class="bg-white/10 p-4 rounded-lg border border-white/20">
                        <p class="text-sm">Inspection Fee: <span
                                class="font-bold text-secondary">₦{{ number_format($property->inspection_fee, 2) }}</span>
                        </p>
                    </div>
                @endif

                <button type="submit"
                    class="w-full btn-secondary mt-4 font-bold py-3 rounded-lg hover:bg-opacity-90 transition">
                    {{ $property->inspection_fee > 0 ? 'Proceed to Payment' : 'Confirm Booking' }}
                </button>
            </form>
        </div>
    </section>
@endsection
