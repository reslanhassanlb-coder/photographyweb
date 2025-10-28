@extends('layouts.master')
@section('pagetitle', 'Portfolio')
@section('content')
<main id="main">

    <!--  Breadcrumbs  -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Our Portfolio</h2>
              <p>Explore our diverse range of successful projects</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li>Our Portfolio</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <div class="single-page">
      <!-- Portfolio Section -->
      <section id="portfolio" class="portfolio section-grey">
        <div class="container" data-aos="fade-up">
          <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">
            <div>
              <ul class="portfolio-flters">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".filter-app">Digital Marketing</li>
                <li data-filter=".filter-product">Web Development</li>
                <li data-filter=".filter-branding">UI/UX Desing</li>
                <li data-filter=".filter-books">Production</li>
              </ul><!-- End Portfolio Filters -->
            </div>

            <div class="row gy-4 portfolio-container">

              <div class="col-xl-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-wrap">
                  <a href="assets/images/portfolio/dm-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/images/portfolio/dm-1.jpg" class="img-fluid" alt="A laptop displaying an analytics dashboard in a dimly lit room with a red ambient glow, representing digital marketing and data analysis."></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-xl-4 col-md-6 portfolio-item filter-product">
                <div class="portfolio-wrap">
                  <a href="assets/images/portfolio/app-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/images/portfolio/app-2.jpg" class="img-fluid" alt=""></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                <div class="portfolio-wrap">
                  <a href="assets/images/portfolio/ui-ux-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/images/portfolio/ui-ux-1.jpg" class="img-fluid" alt=""></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-xl-4 col-md-6 portfolio-item filter-books">
                <div class="portfolio-wrap">
                  <a href="assets/images/portfolio/production.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/images/portfolio/production.jpg" class="img-fluid" alt=""></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-xl-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-wrap">
                  <a href="assets/images/portfolio/dm-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/images/portfolio/dm-2.jpg" class="img-fluid" alt=""></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                <div class="portfolio-wrap">
                  <a href="assets/images/portfolio/ui-ux-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/images/portfolio/ui-ux-2.jpg" class="img-fluid" alt=""></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-xl-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-wrap">
                  <a href="assets/images/portfolio/dm-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/images/portfolio/dm-3.jpg" class="img-fluid" alt=""></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                <div class="portfolio-wrap">
                  <a href="assets/images/portfolio/ui-ux-3.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/images/portfolio/ui-ux-3.jpg" class="img-fluid" alt=""></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
                <div class="portfolio-wrap">
                  <a href="assets/images/portfolio/ui-ux-4.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/images/portfolio/ui-ux-4.jpg" class="img-fluid" alt=""></a>
                </div>
              </div><!-- End Portfolio Item -->
            </div><!-- End Portfolio Container -->

          </div>

        </div>
      </section><!-- End Portfolio Section -->
    </div>

  </main><!-- End #main -->
@endsection
