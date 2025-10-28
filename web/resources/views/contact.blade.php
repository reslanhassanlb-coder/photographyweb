@extends('layouts.master')
@section('pagetitle', 'Contact Us')
@section('content')
<!-- Hero Header -->
  <header class="contact-header">
    <h1>Get in Touch</h1>
  </header>

  <!-- Contact Section -->
  <section class="py-5">
    <div class="container">
      <div class="row g-5">
        <div class="col-md-6">
           @if (\Session::has('msg'))
            <div class="alert alert-success alert-dismissable alert-dismissable">
                <ul style="padding-left: 10px">
                    <li>{!! \Session::get('msg') !!}</li>
                </ul>
            </div>
            @endif

          <h2 class="mb-4">Let's Work Together</h2>
          <form class="contact-form"  method="post" action="{{route('sendmail')}}">
              @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required />
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Your Message</label>
              <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-brand">Send Message</button>

          </form>
        </div>
        <div class="col-md-6">
          <h3 class="mb-4">Visit the Studio</h3>
          <div class="ratio ratio-4x3">
            <!--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6658.753636932342!2d35.40519942829592!3d33.43948792958121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slb!4v1750171521143!5m2!1sen!2slb" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>-->
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d6658.480164692658!2d35.40665855!3d33.44305109999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzPCsDI2JzE1LjkiTiAzNcKwMjQnNTQuMSJF!5e0!3m2!1sen!2slb!4v1750174384534!5m2!1sen!2slb" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
