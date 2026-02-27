<?php

namespace App\Livewire\Backend\Agent;

use Livewire\Component;
use App\Models\Document;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class DocumentComponent extends Component
{
    use WithFileUploads;

    public $file;
    public $newfile;
    public $client_id;
    public $type;

    public $document_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {    
       $documents = Document::where('agent_id', auth()->id())->latest()->get();
       $clients = User::where('type', 'client')->where('agent_id', auth()->id())->latest()->get();

        return view('livewire.backend.agent.document-component', [
            'documents' => $documents,
            'clients' => $clients,
        ])
        ->layout('layouts.agent.app', [
            'title' => "Documents Us | Let's Go China",
        ]);
    }

    private function resetInputFields()
    {
        $this->file = '';
        $this->client_id = '';
        $this->type = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }
    public function updated($name)
    {
        $this->validateOnly($name, [
            'file' => 'required',
            'client_id' => 'required',
            'type' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'file' => 'required',
            'client_id' => 'required',
            'type' => 'required',
        ]);
        try{
            $store = new Document();
            if($this->file) {
                $fileName = Carbon::now()->timestamp . '.' . $this->file->getClientOriginalExtension();
                $path = $this->file->storeAs('documents', $fileName, 'public');
                $fileData = '/storage/'.$path;
                $store->file = $fileData;
            }
            $store->agent_id = auth()->id();
            $store->client_id = $this->client_id;
            $store->name = $this->type;
            $store->save();

            return redirect()->route('agent.documents')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = Document::findOrFail($id);
        $this->document_id = $id;
        $this->file = $edit->file;
    }

    public function update()
    {
        try {
            $update = Document::findOrFail($this->document_id);

            if ($this->newfile) {
                if ($update->file) {
                    $oldFile = str_replace('/storage/', '', $update->file);

                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }

                $fileName = Carbon::now()->timestamp . '.' . $this->newfile->getClientOriginalExtension();
                $path = $this->newfile->storeAs('documents', $fileName, 'public');
                $update->file = '/storage/' . $path;
            }

            $update->status = 'uploaded';
            $update->save();

            return redirect()->route('agent.documents')->with('success', 'Data successfully updated');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function verify($id)
    {
        Document::find($id)->update([
            'status' => 'verified',
            'verified_by' => auth()->id()
        ]);

        return redirect()->route('agent.documents')->with('success', 'Data successfully verified');
    }
}

