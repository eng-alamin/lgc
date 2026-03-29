<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageHistory extends Model
{
    protected $guarded = [];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
