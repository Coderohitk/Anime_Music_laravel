<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimeModel extends Model
{
    protected $table = 'anime';

    protected $fillable = [
        'title',
        'cover_image',
        'is_favourite',
        'description',
        'rating',
        'genre',
        'release_year',
    ];

}
