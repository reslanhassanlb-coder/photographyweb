<?php

namespace App\Http\Controllers;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        SEOMeta::setTitle('Contact Hassan Reslan Photography – Lebanon');
        SEOMeta::setDescription('Get in touch with Hassan Reslan Photography for wedding, engagement, or event photography in Lebanon.');
        SEOMeta::setCanonical('https://www.hassanreslanphotography.com/contact');
        SEOMeta::addKeyword(['contact Hassan Reslan', 'wedding photographer Lebanon', 'event photographer Lebanon']);

        OpenGraph::setTitle('Contact Hassan Reslan Photography – Lebanon');
        OpenGraph::setDescription('Reach out for professional wedding, engagement, and event photography services in Lebanon.');
        OpenGraph::setUrl('https://www.hassanreslanphotography.com/contact');
        OpenGraph::addProperty('type', 'contact');
        OpenGraph::addImage('https://www.hassanreslanphotography.com/images/og-contact.jpg');

        JsonLd::setTitle('Contact Hassan Reslan Photography – Lebanon');
        JsonLd::setDescription('Reach out for professional wedding, engagement, and event photography services in Lebanon.');
        JsonLd::setUrl('https://www.hassanreslanphotography.com/contact');
        JsonLd::addImage('https://www.hassanreslanphotography.com/images/og-contact.jpg');
        return view('contact');
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
