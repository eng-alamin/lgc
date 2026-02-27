<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Form;

class Invoice extends Model
{
    protected $guarded = [];

    protected $casts = [
        'items' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
