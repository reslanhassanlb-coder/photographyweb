<!-- Recent Blog Posts Section -->
<section id="recent-posts" class="recent-posts">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <h2>Blog Posts</h2>
        <p>Insights, Tips, and Trends for Engaging Content</p>
      </div>
      <div class="row gy-4">
        @foreach($posts as $post )
        <div class="col-lg-4">
          <article>
            <div class="post-img">
              <img src="{{asset( 'storage/app/public/'. $post->image)}}" alt="{{$post->image_alt}}" title="{{$post->image_alt}}" class="img-fluid">
            </div>
            <p class="post-category">{{ $post->name}}</p>
            <h2 class="title">
              <a href="{{route('blog-details',[$post->id,$post->category_id])}}">{{ $post->title}}</a>
            </h2>
            <div class="d-flex align-items-center justify-content-center">
              <div class="post-meta">
                <p class="post-author">{{ $post->author}}</p>
                <p class="post-date">
                    <time datetime="{{$post->created_at}}">{{ $post->created_at->format('M d, Y') }}</time>
                </p>
              </div>
            </div>
          </article>
        </div><!-- End post list item -->
        @endforeach
      </div><!-- End recent posts list -->
    </div>
  </section><!-- End Recent Blog Posts Section -->