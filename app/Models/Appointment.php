<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
