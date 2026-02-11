<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Bannar as BannarModel;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Bannar extends Component
{
    use WithFileUploads;

    public $type;
    public $file;
    public $newfile;
    public $title;

    public $bannar_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {    $bannars = BannarModel::get();

        return view('livewire.backend.admin.bannar', [
            'bannars' => $bannars,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Bannar | Let's Go China",
        ]);
    }

     private function resetInputFields()
    {
        $this->type = '';
        $this->file = '';
        $this->title = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }
    public function updated($name)
    {
        $this->validateOnly($name, [
            'type' => 'required',
            'file' => 'required',
            'title' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'type' => 'required',
            'file' => 'required',
            'title' => 'required',
        ]);

        try{
            $store = new VisaModel();
            $store->icon = $this->icon;
            if($this->file) {
                $fileName = Carbon::now()->timestamp . '.' . $this->file->getClientOriginalExtension();
                $path = $this->file->storeAs('bannars', $fileName, 'public');
                $fileData = '/storage/'.$path;
                $store->file = $fileData;
            }
            $store->icon = $this->icon;
            $store->title = $this->title;
            $store->subtitle = $this->subtitle;
            $store->description = $this->description;
            $store->save();

            return redirect()->route('admin.crud.visa')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = VisaModel::findOrFail($id);
        $this->bannar_id = $id;
        $this->file = $edit->file;
        $this->icon = $edit->icon;
        $this->title = $edit->title;
        $this->subtitle = $edit->subtitle;
        $this->description = $edit->description;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ]);

        try {
            $update = VisaModel::findOrFail($this->bannar_id);

            if ($this->newfile) {
                if ($update->file) {
                    $oldFile = str_replace('/storage/', '', $update->file);

                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }

                $fileName = Carbon::now()->timestamp . '.' . $this->newfile->getClientOriginalExtension();
                $path = $this->newfile->storeAs('bannars', $fileName, 'public');
                $update->file = '/storage/' . $path;
            }

            $update->icon = $this->icon;
            $update->subtitle = $this->subtitle;
            $update->description = $this->description;
            $update->save();

            return redirect()->route('admin.crud.visa')->with('success', 'Data successfully updated');

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
            $data = VisaModel::find($this->delete_id);

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

            return redirect()->route('admin.crud.visa')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = VisaModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = VisaModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->file) {
                    $filePath = str_replace('/storage/', '', $item->file);
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
            VisaModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.visa')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


}
