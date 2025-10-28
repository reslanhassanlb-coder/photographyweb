@extends('layouts.master')
@section('pagetitle', 'About Us')
@section('content')
<!-- Hero Section -->
  <section class="about-header">
    <h1>About Me</h1>
  </section>

  <!-- About Content -->
  <section class="about-section">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <img src="{{asset('assets/images/bw.jpg')}}" alt="Hassan Reslan photographing a wedding couple" class="img-fluid about-img" />
        </div>
        <div class="col-lg-6">
          <h2>Hello, I’m Hassan Reslan</h2>
          <p class="mb-3">I’m a passionate photographer with over <span class="highlight">10 years</span> of experience capturing timeless moments in weddings, engagements, and lifestyle portraits. My approach is creative, storytelling, and focused on real emotions.</p>
          <p>I believe photography is not just about taking pictures, it’s about <span class="highlight">preserving memories</span>. Whether it's a quiet look between newlyweds or the excitement of a big celebration, I strive to capture it authentically and artistically.</p>
          <p class="mt-4"><strong>📍 Based in Zefta, Lebanon | Available worldwide</strong></p>
        </div>
      </div>
    </div>
  </section>
@endsection

