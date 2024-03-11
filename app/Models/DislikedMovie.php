<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DislikedMovie extends Model
{
    use HasFactory;
    
    protected $table = 'disliked_movies';

    protected $fillable = [
        'user_id',
        'imdbID',
        'title',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
