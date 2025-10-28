<main id="main">

    <!--  Breadcrumbs  -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center">>
        <div class="container position-relative">
          <h2 class="text-center">Our Blogs</h2>
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <div class="search-form">
                  <form action="{{ route('search')}}" method="POST">
                    @csrf
                      <input type="text" name="search" placeholder="Search...">
                      <button><i class="fa fa-search"></i></button>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li>Our Blogs</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <section class="single-page">
      <div class="container" data-aos="fade-up">
        <!-- Recent Blog Posts Section -->
        <div id="recent-posts" class="recent-posts">
          <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                @foreach ($posts as $post)
                <div class="col-lg-4">
                    <article>
                      <div class="post-img">
                        <!--<img src="assets/images/blog/blog-1.jpg" alt="" class="img-fluid">-->
                        <img src="{{asset( 'storage/app/public/'. $post->image)}}" alt="{!! $post->image_alt !!}" title="{{$post->image_alt}}" class="img-fluid">
                      </div>
                      {{$post->image_alt}}
                      <p class="post-category">{{$post->name}}</p>
                      <h2 class="title">
                        <a href="{{route('blog-details',[$post->id,$post->category_id])}}">{{$post->title}}</a>
                      </h2>
                      <div class="d-flex align-items-center justify-content-center">
                        <div class="post-meta">
                          <p class="post-author">{{$post->author}}</p>
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
        </div><!-- End Recent Blog Posts Section -->
      </div>
    </section>

  </main><!-- End #main -->
