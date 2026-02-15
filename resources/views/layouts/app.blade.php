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
        :class="{ 'bg-white/90 backdrop-blur-md shadow-md py-2': $window.scrollY > 10, 'bg-transparent py-4': $window.scrollY <=
                10 }"
        @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-heading text-2xl font-bold text-primary">
                        ROLAD<span class="text-secondary">Properties</span>
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
                        <!-- Social Icons Placeholder -->
                        <a href="#" class="text-gray-300 hover:text-secondary"><span
                                class="sr-only">Facebook</span>FB</a>
                        <a href="#" class="text-gray-300 hover:text-secondary"><span
                                class="sr-only">Instagram</span>IG</a>
                        <a href="#" class="text-gray-300 hover:text-secondary"><span
                                class="sr-only">Twitter</span>TW</a>
                    </div>
                </div>

                <div>
                    <h3 class="font-heading text-lg font-semibold mb-4 text-secondary">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('properties.index') }}" class="hover:text-white transition">Our
                                Properties</a></li>
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
                        <li>123 Real Estate Avenue, Lagos, Nigeria</li>
                        <li><a href="mailto:info@roladproperties.com"
                                class="hover:text-white">info@roladproperties.com</a></li>
                        <li><a href="tel:+2348000000000" class="hover:text-white">+234 800 000 0000</a></li>
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
