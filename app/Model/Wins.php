<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wins extends Model
{
    protected $fillable = [
        'id', 'user_id', 'app_id', 'prize', 'plan_test'
    ];

    protected $hidden   = [];
}
