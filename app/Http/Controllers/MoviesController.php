<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index ()
    {
        try {
            $response = Http::get('http://www.omdbapi.com/?i=tt3896198&apikey=c468ba62&S=Shawshank');
            $data = $response->json();
        } catch (\Exception $e) {
            // Handle API request failure
            \Log::error('API request failed: ' . $e->getMessage());
            $data = [];
        }
    
        return Inertia::render('Dashboard', [
            'response' => $data
        ]);
    }
}
