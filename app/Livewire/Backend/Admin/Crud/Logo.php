<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Logo as LogoModel;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Logo extends Component
{
    use WithFileUploads;

    public $file;
    public $newfile;

    public $logo_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    
    public function render()
    {    $logos = LogoModel::get();

        return view('livewire.backend.admin.crud.logo', [
            'logos' => $logos,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Logos | Let's Go China",
        ]);
    }
    private function resetInputFields()
    {
        $this->file = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }
    public function updated($name)
    {
        $this->validateOnly($name, [
            'file' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'file' => 'required',
        ]);

        try{
            $store = new LogoModel();
            if($this->file) {
                $fileName = Carbon::now()->timestamp . '.' . $this->file->getClientOriginalExtension();
                $path = $this->file->storeAs('logos', $fileName, 'public');
                $fileData = '/storage/'.$path;
                $store->file = $fileData;
            }
            $store->save();

            return redirect()->route('admin.crud.logo')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = LogoModel::findOrFail($id);
        $this->logo_id = $id;
        $this->file = $edit->file;
    }

    public function update()
    {

        try {
            $update = LogoModel::findOrFail($this->logo_id);

            if ($this->newfile) {
                if ($update->file) {
                    $oldFile = str_replace('/storage/', '', $update->file);

                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }

                $fileName = Carbon::now()->timestamp . '.' . $this->newfile->getClientOriginalExtension();
                $path = $this->newfile->storeAs('logos', $fileName, 'public');
                $update->file = '/storage/' . $path;
            }
            $update->save();

            return redirect()->route('admin.crud.logo')->with('success', 'Data successfully updated');

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
            $data = LogoModel::find($this->delete_id);

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

            return redirect()->route('admin.crud.logo')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = LogoModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = LogoModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->file) {
                    $filePath = str_replace('/storage/', '', $item->file);
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
            LogoModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.logo')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}
