<?php

namespace App\Livewire\Backend\Admin\Application;

use Livewire\Component;
use App\Models\Form;
use App\Models\StatusHistory;

class AddComponent extends Component
{
    public $name;
    public $gender;
    public $date_of_birth;
    public $nationality;
    public $marital_status;
    public $religion;
    public $number;
    public $email;
    public $current_address;
    public $permanent_address;
    public $passport_number;
    public $date_of_issue;
    public $date_of_expiry;
    public $place_of_issue;
    public $medium_of_instruction;
    public $duolingo;
    public $score;
    public $intended_level_of_study;
    public $preferred_field_of_study;
    public $preferred_intake;
    public $preferred_university;
    public $guardian_name;
    public $guardian_relationship;
    public $guardian_number;
    public $guardian_address;
    public $have_medical_condition;
    public $medical_condition_detail;
    public $have_visa_condition;
    public $visa_condition_detail;
    public $have_visa_refusal_condition;
    public $visa_refusal_condition_detail;

    public $educations = [];

    public $form_number;

    public function mount()
    {
        $code = Form::latest()->first();
        if (empty($code->id)) {
            $this->form_number = '101';
        } else {
            $this->form_number = str_pad($code->serial + 1, 3, "0", STR_PAD_LEFT);
        }

        $this->educations = [
            [
                'degree' => '',
                'institution' => '',
                'year' => '',
                'grade' => '',
            ]
        ];
    }

    public function render()
    {
        return view('livewire.backend.admin.application.add-component')
        ->layout('layouts.backend.app', [
            'title' => "New Application | Let's Go China",
        ]);
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

    public function updated($name)
    {
        $this->validateOnly($name, [
            'name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'nationality' => 'required',
            'marital_status' => 'required',
            'number' => 'required',
            'email' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'passport_number' => 'required',
            'date_of_issue' => 'required',
            'date_of_expiry' => 'required',
            'place_of_issue' => 'required',
            'medium_of_instruction' => 'required',
            'duolingo' => 'required',
            'score' => 'required',
            'intended_level_of_study' => 'required',
            'preferred_field_of_study' => 'required',
            'preferred_intake' => 'required',
            'preferred_university' => 'required',
            'guardian_name' => 'required',
            'guardian_relationship' => 'required',
            'guardian_number' => 'required',
            'guardian_address' => 'required',
            'have_medical_condition' => 'required',
            'medical_condition_detail' => 'required_if:have_medical_condition,Yes',
            'have_visa_condition' => 'required',
            'visa_condition_detail' => 'required_if:have_visa_condition,Yes',
            'have_visa_refusal_condition' => 'required',
            'visa_refusal_condition_detail' => 'required_if:have_visa_refusal_condition,Yes',

            'educations.*.degree' => 'required',
            'educations.*.institution' => 'required',
            'educations.*.year' => 'required',
            'educations.*.grade' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'nationality' => 'required',
            'marital_status' => 'required',
            'number' => 'required',
            'email' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'passport_number' => 'required',
            'date_of_issue' => 'required',
            'date_of_expiry' => 'required',
            'place_of_issue' => 'required',
            'medium_of_instruction' => 'required',
            'duolingo' => 'required',
            'score' => 'required',
            'intended_level_of_study' => 'required',
            'preferred_field_of_study' => 'required',
            'preferred_intake' => 'required',
            'preferred_university' => 'required',
            'guardian_name' => 'required',
            'guardian_relationship' => 'required',
            'guardian_number' => 'required',
            'guardian_address' => 'required',
            'have_medical_condition' => 'required',
            'medical_condition_detail' => 'required_if:have_medical_condition,Yes',
            'have_visa_condition' => 'required',
            'visa_condition_detail' => 'required_if:have_visa_condition,Yes',
            'have_visa_refusal_condition' => 'required',
            'visa_refusal_condition_detail' => 'required_if:have_visa_refusal_condition,Yes',

            'educations.*.degree' => 'required',
            'educations.*.institution' => 'required',
            'educations.*.year' => 'required',
            'educations.*.grade' => 'required',
        ]);


        try{
            $data = new Form();
            $data->serial  = $this->form_number;
            $data->number  = 'L3G6C' . $this->form_number;
            // $data->user_id = auth()->id();
            $data->type = "Education";
            $data->data = [
                'name' => $this->name,
                'gender' => $this->gender,
                'date_of_birth' => $this->date_of_birth,
                'nationality' => $this->nationality,
                'marital_status' => $this->marital_status,
                'religion' => $this->religion,
                'number' => $this->number,
                'email' => $this->email,
                'current_address' => $this->current_address,
                'permanent_address' => $this->permanent_address,
                'passport_number' => $this->passport_number,
                'date_of_issue' => $this->date_of_issue,
                'date_of_expiry' => $this->date_of_expiry,
                'place_of_issue' => $this->place_of_issue,
                'medium_of_instruction' => $this->medium_of_instruction,
                'duolingo' => $this->duolingo,
                'score' => $this->score,
                'intended_level_of_study' => $this->intended_level_of_study,
                'preferred_field_of_study' => $this->preferred_field_of_study,
                'preferred_intake' => $this->preferred_intake,
                'preferred_university' => $this->preferred_university,
                'guardian_name' => $this->guardian_name,
                'guardian_relationship' => $this->guardian_relationship,
                'guardian_number' => $this->guardian_number,
                'guardian_address' => $this->guardian_address,
                'have_medical_condition' => $this->have_medical_condition,
                'medical_condition_detail' => $this->medical_condition_detail,
                'have_visa_condition' => $this->have_visa_condition,
                'visa_condition_detail' => $this->visa_condition_detail,
                'have_visa_refusal_condition' => $this->have_visa_refusal_condition,
                'visa_refusal_condition_detail' => $this->visa_refusal_condition_detail,
                'educations' => $this->educations,
            ];
            $data->status = "Pending";
            $data->save();

            $history = new StatusHistory();
            $history->module = 'Form';
            $history->module_id = $data->id;
            $history->status = "Pending";
            $history->save();

            return redirect()->route('admin.application.list')->with('success', 'Form request submitted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Form updated failed: ' . $e->getMessage());
        }
    }

}
