@extends('layouts.master')

@section('content')
<main id="main">

    <!--  Breadcrumbs  -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center">>
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>People Love Us</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing elit</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Testimonials</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <div class="single-page">

        <!-- Testimonials Section -->
    <section class="testimonials">
      <div class="container" data-aos="fade-up">
        <div class="" data-aos="fade-up" data-aos-delay="100">
          <div class="">

            <div class="">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <div class="d-flex align-items-center info-box">
                    <img src="assets/images/testimonials/testimonial-1.jpg" class="testimonial-img flex-shrink-0"
                      alt="">
                    <div>
                      <h3>Jhone Doe</h3>
                      <h4>CFO</h4>
                      <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                          class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                    </div>
                  </div>
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.
                    Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam.
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->

  </div>

  </main><!-- End #main -->
@endsection
