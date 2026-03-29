<?php

namespace App\Livewire\Backend\Agent;

use Livewire\Component;
use App\Models\User;
use App\Models\Appointment;
use App\Models\CallLog;
use App\Models\FollowUp;
use App\Models\Form;
use App\Models\Invoice;
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
        $users = User::where('agent_id', auth()->id())->latest()->get();
        $applications = Form::where('agent_id', auth()->id())->latest()->get();
        $invoices = Invoice::where('agent_id', auth()->id())->latest()->get();

        return view('livewire.backend.agent.dashboard-component',[
            'users' => $users,
            'applications' => $applications,
            'invoices' => $invoices,
        ])
        ->layout('layouts.agent.app', [
            'title' => "Dashboard | Let's Go China"
        ]);
    }

    public function loadStats()
    {
        $today = Carbon::today();

        $this->activeOnline = User::where('agent_id', auth()->id())->where('last_seen', '>=', now()->subMinutes(1))->count();
        $this->clientsToday = User::where('agent_id', auth()->id())->whereDate('created_at', $today)->count();
        $this->applicationsToday = Form::where('agent_id', auth()->id())->whereDate('created_at', $today)->count();
        $this->followupsToday = FollowUp::where('assign_id', auth()->id())->whereDate('created_at', $today)->count();

        $this->total_earning_pending = Commission::where('agent_id', auth()->id())->where('status', 'pending')->sum('commission_amount');
        $this->total_earning_approved = Commission::where('agent_id', auth()->id())->where('status', 'approved')->sum('commission_amount');
        $this->total_earning_paid = Commission::where('agent_id', auth()->id())->where('status', 'paid')->sum('commission_amount');

        $start = now()->subDays(30);
        $end = now();

        $this->total_client = User::where('agent_id', auth()->id())->where('account_status', 1)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_application = Form::where('agent_id', auth()->id())->where('status', 'approved')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_earning = Commission::where('agent_id', auth()->id())->where('status', 'paid')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->sum('commission_amount');
    }

    public function getEventByDate($start=null, $end=null)
    {
        $this->total_client = User::where('agent_id', auth()->id())->where('account_status', 1)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_application = Form::where('agent_id', auth()->id())->where('status', 'approved')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->count();
        $this->total_earning = Commission::where('agent_id', auth()->id())->where('status', 'paid')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->sum('commission_amount');

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
