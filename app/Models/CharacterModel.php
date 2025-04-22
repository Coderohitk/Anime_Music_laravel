<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterModel extends Model
{
    protected $table = 'characters';

    protected $fillable = [
        'name',
        'image_url',
        'anime_id',
        'description',
        'voice_actor_english',
        'voice_actor_japanese',
        'role',
    ];

}
