@extends('layouts.master')
@section('pagetitle', 'Special Photography Offers')
@section('content')
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f6f8fb;
  }
.offers-section {
    text-align: center;
    padding: 30px 20px;
  }
  .offers-header {
    color: #B8860B;
    font-size: 2.5rem;
    font-weight: 700;
    text-align:center;
    padding: 10px 0px;
  }
  .profile-info {
    margin: 20px 0;
  }
  .profile-info img {
    width: 80px;
    border-radius: 50%;
  }


  .book-btn {
    display: inline-block;
    background: #B8860B;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 30px;
    cursor: pointer;
    transition: 0.3s;
  }
  .book-btn-rec {
    display: inline-block;
    background: white;
    color: #B8860B;
    border: none;
    padding: 10px 20px;
    border-radius: 30px;
    cursor: pointer;
    transition: 0.3s;
  }
  .book-btn:hover {
    background: black;
  }
  .book-btn-rec:hover {
    background: black;
    color:white;
  }
  /* Modal */
  .modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
  }
  .modal.active { display: flex; }
  .modal-content {
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    width: 90%;
    max-width: 400px;
    text-align: left;
  }
  .modal-content h3 {
    color: black;
  }
  .modal-content input, .modal-content select, .modal-content textarea {
    width: 100%;
    margin-bottom: 12px;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ddd;
  }
  .modal-content button {
    background: black;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
  }
</style>

<section class="offers-section">

</section>

<!-- Booking Modal -->
<div id="bookingModal" class="modal">
  <div class="modal-content">
    <h3>Book Your Package</h3>
    <form action="{{ route('offers.book') }}" method="POST">
      @csrf
      <input type="hidden" name="package" id="selectedPackage">
      <input type="hidden" name="package_id" id="packageId">
      <select name="event_type" required>
        <option value="">Event Type</option>
        <option value="Wedding">Wedding</option>
        <option value="Engagement">Engagement</option>
        <option value="Other">Other</option>
      </select>
      <input type="text" id="address" name="address"
       value="{{ old('address') }}"
       placeholder="123 Main Street, Beirut, Lebanon"
       class="mt-1 block w-full border rounded-md p-2" required>
      <input type="date" name="event_date"  min="{{ now()->toDateString() }}" required>
      <textarea name="notes" placeholder="Any notes..." rows="3"></textarea>
      <div style="text-align:right;">
        <button type="submit">Confirm Booking</button>
        <button type="button" style="background:#ccc;" onclick="closeModal()">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- Packages Section -->
<section id="packages">
    <div class="container">
        <h2 class="offers-header">Welcome {{ $profile->name ?? 'Guest' }}</h2>
        <h2 class="text-center animate-on-scroll">Choose Your Photography Package</h2>

        <div class="pricing-grid">
            @foreach($packages as $package)
                <div class="package-card card-hover {{ $package->recommended ? 'package-premium' : '' }} animate-on-scroll">
                    @if($package->recommended)
                    <div class="recommended-tag">Recommended</div>
                    @endif
                    <h4>{{ $package->title}}</h4>
                    <div>
                        <p class="price package-price" style="color: {{ $package->recommended ? 'white' : 'black' }};">${{ number_format($package->price,0)}}</p>
                        <p class="price package-offer" style="color: {{ $package->recommended ? 'white !important' : 'black' }};">${{ number_format($package->offer_price,0)}}</p>
                    </div>
                    <button class="{{ $package->recommended ? ' book-btn-rec' : 'book-btn' }} " onclick="openModal('{{ $package['title'] }}',{{$package->id}})">Book Now</button>
                    <ul class="features">
                        @foreach($package->features as $feature)
                            <li><span class="check">✓</span>{{ $feature['feature'] }}</li>
                        @endforeach
                    </ul>

                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- end packages section -->
<script>
  function openModal(packageName,packageId) {
    document.getElementById('selectedPackage').value = packageName;

    document.getElementById('packageId').value = packageId;
    document.getElementById('bookingModal').classList.add('active');
  }
  function closeModal() {
    document.getElementById('bookingModal').classList.remove('active');
  }
</script>
@endsection
