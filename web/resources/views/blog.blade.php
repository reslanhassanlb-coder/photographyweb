@extends('layouts.master')
@section('pagetitle', 'Blogs')
@section('content')

{{--Widget::RecentPosts()--}}
{{--@widget('RecentPosts', request('search')) --}}
<section id="blog-main-page" class="py-16" style="padding:150px 0 !important">
    <div class="container blog-page-layout">

        <div class="main-blog-content">

           @isset($searchQuery)

            <h1 class="section-title text-start mb-4">
                Search Results for: "<span style="color: var(--color-accent);">{{ $searchQuery }}</span>"
            </h1>
            <p class="mb-10 text-lg text-gray-600 text-center">
                {{ $allBlogs->total() }} articles found.
            </p>

            @elseif(isset($currentCategory))
            <h1 class="section-title text-start mb-4">
                {{ $currentCategory->name }} Posts
            </h1>
            <p class="mb-10 text-lg text-gray-600 text-center">
                Showing all articles in the **{{ $currentCategory->name }}** category.
            </p>
            @else
            <h1 class="section-title text-start mb-10">All Latest Stories</h1>
            @endisset
            <div class="blog-grid" id="all-blogs-grid">

                @forelse($allBlogs as $blog)
                <article class="blog-post">
                    <img src="{{ asset('storage/app/public/' . $blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
                    <div class="post-content">
                        <span class="post-category">{{ $blog->blogcategory->name }}</span>
                        <h3>{{ $blog->title }}</h3>
                        <p>{!! \Illuminate\Support\Str::limit($blog->description, 120) !!} </p>
                        <a href="{{ route('blog.show', [$blog->slug]) }}" class="read-more-link">

                        Read Article <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
                @empty
                <p class="col-span-full text-center text-lg text-gray-500">No blog posts found yet. Check back soon!</p>
                @endforelse

            </div>

            <div class="mt-12 text-center">
               {{ $allBlogs->links('pagination::bootstrap-5') }}
            </div>

        </div>

        <aside class="blog-sidebar">

            <div class="sidebar-widget search-widget">
                <h4 class="widget-title">Search Blog</h4>
                <form action="{{ route('blog.search') }}" method="GET">
                    <div class="search-box">
                        <input type="text" name="query" placeholder="Enter keywords..." required>
                        <button type="submit" class="search-btn" aria-label="Search"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>

            <div class="sidebar-widget categories-widget">
                <h4 class="widget-title">Categories</h4>
                <ul class="category-list">
                    @php
                       $isAllActive = !isset($currentCategory) && !isset($searchQuery);
                    @endphp
                    <li>
                        <a href="{{ route('blogs') }}" class="{{ $isAllActive ? 'active-category' : '' }}">
                            All Posts <span class="count">({{ $totalPostCount ??  0 }})</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                    @php
                        // Check if $currentCategory is set AND if its slug matches the current category in the loop
                        $isActive = (isset($currentCategory) && $currentCategory->slug === $category->slug);
                    @endphp
                    <li><a href="{{ route('blogs.category', $category->slug) }}" class="{{ $isActive ? 'active-category' : '' }}">{{ $category->name }} <span class="count">({{ $category->blogs_count }})</span></a></li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar-widget latest-posts-widget">
                <h4 class="widget-title">Featured Posts</h4>
                <div class="latest-posts-list">
                    @foreach($featuredBlogs as $blog)
                    <div class="post-item">
                        <img src="{{ asset('storage/app/public/' . $blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
                        <div class="post-item-content">
                            <span class="post-date">{{ $blog->created_at->format('M d, Y') }}</span>
                            <h5><a href="{{  route('blog-details', [$blog->id,$blog->blogcategory->id]) }}">{{ \Illuminate\Support\Str::limit($blog->title, 40) }}</a></h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </aside>

    </div>
</section>
@endsection

