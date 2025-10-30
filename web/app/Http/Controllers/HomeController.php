<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\VisitorProfile;
use App\Models\VisitorLog;
use App\Models\Package;
use App\Models\blog;
use App\Models\PackageBooking;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = VisitorProfile::where('visitor_uuid', session('visitor_uuid'))->first();
        if(session('user_email') ){
            $booking =  PackageBooking::where('user_email', session('user_email'))->first();
        }
        else{
            $booking = null;
        }
        $packages = Package::all();
        $blogs = blog::where('display_in_home', true)->get();

       SEOMeta::setTitle('Hassan Reslan Photography – Wedding & Event Lebanon');
       SEOMeta::setDescription('Hassan Reslan Photography captures weddings, engagements, and special events in Lebanon with creativity and professionalism.');

       SEOMeta::addKeyword([
                'wedding photography Lebanon',
                'engagement photographer Lebanon',
                'event photography Lebanon'
            ]);

        SEOMeta::setCanonical('https://www.hassanreslanphotography.com');


        // OpenGraph
        OpenGraph::setTitle('Hassan Reslan Photography – Wedding & Event Lebanon');
        OpenGraph::setDescription('Professional photography services for weddings, engagements, and events in Lebanon.');
        OpenGraph::setUrl('https://www.hassanreslanphotography.com');
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage('https://www.hassanreslanphotography.com/assets/images/hero.png');
        TwitterCard::setTitle('Hassan Reslan Photography');
        TwitterCard::setImage(asset('assets/images/hero.png'));


         // JSON-LD
        JsonLd::setTitle('Hassan Reslan Photography – Wedding & Event Lebanon');
        JsonLd::setType('LocalBusiness');
        JsonLd::addValue('name', 'Hassan Reslan Photography');
        JsonLd::addValue('url', 'https://hassanreslanphotography.com/');
        JsonLd::addValue('telephone', '+96170837485');
        JsonLd::setDescription('Professional photography services for weddings, engagements, and events in Lebanon.');
        JsonLd::setImage('https://hassanreslanphotography.com/assets/images/hero.png'); // Use ABSOLUTE URL
        JsonLd::addValue('openingHours', 'Mo,Tu,We,Th,Fr 09:00-20:00');

        // 2. Set the Address structure
        JsonLd::addValue('address', [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Zefta main street',
            'addressLocality' => 'Nabatieh',
            'addressCountry' => 'LB',
        ]);

        // 3. Set the social media profiles
        JsonLd::addValue('sameAs', [
            'https://www.instagram.com/hassanreslanphotography/',
            'https://www.facebook.com/profile.php?id=100078667700822'
        ]);
        // You can add a price range property too:
        JsonLd::addValue('priceRange', '$$');

        return view('welcome', compact('profile','packages', 'blogs', 'booking'));
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
