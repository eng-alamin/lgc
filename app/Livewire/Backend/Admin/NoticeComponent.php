<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Notice;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class NoticeComponent extends Component
{
    use WithFileUploads;

    public $file;
    public $newfile;
    public $title;
    public $description;

    public $notice_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {    $data = Notice::get();

        return view('livewire.backend.admin.notice-component', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Notices | Let's Go China",
        ]);
    }

     private function resetInputFields()
    {
        $this->file = '';
        $this->title = '';
        $this->description = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }
    public function updated($name)
    {
        $this->validateOnly($name, [
            'title' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
        ]);

        try{
            $store = new Notice();
            if($this->file) {
                $fileName = Carbon::now()->timestamp . '.' . $this->file->getClientOriginalExtension();
                $path = $this->file->storeAs('notices', $fileName, 'public');
                $fileData = '/storage/'.$path;
                $store->file = $fileData;
            }
            $store->title = $this->title;
            $store->description = $this->description;
            $store->save();

            return redirect()->route('admin.notices')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = Notice::findOrFail($id);
        $this->notice_id = $id;
        $this->file = $edit->file;
        $this->title = $edit->title;
        $this->description = $edit->description;

        $this->dispatch('refreshSelect');
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
        ]);

        try {
            $update = Notice::findOrFail($this->notice_id);

            if ($this->newfile) {
                if ($update->file) {
                    $oldFile = str_replace('/storage/', '', $update->file);

                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }

                $fileName = Carbon::now()->timestamp . '.' . $this->newfile->getClientOriginalExtension();
                $path = $this->newfile->storeAs('notices', $fileName, 'public');
                $update->file = '/storage/' . $path;
            }

            $update->title = $this->title;
            $update->description = $this->description;
            $update->save();

            return redirect()->route('admin.notices')->with('success', 'Data successfully updated');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }


    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }

    public function delete()
    {
        try {
            $data = Notice::find($this->delete_id);

            if (!$data) {
                return redirect()->back()->with('error', 'Data not found.');
            }
            if ($data->file) {
                $filePath = str_replace('/storage/', '', $data->file);

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }

            $data->delete();

            return redirect()->route('admin.notices')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = Notice::latest()->limit(10)->pluck('id')->map(function ($id) {
                return (string) $id;
            })->toArray();
        } else {
            $this->selectedItems = [];
        }
    }
    public function selectedItemsClick()
    {
        return $this->selectedItems;
    }
    public function selectedItemsCount()
    {
        return count($this->selectedItems);
    }
    public function deleteSelectedItems()
    {

        try {
            $data = Notice::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->file) {
                    $filePath = str_replace('/storage/', '', $item->file);
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
            Notice::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.notices')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}
