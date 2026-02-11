<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Choose as ChooseModel;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Choose extends Component
{
    use WithFileUploads;

    public $file;
    public $newfile;
    public $title;
    public $description;

    public $choose_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {    $chooses = ChooseModel::get();

        return view('livewire.backend.admin.crud.choose', [
            'chooses' => $chooses,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Chooses Us | Let's Go China",
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
            'file' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'file' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        try{
            $store = new ChooseModel();
            if($this->file) {
                $fileName = Carbon::now()->timestamp . '.' . $this->file->getClientOriginalExtension();
                $path = $this->file->storeAs('chooses', $fileName, 'public');
                $fileData = '/storage/'.$path;
                $store->file = $fileData;
            }
            $store->title = $this->title;
            $store->description = $this->description;
            $store->save();

            return redirect()->route('admin.crud.choose')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = ChooseModel::findOrFail($id);
        $this->choose_id = $id;
        $this->file = $edit->file;
        $this->title = $edit->title;
        $this->description = $edit->description;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            $update = ChooseModel::findOrFail($this->choose_id);

            if ($this->newfile) {
                if ($update->file) {
                    $oldFile = str_replace('/storage/', '', $update->file);

                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }

                $fileName = Carbon::now()->timestamp . '.' . $this->newfile->getClientOriginalExtension();
                $path = $this->newfile->storeAs('chooses', $fileName, 'public');
                $update->file = '/storage/' . $path;
            }

            $update->title = $this->title;
            $update->description = $this->description;
            $update->save();

            return redirect()->route('admin.crud.choose')->with('success', 'Data successfully updated');

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
            $data = ChooseModel::find($this->delete_id);

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

            return redirect()->route('admin.crud.choose')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = ChooseModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = ChooseModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->file) {
                    $filePath = str_replace('/storage/', '', $item->file);
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
            ChooseModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.choose')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}
