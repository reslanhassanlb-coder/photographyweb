<div class="sticky-social-bar">
        <a href="https://www.facebook.com/hassanreslanphotography" target="_blank" rel="noopener" aria-label="Follow us on Facebook">
            <i class="fa fa-facebook-f"></i>
        </a>

        <a href="https://www.instagram.com/hassanreslanphotography" target="_blank" rel="noopener" aria-label="Follow us on Instagram">
            <i class="fab fa-instagram"></i>
        </a>

        <a href="https://wa.me/+96170837485" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <header id="main-header" style="background-color:{{(Request::is('my-booking') || Request::is('offers') || Request::is('blog') || Request::is('blog/*'))  ? 'black' : ''  }}">
        <div class="container nav-bar" >
            <a href="{{route('home')}}"><img src="{{asset('assets/images/hrlogo.png')}}" style="width:50px; height:50px;"></a>
            <nav id="main-nav-menu" >
                <ul>
                    <li><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                    <li><a class="nav-link {{ Request::is('/#gallery') ? 'active' : '' }}"  href="{{ url('/#gallery') }}">Gallery</a></li>
                    <li><a class="nav-link {{ Request::is('/#services') ? 'active' : '' }}"  href="{{ url('/#services') }}">Services</a></li>
                    <li><a class="nav-link {{ Request::is('/#packages') ? 'active' : '' }}"  href="{{ url('/#packages') }}">Packages</a></li>
                    <li><a class="nav-link {{ Request::is('/#blog') ? 'active' : '' }}"  href="{{ url('/#blog') }}">Blog</a></li>
                    <li><a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/#about') }}">About</a></li>
                    <li><a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ url('/#contact') }}">Contact</a></li>
                </ul>
            </nav>

            <!-- NEW DEDICATED MOBILE BOOKING PANEL (Hidden on desktop, slides in on mobile) -->

            <div id="mobile-booking-panel" class="mobile-panel {{session('user_email') ? '' : 'hidden' }}">
                <button id="booking-panel-close" class="mobile-panel-close" aria-label="Close Booking Panel">
                    &times; <!-- Use a simple 'x' or icon for closing -->
                </button>

                <div class="mobile-panel-content">
                    <!-- Re-use the notification content here -->
                    <h4>Current Booking Selection:</h4>

                   @if(@isset($booking))
                    <div class="flyout-body" style="color:white">
                        <p>You have **1 Booking** saved for inquiry.</p>
                        <p class="package-name">{{ $booking->package->title }} Package</p>
                        <p>Date: {{ date('F j, Y', strtotime($booking->date)) }}</p>
                    </div>
                    <div class="flyout-footer">
                        <a href="{{route('booking.show')}}" class="btn btn-sm btn-light">View Details</a>
                        <!--<a href="#contact" class="btn btn-sm btn-accent">Finalize Booking</a>-->
                    </div>
                    @else
                        <div class="flyout-body">
                        <p style="color:white">No Booking Found</p>
                    </div>
                    <div class="flyout-footer">
                        <a href="{{route('offers')}}" class="btn btn-sm btn-light">Book Now</a>
                        <!--<a href="#contact" class="btn btn-sm btn-accent">Finalize Booking</a>-->
                    </div>
                    @endif
                    <!-- End of Notification content -->
                </div>
            </div>
            <div class="user-access-container">
                <a href="#" class="nav-icon user-link" id="user-icon-toggle" aria-label="Login or Register">
                    <span class="icon-user-fix" style="margin-right:15px">
                        @if(session('user_email'))
                            @isset( $profile->avatar)
                            <img src="{{ $profile->avatar }}" alt="User Avatar" class="user-avatar">
                            @endisset
                            <img src="{{ asset('assets/images/user.png') }}" alt="User Avatar" class="user-avatar">
                            <span  class="user-email">{{ session('user_email') }}</span>
                            <i class="fa fa-caret-down fa-sm"></i>
                        @else
                            <i class="fa fa-user"></i>
                         @endif
                    </span>
                </a>

                <div class="user-flyout-panel" id="user-flyout-panel">
                    <div class="logged-out-state {{ session('user_email') ? 'hidden' : '' }}" id="logged-out-state">
                        <h4>Client Login</h4>
                        <form  id="login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="email" placeholder="Email" name="email"  required>
                            <input type="password" placeholder="Password" name="password" required>
                            <button type="submit" class="btn btn-accent btn-full">Log In</button>
                        </form>
                        <p class="register-text">New client? <a href="{{ route('register') }}">Register Here</a></p>

                    <div class="social-login-separator   text-center">
                        <span>OR</span>
                    </div>

                    <div class="social-login-buttons">

                        <button class="btn btn-social btn-google " onclick="startSocialLogin('google')">
                            <i class="fab fa-google mb-5"></i> Login with Google
                        </button>

                        <button class="btn btn-social btn-facebook" onclick="startSocialLogin('facebook')">
                            <i class="fab fa-facebook-f"></i> Login with Facebook
                        </button>

                    </div>
                    </div>

                    <div class="logged-in-state {{ session('user_email') ? '' : 'hidden' }}" id="logged-in-state">
                        <h5>Welcome Back, <span id="user-display-name">{{ session('user_email')}}</span>!</h5>
                        <!--<a href="#dashboard" class="btn btn-sm btn-light btn-full">View Dashboard</a>-->
                        <button id="logout-button" onclick="window.location.href='{{ route('logout') }}'" class="btn btn-sm btn-dark btn-full mt-10">Log Out</button>
                    </div>
                </div>
            </div>
            <div class="booking-flyout-container {{session('user_email') ? '' : 'hidden' }}">
            <a href="#" class="nav-icon booking-link" id="booking-icon-toggle" aria-label="Book a photography session">
                <span class="icon-calendar-fix">
                    <i class="fa fa-calendar-alt"></i>
                </span>
                <span class="booking-count">
                    @if(@isset($booking))
                        {{ 1 }}
                    @else
                        {{ 0 }}
                    @endif
                </span>
            </a>

            <div class="booking-flyout-panel" id="booking-flyout-panel">
                <div class="flyout-header">
                    <h4>Your Current Selections</h4>
                </div>
                @if(@isset($booking))
                <div class="flyout-body">
                    <p>You have **1 Booking** saved for inquiry.</p>
                    <p class="package-name">{{ $booking->package->title }} Package</p>
                     <p>Date: {{ date('F j, Y', strtotime($booking->date)) }}</p>
                </div>
                <div class="flyout-footer">
                    <a href="{{route('booking.show')}}" class="btn btn-sm btn-light">View Details</a>
                    <!--<a href="#contact" class="btn btn-sm btn-accent">Finalize Booking</a>-->
                </div>
                @else
                    <div class="flyout-body">
                    <p>No Booking Found</p>
                </div>
                 <div class="flyout-footer">
                    <a href="{{route('offers')}}" class="btn btn-sm btn-light">Book Now</a>
                    <!--<a href="#contact" class="btn btn-sm btn-accent">Finalize Booking</a>-->
                </div>
                @endif

            </div>
        </div>
            <div class="menu-toggle" id="menu-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </header>
