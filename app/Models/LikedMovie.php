<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LikedMovie extends Model
{
    use HasFactory;

    protected $table = 'liked_movies';

    protected $fillable = [
        'user_id',
        'imdbID',
        'Title'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
