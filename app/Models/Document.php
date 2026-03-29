<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    public function getIsExpiredAttribute()
    {
        return $this->expiry_date && now()->gt($this->expiry_date);
    }
}
