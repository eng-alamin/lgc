<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Course as CourseModel;

class Course extends Component
{
    public $number;
    public $title;
    public $description;

    public $course_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {    $data = CourseModel::get();

        return view('livewire.backend.admin.crud.course', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Courses Us | Let's Go China",
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
            $store = new CourseModel();
            $store->number = $this->number;
            $store->title = $this->title;
            $store->description = $this->description;
            $store->save();

            return redirect()->route('admin.crud.courses')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = CourseModel::findOrFail($id);
        $this->course_id = $id;
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
            $update = CourseModel::findOrFail($this->course_id);

            $update->number = $this->number;
            $update->title = $this->title;
            $update->description = $this->description;
            $update->save();

            return redirect()->route('admin.crud.courses')->with('success', 'Data successfully updated');

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
            $data = CourseModel::find($this->delete_id);
            $data->delete();

            return redirect()->route('admin.crud.courses')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = CourseModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            CourseModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.courses')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}