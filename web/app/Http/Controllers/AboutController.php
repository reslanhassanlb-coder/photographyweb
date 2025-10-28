<?php

namespace App\Http\Controllers;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            SEOMeta::setTitle('About Hassan Reslan – Photographer in Lebanon');
            SEOMeta::setDescription('Learn about Hassan Reslan, a professional photographer in Lebanon specializing in weddings, engagements, and event photography.');
            SEOMeta::setCanonical('https://www.hassanreslanphotography.com/about');
            SEOMeta::addKeyword(['Hassan Reslan photographer', 'Lebanon wedding photographer', 'Lebanon event photographer']);

            OpenGraph::setTitle('About Hassan Reslan – Photographer in Lebanon');
            OpenGraph::setDescription('Learn about Hassan Reslan, a professional photographer in Lebanon specializing in weddings, engagements, and events.');
            OpenGraph::setUrl('https://www.hassanreslanphotography.com/about');
            OpenGraph::addProperty('type', 'profile');
            OpenGraph::addImage('https://www.hassanreslanphotography.com/images/og-about.jpg');

            JsonLd::setTitle('About Hassan Reslan – Photographer in Lebanon');
            JsonLd::setDescription('Learn about Hassan Reslan, a professional photographer in Lebanon specializing in weddings, engagements, and events.');
            JsonLd::setUrl('https://www.hassanreslanphotography.com/about');
            JsonLd::addImage('https://www.hassanreslanphotography.com/images/og-about.jpg');

        return view('about');
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
