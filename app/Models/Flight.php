<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $guarded = [];

    protected $casts = [
        'departure_time' => 'datetime',
        'transit_time' => 'datetime',
        'arrival_time' => 'datetime'
    ];
}
