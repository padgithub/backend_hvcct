<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{

    protected $fillable = [
        'id', 'app_id', 'details', 'a', 'b', 'c', 'd', 'answer',
    ];

    protected $hidden   = [];
}
