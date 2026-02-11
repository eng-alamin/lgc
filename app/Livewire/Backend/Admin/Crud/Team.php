<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Team as TeamModel;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use File;

class Team extends Component
{
    use WithFileUploads;

    public $image;
    public $newimage;
    public $name;
    public $position;
    public $social = [
        'facebook' => '',
        'instagram' => '',
        'x' => '',
        'linkedin' => '',
    ];

    public $team_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];


    public function render()
    {    $teams = TeamModel::latest()->get();

        return view('livewire.backend.admin.crud.team', [
            'teams' => $teams,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Teams | Let's Go China",
        ]);
    }

    private function resetInputFields()
    {
        $this->image = '';
        $this->name = '';
        $this->position = '';
        $this->social = '';
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
            'social.facebook' => 'nullable|url',
            'social.instagram' => 'nullable|url',
            'social.x' => 'nullable|url',
            'social.linkedin' => 'nullable|url',
        ]);
    }

    public function store()
    {
       
        $this->validate([
            'image' => 'required',
            'name' => 'required',
            'position' => 'required',
            'social.facebook' => 'nullable',
            'social.instagram' => 'nullable',
            'social.x' => 'nullable',
            'social.linkedin' => 'nullable',
        ]);

        try{
            $store = new TeamModel();
            if($this->image) {
                $imageName = Carbon::now()->timestamp . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('teams', $imageName, 'public');
                $imageData = '/storage/'.$path;
                $store->image = $imageData;
            }
            $store->name = $this->name;
            $store->position = $this->position;
            $store->social = array_filter($this->social);
            $store->save();

            return redirect()->route('admin.crud.team')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = TeamModel::findOrFail($id);
        $this->team_id = $id;
        $this->image = $edit->image;
        $this->name = $edit->name;
        $this->position = $edit->position;

        $dbSocial = is_array($edit->social) ? $edit->social : json_decode($edit->social, true);
        $this->social = array_merge(
            [
                'facebook' => '',
                'instagram' => '',
                'x' => '',
                'linkedin' => '',
            ],
            $dbSocial ?? []
        );
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'position' => 'required',
            'social.facebook' => 'nullable|url',
            'social.instagram' => 'nullable|url',
            'social.x' => 'nullable|url',
            'social.linkedin' => 'nullable|url',
        ]);

        try {
            $update = TeamModel::findOrFail($this->team_id);

            if ($this->newimage) {
                if ($update->image) {
                    $oldImage = str_replace('/storage/', '', $update->image);

                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }

                $imageName = Carbon::now()->timestamp . '.' . $this->newimage->getClientOriginalExtension();
                $path = $this->newimage->storeAs('teams', $imageName, 'public');
                $update->image = '/storage/' . $path;
            }

            $update->name = $this->name;
            $update->position = $this->position;
            $update->social = array_filter($this->social);
            $update->save();

            return redirect()->route('admin.crud.team')->with('success', 'Data successfully updated');

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
            $data = TeamModel::find($this->delete_id);

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

            return redirect()->route('admin.crud.team')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = TeamModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            $data = TeamModel::whereIn('id', $this->selectedItems)->get();

            foreach ($data as $item) {
                if ($item->image) {
                    $imagePath = str_replace('/storage/', '', $item->image);
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }
            TeamModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.team')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}
