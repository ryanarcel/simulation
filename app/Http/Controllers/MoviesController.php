<?php

namespace App\Http\Controllers;

use App\Models\LikedMovie;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index (Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');

            try {
                $response = Http::get("http://www.omdbapi.com/?i=tt3896198&apikey=c468ba62&S=$search");
                $data = $response->json();
            } catch (\Exception $e) {
                // Handle API request failure
                \Log::error('API request failed: ' . $e->getMessage());;
            }
            
            return Inertia::render('Dashboard', [
                'response' => $data
            ]);
        }

        return Inertia::render('Dashboard');
    }

    public function show ($imdbID)
    {
        $likedMovie = LikedMovie::where('imdbID', $imdbID)->where('user_id', auth()->user()->id)->first();

        return response()->json(['liked' => $likedMovie ? true : false]);
    }

    public function likeMovie (Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required',
            'title' => 'required',
        ]);

        if($request->like) {
            LikedMovie::updateOrCreate([
                'user_id' => auth()->user()->id,
                'imdbID' => $validated['movie_id'],
                'Title' => $validated['title']
            ]);
        } else {
            LikedMovie::where('imdbID', $validated['imdbID'])->delete();
        }

        return to_route('dashboard',[
            'movie' => $validated['title'],
            'liked' => $request->like ? true : false
        ]);
       
    }

}
