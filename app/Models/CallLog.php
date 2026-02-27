<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CallLog extends Model
{
    protected $guarded = [];

    public function staff()
    {
        return $this->belongsTo(User::class,'assigned_to');
    }
}
