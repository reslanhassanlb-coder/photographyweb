<x-mail::message>
# New Booking Received!

A new package booking has been submitted. Here are the details:

<x-mail::table>
| Detail | Value |
| :------------- | :------------- |
| **Client Email** | {{ $booking->user_email }} |
| **Package** | {{ $booking->package['title'] }} |
| **Event Type** | {{ $booking->event_type }} |
| **Date** | {{ \Carbon\Carbon::parse($booking->date)->format('F jS, Y') }} |
| **Address** | {{ $booking->address }} |
| **Current Status** | **{{ strtoupper($booking->status) }}** |
</x-mail::table>

**Notes from Client:**
{{ $booking->notes ?? 'None provided.' }}

<x-mail::button :url="route('booking.show')">
View All Bookings
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Automated System
</x-mail::message>
