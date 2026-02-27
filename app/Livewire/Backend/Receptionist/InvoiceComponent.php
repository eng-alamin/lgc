<?php

namespace App\Livewire\Backend\Receptionist;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Form;
use App\Models\User;

class InvoiceComponent extends Component
{
    public $form_id;
    public $number;
    public $date;
    public $items = [];
    public $total_amount;
    public $paid_amount;
    public $due_amount;
    public $method;
    public $notes;

    public $invoice_id;
    public $delete_id;

    protected $listeners = [
        'deleteConfirmed' => 'deleteInvoice',
    ];

    public function mount()
    {
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
        $this->dispatch('refreshSelect');
        // $this->dispatch('refreshSelect', ['type' => $this->type]);

        $invoices = Invoice::latest()->get();
        $forms = Form::latest()->get();

        return view('livewire.backend.receptionist.invoice-component', [
            'invoices' => $invoices,
            'forms' => $forms,
        ])
        ->layout('layouts.receptionist.app', [
            'title' => "Invoices | Let's Go China",
        ]);
    }

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

    private function resetInputFields()
    {
        $this->form_id = '';
        $this->number = '';
        $this->items = [
            [
                'name' => '',
                'total' => '',
                'advance' => '',
            ]
        ];
        $this->date = '';
        $this->method = '';
        $this->notes = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'form_id' => 'required|exists:forms,id',
            'date' => 'required|date',

            'items.*.name' => 'required',
            'items.*.total' => 'required|numeric',
            'items.*.advance' => 'required|numeric',
        ]);
    }

    public function store()
    {
        $this->validate([
            'form_id' => 'required|exists:forms,id',
            'date' => 'required|date',

            'items.*.name' => 'required',
            'items.*.total' => 'required|numeric',
            'items.*.advance' => 'required|numeric',
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

            Invoice::create([
                'created_by' => auth()->id(),
                'form_id' => $this->form_id,
                'serial'  => $this->number,
                'number'  => 'L3G6CIN' . $this->number,
                'date' => $this->date,
                'items' => $this->items,
                'method' => $this->method,
                'total_amount' => $total,
                'paid_amount' => $paid,
                'due_amount' => $due,
                'status' => $status,
                'notes' => $this->notes,
            ]);

            return redirect()->route('receptionist.invoices')->with('success', 'Data Created Successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data created failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = Invoice::findOrFail($id);
        $this->invoice_id = $id;
        $this->form_id = $edit->form_id;
        $this->serial = $edit->number;
        $this->date = $edit->date;
        $this->items = $edit->items;
        $this->method = $edit->method;
        $this->notes = $this->notes;
    }

    public function update()
    {
        $this->validate([
            'form_id' => 'required|exists:forms,id',
            'date' => 'required|date',

            'items.*.name' => 'required',
            'items.*.total' => 'required|numeric',
            'items.*.advance' => 'required|numeric',
        ]);

        try {
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

            $update = Invoice::findOrFail($this->invoice_id);
            $update->date = $this->date;
            $update->items = $this->items;
            $update->method = $this->method;
            $update->total_amount = $total;
            $update->paid_amount = $paid;
            $update->due_amount = $due;
            $update->status = $status;
            $update->notes = $this->notes;
            $update->save();

            return redirect()->route('receptionist.invoices')->with('success', 'Data successfully updated');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteInvoice()
    {
        try{
            $data = Invoice::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('invoice')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The invoice is deleted for information.");

            return redirect()->route('receptionist.invoices')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }

}