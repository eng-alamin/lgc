<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Appointment;
use Carbon\Carbon;

class CalendarComponent extends Component
{
    public $events = [];

    protected $listeners = [
        'refreshCalendar'=>'loadEvents',
        'statusUpdated'=>'loadEvents',
        'updateAppointment' => 'updateAppointment',
        'updateAppointmentStatus' => 'updateAppointmentStatus',
    ];

    public function mount()
    {
        $this->loadEvents();
    }

    public function render()
    {
        return view('livewire.backend.admin.calendar-component')
        ->layout('layouts.backend.app', [
            'title' => "Calendar | Let's Go China"
        ]);
    }

    public function loadEvents()
    {
        $this->events = Appointment::with('client')->get()->map(function ($item) {
            // Status based color
            $color = match($item->status){
                'completed' => 'green',
                'cancelled' => 'red',
                default => 'blue',
            };

            return [
                'id' => $item->id,
                'title' => $item->client->name,
                'start' => $item->appointment_date.'T'.$item->appointment_time,
                'backgroundColor' => $color,
                'borderColor' => $color,
            ];
        })->toArray();

        $this->dispatch('updateCalendar', events: $this->events);
    }

    // Drag & Drop Update
    public function updateAppointment($id,$date,$time)
    {
        $appointment = Appointment::find($id);
        if(!$appointment) return;

        $dt = Carbon::parse($date);
        $date = $dt->format('Y-m-d');
        $time = $dt->format('H:i:s');

        $exists = Appointment::where('agent_id',$appointment->agent_id)
            ->where('appointment_date',$date)
            ->where('appointment_time',$time)
            ->where('id','!=',$id)
            ->exists();

        if($exists){
            $this->dispatch('alert',['type'=>'error','message'=>'Agent already booked!']);
            return;
        }

        $appointment->update(['appointment_date'=>$date,'appointment_time'=>$time]);
        
        $this->dispatch('alert',['type'=>'success','message'=>'Appointment rescheduled!']);
        $this->loadEvents();
    }

    public function updateAppointmentStatus($id,$status)
    {
        $appointment = Appointment::find($id);
        if(!$appointment) return;

        $appointment->status = $status;
        $appointment->save();

        // if($status == 'completed'){
        //     $appointment->followUp()->create([
        //         'assigned_to'=>$appointment->agent_id,
        //         'status'=>'pending',
        //         'follow_up_date'=>Carbon::now()->addDay(),
        //         'notes'=>'Follow-up after completed appointment with '.$appointment->client->name
        //     ]);
        // }

        $this->dispatch('success', message: 'Status Updated Successfully');
        $this->dispatch('statusUpdated');
    }
}
