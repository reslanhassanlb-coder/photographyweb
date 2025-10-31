<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\VisitorProfile;
use App\Models\VisitorLog;
use App\Models\PackageBooking;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    // Called by frontend to store visitor_uuid into session and return redirect url
    public function start(Request $request, $provider)
    {
        $request->validate(['visitor_uuid' => 'nullable|string']);
        if ($request->filled('visitor_uuid')) {
            session(['visitor_uuid' => $request->visitor_uuid]);
        }
        // return redirect url (optional location)
        return response()->json(['redirect' => route('social.redirect', $provider)]);
    }

    // Socialite redirect
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    // Callback from provider
    public function callback(Request $request, $provider)
    {
        // Check if user canceled
        if ($request->has('error') && $request->error === 'access_denied') {
            // Redirect back safely
            return redirect('/#packages')->with('error', 'Facebook login canceled.');
        }

        if (!$request->has('code')) {
            return redirect('/#packages')->with('error', 'Facebook login failed: missing code.');
        }
        // Check if we already have a session token
        if (!session()->has('social_access_token')) {
            $socialUser = Socialite::driver($provider)->stateless()->user();
            session(['social_access_token' => $socialUser->token]);
        } else {
            // Optional: if you want the socialUser object again, you can fetch it using the token
            $socialUser = Socialite::driver($provider)
                            ->stateless()
                            ->userFromToken(session('social_access_token'));
        }
        //$socialUser = Socialite::driver($provider)->stateless()->user();

        // Pull extra info when available
        $socialData = $socialUser->user ?? [];

        $profile = VisitorProfile::updateOrCreate(
            ['social_id' => $socialUser->getId(), 'provider' => $provider],
            [
                'visitor_uuid' => session('visitor_uuid') ?? null,
                'name' => $socialUser->getName() ?: ($socialData['name'] ?? null),
                'email' => $socialUser->getEmail() ?: ($socialData['email'] ?? null),
                'avatar' => $socialUser->getAvatar() ?: ($socialData['picture'] ?? null),
                'gender' => $socialData['gender'] ?? null,
                'locale' => $socialData['locale'] ?? null,
            ]
        );

        // Attach profile to existing visitor_logs with same visitor_uuid
        if ($profile->visitor_uuid) {
            VisitorLog::where('visitor_uuid', $profile->visitor_uuid)
                ->whereNull('visitor_profile_id')
                ->update(['visitor_profile_id' => $profile->id]);
        } else {
            // fallback: if session has visitor_uuid
            $vu = session('visitor_uuid');
            if ($vu) {
                VisitorLog::where('visitor_uuid', $vu)->whereNull('visitor_profile_id')->update(['visitor_profile_id' => $profile->id]);
            }
        }

        // Save profile id into session so admin pages or future actions can use it
        session(['visitor_profile_id' => $profile->id]);
        session(['user_email' => $profile->email]);

        // We use the custom Auth guard here to ensure the user is officially logged in
        // by the Laravel system, allowing auth()->check() to work correctly later.
        Auth::guard('visitor')->login($profile); // <-- ADDED: Explicitly log in via the 'visitor' guard

        // redirect to a "thanks" page or back to the packages section
        //return redirect('/')->with('status', 'Profile connected. Thanks!');
        //return redirect()->route('offers')->with('success', 'Welcome  '.$socialUser->getName().'!' . 'please Check our packages below.');

         $booking = PackageBooking::where('user_email',  $socialData['email'])->latest()->first();
        //echo  $booking ;exit;
        if ($booking) {
            //session(['user_email' => $socialData['email']]);
           // return redirect()->route('booking.show')->with('success', 'Welcome  '.$socialUser->getName().'!' . 'You have an existing booking, please check it below.' );
            return redirect()->route('booking.show')->with('msg', [
                        'type' => 'success',
                        'msg'  => 'Welcome  '.$socialUser->getName() .'!' . 'You have an existing booking, please check it below.',
                        'text' => 'Logged in successfully!',
                        ]);
        }
        else {
            //session(['user_email' => $socialData['email']]);
            return redirect()->route('offers')->with('success', 'Welcome  '.$socialUser->getName().'!' . 'please Check our packages below.' );
        }
    }

    /**
     * Handle visitor registration via email.
     *
     * This function allows a new visitor to register using their email and password.
     * Steps performed:
     * 1. Validate the request data (name, email, password, password confirmation)
     * 2. Create a new VisitorProfile in the database with hashed password
     * 3. Log in the newly registered visitor
     * 4. Redirect to the home page with a success message
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:20', // matches your database length
                'regex:/^\+?[0-9]{6,15}$/', // allows +, only digits, 6-15 chars
            ],
            'email' => 'required|email|unique:visitor_profiles,email',
            'password' => 'required|min:6|confirmed',
        ]);


        $visitor = VisitorProfile::create([
            'visitor_uuid' => Str::uuid(),
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'provider' => 'email',
            'locale' => app()->getLocale(),

        ]);

        Auth::login($visitor);

        return redirect('login')->with('success', 'Registration successful!');
    }
    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.visitor-register');
    }

    // Show login form
    public function showLoginForm()
    {

        return view('auth.visitor-login');
    }

    // Login via email and password
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $visitor = VisitorProfile::where('email', $request->email)->first();

        if (!$visitor || !Hash::check($request->password, $visitor->password)) {

            return back()->with('msg', [
                'type' => 'error',
                'text' => 'Logged in failed!',
            ]);
        }
        else{
            session(['user_email' =>$request->email]);
            session(['visitor_uuid' => $visitor->visitor_uuid]);
            Auth::guard('visitor')->login($visitor);

             $booking = PackageBooking::where('user_email',  $request->email)->latest()->first();

            if ($booking) {
                //session(['user_email' => $socialData['email']]);
                return redirect()->route('booking.show')->with('msg', [
                    'type' => 'success',
                    'msg'  => 'Welcome  '. $request->email .'!' . 'You have an existing booking, please check it below.',
                    'text' => 'Logged in successfully!',
                    ]);
            }
            else {
                //session(['user_email' => $socialData['email']]);
                return redirect()->route('offers')->with('msg', [
                    'type' => 'success',
                    'msg'  => 'Welcome  '. $request->email.'!' . 'please Check our packages below.',
                    'text' => 'Logged in successfully!',
                    ]);
            }


            // 'text'=> 'Welcome  '.$request->email.'!' . 'Logged in successfully!.',
            /*return redirect('/#packages')->with('msg', [
            'type' => 'success',
            'text' => "Logged in successfully!",
            ]);*/
        }

        //Auth::login($visitor);

    }


    /**
     * Handle visitor logout.
     *
     * This function handles a complete logout across all authentication guards
     * and clears custom session data used for social logins.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // 1. Log out the specific 'visitor' guard (used for email/password login)
        Auth::guard('visitor')->logout();

        // 2. Log out the default guard (if it was used for social login or another path)
        // This is a failsafe.
        Auth::logout();

        // 3. Clear all custom session keys used for tracking visitor state
        $request->session()->forget([
            'visitor_uuid',
            'visitor_profile_id',
            'user_email',
            'social_access_token', // Added for completeness
            'social_user'
        ]);

        // 4. Invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect back to homepage or wherever
        return redirect('/#packages')->with('msg', [
            'type' => 'success',
            'text' => "You have been logged out.",
            ]);
    }
}
