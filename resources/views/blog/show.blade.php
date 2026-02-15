@extends('layouts.app')

@section('title', $post->title . ' - ROLAD Properties')

@section('content')
    <!-- Post Header -->
    <header class="bg-primary text-white py-20 relative">
        <div class="absolute inset-0 bg-black/40 z-0">
            <img src="{{ $post->cover_image ? asset('storage/' . $post->cover_image) : 'https://via.placeholder.com/2000x600' }}"
                class="w-full h-full object-cover opacity-50">
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            @if ($post->category)
                <span
                    class="bg-secondary text-dark font-bold px-3 py-1 rounded-full text-xs uppercase tracking-wider mb-4 inline-block">{{ $post->category->name }}</span>
            @endif
            <h1 class="font-heading text-3xl md:text-5xl font-bold mb-4">{{ $post->title }}</h1>
            <div class="flex items-center justify-center text-gray-200 text-sm">
                <span>By {{ $post->author->name ?? 'Admin' }}</span>
                <span class="mx-2">•</span>
                <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</span>
                <span class="mx-2">•</span>
                <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <article class="lg:col-span-2 prose prose-lg max-w-none text-gray-700">
                {!! nl2br(e($post->content)) !!}
            </article>

            <!-- Sidebar -->
            <aside class="space-y-8">
                <!-- Search -->
                <!-- Ideally implement search functionality later -->

                <!-- Call to Action -->
                <div class="bg-primary text-white p-8 rounded-xl text-center relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="font-heading font-bold text-2xl mb-2">Invest Smart</h3>
                        <p class="text-gray-200 text-sm mb-6">Get exclusive real estate offers and investment tips delivered
                            to your inbox.</p>
                        <form class="space-y-3" action="#" method="POST"> <!-- Placeholder action -->
                            @csrf
                            <input type="email" name="email" placeholder="Your Email Address"
                                class="w-full px-4 py-2 rounded-lg text-dark outline-none">
                            <button class="w-full btn-secondary">Subscribe</button>
                        </form>
                    </div>
                </div>

                <!-- Categories -->
                @if ($categories->count() > 0)
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-heading font-bold text-lg text-primary mb-4">Categories</h3>
                        <ul class="space-y-2">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#" class="flex justify-between text-gray-600 hover:text-primary">
                                        <span>{{ $category->name }}</span>
                                        <span
                                            class="bg-gray-100 px-2 py-0.5 rounded text-xs">{{ $category->posts_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Recent Posts Sidebar -->
                @if ($recentPosts->count() > 0)
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-heading font-bold text-lg text-primary mb-4">Recent Posts</h3>
                        <ul class="space-y-4">
                            @foreach ($recentPosts as $recent)
                                <li class="flex items-start">
                                    <img src="{{ $recent->cover_image ? asset('storage/' . $recent->cover_image) : 'https://via.placeholder.com/100x100' }}"
                                        class="w-16 h-16 object-cover rounded-lg mr-3">
                                    <div>
                                        <a href="{{ route('blog.show', $recent->slug) }}"
                                            class="font-bold text-primary hover:text-secondary text-sm block line-clamp-2">
                                            {{ $recent->title }}
                                        </a>
                                        <span
                                            class="text-xs text-gray-500">{{ $recent->published_at ? $recent->published_at->format('M d, Y') : '' }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </div>
@endsection
