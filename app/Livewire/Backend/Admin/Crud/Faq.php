<?php

namespace App\Livewire\Backend\Admin\Crud;

use Livewire\Component;
use App\Models\Faq as FaqModel;

class Faq extends Component
{
    public $question;
    public $answer;

    public $faq_id;
    public $delete_id;

    public $selectedItems = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {    $faqs = FaqModel::get();

        return view('livewire.backend.admin.crud.faq', [
            'faqs' => $faqs,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Faqs | Let's Go China",
        ]);
    }

    private function resetInputFields()
    {
        $this->question = '';
        $this->answer = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }
    public function updated($name)
    {
        $this->validateOnly($name, [
            'question' => 'required',
            'answer' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        try{
            $store = new FaqModel();
            $store->question = $this->question;
            $store->answer = $this->answer;
            $store->save();

            return redirect()->route('admin.crud.faq')->with('success', 'Data is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data store failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit = FaqModel::findOrFail($id);
        $this->faq_id = $id;
        $this->question = $edit->question;
        $this->answer = $edit->answer;
    }

    public function update()
    {
        $this->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        try {
            $update = FaqModel::findOrFail($this->faq_id);
            $update->question = $this->question;
            $update->answer = $this->answer;
            $update->save();

            return redirect()->route('admin.crud.faq')->with('success', 'Data successfully updated');

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
            $data = FaqModel::find($this->delete_id);
            $data->delete();

            return redirect()->route('admin.crud.faq')->with('success', 'Data successfully deleted');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }


    public function selectedItemsAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = FaqModel::latest()->limit(10)->pluck('id')->map(function ($id) {
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
            FaqModel::whereIn('id', $this->selectedItems)->delete();

            $this->selectedItems = [];
            $this->selectAll = false;

            return redirect()->route('admin.crud.faq')->with('success', 'Selected data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data deletion failed: ' . $e->getMessage());
        }
    }
}