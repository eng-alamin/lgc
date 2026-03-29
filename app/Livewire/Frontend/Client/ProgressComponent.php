<?php

namespace App\Livewire\Frontend\Client;

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

class ProgressComponent extends Component
{
    use WithFileUploads;

    public Client $client;

    public $form;

    public function mount()
    {
        $this->client = auth()->user()->client;
        $this->form = $this->client->form;
    }

    public function render()
    {
        return view('livewire.frontend.client.progress-component',[
            'timeline' => $this->form?->stageHistories()->with('stage')->get()
        ])
        ->layout('layouts.client.app', [
            'title' => "Progress | Let's Go China"
        ]);
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

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }
}
