<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', [App\Http\Controllers\MoviesController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/like', [App\Http\Controllers\MoviesController::class, 'likeMovie'])
->middleware(['auth', 'verified'])->name('likeMovie');

Route::post('/dislike', [App\Http\Controllers\MoviesController::class, 'dislikeMovie'])
->middleware(['auth', 'verified'])->name('dislikeMovie');

Route::get('/check-if-liked/{imdbID}', [App\Http\Controllers\MoviesController::class, 'checkIfLiked'])
->middleware('auth')->name('checkIfLiked');

Route::get('/check-if-disliked/{imdbID}', [App\Http\Controllers\MoviesController::class, 'checkIfDisliked'])
->middleware('auth')->name('checkIfDisliked');

Route::get('my-movies', [App\Http\Controllers\MoviesController::class, 'show'])
->middleware('auth')->name('myMovies');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
