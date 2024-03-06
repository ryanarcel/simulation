<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedMovie extends Model
{
    use HasFactory;

    protected $table = 'liked_movies';

    protected $fillable = [
        'user_id',
        'imdbID',
        'Title'
    ];
}
