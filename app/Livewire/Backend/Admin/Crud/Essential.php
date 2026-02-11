<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Essential as EssentialModel;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Essential extends Component
{
    use WithFileUploads;

    public $file;
    public $newfile;
    public $icon;
    public $newicon;
    public $title;
    public $description;

    public $essential_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];


    public function render()
    {    $essentials = EssentialModel::latest()->get();

        return view('livewire.backend.admin.crud.essential', [
            'essentials' => $essentials,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Essentials | Let's Go China",
        ]);
    }

    private function resetInputFields()
    {
        $this->file = '';
        $this->icon = '';
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
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'file' => 'required',
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        try{
            $store = new EssentialModel();
            if($this->file) {
                $fileName = Carbon::now()->timestamp . '.' . $this->file->getClientOriginalExtension();
                $path = $this->file->storeAs('essentials', $fileName, 'public');
                $fileData = '/storage/'.$path;
                $store->file = $fileData;
            }
            if($this->icon) {
                $iconName = Carbon::now()->timestamp . '.' . $this->icon->getClientOriginalExtension();
                $path = $this->icon->storeAs('essentials', $iconName, 'public');
                $iconData = '/storage/'.$path;
                $store->icon = $iconData;
            }
            $store->title = $this->title;
            $store->description = $this->description;
            $store->save();

            return redirect()->route('admin.crud.essential')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = EssentialModel::findOrFail($id);
        $this->essential_id = $id;
        $this->file = $edit->file;
        $this->icon = $edit->icon;
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
            $update = EssentialModel::findOrFail($this->essential_id);

            if ($this->newfile) {
                if ($update->file) {
                    $oldFile = str_replace('/storage/', '', $update->file);

                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }

                $fileName = Carbon::now()->timestamp . '.' . $this->newfile->getClientOriginalExtension();
                $path = $this->newfile->storeAs('essentials', $fileName, 'public');
                $update->file = '/storage/' . $path;
            }

            if ($this->newicon) {
                if ($update->icon) {
                    $oldIcon = str_replace('/storage/', '', $update->icon);

                    if (Storage::disk('public')->exists($oldIcon)) {
                        Storage::disk('public')->delete($oldIcon);
                    }
                }

                $iconName = Carbon::now()->timestamp . '.' . $this->newicon->getClientOriginalExtension();
                $path = $this->newicon->storeAs('essentials', $iconName, 'public');
                $update->icon = '/storage/' . $path;
            }

            $update->title = $this->title;
            $update->description = $this->description;
            $update->save();

            return redirect()->route('admin.crud.essential')->with('success', 'Data successfully updated');

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
            $data = EssentialModel::find($this->delete_id);

            if (!$data) {
                return redirect()->back()->with('error', 'Data not found.');
            }
            if ($data->file) {
                $filePath = str_replace('/storage/', '', $data->file);

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
            if ($data->icon) {
                $iconPath = str_replace('/storage/', '', $data->icon);

                if (Storage::disk('public')->exists($iconPath)) {
                    Storage::disk('public')->delete($iconPath);
                }
            }

            $data->delete();

            return redirect()->route('admin.crud.essential')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = EssentialModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = EssentialModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->file) {
                    $filePath = str_replace('/storage/', '', $item->file);
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
                if ($item->icon) {
                    $iconPath = str_replace('/storage/', '', $item->icon);
                    if (Storage::disk('public')->exists($iconPath)) {
                        Storage::disk('public')->delete($iconPath);
                    }
                }
            }
            EssentialModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.essential')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}

