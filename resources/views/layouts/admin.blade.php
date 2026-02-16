<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200">
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <span class="text-xl font-bold text-gray-800">Rolad Admin</span>
                </a>
            </div>
            <nav class="mt-6 px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Dashboard
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</p>
                </div>

                <a href="{{ route('admin.properties.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.properties.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Properties
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Clients / Users
                </a>
                <a href="{{ route('admin.users.index') }}?role=affiliate"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    Affiliates
                </a>
                <a href="{{ route('admin.transactions.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.transactions.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Transactions
                </a>
                <a href="{{ route('admin.blogs.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.blogs.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Blog
                </a>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Testimonials
                </a>
                <a href="{{ route('admin.faqs.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.faqs.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    FAQs
                </a>

                <a href="{{ route('admin.leads.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.leads.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Inspection Bookings
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Settings</p>
                </div>

                <a href="{{ route('admin.bank-accounts.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.bank-accounts.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Bank Accounts
                </a>

                <a href="{{ route('admin.settings.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    General Settings
                </a>
                <a href="{{ route('admin.roles.index') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 {{ request()->routeIs('admin.roles.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Roles & Permissions
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex justify-between items-center px-6 py-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        @yield('header')
                    </h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-900">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
