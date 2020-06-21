<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Apps extends Model
{
    protected $fillable = [
        'id', 'name', 'version_ios', 'version_android', 'prize', 'plan_test', 'plan_show_win'
    ];

    protected $hidden   = [];
}
