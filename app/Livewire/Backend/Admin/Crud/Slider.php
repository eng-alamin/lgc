<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Slider as SliderModel;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Slider extends Component
{
    use WithFileUploads;

    public $file1;
    public $newfile1;
    public $file2;
    public $newfile2;
    public $file3;
    public $newfile3;
    public $file4;
    public $newfile4;
    public $subtitle;
    public $title;
    public $description;
    public $link;

    public $slider_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {
        $sliders = SliderModel::get();

        return view('livewire.backend.admin.crud.slider', [
            'sliders' => $sliders,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Sliders | Let's Go China",
        ]);
    }
private function resetInputFields()
    {
        $this->file1 = '';
        $this->file2 = '';
        $this->file3 = '';
        $this->file4 = '';
        $this->subtitle = '';
        $this->title = '';
        $this->description = '';
        $this->link = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }
    public function updated($name)
    {
        $this->validateOnly($name, [
            'file1' => 'required',
            'subtitle' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'file1' => 'required',
            'subtitle' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        try{
            $store = new SliderModel();
            if($this->file1) {
                $fileName1 = time() . '_' . uniqid() . '.' . $this->file1->getClientOriginalExtension();
                $path = $this->file1->storeAs('sliders', $fileName1, 'public');
                $fileData1 = '/storage/'.$path;
                $store->file1 = $fileData1;
            }
            if($this->file2) {
                $fileName2 = time() . '_' . uniqid() . '.' . $this->file2->getClientOriginalExtension();
                $path = $this->file2->storeAs('sliders', $fileName2, 'public');
                $fileData2 = '/storage/'.$path;
                $store->file2 = $fileData2;
            }
            if($this->file3) {
                $fileName3 = time() . '_' . uniqid() . '.' . $this->file3->getClientOriginalExtension();
                $path = $this->file3->storeAs('sliders', $fileName3, 'public');
                $fileData3 = '/storage/'.$path;
                $store->file3 = $fileData3;
            }
            if($this->file4) {
                $fileName4 = time() . '_' . uniqid() . '.' . $this->file4->getClientOriginalExtension();
                $path = $this->file4->storeAs('sliders', $fileName4, 'public');
                $fileData4 = '/storage/'.$path;
                $store->file4 = $fileData4;
            }

            $store->subtitle = $this->subtitle;
            $store->title = $this->title;
            $store->description = $this->description;
            $store->link = $this->link;
            $store->save();

            return redirect()->route('admin.crud.slider')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = SliderModel::findOrFail($id);
        $this->slider_id = $id;
        $this->file1 = $edit->file1;
        $this->file2 = $edit->file2;
        $this->file3 = $edit->file3;
        $this->file4 = $edit->file4;
        $this->subtitle = $edit->subtitle;
        $this->title = $edit->title;
        $this->description = $edit->description;
        $this->link = $edit->link;
    }

    public function update()
    {
        $this->validate([
            'subtitle' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            $update = SliderModel::findOrFail($this->slider_id);

            if ($this->newfile1) {
                if ($update->file1) {
                    $oldFile1 = str_replace('/storage/', '', $update->file1);

                    if (Storage::disk('public')->exists($oldFile1)) {
                        Storage::disk('public')->delete($oldFile1);
                    }
                }

                $fileName1 = time() . '_' . uniqid() . '.' . $this->newfile1->getClientOriginalExtension();
                $path = $this->newfile1->storeAs('sliders', $fileName1, 'public');
                $update->file1 = '/storage/' . $path;
            }
            if ($this->newfile2) {
                if ($update->file2) {
                    $oldFile2 = str_replace('/storage/', '', $update->file2);

                    if (Storage::disk('public')->exists($oldFile2)) {
                        Storage::disk('public')->delete($oldFile2);
                    }
                }

                $fileName2 = time() . '_' . uniqid() . '.' . $this->newfile2->getClientOriginalExtension();
                $path = $this->newfile2->storeAs('sliders', $fileName2, 'public');
                $update->file2 = '/storage/' . $path;
            }
            if ($this->newfile3) {
                if ($update->file3) {
                    $oldFile3 = str_replace('/storage/', '', $update->file3);

                    if (Storage::disk('public')->exists($oldFile3)) {
                        Storage::disk('public')->delete($oldFile3);
                    }
                }

                $fileName3 = time() . '_' . uniqid() . '.' . $this->newfile3->getClientOriginalExtension();
                $path = $this->newfile3->storeAs('sliders', $fileName3, 'public');
                $update->file3 = '/storage/' . $path;
            }
            if ($this->newfile4) {
                if ($update->file4) {
                    $oldFile4 = str_replace('/storage/', '', $update->file4);

                    if (Storage::disk('public')->exists($oldFile4)) {
                        Storage::disk('public')->delete($oldFile4);
                    }
                }

                $fileName4 = time() . '_' . uniqid() . '.' . $this->newfile4->getClientOriginalExtension();
                $path = $this->newfile4->storeAs('sliders', $fileName4, 'public');
                $update->file4 = '/storage/' . $path;
            }

            $update->subtitle = $this->subtitle;
            $update->title = $this->title;
            $update->description = $this->description;
            $update->link = $this->link;
            $update->save();

            return redirect()->route('admin.crud.slider')->with('success', 'Data successfully updated');

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
            $data = SliderModel::find($this->delete_id);

            if (!$data) {
                return redirect()->back()->with('error', 'Data not found.');
            }
            if ($data->file1) {
                $filePath1 = str_replace('/storage/', '', $data->file1);

                if (Storage::disk('public')->exists($filePath1)) {
                    Storage::disk('public')->delete($filePath1);
                }
            }
            if ($data->file2) {
                $filePath2 = str_replace('/storage/', '', $data->file2);

                if (Storage::disk('public')->exists($filePath2)) {
                    Storage::disk('public')->delete($filePath2);
                }
            }
            if ($data->file3) {
                $filePath3 = str_replace('/storage/', '', $data->file3);

                if (Storage::disk('public')->exists($filePath3)) {
                    Storage::disk('public')->delete($filePath3);
                }
            }
            if ($data->file4) {
                $filePath4 = str_replace('/storage/', '', $data->file4);

                if (Storage::disk('public')->exists($filePath4)) {
                    Storage::disk('public')->delete($filePath4);
                }
            }

            $data->delete();

            return redirect()->route('admin.crud.slider')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = SliderModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = SliderModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->file1) {
                    $filePath1 = str_replace('/storage/', '', $item->file1);
                    if (Storage::disk('public')->exists($filePath1)) {
                        Storage::disk('public')->delete($filePath1);
                    }
                }
                if ($item->file2) {
                    $filePath2 = str_replace('/storage/', '', $item->file2);
                    if (Storage::disk('public')->exists($filePath2)) {
                        Storage::disk('public')->delete($filePath2);
                    }
                }
                if ($item->file3) {
                    $filePath3 = str_replace('/storage/', '', $item->file3);
                    if (Storage::disk('public')->exists($filePath3)) {
                        Storage::disk('public')->delete($filePath3);
                    }
                }
                if ($item->file4) {
                    $filePath4 = str_replace('/storage/', '', $item->file4);
                    if (Storage::disk('public')->exists($filePath4)) {
                        Storage::disk('public')->delete($filePath4);
                    }
                }
            }
            SliderModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.slider')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}
