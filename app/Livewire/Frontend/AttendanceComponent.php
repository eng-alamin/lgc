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
            'title' => "Attendance | Let's Go China"
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

        $employee = Employee::where('id_number', $this->id_number)->first();

        $attendance = Attendance::where('employee_id', $employee->id)->whereDate('date', now()->toDateString())->first();

        // Check In
        if (!$attendance) {

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

        // Check Out
        if (!$attendance->check_out) {

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
