<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Form;
use App\Models\StatusHistory;
use Carbon\Carbon;

class FormComponent extends Component
{
    public $service;

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

    public $showForm = false;
    public $remainingTime = null;

    public $data = null;

    public $form_id;
    public $form_number;

    public function mount()
    {
        $code = Form::latest()->first();
        if (empty($code->id)) {
            $this->form_number = '101';
        } else {
            $this->form_number = str_pad($code->serial + 1, 3, "0", STR_PAD_LEFT);
        }

        $this->checkFormAvailability();
        $this->serviceLoad();
    }
    public function checkFormAvailability()
    {
        $data = Form::where('client_id', auth()->id())->latest()->first();

        if (!$data) {
            $this->showForm = true;
            $this->remainingTime = null;
            $this->resetFormFields();
            return;
        }

        $nextAvailableAt = $data->created_at->addHours(24);

        if (now()->gte($nextAvailableAt)) {
            $this->showForm = true;
            $this->remainingTime = null;
            $this->resetFormFields();
        } else {
            $this->showForm = false;
            $diff = now()->diff($nextAvailableAt);
            $this->remainingTime = $diff->h . ' hour ' . $diff->i . ' minute ' . $diff->s . ' second';
            $this->fillOldData($data);
        }
    }
    private function fillOldData($data)
    {
        $this->data = Form::where('client_id', auth()->id())->latest()->first();

        $this->form_id = $data->id;

        $this->name = $data->data['name'] ?? null;
        $this->gender = $data->data['gender'] ?? null;
        $this->date_of_birth = $data->data['date_of_birth'] ?? null;
        $this->nationality = $data->data['nationality'] ?? null;
        $this->marital_status = $data->data['marital_status'] ?? null;
        $this->religion = $data->data['religion'] ?? null;
        $this->number = $data->data['number'] ?? null;
        $this->email = $data->data['email'] ?? null;
        $this->current_address = $data->data['current_address'] ?? null;
        $this->permanent_address = $data->data['permanent_address'] ?? null;
        $this->passport_number = $data->data['passport_number'] ?? null;
        $this->date_of_issue = $data->data['date_of_issue'] ?? null;
        $this->date_of_expiry = $data->data['date_of_expiry'] ?? null;
        $this->place_of_issue = $data->data['place_of_issue'] ?? null;
        $this->medium_of_instruction = $data->data['medium_of_instruction'] ?? null;
        $this->duolingo = $data->data['duolingo'] ?? null;
        $this->score = $data->data['score'] ?? null;
        $this->intended_level_of_study = $data->data['intended_level_of_study'] ?? null;
        $this->preferred_field_of_study = $data->data['preferred_field_of_study'] ?? null;
        $this->preferred_intake = $data->data['preferred_intake'] ?? null;
        $this->preferred_university = $data->data['preferred_university'] ?? null;
        $this->guardian_name = $data->data['guardian_name'] ?? null;
        $this->guardian_relationship = $data->data['guardian_relationship'] ?? null;
        $this->guardian_number = $data->data['guardian_number'] ?? null;
        $this->guardian_address = $data->data['guardian_address'] ?? null;
        $this->have_medical_condition = $data->data['have_medical_condition'] ?? null;
        $this->medical_condition_detail = $data->data['medical_condition_detail'] ?? null;
        $this->have_visa_condition = $data->data['have_visa_condition'] ?? null;
        $this->visa_condition_detail = $data->data['visa_condition_detail'] ?? null;
        $this->have_visa_refusal_condition = $data->data['have_visa_refusal_condition'] ?? null;
        $this->visa_refusal_condition_detail = $data->data['visa_refusal_condition_detail'] ?? null;
        $this->educations = $data->data['educations'] ?? null;
    }
    private function resetFormFields()
    {
        $this->form_id = null;

        $this->reset([
            'name',
            'gender',
            'date_of_birth',
            'nationality',
            'marital_status',
            'religion',
            'number',
            'email',
            'current_address',
            'permanent_address',
            'passport_number',
            'date_of_issue',
            'date_of_expiry',
            'place_of_issue',
            'medium_of_instruction',
            'duolingo',
            'score',
            'intended_level_of_study',
            'preferred_field_of_study',
            'preferred_intake',
            'preferred_university',
            'guardian_name',
            'guardian_relationship',
            'guardian_number',
            'guardian_address',
            'have_medical_condition',
            'medical_condition_detail',
            'have_visa_condition',
            'visa_condition_detail',
            'have_visa_refusal_condition',
            'visa_refusal_condition_detail',
            'educations'
        ]);
    }
    public function serviceLoad()
    {
        $this->educations = [
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
        $this->showForm = true;
    }
    public function view()
    {
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.frontend.client.form-component')
        ->layout('layouts.client.app', [
            'title' => "Form | Let's Go China"
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
            $data->client_id = auth()->id();
            $data->type = "education";
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
            $data->status = "pending";
            $data->save();

            $history = new StatusHistory();
            $history->module = 'form';
            $history->module_id = $data->id;
            $history->status = "pending";
            $history->save();

            return redirect()->route('form')->with('success', 'Form request submitted successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Form updated failed: ' . $e->getMessage());
        }
    }
    public function update()
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
            $data = Form::findOrFail($this->form_id);
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
            $data->save();

            return redirect()->route('form')->with('success', 'Form request updated successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Form updated failed: ' . $e->getMessage());
        }
    }
}
