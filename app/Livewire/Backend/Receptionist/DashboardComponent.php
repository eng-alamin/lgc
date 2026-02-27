<?php

namespace App\Livewire\Backend\Receptionist;

use Livewire\Component;
use App\Models\User;
use App\Models\Appointment;
use App\Models\CallLog;
use App\Models\FollowUp;
use App\Models\Form;
use App\Models\Invoice;
use Carbon\Carbon;

class DashboardComponent extends Component
{
    public $activeOnline;
    public $applicationsToday;
    public $appointmentsToday;
    public $callLogsToday;

    public $total_application = 0;
    public $total_appointment = 0;
    public $total_followup = 0;
    public $total_calllogs = 0;

    protected $listeners = [
        'refreshDashboard' => '$refresh',
        'getEventByDate' => 'getEventByDate',
    ];

    public function mount()
    {
        $this->loadStats();
    }

    public function render()
    {
        $users = User::latest()->get();
        $appointments = Appointment::latest()->get();
        $calllogs = CallLog::latest()->get();
        $applications = Form::latest()->get();
        $invoices = Invoice::latest()->get();

        return view('livewire.backend.receptionist.dashboard-component',[
            'users' => $users,
            'appointments' => $appointments,
            'calllogs' => $calllogs,
            'applications' => $applications,
            'invoices' => $invoices,
        ])
        ->layout('layouts.receptionist.app', [
            'title' => "Dashboard | Let's Go China"
        ]);
    }

    public function loadStats()
    {
        $today = Carbon::today();

        $this->activeOnline = User::where('last_seen', '>=', now()->subMinutes(1))->count();
        $this->applicationsToday = Form::whereDate('created_at', $today)->count();
        $this->appointmentsToday = Appointment::whereDate('appointment_date', $today)->count();
        $this->callLogsToday = CallLog::whereDate('created_at', $today)->count();

        $start = now()->subDays(30);
        $end = now();

        $this->total_application = Form::where('status', 'approved')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_appointment = Appointment::where('status', 'completed')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_calllogs = CallLog::where('status', 'contacted')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
    }

    public function getEventByDate($start=null, $end=null)
    {
        $this->total_application = Form::where('status', 'approved')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_appointment = Appointment::where('status', 'completed')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_followup = FollowUp::where('status', 'done')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_calllogs = CallLog::where('status', 'contacted')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();

    }


    // Invoices
    public $invoiceFilter = 'today';
    public function setFilterInvoice($value)
    {
        $this->invoiceFilter = $value;
    }
    public function getInvoicesProperty()
    {
        return match ($this->invoiceFilter) {

            'yesterday' =>
                Invoice::whereDate('created_at', Carbon::yesterday())
                    ->latest()
                    ->take(6)
                    ->get(),

            'week' =>
                Invoice::whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])
                    ->latest()
                    ->take(6)
                    ->get(),

            default =>
                Invoice::whereDate('created_at', Carbon::today())
                    ->latest()
                    ->take(6)
                    ->get(),
        };
    }
    
    // Applications
    public $applicationFilter = 'today';
    public function setFilterApplication($value)
    {
        $this->applicationFilter = $value;
    }
    public function getApplicationsProperty()
    {
        return match ($this->applicationFilter) {

            'yesterday' =>
                Form::whereDate('created_at', Carbon::yesterday())
                    ->latest()
                    ->take(6)
                    ->get(),

            'week' =>
                Form::whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])
                    ->latest()
                    ->take(6)
                    ->get(),

            default =>
                Form::whereDate('created_at', Carbon::today())
                    ->latest()
                    ->take(6)
                    ->get(),
        };
    }

    // Appointments
    public $appointmentFilter = 'today';
    public function setFilterAppointment($value)
    {
        $this->appointmentFilter = $value;
    }
    public function getAppointmentsProperty()
    {
        return match ($this->appointmentFilter) {

            'yesterday' =>
                Appointment::whereDate('created_at', Carbon::yesterday())
                    ->latest()
                    ->take(6)
                    ->get(),

            'week' =>
                Appointment::whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])
                    ->latest()
                    ->take(6)
                    ->get(),

            default =>
                Appointment::whereDate('created_at', Carbon::today())
                    ->latest()
                    ->take(6)
                    ->get(),
        };
    }

    // Calllogs
    public $calllogFilter = 'today';
    public function setFilterCalllog($value)
    {
        $this->calllogFilter = $value;
    }
    public function getCalllogsProperty()
    {
        return match ($this->calllogFilter) {

            'yesterday' =>
                Calllog::whereDate('created_at', Carbon::yesterday())
                    ->latest()
                    ->take(6)
                    ->get(),

            'week' =>
                Calllog::whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])
                    ->latest()
                    ->take(6)
                    ->get(),

            default =>
                Calllog::whereDate('created_at', Carbon::today())
                    ->latest()
                    ->take(6)
                    ->get(),
        };
    }
}
