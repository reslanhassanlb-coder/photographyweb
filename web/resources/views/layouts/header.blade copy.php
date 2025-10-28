
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg  fixed-top">
    <div class="container justify-content-right">


         <button class="navbar-toggler ms-auto"
            style="border: 2px solid orange !important;"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1);"></span>

        </button>


        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item px-3">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ Request::is('/#gallery') ? 'active' : '' }}"  href="{{ url('/#gallery') }}">Gallery</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ Request::is('/#services') ? 'active' : '' }}"  href="{{ url('/#services') }}">Services</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ Request::is('/#packages') ? 'active' : '' }}"  href="{{ url('/#packages') }}">Packages</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

  <!-- End Header -->
