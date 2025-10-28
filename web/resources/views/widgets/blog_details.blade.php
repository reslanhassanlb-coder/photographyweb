<main id="main">

    <!--  Breadcrumbs  -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center">
        <div class="container position-relative">
          <h2 class="text-center">

          </h2>
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('blogs')}}">Blogs</a></li>
            <li>Blog Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <section class="single-page">
      <div class="container" data-aos="fade-up">
        {{ Widget::Posts()}}
        <div class="col-lg-4">
          <div class="blog-sidbar">
            <div class="search-form">
                <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="row">
              <div class="col-lg-4"><img src="assets/images/blog/blog-1.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
              <div class="col-lg-4"><img src="assets/images/blog/blog-2.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
              <div class="col-lg-4"><img src="assets/images/blog/blog-3.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
              <div class="col-lg-4"><img src="assets/images/blog/blog-4.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
              <div class="col-lg-4"><img src="assets/images/blog/blog-5.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
              <div class="col-lg-4"><img src="assets/images/blog/blog-6.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
              <div class="col-lg-4"><img src="assets/images/blog/blog-2.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
              <div class="col-lg-4"><img src="assets/images/blog/blog-4.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
              <div class="col-lg-4"><img src="assets/images/blog/blog-5.jpg" class="img-fluid rounded-4 mb-4" alt=""></div>
             
            </div>
            <hr/>
            <h3>Top Posts</h3>
            <ul>
               {{ Widget::LatestPosts()}}
            </ul>
            <hr/>
            <h3>Categories</h3>
            <ul>
             {{ Widget::CategoriesList()}}
            </ul>
          </div>
        </div>
      </div>
      </div>
    </section>

  </main><!-- End #main --> 
