<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Blog as BlogModel;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Blog extends Component
{
    use WithFileUploads;

    public $file;
    public $newfile;
    public $title;
    public $short_description;
    public $description;

    public $blog_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {
        $blogs = BlogModel::latest()->get();

        return view('livewire.backend.admin.crud.blog', [
            'blogs' => $blogs,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Blogs | Let's Go China",
        ]);
    }

    private function resetInputFields()
    {
        $this->file = '';
        $this->title = '';
        $this->short_description = '';
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
            'short_description' => 'required',
            'description' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'file' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        try{
            $store = new BlogModel();
            if($this->file) {
                $fileName = Carbon::now()->timestamp . '.' . $this->file->getClientOriginalExtension();
                $path = $this->file->storeAs('blogs', $fileName, 'public');
                $fileData = '/storage/'.$path;
                $store->file = $fileData;
            }
            $store->title = $this->title;
            $store->short_description = $this->short_description;
            $store->description = $this->description;
            $store->save();

            return redirect()->route('admin.crud.blog')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = BlogModel::findOrFail($id);
        $this->blog_id = $id;
        $this->file = $edit->file;
        $this->title = $edit->title;
        $this->short_description = $edit->short_description;
        $this->description = $edit->description;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        try {
            $update = BlogModel::findOrFail($this->blog_id);

            if ($this->newfile) {
                if ($update->file) {
                    $oldFile = str_replace('/storage/', '', $update->file);

                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }

                $fileName = Carbon::now()->timestamp . '.' . $this->newfile->getClientOriginalExtension();
                $path = $this->newfile->storeAs('blogs', $fileName, 'public');
                $update->file = '/storage/' . $path;
            }

            $update->title = $this->title;
            $update->short_description = $this->short_description;
            $update->description = $this->description;
            $update->save();

            return redirect()->route('admin.crud.blog')->with('success', 'Data successfully updated');

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
            $data = BlogModel::find($this->delete_id);

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

            return redirect()->route('admin.crud.blog')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = BlogModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = BlogModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->file) {
                    $filePath = str_replace('/storage/', '', $item->file);
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
            BlogModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.blog')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}
