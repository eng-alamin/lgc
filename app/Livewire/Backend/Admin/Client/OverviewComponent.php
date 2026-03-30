<?php

namespace App\Livewire\Backend\Admin\Client;

use Livewire\Component;

use App\Models\User;
use App\Models\Counselor;
use App\Models\Agent;
use App\Models\Client;
use App\Models\Form;
use App\Models\Invoice;
use App\Models\Document;
use App\Models\Flight;

use App\Models\Stage;
use App\Models\StageHistory;

use Livewire\WithFileUploads;
use Carbon\Carbon;

class OverviewComponent extends Component
{
    use WithFileUploads;

    public $client;
    public $form;
    public $timelineLast;

    public $stage_id;
    public $title;
    public $description;
    public $status = "pending";

    public $counselor_id;
    public $agent_id;

    public function mount($id)
    {
        $client = Client::findOrfail($id);

        $this->client = $client;
        $this->form = $client->form;

        // Invoice
        $code = Invoice::latest()->first();
        if (empty($code->id)) {
            $this->number = '101';
        } else {
            $this->number = str_pad($code->serial + 1, 3, "0", STR_PAD_LEFT);
        }
        $this->date = now()->format('Y-m-d');
        $this->method = 'cash';
        $this->items = [
            [
                'name' => '',
                'total' => '',
                'advance' => '',
            ]
        ];
    }
    public function render()
    {
        $this->dispatch('render-selectpicker');

        $this->timelineLast = $this->form?->stageHistories()->with('stage')->get();

        return view('livewire.backend.admin.client.overview-component',[
            'stages' => Stage::orderBy('order')->get(),
            'counselors' => Counselor::latest()->get(),
            'agents' => Agent::latest()->get(),
            'timeline' => $this->form?->stageHistories()->with('stage')->get(),
        ])
        ->layout('layouts.backend.app', [
            'title' => "Clients | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->stage_id = '';
        $this->title = '';
        $this->description = '';

        $this->file = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function addStage()
    {
        $this->validate([
            'stage_id' => 'required',
        ]);

        StageHistory::updateOrCreate(
            [
                'form_id' => $this->form->id,
                'stage_id' => $this->stage_id
            ],
            [
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status,
            ]
        );

        if ($this->stage_id == 1 && $this->counselor_id) {
            $form = Form::find($this->form->id);
            if ($form) {
                $form->update([
                    'counselor_id' => $this->counselor_id,
                    'agent_id' => $this->agent_id
                ]);
            } 
        }

        if ($this->stage_id == 3) {
            Document::where('client_id', $this->client->id)->update([
                'form_id' => $this->form->id
            ]);
        } 

        $this->dispatch('success', message: 'Stage Updated Successfully');
        $this->dispatch('closeModal');
        $this->reset(['stage_id','title','description','status']);
    }

    public $invoice_id;
    public $date;
    public $method;
    public $items = [];
    public $total_amount;
    public $paid_amount;
    public $due_amount;
    public $notes;

    public $invoice;

    public function addRow()
    {
        $this->items[] = [
            'name' => '',
            'total' => '',
            'advance' => '',
        ];
    }
    public function removeRow($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }
  
    public function viewInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        $this->date = $invoice->date;
        $this->method = $invoice->method;
        $this->items = $invoice->items;
        $this->notes = $invoice->notes;
        $this->invoice = $invoice;
    }
    public function storeInvoice()
    {
        $this->validate([
            'method' => 'required',
            'date' => 'required|date',

            'items.*.name' => 'required',
            'items.*.total' => 'required|numeric|digits_between:1,8',
            'items.*.advance' => 'required|numeric|digits_between:1,8',
        ]);

        try{
            $total = 0;
            $paid = 0;

            foreach ($this->items as $item) {
                $total += (float) ($item['total'] ?? 0);
                $paid  += (float) ($item['advance'] ?? 0);
            }

            $due = max($total - $paid, 0);

            if ($paid == 0) {
                $status = 'due';
            } elseif ($paid < $total) {
                $status = 'partial';
            } else {
                $status = 'paid';
            }


            $code = Invoice::latest()->first();
            if (empty($code->id)) {
                $number = '101';
            } else {
                $number = str_pad($code->serial + 1, 3, "0", STR_PAD_LEFT);
            }

           Invoice::create([
                'created_by' => auth()->id(),
                'form_id' => $this->form->id,
                'serial'  => $number,
                'number'  => 'L3G6CIN' . $number,
                'date' => $this->date,
                'items' => $this->items,
                'method' => $this->method,
                'total_amount' => $total,
                'paid_amount' => $paid,
                'due_amount' => $due,
                'payment_status' => $status,
                'notes' => $this->notes,
            ]);

            $this->dispatch('success', message: 'Consignee is successfully saved');
            $this->dispatch('closeModal');
            
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data created failed: ' . $e->getMessage());
        }
    }

    public $file;
    public $document_type;
    public function typeDocument($document_type)
    {
        $this->document_type = $document_type;
    }
    public function uploadFile()
    {
        $fileName = Carbon::now()->timestamp.'.'.$this->file->getClientOriginalExtension();
        $path = $this->file->storeAs('documents', $fileName, 'public');
        return '/storage/'.$path;
    }
    public function storeDocument()
    {
        $this->validate([
            'file' => 'file|max:2048'
        ]);
        try{
            Document::updateOrCreate(
                [
                    'client_id' => $this->client->id,
                    'document_type' => $this->document_type,
                ],
                [
                    'form_id' => $this->form->id,
                    'file' => $this->file ? $this->uploadFile() : null,
                    'status' => 'uploaded',
                ]
            );

            $this->dispatch('success', message: 'Document file updated successfully');
            $this->dispatch('closeModal');
            $this->resetInputFields();

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }
    public function verifiedDocument($id)
    {
        try{
            $document = Document::findOrFail($id);
            $document->update([
                'status' => 'verified'
            ]);

            $this->dispatch('success', message: 'Document status updated successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }
    public function declinedDocument($id)
    {
        try{
            $document = Document::findOrFail($id);
            $document->update([
                'status' => 'declined'
            ]);

            $this->dispatch('success', message: 'Document status updated successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public $airline;
    public $flight_number;
    public $departure_city;
    public $departure_time;
    public $transit_city;
    public $transit_time;
    public $arrival_city;
    public $arrival_time;

    public function addFlight($id = null)
    {
        if (!$id) {
            $this->reset([
                'airline',
                'flight_number',
                'departure_city',
                'departure_time',
                'transit_city',
                'transit_time',
                'arrival_city',
                'arrival_time'
            ]);
            return;
        }

        $flight = Flight::findOrFail($id);
        $this->airline = $flight->airline;
        $this->flight_number = $flight->flight_number;
        $this->departure_city = $flight->departure_city;
        $this->departure_time = $flight->departure_time?->format('Y-m-d\TH:i');
        $this->transit_city = $flight->transit_city;
        $this->transit_time = $flight->transit_time?->format('Y-m-d\TH:i');
        $this->arrival_city = $flight->arrival_city;
        $this->arrival_time = $flight->arrival_time?->format('Y-m-d\TH:i');
    }

    public function storeFlight()
    {
        $this->validate([
            'airline' => 'required',
            'flight_number' => 'required',
        ]);

        try{
            Flight::updateOrCreate(
                [
                    'form_id' => $this->form->id,
                ],
                [
                    'airline' => $this->airline,
                    'flight_number' => $this->flight_number,
                    'departure_city' => $this->departure_city,
                    'departure_time' => $this->departure_time,
                    'transit_city' => $this->transit_city,
                    'transit_time' => $this->transit_time,
                    'arrival_city' => $this->arrival_city,
                    'arrival_time' => $this->arrival_time,
                ]
            );

            $this->dispatch('success', message: 'Consignee is successfully saved');
            $this->dispatch('closeModal');

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }

    public function statusClick($id, $newStatus)
    {
        $stage = StageHistory::findOrFail($id);

        // Update Status
        $stage->update([
            'status' => $newStatus
        ]);

        $this->dispatch('success', message: 'Stage status updated successfully');
    }

}
