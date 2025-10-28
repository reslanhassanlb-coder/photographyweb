<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $agent = new \Jenssegers\Agent\Agent;

       $ip = $request->ip() === '127.0.0.1' ? '8.8.8.8' : $request->ip();

        // Fetch geo info
        $geo = Http::get("https://ipapi.co/{$ip}/json/")->json();

        $country = $geo['country_name'] ?? 'Unknown';
        $region  = $geo['region'] ?? 'Unknown';
        $city    = $geo['city'] ?? 'Unknown';

        // Detect browser, OS, device
        $agent = new Agent();
        $agent->setUserAgent($request->header('User-Agent'));

        VisitorLog::create([
            'visitor_uuid' => $request->visitor_uuid,
            'page_url'     => $request->page_url,
            'time_spent'   => $request->time_spent,
            'visited_at'   => now(),
            'ip'           => $ip,
            'country' => $country,
            'region' => $region,
            'city' => $city,
            'device'       => $agent->device(),
            'browser'      => $agent->browser(),
            'os'           => $agent->platform(),
            'referrer'     => $request->headers->get('referer'),
        ]);

        return response()->json(['success' => true]);

        /* old function */
    // Check if data comes from sendBeacon (raw JSON)
        /*$data = $request->json()->all();

        if (!$data) {
            // fallback to normal POST
            $data = $request->all();
        }

        $validated = \Validator::make($data, [
            'visitor_uuid' => 'required|string',
            'page_url' => 'required|string',
            'time_spent' => 'required|numeric',
        ])->validated();

        VisitorLog::create($validated);

        return response()->json(['status' => 'ok']);*/
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
