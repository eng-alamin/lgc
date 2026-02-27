<?php

namespace App\Livewire\Backend\Admin\Application;

use Livewire\Component;
use App\Models\User;
use App\Models\Form;
use App\Models\StatusHistory;

class AddComponent extends Component
{
    public $clients;
    public $client_id;
    public $service;

    public $e_name;
    public $e_gender;
    public $e_date_of_birth;
    public $e_nationality;
    public $e_marital_status;
    public $e_religion;
    public $e_number;
    public $e_email;
    public $e_current_address;
    public $e_permanent_address;
    public $e_passport_number;
    public $e_date_of_issue;
    public $e_date_of_expiry;
    public $e_place_of_issue;
    public $e_medium_of_instruction;
    public $e_duolingo;
    public $e_score;
    public $e_intended_level_of_study;
    public $e_preferred_field_of_study;
    public $e_preferred_intake;
    public $e_preferred_university;
    public $e_guardian_name;
    public $e_guardian_relationship;
    public $e_guardian_number;
    public $e_guardian_address;
    public $e_have_medical_condition;
    public $e_medical_condition_detail;
    public $e_have_visa_condition;
    public $e_visa_condition_detail;
    public $e_have_visa_refusal_condition;
    public $e_visa_refusal_condition_detail;
    public $e_educations = [];

    public $form_number;

    public function mount()
    {
        $code = Form::latest()->first();
        if (empty($code->id)) {
            $this->form_number = '101';
        } else {
            $this->form_number = str_pad($code->serial + 1, 3, "0", STR_PAD_LEFT);
        }

        $this->clients = User::where('type', 'client')->latest()->get();

        $this->serviceLoad();
    }

    public function render()
    {
        return view('livewire.backend.admin.application.add-component')
        ->layout('layouts.backend.app', [
            'title' => "New Application | Let's Go China",
        ]);
    }

     public function getEventClient()
    {
        if($this->client_id){
            $client = User::find($this->client_id);
            $this->e_name = $client->name;
            $this->e_number = $client->phone;
            $this->e_email = $client->email;
            $this->e_current_address = $client->data['address'];
            $this->e_permanent_address = $client->data['address'];
        }
    }

    public function serviceLoad()
    {
        $this->dispatch('refreshSelect');

        $this->e_educations = [
            [
                'degree' => '',
                'institution' => '',
                'year' => '',
                'grade' => '',
            ]
        ];
    }

    public function addRow()
    {
        $this->e_educations[] = [
            'degree' => '',
            'institution' => '',
            'year' => '',
            'grade' => '',
        ];
    }

    public function removeRow($index)
    {
        unset($this->e_educations[$index]);
        $this->e_educations = array_values($this->e_educations);
    }

    public function updated($name)
    {
         if($this->service === 'education') {
                $this->validateOnly($name, [
                    'client_id' => 'required',
                    'e_name' => 'required',
                    'e_gender' => 'required',
                    'e_date_of_birth' => 'required',
                    'e_nationality' => 'required',
                    'e_marital_status' => 'required',
                    'e_number' => 'required',
                    'e_email' => 'required',
                    'e_current_address' => 'required',
                    'e_permanent_address' => 'required',
                    'e_passport_number' => 'required',
                    'e_date_of_issue' => 'required',
                    'e_date_of_expiry' => 'required',
                    'e_place_of_issue' => 'required',
                    'e_medium_of_instruction' => 'required',
                    'e_duolingo' => 'required',
                    'e_score' => 'required',
                    'e_intended_level_of_study' => 'required',
                    'e_preferred_field_of_study' => 'required',
                    'e_preferred_intake' => 'required',
                    'e_preferred_university' => 'required',
                    'e_guardian_name' => 'required',
                    'e_guardian_relationship' => 'required',
                    'e_guardian_number' => 'required',
                    'e_guardian_address' => 'required',
                    'e_have_medical_condition' => 'required',
                    'e_medical_condition_detail' => 'required_if:have_medical_condition,Yes',
                    'e_have_visa_condition' => 'required',
                    'e_visa_condition_detail' => 'required_if:have_visa_condition,Yes',
                    'e_have_visa_refusal_condition' => 'required',
                    'e_visa_refusal_condition_detail' => 'required_if:have_visa_refusal_condition,Yes',

                    'e_educations.*.degree' => 'required',
                    'e_educations.*.institution' => 'required',
                    'e_educations.*.year' => 'required',
                    'e_educations.*.grade' => 'required',
                ]);
        } else {
            
        }
    }

    public function education()
    {
        $this->validate([
            'client_id' => 'required',
            'e_name' => 'required',
            'e_gender' => 'required',
            'e_date_of_birth' => 'required',
            'e_nationality' => 'required',
            'e_marital_status' => 'required',
            'e_number' => 'required',
            'e_email' => 'required',
            'e_current_address' => 'required',
            'e_permanent_address' => 'required',
            'e_passport_number' => 'required',
            'e_date_of_issue' => 'required',
            'e_date_of_expiry' => 'required',
            'e_place_of_issue' => 'required',
            'e_medium_of_instruction' => 'required',
            'e_duolingo' => 'required',
            'e_score' => 'required',
            'e_intended_level_of_study' => 'required',
            'e_preferred_field_of_study' => 'required',
            'e_preferred_intake' => 'required',
            'e_preferred_university' => 'required',
            'e_guardian_name' => 'required',
            'e_guardian_relationship' => 'required',
            'e_guardian_number' => 'required',
            'e_guardian_address' => 'required',
            'e_have_medical_condition' => 'required',
            'e_medical_condition_detail' => 'required_if:have_medical_condition,Yes',
            'e_have_visa_condition' => 'required',
            'e_visa_condition_detail' => 'required_if:have_visa_condition,Yes',
            'e_have_visa_refusal_condition' => 'required',
            'e_visa_refusal_condition_detail' => 'required_if:have_visa_refusal_condition,Yes',

            'e_educations.*.degree' => 'required',
            'e_educations.*.institution' => 'required',
            'e_educations.*.year' => 'required',
            'e_educations.*.grade' => 'required',
        ]);


        try{
            $data = new Form();
            $data->serial  = $this->form_number;
            $data->number  = 'L3G6C' . $this->form_number;
            $data->type = "education";
            $data->client_id  = $this->client_id;
            $data->data = [
                'name' => $this->e_name,
                'gender' => $this->e_gender,
                'date_of_birth' => $this->e_date_of_birth,
                'nationality' => $this->e_nationality,
                'marital_status' => $this->e_marital_status,
                'religion' => $this->e_religion,
                'number' => $this->e_number,
                'email' => $this->e_email,
                'current_address' => $this->e_current_address,
                'permanent_address' => $this->e_permanent_address,
                'passport_number' => $this->e_passport_number,
                'date_of_issue' => $this->e_date_of_issue,
                'date_of_expiry' => $this->e_date_of_expiry,
                'place_of_issue' => $this->e_place_of_issue,
                'medium_of_instruction' => $this->e_medium_of_instruction,
                'duolingo' => $this->e_duolingo,
                'score' => $this->e_score,
                'intended_level_of_study' => $this->e_intended_level_of_study,
                'preferred_field_of_study' => $this->e_preferred_field_of_study,
                'preferred_intake' => $this->e_preferred_intake,
                'preferred_university' => $this->e_preferred_university,
                'guardian_name' => $this->e_guardian_name,
                'guardian_relationship' => $this->e_guardian_relationship,
                'guardian_number' => $this->e_guardian_number,
                'guardian_address' => $this->e_guardian_address,
                'have_medical_condition' => $this->e_have_medical_condition,
                'medical_condition_detail' => $this->e_medical_condition_detail,
                'have_visa_condition' => $this->e_have_visa_condition,
                'visa_condition_detail' => $this->e_visa_condition_detail,
                'have_visa_refusal_condition' => $this->e_have_visa_refusal_condition,
                'visa_refusal_condition_detail' => $this->e_visa_refusal_condition_detail,
                'educations' => $this->e_educations,
            ];
            $data->status = "pending";
            $data->save();

            $history = new StatusHistory();
            $history->module = 'Form';
            $history->module_id = $data->id;
            $history->status = "pending";
            $history->save();

            return redirect()->route('admin.application.list')->with('success', 'Form request submitted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Form updated failed: ' . $e->getMessage());
        }
    }

}
