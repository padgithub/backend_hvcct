<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    protected $fillable = [
        'id', 'user_id', 'app_id', 'point', 'play_times'
    ];

    protected $hidden   = [];
}
