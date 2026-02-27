<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $guarded = [];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
