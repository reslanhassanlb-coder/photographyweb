@extends('layouts.master')
@section('pagetitle', 'Hassan Reslan Photography | Gallery')
@section('content')

<!-- Back to Top Button -->

<!--<button id="backToTop" class="btn btn-brand rounded-circle shadow">
  <i class="fas fa-chevron-up"></i>
</button>-->
 <section id="hero" style="background-image: url('https://images.pexels.com/photos/2959192/pexels-photo-2959192.jpeg?_gl=1*v5bjb9*_ga*NDIwNDY0MzczLjE3NjA1MTYxOTY.*_ga_8JE65Q40S6*czE3NjA1MjMwMDMkbzIkZzEkdDE3NjA1MjM1MjIkajMyJGwwJGgw');">
    <div class="container hero-content">
        <h1 class="animate-on-scroll">Capturing Timeless Moments in Lebanon</h1>
        <p class="animate-on-scroll" style="animation-delay: 0.1s;">Wedding & Event Photographer specializing in creativity and professionalism.</p>
        <a href="#gallery" class="btn btn-ghost animate-on-scroll" style="animation-delay: 0.2s;">View Portfolio</a>
        <a href="#packages" class="btn btn-ghost-offer animate-on-scroll" style="animation-delay: 0.2s;">Offers</a>
    </div>
</section>
<section id="why-choose">
        <div class="container">
            <h2 class="text-center animate-on-scroll">Why Choose Hassan Reslan Photography?</h2>
            <div class="why-choose-grid">
                <div class="card card-hover animate-on-scroll">
                    <span class="icon">📷</span>
                    <h3>Professional Expertise</h3>
                    <p>Years of experience ensuring every moment is captured with precision and creativity.</p>
                </div>
                <div class="card card-hover animate-on-scroll">
                    <span class="icon">✨</span>
                    <h3>Personalized Approach</h3>
                    <p>We tailor the photography experience to your unique style, vision, and personality.</p>
                </div>
                <div class="card card-hover animate-on-scroll">
                    <span class="icon">💎</span>
                    <h3>High-Quality Deliverables</h3>
                    <p>Stunning, high-resolution edited photos presented in elegant, polished albums.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="about" class="bg-light">
        <div class="container">

            <h2 class="text-center">The Vision Behind the Lens</h2>

            <p class="text-center" style="font-size: 1.25rem; max-width: 700px; margin: 15px auto 60px;">
                "Capturing the fleeting moment, preserving the genuine feeling, crafting timeless art."
            </p>

            <div class="about-grid">

                <div class="about-story animate-on-scroll">
                    <h3>My Journey</h3>
                    <p>
                        My name is Hassan Reslan, and photography isn't just a career it's the language I use to express the world's beauty. It began as a simple passion ten years ago, observing how light interacts with texture and emotion. Today, it has grown into a commitment to documenting life's most precious and unrepeatable chapters.
                    </p>
                    <p>
                        I specialize in **candid and editorial style** photography, focusing less on rigid posing and more on authentic moments. Every click of the shutter is aimed at capturing the real, unfiltered story of your day, resulting in a collection of images that feel deeply personal and timelessly elegant.
                    </p>
                    <a href="#contact" class="btn" style="margin-top: 10px;">Let's Discuss Your Vision</a>
                </div>

                <div class="about-image animate-on-scroll">
                    <img src="{{ asset('assets/images/bw.jpg') }}" alt="Hassan Reslan behind the camera" loading="lazy">
                </div>

                <div class="about-philosophy animate-on-scroll">
                    <h3>My Philosophy</h3>
                    <ul class="philosophy-list">
                        <li>
                            <span class="icon">&#10003;</span>
                            <div class="text-content">
                                <h4>Timeless Elegance</h4>
                                <p>We avoid fleeting trends, prioritizing classic compositions and clean editing for images that never age.</p>
                            </div>
                        </li>
                        <li>
                            <span class="icon">&#10003;</span>
                            <div class="text-content">
                                <h4>Authentic Storytelling</h4>
                                <p>Your comfort is paramount. We focus on natural light and candid moments to draw out genuine emotion.</p>
                            </div>
                        </li>
                        <li>
                            <span class="icon">&#10003;</span>
                            <div class="text-content">
                                <h4>Dedicated Craftsmanship</h4>
                                <p>From the initial consultation to final print delivery, every step is handled with meticulous attention to detail.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <section id="services" class="bg-light">
        <div class="container">
            <h2 class="text-center animate-on-scroll">Our Core Services</h2>
            <div class="services-grid">
                <div class="service-card card-hover animate-on-scroll">
                    <img src="{{asset('assets/images/wedding.jpg')}}"  alt="Wedding Photography Lebanon" title="Wedding Photography Lebanon" loading="lazy">
                    <h3>Wedding Photography</h3>
                    <p>Capturing your special day with creativity and emotion. From candid moments to elegant portraits, we create timeless memories of your wedding.</p>
                </div>
                <div class="service-card card-hover animate-on-scroll">
                    <img src="{{asset('assets/images/engagement.jpg')}}" alt="Engagement Photography Lebanon" title="Engagement Photography Lebanon" loading="lazy">
                    <h3>Engagement Photography</h3>
                    <p>Celebrate your love with stunning engagement photos in Lebanon. Our team captures the essence of your relationship in beautiful, romantic images.</p>
                </div>
                <div class="service-card card-hover animate-on-scroll">
                    <img src="{{asset('assets/images/events.jpg')}}" alt="Event Photography Lebanon" title="Event Photography Lebanon" loading="lazy">
                    <h3>Event Photography</h3>
                    <p>Professional coverage for birthdays, corporate events, and special occasions. We ensure every important moment is documented with style.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="packages">
        <div class="container">
            <h2 class="text-center animate-on-scroll">Choose Your Photography Package</h2>

            <div class="pricing-grid">
                @foreach($packages as $package)
                    <div class="package-card card-hover {{ $package->recommended ? 'package-premium' : '' }} animate-on-scroll">
                        @if($package->recommended)
                        <div class="recommended-tag">Recommended</div>
                        @endif
                        <h4>{{ $package->title}}</h4>
                        <div >
                            <p class="price package-price" style="text-decoration:line-through; color: {{ $package->recommended ? 'white' : 'black' }};">${{ number_format($package->price,0)}}</p>
                            <p class="price package-offer" style="color: {{ $package->recommended ? 'white !important' : 'black' }};">${{ number_format($package->offer_price,0)}}</p>
                        </div>

                        <ul class="features">
                            @foreach($package->features as $feature)
                                <li><span class="check">✓</span>{{ $feature['feature'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            @if(session('user_email'))
                @php
                $booking = \App\Models\PackageBooking::where('user_email', session('user_email'))->first();
                @endphp

                @if($booking)
                <div class="cta-booking text-center animate-on-scroll">
                    <p style="color:green; font-weight:bold;">You already have a booking!</p>
                    <button onclick="window.location.href='{{ route('booking.show') }}'" style="margin:5px; padding:10px 20px; background:#db4437; color:#fff; border:none; border-radius:5px; cursor:pointer;">Check Your Booking</button>
                    <button onclick="window.location.href='{{ route('logout') }}'" style="margin:5px; padding:10px 20px; background:#4267B2; color:#fff; border:none; border-radius:5px; cursor:pointer;">Logout</button>
                </div>
                @else
                <div class="cta-booking text-center animate-on-scroll">
                    <p style="color:red; font-weight:bold;">You have not booked yet. Please book now!</p>
                    <button onclick="window.location.href='{{ route('offers') }}'" style="margin:5px; padding:10px 20px; background:#db4437; color:#fff; border:none; border-radius:5px; cursor:pointer;">Book Now</button>
                    <button onclick="window.location.href='{{ route('logout') }}'" style="margin:5px; padding:10px 20px; background:#4267B2; color:#fff; border:none; border-radius:5px; cursor:pointer;">Logout</button>
                </div>
                @endif
            @else
                <div class="cta-booking text-center animate-on-scroll">
                    <p style="margin-bottom: 20px;">Want a personalized offer? Sign in to get a special offer.</p>
                    <a href="{{ route('login') }}" class="btn" >Login</a>
                </div>
            @endif
        </div>
    </section>

    {{Widget::Gallary()}}

    <section id="testimonials" class="bg-light">
        <div class="container text-center">
            <h2 class="section-heading">Client Love</h2>
            <p class="section-subheading">Don't just take my word for it. Hear what my clients have to say!</p>

            <div class="testimonial-grid">

                <div class="testimonial-card animate-on-scroll">
                    <p class="quote">
                        "Hassan captured the genuine joy and chaos of our wedding day perfectly. The photos are candid, beautiful, and absolutely timeless. We felt so comfortable having him around!"
                    </p>
                    <p class="client-name">— Maya & Elias, Wedding Clients</p>
                </div>

                <div class="testimonial-card animate-on-scroll">
                    <p class="quote">
                        "The portrait session was professional yet relaxed. Hassan has a keen eye for light and texture. The final images exceeded every expectation. Highly recommend!"
                    </p>
                    <p class="client-name">— Sarah K., Portrait Session</p>
                </div>

                <div class="testimonial-card animate-on-scroll">
                    <p class="quote">
                        "We hired Hassan for our corporate event, and his ability to document key moments while staying unobtrusive was remarkable. Fast delivery and stunning quality."
                    </p>
                    <p class="client-name">— Global Events Management</p>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================================== -->
    <!-- BLOG SECTION (NEW BLOCK) -->
    <!-- ======================================== -->
    <section id="blog" class="animate-on-scroll">
        <div class="container">
            <h2 class="section-title">Latest Stories & Tips</h2>
            <p class="section-subtitle">A behind-the-scenes look at our work, photography tips, and client spotlights.</p>

            <div class="blog-grid">

                @foreach($blogs as $blog)
                @if($blog->display_in_home)

                <article class="blog-post animate-on-scroll">
                    <img src="{{ asset('storage/app/public/' . $blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
                    <div class="post-content">
                        <span class="post-category">{{ $blog->blogcategory->name }}</span>
                        <h3>{{ $blog->title }}</h3>
                        <p>{!! \Illuminate\Support\Str::words($blog->description, 30, '...') !!} </p>
                        <a href="{{route('blog.show',$blog->slug)}}" class="read-more-link">Read Article <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
                @endif
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{route('blogs')}}" class="cta-button primary-cta" style="margin-top: 20px;">View All Blog Posts</a>
            </div>
        </div>
    </section>
    <!-- END BLOG SECTION -->
    <section id="contact" class="bg-dark">
        <div class="container">
            <div class="login-register-mobile-block">

                <h2>Client Access</h2>
                <p class="description {{ session('user_email') ? 'hidden' : '' }}">Log in to view saved packages or register to begin your booking.</p>

                <div class="logged-out-state-mobile {{ session('user_email') ? 'hidden' : '' }}">
                    <form id="login-form-mobile" method="POST" action="{{ route('login') }}">
                         @csrf
                        <input type="email" placeholder="Email"  name="email" required>
                        <input type="password" placeholder="Password" name="password" required>
                        <button type="submit" class="btn btn-accent btn-full">Log In</button>
                    </form>

                    <div class="social-login-separator"><span>OR</span></div>
                    <div class="social-login-buttons" style="text-align: center;">
                        <button class="btn btn-social btn-google" onclick="startSocialLogin('google')"><i class="fab fa-google"></i> Login with Google</button>
                        <button class="btn btn-social btn-facebook" onclick="startSocialLogin('facebook')"><i class="fab fa-facebook-f"></i> Login with Facebook</button>
                    </div>
                    <p class="register-text">New client? <a href="{{ route('register') }}">Register Here</a></p>
                </div>

                <div class="logged-in-state-mobile {{ session('user_email') ? '' : 'hidden' }}">
                    <h4>Welcome Back!</h4>
                    <!--<a href="#dashboard" class="btn btn-sm btn-light btn-full">View Dashboard</a>-->
                    <button onclick='window.location.href="{{route("logout")}}"' id="logout-button-mobile" class="btn btn-sm btn-dark btn-full mt-10">Log Out</button>
                </div>
            </div>

            <h2 class="text-center text-white">Let's Create Together</h2>

            <p class="text-center text-light" style="font-size: 1.15rem; max-width: 700px; margin: 15px auto 60px;">
                Ready to book your session or just have a question? Fill out the form below or reach out directly.
            </p>

            <div class="contact-grid">

                <div class="contact-form-wrapper animate-on-scroll">
                    <form action="{{route('sendmail')}}" method="POST" class="contact-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" required placeholder="Full Name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required placeholder="name@example.com" required>
                        </div>

                        <!--<div class="form-group">
                            <label for="subject">Subject / Session Type</label>
                            <input type="text" id="subject" name="subject" placeholder="e.g., Wedding, Portrait, Commercial">
                        </div>-->

                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" rows="5" required placeholder="Write your message here..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-accent">Send Message</button>
                    </form>
                </div>

                <div class="contact-info-wrapper animate-on-scroll">

                    <div class="contact-details">
                        <h3>Contact Details</h3>
                        <p><strong><i class="fas fa-envelope"></i></strong> <a href="mailto:info@hassanreslan.com">reslanhassanlb@gmail.com</a></p>
                        <p><strong><i class="fas fa-phone-alt"></i></strong> <a href="tel:+96170837485">+961 70837485</a></p>
                        <p><strong><i class="fas fa-map-marker-alt"></i></strong> Zefta - Nabatieh Main Road, Lebanon</p>
                    </div>
                    <div class="map-placeholder">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d6658.480164692658!2d35.40665855!3d33.44305109999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzPCsDI2JzE1LjkiTiAzNcKwMjQnNTQuMSJF!5e0!3m2!1sen!2slb!4v1750174384534!5m2!1sen!2slb"
                            width="100%"
                            height="400"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Map to Beirut Studio Location">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@if(session('msg'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: '{{ session('msg')['type'] ?? 'success' }}',
                title: '{{ session('msg')['text'] ?? '' }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        });
    </script>
@endif

