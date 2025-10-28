<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        SEOMeta::setTitle('Services');
        SEOMeta::setDescription('At weprokit, we offer expert Digital Marketing, UI/UX Design, Web Development, and Production services to help your brand grow. From SEO and social media to stunning websites and creative branding, we provide data-driven solutions tailored to your success. Elevate your online presence with weprokit today!');
        //SEOMeta::setCanonical('http://127.0.0.1:8000/services');
        SEOMeta::setCanonical('https://www.weprokit.com/services');
        SEOMeta::addKeyword(['Online Marketing Solutions', 'UI/UX Design Services', 'Web Development Company','Branding & Production Services','Online Marketing Solutions']);

        OpenGraph::setDescription('At weprokit, we offer expert Digital Marketing, UI/UX Design, Web Development, and Production services to help your brand grow. From SEO and social media to stunning websites and creative branding, we provide data-driven solutions tailored to your success. Elevate your online presence with weproKit today!');
        OpenGraph::setTitle('Services');
        //OpenGraph::setUrl('http://127.0.0.1:8000/');
        OpenGraph::setUrl('https://www.weprokit.com/');
        OpenGraph::addProperty('type', 'website');

        
        JsonLd::setTitle('Services');
        JsonLd::setDescription('At weprokit, we offer expert Digital Marketing, UI/UX Design, Web Development, and Production services to help your brand grow. From SEO and social media to stunning websites and creative branding, we provide data-driven solutions tailored to your success. Elevate your online presence with weprokit today!');
        JsonLd::setUrl('https://weprokit.com');

        return view('services');
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
