<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceComponent extends Component
{
    public $latitude;
    public $longitude;

    public $id_number;

    // Office location hardcoded
    public $officeLat = 23.829530799863452;
    public $officeLng = 90.41873039093132;
    public $officeRadius = 50;      // meters

    protected $listeners = ['setLocation'];

    public function render()
    {
        return view('livewire.frontend.attendance-component')
        ->layout('layouts.app', [
            'title' => "Attendance | Let's Go China",
            'seo' => [
                'title' => "Attendance | Let's Go China",
                'description' => config('setting.detail'),
                'image' => asset(config('setting.logo')),
                'url' => url('/'),
                'type' => 'website',
            ],
        ]);
    }

    public function setLocation($latitude, $longitude)
    {
        $this->latitude = $latitude ?? null;
        $this->longitude = $longitude ?? null;
        $this->attendanceAction();
    }


    public function attendanceAction()
    {
        $currentTime = now();
        $timeNow = $currentTime->format('H:i');

        // Distance check
        $distance = $this->distance(
            $this->latitude,
            $this->longitude,
            $this->officeLat,
            $this->officeLng
        );
        if ($distance > $this->officeRadius) {
            $this->dispatch('error', message: 'Outside Office Area');
            return;
        }

        // Employee check
        $employee = Employee::where('id_number', $this->id_number)->first();
        if (!$employee) {
            $this->dispatch('error', message: 'Employee not found');
            return;
        }

        // Today attendance
        $attendance = Attendance::where('employee_id', $employee->id)->whereDate('date', now()->toDateString())->first();

        // CHECK IN (ONLY BEFORE 1 PM)
        if (!$attendance) {

            if ($timeNow >= '13:00') {
                $this->dispatch('error', message: 'Check In is closed after 1:00 PM');
                return;
            }

            Attendance::create([
                'employee_id' => $employee->id,
                'date' => now()->toDateString(),
                'check_in' => now()->format('H:i:s'),
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'status' => 'present'
            ]);

            $this->dispatch('success', message: 'Check In Successful');
            return;
        }

        // CHECK OUT (ONLY AFTER 1 PM)
        if (!$attendance->check_out) {

            if ($timeNow < '13:00') {
                $this->dispatch('error', message: 'Check Out is allowed only after 1:00 PM');
                return;
            }

            $attendance->update([
                'check_out' => now()->format('H:i:s'),
            ]);
            
            $this->dispatch('success', message: 'Check Out Successful');
            return;
        }

        // Already done
        $this->dispatch('error', message: 'Attendance Already Completed Today');
    }
    
    private function distance($lat1,$lon1,$lat2,$lon2)
    {
        $earthRadius = 6371000;

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(
            pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) *
            pow(sin($lonDelta / 2), 2)
        ));

        return $angle * $earthRadius;
    }


}
