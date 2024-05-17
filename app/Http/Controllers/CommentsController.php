<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Inertia\Inertia;
use App\Models\User;

class CommentsController extends Controller
{
    public function show ()
    {
        $user = auth()->user();
        $comments = $user->comments;

        return Inertia::render('Pages/Reviews', [
            'comments' => $comments,
        ]);
    }
}
