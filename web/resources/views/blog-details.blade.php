@extends('layouts.master')
@section('pagetitle', 'Blog Details')
@section('content')

<section id="blog-details" class="py-20" style="padding:150px 0 !important">
    <div class="container blog-page-layout">

        <div class="main-article-content">

            <div class="article-header">
                <span class="post-category">{{ $blog->blogcategory->name }}</span>
                <h1 class="article-title">{{ $blog->title }}</h1>
                <div class="article-meta">
                    <span class="meta-item"><i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                    <span class="meta-item"><i class="fas fa-user"></i> By {{ $blog->author->name ?? 'Admin' }}</span>
                </div>
            </div>

            <div class="article-featured-image mb-8">
                <img src="{{ asset('storage/app/public/' . $blog->image) }}" alt="{{ $blog->title }}" loading="eager">
            </div>

           <div class="article-body" style="white-space: pre-wrap; font-family: monospace; padding: 20px; background-color: #f4f4f4;">
                {!! $blog->description !!}
            </div>

            <div class="article-footer-meta mt-10 border-t pt-5">

                <div class="article-tags">
                    @if($blog->tags->count())
                        <strong>Tags:</strong>
                        @foreach($blog->tags as $tag)
                            <a href="{{ route('blogs.tag', $tag->slug) }}" class="tag-link">{{ $tag->name }}</a>
                        @endforeach
                    @endif
                </div>

                <div class="social-share-buttons">
                    <strong>Share:</strong>
                    {{-- Replace with actual URL logic for sharing --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="share-btn facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($blog->title) }}" target="_blank" class="share-btn twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}&media={{ asset('storage/app/public/' . $blog->image) }}" target="_blank" class="share-btn pinterest"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>

            {{-- <div class="author-box mt-10">...</div> --}}
            <div class="back-to-blogs-container mt-12 pt-6 border-t border-gray-200">
                <a href="{{ route('blogs') }}" class="back-to-blogs-link">
                    <i class="fas fa-arrow-left"></i> Back to All Blog Posts
                </a>
            </div>
        </div>

        <aside class="blog-sidebar">

            <div class="sidebar-widget latest-posts-widget">
                <h4 class="widget-title">More in {{ $blog->blogcategory->name }}</h4>
                <div class="latest-posts-list">
                    @forelse($relatedBlogs as $related)
                    <div class="post-item">
                        <img src="{{ asset('storage/app/public/' . $related->image) }}" alt="{{ $related->title }}" loading="lazy">
                        <div class="post-item-content">
                            <span class="post-date">{{ $related->created_at->format('M d, Y') }}</span>
                            <h5><a href="{{ route('blog.show', $related->slug) }}">{{ \Illuminate\Support\Str::limit($related->title, 40) }}</a></h5>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500">No related posts found.</p>
                    @endforelse
                </div>
            </div>

            {{-- @include('partials.blog-sidebar', ['categories' => $categories, 'featuredBlogs' => $featuredBlogs]) --}}

        </aside>

    </div>
</section>
{{-- Widget::BlogDetails() --}}

@endsection


