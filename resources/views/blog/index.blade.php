@extends('layouts.app')

@section('title', 'News & Updates - ROLAD Properties')

@section('content')
    <!-- Blog Header -->
    <section class="bg-primary py-20 text-center text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pattern-dots"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4">
            <span class="text-secondary font-bold tracking-wider uppercase mb-2 block">Our Blog</span>
            <h1 class="font-heading text-4xl md:text-5xl font-bold mb-4">Latest News & Insights</h1>
            <p class="text-xl text-gray-300">Stay updated with the latest trends in real estate, project updates, and
                company news.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Featured Post -->
        @if ($featured)
            <div class="mb-16">
                <h2 class="font-heading text-2xl font-bold text-primary mb-8 border-b border-gray-200 pb-2">Featured Story
                </h2>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="h-64 md:h-96 overflow-hidden">
                        <img src="{{ $featured->cover_image ? asset('storage/' . $featured->cover_image) : 'https://via.placeholder.com/800x600' }}"
                            alt="{{ $featured->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 md:p-12">
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            @if ($featured->category)
                                <span
                                    class="bg-secondary/10 text-secondary font-bold px-3 py-1 rounded-full">{{ $featured->category->name }}</span>
                                <span class="mx-2">•</span>
                            @endif
                            <span>{{ $featured->published_at ? $featured->published_at->format('M d, Y') : '' }}</span>
                        </div>
                        <h3 class="font-heading text-3xl font-bold text-primary mb-4 group-hover:text-secondary transition">
                            {{ $featured->title }}</h3>
                        <p class="text-gray-600 mb-6 line-clamp-3">
                            {{ Str::limit(strip_tags($featured->content), 200) }}
                        </p>
                        <a href="{{ route('blog.show', $featured->slug) }}" class="btn-primary inline-flex items-center">
                            Read Full Story
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Recent Posts Grid -->
        <h2 class="font-heading text-2xl font-bold text-primary mb-8 border-b border-gray-200 pb-2">Recent Articles</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <!-- Post -->
                <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $post->cover_image ? asset('storage/' . $post->cover_image) : 'https://via.placeholder.com/400x300' }}"
                            alt="{{ $post->title }}"
                            class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        @if ($post->category)
                            <span
                                class="text-xs font-bold text-secondary uppercase tracking-wider">{{ $post->category->name }}</span>
                        @endif
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <h3
                                class="font-heading text-xl font-bold text-primary mt-2 mb-3 hover:text-secondary cursor-pointer">
                                {{ $post->title }}</h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($post->content), 120) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}"
                            class="text-primary font-semibold text-sm hover:underline">Read More &rarr;</a>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">No articles found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
