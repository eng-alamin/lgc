<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Testimonial as TestimonialModel;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Testimonial extends Component
{
    use WithFileUploads;

    public $image;
    public $newimage;
    public $name;
    public $position;
    public $comment;
    public $review;

    public $testimonial_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];


    public function render()
    {    $testimonials = TestimonialModel::latest()->get();

        return view('livewire.backend.admin.crud.testimonial', [
            'testimonials' => $testimonials,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Testimonials | Let's Go China",
        ]);
    }

    private function resetInputFields()
    {
        $this->image = '';
        $this->name = '';
        $this->position = '';
        $this->comment = '';
        $this->review = '';
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
            'position' => 'required',
            'comment' => 'required',
            'review' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'image' => 'required',
            'name' => 'required',
            'position' => 'required',
            'comment' => 'required',
            'review' => 'required',
        ]);

        try{
            $store = new TestimonialModel();
            if($this->image) {
                $imageName = Carbon::now()->timestamp . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('testimonials', $imageName, 'public');
                $imageData = '/storage/'.$path;
                $store->image = $imageData;
            }
            $store->name = $this->name;
            $store->position = $this->position;
            $store->comment = $this->comment;
            $store->review = $this->review;
            $store->save();

            return redirect()->route('admin.crud.testimonial')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = TestimonialModel::findOrFail($id);
        $this->testimonial_id = $id;
        $this->image = $edit->image;
        $this->name = $edit->name;
        $this->position = $edit->position;
        $this->comment = $edit->comment;
        $this->review = $edit->review;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'position' => 'required',
            'comment' => 'required',
            'review' => 'required',
        ]);

        try {
            $update = TestimonialModel::findOrFail($this->testimonial_id);

            if ($this->newimage) {
                if ($update->image) {
                    $oldImage = str_replace('/storage/', '', $update->image);

                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }

                $imageName = Carbon::now()->timestamp . '.' . $this->newimage->getClientOriginalExtension();
                $path = $this->newimage->storeAs('testimonials', $imageName, 'public');
                $update->image = '/storage/' . $path;
            }

            $update->name = $this->name;
            $update->position = $this->position;
            $update->comment = $this->comment;
            $update->review = $this->review;
            $update->save();

            return redirect()->route('admin.crud.testimonial')->with('success', 'Data successfully updated');

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
            $data = TestimonialModel::find($this->delete_id);

            if (!$data) {
                return redirect()->back()->with('error', 'Data not found.');
            }
            if ($data->image) {
                $imagePath = str_replace('/storage/', '', $data->image);

                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            $data->delete();

            return redirect()->route('admin.crud.testimonial')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = TestimonialModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = TestimonialModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->image) {
                    $imagePath = str_replace('/storage/', '', $item->image);
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }
            TestimonialModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.testimonial')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}
