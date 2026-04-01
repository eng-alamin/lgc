<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    
    public function form()
    {
        return $this->hasOne(Form::class)->whereIn('status', ['processing', 'approved'])->latest();
        // return $this->hasOne(Form::class)->whereNotIn('status', ['declined', 'pending'])->latest();
        // return $this->hasOne(Form::class)->whereIn('status', ['processing', 'approved'])->latestOfMany();
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function invoices()
    {
        return $this->hasManyThrough(
            Invoice::class,
            Form::class,
            'client_id', // forms table
            'form_id',   // invoices table
            'id',        // clients table
            'id'         // forms table
        );
    }
}
