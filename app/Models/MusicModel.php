<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicModel extends Model
{
    protected $table = 'music';

    protected $fillable = [
        'title',
        'cover_image',
        'artist',
        'album',
        'genre',
        'release_year',
    ];

}
