@extends('layouts.master')
@section('pagetitle', 'My Booking')
@section('content')

<style>
.profile-container {
  display: flex;
  justify-content: center; /* horizontal center */
  align-items: center;      /* vertical center */
  height: 100vh;            /* full viewport height */
  background: #f9f9f9;      /* optional background */
}

.profile-info {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 40px auto; /* centers horizontally */
  gap: 15px;
  padding: 10px 20px;
}
.profile-info .avatar img {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  object-fit: cover;
  border: 1px solid #ccc;
}

.profile-info .info p {
  margin: 0;
  color: #555;
  font-size: 1rem;
}
.booking-card {
  max-width: 600px;
  margin: 20px auto;
  background: #fff;
  border: 1px solid #eee;
  border-radius: 16px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  padding: 20px 25px;
  font-family: "Poppins", sans-serif;
  color: #333;
}

.booking-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
  border-bottom: 1px solid #f0f0f0;
  padding-bottom: 10px;
}

.booking-header h3 {
  margin: 0;
  font-size: 1.4rem;
  color: #222;
}

.status {
  font-size: 0.9rem;
  padding: 5px 10px;
  border-radius: 8px;
  font-weight: 500;
}

.status.upcoming {
  background: #e8f8ec;
  color: #28a745;
}

.status.past {
  background: #f2f2f2;
  color: #777;
}

.booking-section h4 {
  margin: 10px 0 5px;
  font-size: 1.1rem;
  color: #444;
}

.booking-section p {
  color: #555;
  font-size: 0.95rem;
  line-height: 1.5;
  background: #fafafa;
  padding: 10px;
  border-radius: 8px;
}

.booking-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px 20px;
  margin-top: 15px;
}

.booking-grid div {
  background: #fcfcfc;
  padding: 8px 10px;
  border-radius: 8px;
  border: 1px solid #f0f0f0;
}

.booking-price {
  margin-top: 20px;
  text-align: right;
}

.booking-price .old-price {
  text-decoration: line-through;
  color: #999;
  margin: 0;
}

.booking-price .offer-price {
  color: #B8860B;
  font-weight: bold;
  font-size: 1.2rem;
  margin: 5px 0 0;
}
.status {
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: bold;
    font-size: 0.8em;
    color: white; /* Default text color */
    display: inline-block;
}

/* 🟢 Approved */
.status-approved {
    background-color: #4CAF50; /* Green */
}

/* 🟠 Pending */
.status-pending {
    background-color: #FF9800; /* Orange/Amber */
}

/* 🔴 Rejected */
.status-rejected {
    background-color: #F44336; /* Red */
}

/* ⚪ Missed (Pending, but date is in the past) */
.status-missed {
    background-color: #607D8B; /* Grey/Blue-Grey */
    color: #CFD8DC; /* Lighter text for contrast */
}

/* Fallback */
.status-default {
    background-color: #9E9E9E; /* Grey */
}
</style>
<div class="container" style="max-width:800px; margin-top:100px;">
    <h2 style="text-align:center; color:#B8860B;">My Booking Details</h2>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif


    @if($profile && $profile->avatar)
    <div class="profile-info">
        <div class="avatar">
            <img src="{{ $profile->avatar }}" alt="avatar">
        </div>
        <div class="info">
            <p>{{ $profile->email }}</p>
        </div>
    </div>
    @endif
   <div class="booking-card">
        <div class="thank-text">
            <h2 >🎉 Thank You for Your Booking!</h2>
            <!--<p>We’re excited to be part of your special day.</p>-->
            <p>
                @switch(strtolower($booking->status))
                    @case('approved')
                        Great News! Your booking has been **approved**! We look forward to creating an amazing experience for you.
                        @break

                    @case('rejected')
                        We appreciate your interest. Unfortunately, your booking has been **rejected** . Please contact us for alternative arrangements.
                        @break

                    @case('pending')
                    @default
                        We’ve received your request! Your booking is currently **pending review**. We’ll get back to you within 24-48 hours with confirmation.
                        @break
                @endswitch
            </p>
        </div>
        <div class="booking-header">
            <h3>- {{ $booking->package['title'] }} Package -</h3>
            <span class="status {{ $booking->statusClass }}">
                {{ ucfirst($booking->status) }}
            </span>
        </div>

        <div class="booking-section">
            <h4>Package Details</h4>
            <p>
            @foreach($booking->package['features'] as $feature)
                {{ $feature['feature'] }} /
            @endforeach
            </p>
        </div>
        <div class="booking-grid">
            <div><strong>Event Type:</strong> {{ ucfirst($booking->event_type) }}</div>
            <div><strong>Event Date:</strong> {{ date('F j, Y', strtotime($booking->date)) }}</div>
            <div><strong>Notes:</strong> {{ $booking->notes ?? '—' }}</div>
        </div>

        <div class="booking-price">
            <p class="old-price">Price: {{ number_format($booking->package['price'], 0) }}$</p>
            <p class="offer-price">Offer Price: {{ number_format($booking->package['offer_price'], 0) }}$</p>
        </div>
    </div>

    <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
       <!-- <a href="{{ route('booking.cancel', $booking->id) }}" class="btn btn-danger cancel-booking">Cancel</a>-->
       <button type="button" class="btn btn-sm btn-danger cancel-booking" data-id="{{ $booking->id }}">
            Cancel
        </button>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cancelButtons = document.querySelectorAll('.cancel-booking');

        cancelButtons.forEach(button => {
        button.addEventListener('click', function () {
            const bookingId = this.getAttribute('data-id');
            const token = document.querySelector('meta[name="csrf-token"]').content;
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to cancel your booking.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, cancel it',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit request via form or AJAX
                    fetch(`/booking/${bookingId}`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json',
                        },
                            body: JSON.stringify({ _method: 'PATCH' }) // tell Laravel to treat it as PATCH
                    }).then(response => {
                        if (response.ok) {
                            Swal.fire(
                                'Cancelled!',
                                'Your booking has been cancelled.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        }
                    });
                    }
                });
            });
        });
    });
</script>
