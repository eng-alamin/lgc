<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\University as UniversityModel;

class University extends Component
{
    public $number;
    public $title;
    public $description;

    public $university_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {    $data = UniversityModel::get();

        return view('livewire.backend.admin.crud.university', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Universities Us | Let's Go China",
        ]);
    }

    private function resetInputFields()
    {
        $this->number = '';
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
            'number' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'number' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        try{
            $store = new UniversityModel();
            $store->number = $this->number;
            $store->title = $this->title;
            $store->description = $this->description;
            $store->save();

            return redirect()->route('admin.crud.universities')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = UniversityModel::findOrFail($id);
        $this->university_id = $id;
        $this->number = $edit->number;
        $this->title = $edit->title;
        $this->description = $edit->description;
    }

    public function update()
    {
        $this->validate([
            'number' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            $update = UniversityModel::findOrFail($this->university_id);

            $update->number = $this->number;
            $update->title = $this->title;
            $update->description = $this->description;
            $update->save();

            return redirect()->route('admin.crud.universities')->with('success', 'Data successfully updated');

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
            $data = UniversityModel::find($this->delete_id);
            $data->delete();

            return redirect()->route('admin.crud.universities')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = UniversityModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            UniversityModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.universities')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}
