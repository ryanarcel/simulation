<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Users/Index', [
        'name' => 'Chong'
    ]);
});



Route::get('/options-api', function () {
    return Inertia::render('Users/Options', [
        'name' => 'Chong',
        'birthdate' => 'September 11, 1992'
    ]);
});

Route::get('/composition-api', function () {
    return Inertia::render('Users/Composition', [
        'name' => 'Chong',
        'birthdate' => 'September 11, 1992'
    ]);
});


Route::get('/results', [App\Http\Controllers\DefinitionController::class, 'show']);