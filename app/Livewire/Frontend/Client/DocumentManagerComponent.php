<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithFileUploads;
use App\Models\Document;
use Carbon\Carbon;
use App\Services\ProfileCompletionService;

class DocumentManagerComponent extends Component
{
    use WithFileUploads;

    public $client;
    public $document_type;
    public $document_name;
    public $file;
    public $notes;

    public function mount()
    {
        $this->client = Client::where('user_id', auth()->id())->first();

        if (!$this->client) {
            abort(404, 'Client Not Found');
        }
    }

    protected function rules()
    {
        return [
            'document_type' => 'required',
            'document_name' => 'required_if:document_type,other',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ];
    }

    public function uploadFile()
    {
        $fileName = Carbon::now()->timestamp.'.'.$this->file->getClientOriginalExtension();
        $path = $this->file->storeAs('documents', $fileName, 'public');
        return '/storage/'.$path;
    }

    public function save()
    {
        $this->validate();

        $latest = Document::where('client_id', $this->client->id)
            ->where('document_type', $this->document_type)
            ->latest()
            ->first();

        $version = $latest ? $latest->version + 1 : 1;

        if ($latest) {
            $latest->update(['status' => 'pending']);
        }

        if($this->document_type == "other"){
            $document_type = $this->document_name;
        }else{
            $document_type = $this->document_type;
        }

        Document::updateOrCreate(
                [
                    'client_id' => $this->client->id,
                    'document_type' => $document_type,
                ],
                [
                    'file' => $this->file ? $this->uploadFile() : null,
                    'status' => 'uploaded',
                    'notes' => $this->notes,
                    'version' => $version,
                ]
            );

        ProfileCompletionService::calculate($this->client);

        session()->flash('success', 'Document Uploaded Successfully');

        $this->reset(['document_type', 'document_name', 'file', 'notes',]);
    }

    public function render()
    {
        return view('livewire.frontend.client.document-manager-component',[
            'documents' => $this->client->documents()->latest()->get()
        ])
        ->layout('layouts.client.app', [
            'title' => "Academic | Let's Go China"
        ]);
    }
}
