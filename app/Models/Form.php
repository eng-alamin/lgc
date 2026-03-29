<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'form_id');
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function stages()
    {
        return $this->hasMany(StageHistory::class);
    }
    public function stageHistories()
    {
        return $this->hasMany(StageHistory::class);
        // return $this->hasMany(StageHistory::class, 'form_id');
    }
    public function completedStage()
    {
        return $this->hasOne(StageHistory::class, 'form_id')->where('status', 'completed')->latest();
    }
    public function flight()
    {
        return $this->hasOne(Flight::class);
    }
    public function counselor()
    {
        return $this->belongsTo(Counselor::class);
    }
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
