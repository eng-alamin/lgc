<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Client;
use App\Models\Document;
use Livewire\WithFileUploads;

class DocumentComponent extends Component
{
    use WithFileUploads;

    public $file;
    public $newfile;

    public $client_id;
    public $document_type;
    public $document_name;
    public $notes;

    public function render()
    {    
       $documents = Document::latest()->get();
       $clients = Client::latest()->get();

        return view('livewire.backend.admin.document-component', [
            'documents' => $documents,
            'clients' => $clients,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Documents Us | Let's Go China",
        ]);
    }

    public function canChangeTo($currentStatus, $newStatus)
    {
        $flow = config('status_flow.document');

        if (!isset($flow[$currentStatus])) {
            return false;
        }

        return in_array($newStatus, $flow[$currentStatus]);
    }

    public function statusClick($id, $newStatus)
    {
        $document = Document::findOrFail($id);

        // Prevent invalid transition
        if (!$this->canChangeTo($document->status, $newStatus)) {
            session()->flash('error', 'Invalid status transition!');
            return;
        }

        // Already approved check
        if ($document->status === 'verified') {
            session()->flash('error', 'Already Verified');
            return;
        }

        // Update Status
        $document->update([
            'status' => $newStatus,
            'verified_by' => auth()->id(),
        ]);
        
        return redirect()->route('admin.documents')->with('success', 'Document is successfully status!');
    }
}