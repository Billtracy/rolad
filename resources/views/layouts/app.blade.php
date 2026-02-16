<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ROLAD Properties - Buy Land, Earn with Agriculture')</title>
    <meta name="description" content="@yield('meta_description', 'ROLAD Properties offers premium real estate solutions in Nigeria. Buy land, earn with agriculture, and build your dream home.')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'ROLAD Properties - Buy Land, Earn with Agriculture')">
    <meta property="og:description" content="@yield('meta_description', 'ROLAD Properties offers premium real estate solutions in Nigeria. Buy land, earn with agriculture, and build your dream home.')">
    <meta property="og:image" content="@yield('meta_image', asset('images/og-image.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'ROLAD Properties - Buy Land, Earn with Agriculture')">
    <meta property="twitter:description" content="@yield('meta_description', 'ROLAD Properties offers premium real estate solutions in Nigeria. Buy land, earn with agriculture, and build your dream home.')">
    <meta property="twitter:image" content="@yield('meta_image', asset('images/og-image.jpg'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback for dev environment without vite running -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#1A4D2E',
                            'primary-light': '#2A6E45',
                            secondary: '#D4AF37',
                            'secondary-light': '#F4CF57',
                            accent: '#FAF9F6',
                            dark: '#121212',
                        },
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            heading: ['Playfair Display', 'serif'],
                        }
                    }
                }
            }
        </script>
    @endif

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans text-dark antialiased bg-accent selection:bg-secondary selection:text-white"
    x-data="{ mobileMenuOpen: false }">

    <!-- Navigation -->
    <header class="fixed w-full z-50 transition-all duration-300"
        :class="{
            'bg-white/90 backdrop-blur-md shadow-md py-2': $window.scrollY > 10,
            'bg-transparent py-4': $window.scrollY <=
                10
        }"
        @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-8xl">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-heading text-2xl font-bold text-primary">
                        <img src="{{asset('logo.jpeg')}}" style="height:100px" alt="">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-dark hover:text-primary font-medium transition">Home</a>
                    <a href="{{ route('properties.index') }}"
                        class="text-dark hover:text-primary font-medium transition">Properties</a>
                    <a href="{{ route('about') }}" class="text-dark hover:text-primary font-medium transition">About
                        Us</a>
                    <a href="{{ route('blog.index') }}"
                        class="text-dark hover:text-primary font-medium transition">Blog</a>
                    <a href="{{ route('contact') }}"
                        class="text-dark hover:text-primary font-medium transition">Contact</a>
                </nav>

                <!-- CTA & Auth -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-primary hover:text-primary-light font-medium">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-primary hover:text-primary-light focus:outline-none">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }"
                                class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-white shadow-lg absolute w-full">
            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 text-base font-medium text-primary bg-accent rounded-md">Home</a>
                <a href="{{ route('properties.index') }}"
                    class="block px-3 py-2 text-base font-medium text-dark hover:text-primary hover:bg-gray-50 rounded-md">Properties</a>
                <a href="{{ route('about') }}"
                    class="block px-3 py-2 text-base font-medium text-dark hover:text-primary hover:bg-gray-50 rounded-md">About
                    Us</a>
                <a href="{{ route('blog.index') }}"
                    class="block px-3 py-2 text-base font-medium text-dark hover:text-primary hover:bg-gray-50 rounded-md">Blog</a>
                <a href="{{ route('contact') }}"
                    class="block px-3 py-2 text-base font-medium text-dark hover:text-primary hover:bg-gray-50 rounded-md">Contact</a>
                <div class="border-t border-gray-200 mt-4 pt-4">
                    <a href="{{ route('login') }}"
                        class="block w-full text-center px-4 py-2 border border-primary text-primary rounded-md font-medium mb-2">Login</a>
                    <a href="{{ route('register') }}" class="block w-full text-center btn-primary">Get Started</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-primary text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <a href="{{ route('home') }}" class="font-heading text-2xl font-bold text-white mb-4 block">
                        ROLAD<span class="text-secondary">Properties</span>
                    </a>
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">
                        Building credibility and reliability through strategic showcases of delivered projects and
                        high-impact programs.
                    </p>
                    <div class="flex space-x-4">
                        <!-- Social Icons -->
                        <a href="https://instagram.com/roladpropertiesltd" target="_blank" rel="noopener"
                            class="text-gray-300 hover:text-secondary transition">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-secondary transition">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385h-3.047v-3.47h3.047v-2.642c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.514c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385c5.736-.9 10.124-5.864 10.124-11.854z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-secondary transition">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="font-heading text-lg font-semibold mb-4 text-secondary">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('properties.index') }}" class="hover:text-white transition">Our
                                Properties</a></li>
                        <li><a href="{{ route('testimonials') }}"
                                class="hover:text-white transition">Testimonials</a></li>
                        <li><a href="{{ route('faqs') }}" class="hover:text-white transition">FAQs</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition">Become an
                                Affiliate</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-white transition">Blog & News</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-heading text-lg font-semibold mb-4 text-secondary">Legal</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ route('privacy') }}" class="hover:text-white transition">Privacy Policy</a>
                        </li>
                        <li><a href="{{ route('terms') }}" class="hover:text-white transition">Terms & Conditions</a>
                        </li>
                        <li><a href="{{ route('disclaimer') }}" class="hover:text-white transition">Disclaimer</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-heading text-lg font-semibold mb-4 text-secondary">Contact</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li>307, Lance Awolokun Street, Gbagada Phase 2, Lagos</li>
                        <li><a href="mailto:info@roladproperties.com"
                                class="hover:text-white">info@roladproperties.com</a></li>
                        <li><a href="tel:08039619391" class="hover:text-white">08039619391</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/20 pt-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} ROLAD Properties. All rights reserved.
            </div>
        </div>
    </footer>

    @include('partials.chat-widget')
</body>

</html>
