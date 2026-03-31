<?php

namespace App\Livewire\Backend\Agent;

use Livewire\Component;
use App\Models\Agent;
use App\Models\User;
use App\Models\Client;
use App\Models\Appointment;
use App\Models\CallLog;
use App\Models\FollowUp;
use App\Models\Form;
use App\Models\Commission;
use Carbon\Carbon;

class DashboardComponent extends Component
{
    public $activeOnline;
    public $total_earning_pending;
    public $total_earning_approved;
    public $total_earning_paid;
    public $applicationsToday;
    public $clientsToday;
    public $followupsToday;

    public $total_client = 0;
    public $total_application = 0;
    public $total_earning = 0;

    public $agent_id;

    protected $listeners = [
        'refreshDashboard' => '$refresh',
        'getEventByDate' => 'getEventByDate',
    ];

    public function mount()
    {
        $this->agent_id = optional(auth()->user()->agent)->id;

        $this->loadStats();
    }

    public function render()
    {
        $clients = Client::where('agent_id', $this->agent_id)->latest()->get();
        $forms = Form::where('agent_id', $this->agent_id)->latest()->get();

        return view('livewire.backend.agent.dashboard-component',[
            'clients' => $clients,
            'forms' => $forms,
        ])
        ->layout('layouts.agent.app', [
            'title' => "Dashboard | Let's Go China"
        ]);
    }

    public function loadStats()
    {
        $today = Carbon::today();

        $this->activeOnline = Client::with('user')
        ->where('agent_id', $this->agent_id)
        ->whereHas('user', function ($q)  {
            $q->where('last_seen', '>=', now()->subMinutes(1));
        })
        ->count();

        $this->clientsToday = Client::with('user')
        ->where('agent_id', $this->agent_id)
        ->whereHas('user', function ($q) use ($today) {
            $q->whereDate('created_at', $today);
        })
        ->count();

        $this->applicationsToday = Form::where('agent_id', $this->agent_id)->whereDate('created_at', $today)->count();
        $this->followupsToday = FollowUp::where('assign_id', $this->agent_id)->whereDate('created_at', $today)->count();

        $this->total_earning_pending = Commission::where('agent_id', $this->agent_id)->where('status', 'pending')->sum('commission_amount');
        $this->total_earning_approved = Commission::where('agent_id', $this->agent_id)->where('status', 'approved')->sum('commission_amount');
        $this->total_earning_paid = Commission::where('agent_id', $this->agent_id)->where('status', 'paid')->sum('commission_amount');

        $start = now()->subDays(30);
        $end = now();


        $this->total_client = Client::with('user')
        ->where('agent_id', $this->agent_id)
        ->whereHas('user', function ($q) use ($start, $end)  {
            $q->where('account_status', 1)
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end);
        })
        ->count();

        $this->total_application = Form::where('agent_id', $this->agent_id)->where('status', 'approved')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_earning = Commission::where('agent_id', $this->agent_id)->where('status', 'paid')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->sum('commission_amount');
    }

    public function getEventByDate($start=null, $end=null)
    {
        $this->total_client = Client::with('user')
        ->where('agent_id', $this->agent_id)
        ->whereHas('user', function ($q) use ($start, $end)  {
            $q->where('account_status', 1)
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end);
        })
        ->count();

        $this->total_application = Form::where('agent_id', $this->agent_id)->where('status', 'approved')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_earning = Commission::where('agent_id', $this->agent_id)->where('status', 'paid')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->sum('commission_amount');

    }

    
    // Forms
    public $applicationFilter = 'today';
    public function setFilterApplication($value)
    {
        $this->applicationFilter = $value;
    }
    public function getApplicationsProperty()
    {
        return match ($this->applicationFilter) {

            'yesterday' =>
                Form::where('agent_id', $this->agent_id)
                    ->whereDate('created_at', Carbon::yesterday())
                    ->latest()
                    ->take(6)
                    ->get(),

            'week' =>
                Form::where('agent_id', $this->agent_id)
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])
                    ->latest()
                    ->take(6)
                    ->get(),

            default =>
                Form::where('agent_id', $this->agent_id)
                    ->whereDate('created_at', Carbon::today())
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
                Appointment::where('agent_id', $this->agent_id)
                    ->whereDate('created_at', Carbon::yesterday())
                    ->latest()
                    ->take(6)
                    ->get(),

            'week' =>
                Appointment::where('agent_id', $this->agent_id)
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])
                    ->latest()
                    ->take(6)
                    ->get(),

            default =>
                Appointment::where('agent_id', $this->agent_id)
                    ->whereDate('created_at', Carbon::today())
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
                Calllog::where('agent_id', $this->agent_id)
                    ->whereDate('created_at', Carbon::yesterday())
                    ->latest()
                    ->take(6)
                    ->get(),

            'week' =>
                Calllog::where('agent_id', $this->agent_id)
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])
                    ->latest()
                    ->take(6)
                    ->get(),

            default =>
                Calllog::where('agent_id', $this->agent_id)
                    ->whereDate('created_at', Carbon::today())
                    ->latest()
                    ->take(6)
                    ->get(),
        };
    }
}
