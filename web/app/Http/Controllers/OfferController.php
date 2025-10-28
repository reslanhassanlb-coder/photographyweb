<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorProfile;
use App\Models\PackageBooking;
use App\Models\Package;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBookingNotification;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::all();

        $profile = VisitorProfile::where('visitor_uuid', session('visitor_uuid'))->first();

        $booking =  PackageBooking::where('visitor_uuid', session('visitor_uuid'))->first() ;


        return view('offers.index', compact('profile', 'packages','booking','packages'));
    }

    public function book(Request $request)
    {
        $visitor = VisitorProfile::where('email', session('user_email'))->first();
        $userEmail = $visitor?->email;

       // EMAIL CHECK: Ensure a valid user email exists before proceeding with the booking.
        if (empty($userEmail)) {
            // You can log the error or return a specific error message.
            return back()->with('error', 'Booking failed: Could not retrieve a valid user email.');
        }

        $booking = PackageBooking::create([
            'user_email' => $userEmail,
            'visitor_uuid' => session('visitor_uuid'),
            'package_id' => $request->package_id,
            'event_type' => $request->event_type,
            'date' => $request->event_date,
            'address' => $request->address,
            'notes' => $request->notes,
        ]);

        $booking->refresh();
        // SEND EMAIL NOTIFICATION TO YOUR ADMIN EMAIL
        try {
            // Replace 'your-admin-email@example.com' with your actual email address.
            // We pass the new booking object to the Mailable.

            Mail::to('reslanhassanlb@gmail.com')->send(new NewBookingNotification($booking));
        } catch (\Exception $e) {
            // Optional: Log the email error, but still let the user proceed since the booking was created.
            \Log::error("Failed to send new booking notification email: " . $e->getMessage());

        }

        //return back()->with('success', 'Your booking request was received!');
         return redirect()->route('booking.show')->with('msg', [
                'type' => 'success',
                'text' => 'Your booking request was received!',
            ]);
    }

    public function showMyBooking()
    {
        $profile = VisitorProfile::where('visitor_uuid', session('visitor_uuid'))->first();
        $visitorUuid = session('visitor_uuid');
        $email = session('user_email');

        if (!$visitorUuid) {
            return redirect('/')->with('error', 'Please log in to view your booking.');
        }

        //$booking = PackageBooking::where('visitor_uuid', $visitorUuid)->latest()->first();
        $booking = PackageBooking::where('user_email',  $email)->latest()->first();

        if (!$booking) {
            return redirect('/')->with('info', 'You don’t have any bookings yet.');
        }

        return view('offers.showbooking', compact('booking','profile'));
    }

    public function cancelBooking($id)
    {

        $booking = PackageBooking::findOrFail($id);

        if ($booking) {
            $booking->delete();
            //return redirect('/')->with('success', 'Your booking has been cancelled.');
            return response()->json(['success' => true]);
        }

       // return redirect('/')->with('info', 'You don’t have any bookings to cancel.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
