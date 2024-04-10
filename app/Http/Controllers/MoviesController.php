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

    public function likeMovie (Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required',
            'title' => 'required',
            'year' => 'required',
        ]);

        $checkifDisliked = DislikedMovie::where('imdbID', $validated['movie_id'])
        ->where('user_id', auth()->user()->id)->get();

        if($checkifDisliked->isNotEmpty()) {
            return response()->json([
               'status' => 401,
               'message' => 'Movie is already disliked'
            ]);
        }
        else {
            if ($request->like) {
                LikedMovie::firstOrCreate([
                    'user_id' => auth()->user()->id,
                    'imdbID' => $validated['movie_id'],
                    'title' => $validated['title'],
                    'year' => $validated['year'],
                ]);

                return response()->json([
                    'movie' => $validated['title'],
                    'year' => $validated['year'],
                    'liked' => $request->like ? true : false,
                    'status' => 203,
                ]);

            } else {
                LikedMovie::where('user_id', auth()->user()->id)
                ->where('imdbID', $validated['movie_id'])->delete();

                return response()->json([
                    'movie' => $validated['title'],
                    'year' => $validated['year'],
                    'liked' => $request->like ? true : false,
                    'status' => 204,
                ]);
            }

        }
    }

    public function dislikeMovie (Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required',
            'title' => 'required',
            'year' => 'required',
        ]);

        $checkifLiked = LikedMovie::where('imdbID', $validated['movie_id'])
        ->where('user_id', auth()->user()->id)->get();

        if ($checkifLiked->isNotempty()) {
            return response()->json([
                'status' => 401,
                'message' => 'Movie is already liked'
             ]);
        }
        else {
            if($request->dislike) {
                DislikedMovie::firstOrCreate([
                    'user_id' => auth()->user()->id,
                    'imdbID' => $validated['movie_id'],
                    'title' => $validated['title'],
                    'year' => $validated['year'],
                ]);

                return response()->json([
                    'movie' => $validated['title'],
                    'year' => $validated['year'],
                    'disliked' => $request->dislike ? true : false,
                    'status' => 203,
                ]);

            } else {
                DislikedMovie::where('user_id', auth()->user()->id)
                ->where('imdbID', $validated['movie_id'])->delete();

                return response()->json([
                    'movie' => $validated['title'],
                    'year' => $validated['year'],
                    'disliked' => $request->dislike ? true : false,
                    'status' => 204,
                ]);
            }
        }


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