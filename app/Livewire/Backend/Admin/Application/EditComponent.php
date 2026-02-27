<?php

namespace App\Livewire\Backend\Admin\Application;

use Livewire\Component;
use App\Models\Form;
use App\Models\StatusHistory;

class EditComponent extends Component
{
    public $form_id;
    public $track_number;
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

    public function mount($id)
    {
        $form = Form::findOrFail($id);
        $this->track_number = $form->number;

        if($form->type == 'education'){
            $this->form_id = $form->id;
            $this->service = 'education';
            $this->serviceLoad($form);
        }
    }

    public function render()
    {
        return view('livewire.backend.admin.application.edit-component')
        ->layout('layouts.backend.app', [
            'title' => "Edit Application | Let's Go China",
        ]);
    }

    public function serviceLoad($form)
    {
        $this->dispatch('refreshSelect');

        $this->e_name = $form->data['name'];
        $this->e_gender = $form->data['gender'];
        $this->e_date_of_birth = $form->data['date_of_birth'];
        $this->e_nationality = $form->data['nationality'];
        $this->e_marital_status = $form->data['marital_status'];
        $this->e_religion = $form->data['religion'];
        $this->e_number = $form->data['number'];
        $this->e_email = $form->data['email'];
        $this->e_current_address = $form->data['current_address'];
        $this->e_permanent_address = $form->data['permanent_address'];
        $this->e_passport_number = $form->data['passport_number'];
        $this->e_date_of_issue = $form->data['date_of_issue'];
        $this->e_date_of_expiry = $form->data['date_of_expiry'];
        $this->e_place_of_issue = $form->data['place_of_issue'];
        $this->e_medium_of_instruction = $form->data['medium_of_instruction'];
        $this->e_duolingo = $form->data['duolingo'];
        $this->e_score = $form->data['score'];
        $this->e_intended_level_of_study = $form->data['intended_level_of_study'];
        $this->e_preferred_field_of_study = $form->data['preferred_field_of_study'];
        $this->e_preferred_intake = $form->data['preferred_intake'];
        $this->e_preferred_university = $form->data['preferred_university'];
        $this->e_guardian_name = $form->data['guardian_name'];
        $this->e_guardian_relationship = $form->data['guardian_relationship'];
        $this->e_guardian_number = $form->data['guardian_number'];
        $this->e_guardian_address = $form->data['guardian_address'];
        $this->e_have_medical_condition = $form->data['have_medical_condition'];
        $this->e_medical_condition_detail = $form->data['medical_condition_detail'];
        $this->e_have_visa_condition = $form->data['have_visa_condition'];
        $this->e_visa_condition_detail = $form->data['visa_condition_detail'];
        $this->e_have_visa_refusal_condition = $form->data['have_visa_refusal_condition'];
        $this->e_visa_refusal_condition_detail = $form->data['visa_refusal_condition_detail'];
        $this->e_educations = $form->data['educations'];
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
            $data = Form::find($this->form_id);
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
            $data->save();

            return redirect()->route('admin.application.edit', $data->id)->with('success', 'Form request updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Form updated failed: ' . $e->getMessage());
        }
    }
}
