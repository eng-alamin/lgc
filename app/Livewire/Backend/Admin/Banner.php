<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Banner as BannerModel;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Banner extends Component
{
    use WithFileUploads;

    public $type;
    public $file;
    public $newfile;
    public $title;
    public $description;
    public $number;

    public $banner_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {    $data = BannerModel::get();

        return view('livewire.backend.admin.banner', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Banners | Let's Go China",
        ]);
    }

     private function resetInputFields()
    {
        $this->type = '';
        $this->file = '';
        $this->title = '';
        $this->description = '';
        $this->number = '';
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
        ]);
    }

    public function store()
    {
        $this->validate([
            'type' => 'required',
        ]);

        try{
            $store = new BannerModel();
            if($this->file) {
                $fileName = Carbon::now()->timestamp . '.' . $this->file->getClientOriginalExtension();
                $path = $this->file->storeAs('banners', $fileName, 'public');
                $fileData = '/storage/'.$path;
                $store->file = $fileData;
            }
            $store->type = $this->type;
            $store->title = $this->title;
            $store->description = $this->description;
            $store->number = $this->number;
            $store->save();

            return redirect()->route('admin.banners')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = BannerModel::findOrFail($id);
        $this->banner_id = $id;
        $this->type = $edit->type;
        $this->file = $edit->file;
        $this->title = $edit->title;
        $this->description = $edit->description;
        $this->number = $edit->number;

        $this->dispatch('refreshSelect');
    }

    public function update()
    {
        $this->validate([
            'type' => 'required',
        ]);

        try {
            $update = BannerModel::findOrFail($this->banner_id);

            if ($this->newfile) {
                if ($update->file) {
                    $oldFile = str_replace('/storage/', '', $update->file);

                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }

                $fileName = Carbon::now()->timestamp . '.' . $this->newfile->getClientOriginalExtension();
                $path = $this->newfile->storeAs('banners', $fileName, 'public');
                $update->file = '/storage/' . $path;
            }

            $update->type = $this->type;
            $update->title = $this->title;
            $update->description = $this->description;
            $update->number = $this->number;
            $update->save();

            return redirect()->route('admin.banners')->with('success', 'Data successfully updated');

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
            $data = BannerModel::find($this->delete_id);

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

            return redirect()->route('admin.banners')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = BannerModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = BannerModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->file) {
                    $filePath = str_replace('/storage/', '', $item->file);
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
            BannerModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.banners')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }

}
