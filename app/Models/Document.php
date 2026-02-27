<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Document extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

}
