<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StatusHistory;
use App\Models\User;

class Form extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    public function formStatuses()
    {
        return $this->hasMany(StatusHistory::class, 'module_id')->where('module', 'form')->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
