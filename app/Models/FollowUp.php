<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form;

class FollowUp extends Model
{
    protected $guarded = [];
    
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    public function assign()
    {
        return $this->belongsTo(User::class,'assign_id');
    }


    // Scope for today tasks
    public function scopeToday($query)
    {
        return $query->whereDate('follow_up_date', now()->format('Y-m-d'));
    }

    // Scope for overdue tasks
    public function scopeOverdue($query)
    {
        return $query->whereDate('follow_up_date','<', now()->format('Y-m-d'))
                     ->where('status','pending');
    }
}
