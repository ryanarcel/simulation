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

        $validated = $request->validate([
            'search' => 'required',
        ]);

        if ($validated) {
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
    }

    public function show ($movie_id)
    {
        $likedMovie = LikedMovie::where('imdbID', $movie_id)->where('user_id', auth()->user()->id)->first();

        return $likedMovie ? true : false;
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

        return redirect()->back()->with([
            'movie' => $validated['title'],
            'liked' => true
        ]);
       
    }

}
