<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Client;
use App\Services\ProfileCompletionService;

class AcademicInformationComponent extends Component
{
    use WithFileUploads;

    public Client $client;

    public $educations = [];

    public $openEdit = FALSE;

    protected $rules = [
        'educations.*.degree' => 'required',
        'educations.*.institution' => 'required',
        'educations.*.year' => 'required',
        'educations.*.grade' => 'required',
    ];

    public function mount()
    {
        $this->client = auth()->user()->client;

        $data = $this->client->data ?? [];

        $this->educations = $data['educations'] ?? [
            [
                'degree' => '',
                'institution' => '',
                'year' => '',
                'grade' => '',
            ]
        ];
    }

    public function edit()
    {
        if($this->openEdit  == FALSE){
            $this->openEdit = TRUE;
        }else{
            $this->openEdit = FALSE;
        }
    }

    public function addRow()
    {
        $this->educations[] = [
            'degree' => '',
            'institution' => '',
            'year' => '',
            'grade' => '',
        ];
    }

    public function removeRow($index)
    {
        unset($this->educations[$index]);
        $this->educations = array_values($this->educations);
    }

    public function save()
    {
        $this->validate();

        $this->client->update([
            'data->educations' => $this->educations,
        ]);

        ProfileCompletionService::calculate($this->client);

        session()->flash('success','Academic Information Saved Successfully.');
    }

    public function render()
    {
        return view('livewire.frontend.client.academic-information-component')
        ->layout('layouts.client.app', [
            'title' => "Academic | Let's Go China"
        ]);
    }
}
