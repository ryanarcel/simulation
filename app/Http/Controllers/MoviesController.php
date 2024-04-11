<?php

namespace App\Http\Controllers;

use App\Models\DislikedMovie;
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

    public function show (){
        $user = auth()->user();
        
        return Inertia::render('MyMovies', [
            'likedMovies' => $user->likedMovies,
            'dislikedMovies' => $user->dislikedMovies,
        ]);
    }

    public function checkIfLiked ($imdbID)
    {
        $likedMovie = LikedMovie::where('imdbID', $imdbID)->where('user_id', auth()->user()->id)->first();

        return response()->json(['liked' => $likedMovie ? true : false]);
    }

    public function likeMovie(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required',
            'title' => 'required',
            'year' => 'required',
        ]);
    
        $userId = auth()->user()->id;
    
        $disliked = DislikedMovie::where('imdbID', $validated['movie_id'])->where('user_id', $userId)->exists();
    
        if ($disliked) {
            return response()->json([
                'status' => 401,
                'message' => 'Movie is already disliked'
            ]);
        }
    
        $liked = LikedMovie::where('user_id', $userId)->where('imdbID', $validated['movie_id']);
    
        if ($request->like) {
            $liked->firstOrCreate([
                'user_id' => $userId,
                'imdbID' => $validated['movie_id'],
                'title' => $validated['title'],
                'year' => $validated['year'],
            ]);
    
            $status = 203;
        } else {
            $liked->delete();
    
            $status = 204;
        }
    
        return response()->json([
            'movie' => $validated['title'],
            'year' => $validated['year'],
            'liked' => (bool) $request->like,
            'status' => $status,
        ]);
    }

    public function dislikeMovie(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required',
            'title' => 'required',
            'year' => 'required',
        ]);
    
        $userId = auth()->user()->id;
    
        $liked = LikedMovie::where('imdbID', $validated['movie_id'])->where('user_id', $userId)->exists();
    
        if ($liked) {
            return response()->json([
                'status' => 401,
                'message' => 'Movie is already liked'
            ]);
        }
    
        $disliked = DislikedMovie::where('user_id', $userId)->where('imdbID', $validated['movie_id']);
    
        if ($request->dislike) {
            $disliked->firstOrCreate([
                'user_id' => $userId,
                'imdbID' => $validated['movie_id'],
                'title' => $validated['title'],
                'year' => $validated['year'],
            ]);
    
            $status = 203;
        } else {
            $disliked->delete();
    
            $status = 204;
        }
    
        return response()->json([
            'movie' => $validated['title'],
            'year' => $validated['year'],
            'disliked' => (bool) $request->dislike,
            'status' => $status,
        ]);
    }

    public function checkIfDisliked ($imdbID)
    {
        $dislikedMovie = DislikedMovie::where('imdbID', $imdbID)->where('user_id', auth()->user()->id)->first();

        return response()->json(['disliked' => $dislikedMovie ? true : false]);
    }

    public function delete($imdbID)
    {
        LikedMovie::where('imdbID', $imdbID)->where('user_id', auth()->user()->id)->delete();
        DislikedMovie::where('imdbID', $imdbID)->where('user_id', auth()->user()->id)->delete();

        return redirect()->back();
    }
}