<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Province as ProvinceModel;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Province extends Component
{
    use WithFileUploads;

    public $image;
    public $newimage;
    public $name;
    public $title;
    public $description;

    public $province_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {    $provinces = ProvinceModel::get();

        return view('livewire.backend.admin.crud.province', [
            'provinces' => $provinces,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Provinces | Let's Go China",
        ]);
    }

    private function resetInputFields()
    {
        $this->image = '';
        $this->name = '';
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
            'image' => 'required',
            'name' => 'required',
            'title' => 'required',
        ]);
    }


    public $names = [''];
    public function addInput()
    {
        $this->names[] = '';
    }
    public function removeInput($index)
    {
        unset($this->names[$index]);
        $this->names = array_values($this->names);
    }

    public function store()
    {
        $this->validate([
            'image' => 'required',
            'name' => 'required',
            'title' => 'required',
        ]);

        try{
            $store = new ProvinceModel();
            if($this->image) {
                $imageName = Carbon::now()->timestamp . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('provinces', $imageName, 'public');
                $imageData = '/storage/'.$path;
                $store->image = $imageData;
            }
            $store->name = $this->name;
            $store->title = $this->title;
            $store->description = $this->description;
            $store->json = json_encode($this->names);
            $store->save();

            return redirect()->route('admin.crud.province')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = ProvinceModel::findOrFail($id);
        $this->province_id = $id;
        $this->image = $edit->image;
        $this->name = $edit->name;
        $this->title = $edit->title;
        $this->description = $edit->description;
        $this->names = json_decode($edit->json);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'title' => 'required',
        ]);

        try {
            $update = ProvinceModel::findOrFail($this->province_id);

            if ($this->newimage) {
                if ($update->image) {
                    $oldImage = str_replace('/storage/', '', $update->image);

                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }

                $imageName = Carbon::now()->timestamp . '.' . $this->newimage->getClientOriginalExtension();
                $path = $this->newimage->storeAs('provinces', $imageName, 'public');
                $update->image = '/storage/' . $path;
            }

            $update->name = $this->name;
            $update->title = $this->title;
            $update->description = $this->description;
            $update->json = json_encode($this->names);
            $update->save();

            return redirect()->route('admin.crud.province')->with('success', 'Data successfully updated');

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
            $data = ProvinceModel::find($this->delete_id);

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

            return redirect()->route('admin.crud.province')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = ProvinceModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = ProvinceModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->file) {
                    $filePath = str_replace('/storage/', '', $item->file);
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
            ProvinceModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.province')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}