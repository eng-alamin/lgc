<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($attendance) {

            if($attendance->check_in && $attendance->check_out){

                // Date সহ parse করুন
                $checkIn  = \Carbon\Carbon::parse($attendance->date.' '.$attendance->check_in);
                $checkOut = \Carbon\Carbon::parse($attendance->date.' '.$attendance->check_out);

                // Midnight cross fix (optional safety)
                if($checkOut->lt($checkIn)){
                    $checkOut->addDay();
                }

                // Always positive difference
                $minutes = $checkIn->diffInMinutes($checkOut);
                $hours   = round($minutes / 60, 2);

                $attendance->work_hours = $hours;

                // Office time = 9 hours
                if($hours > 9){
                    $attendance->overtime_hours = round($hours - 9, 2);
                } else {
                    $attendance->overtime_hours = 0;
                }

                // Late check (Office Start 10 AM)
                $officeStart = \Carbon\Carbon::parse($attendance->date.' 10:00:00');

                if($checkIn->gt($officeStart)){
                    $attendance->is_late = true;
                    $attendance->late_minutes = $officeStart->diffInMinutes($checkIn);
                } else {
                    $attendance->is_late = false;
                    $attendance->late_minutes = 0;
                }
            }
        });
    }

}
