<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Client;
use App\Services\ProfileCompletionService;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

use Carbon\Carbon;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PersonalInformationComponent extends Component
{
    use WithFileUploads;

    public Client $client;

    public $showServiceWizard = false;

    public $name, $gender, $date_of_birth;
    public $nationality, $marital_status, $blood_group;
    public $religion, $phone, $email, $address;

    public $avatar;

    public $service;

    public $openEdit = FALSE;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->client->user_id),
            ],
            'phone' => 'required|string|max:20',
            'gender' => 'nullable|string',
            'date_of_birth' => 'required|date|before:today',
            'nationality' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'religion' => 'nullable|string',
            'address' => 'nullable|string',
        ];
        if ($this->avatar instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $rules['avatar'] = 'image|max:2048';
        }
    }

    public function mount()
    {
        $this->client = auth()->user()->client;

        if (!$this->client->service) {
            $this->showServiceWizard = true;
        }

        $info = $this->client->data['personals'] ?? null;
       
        $this->name = $info['name'] ?? $this->client->user->name;
        $this->email = $info['email'] ?? $this->client->user->email;
        $this->phone = $info['phone'] ?? $this->client->user->phone;
        $this->gender = $info['gender'] ?? null;
        $this->date_of_birth = $info['date_of_birth'] ?? null;
        $this->nationality = $info['nationality'] ?? null;
        $this->marital_status = $info['marital_status'] ?? null;
        $this->blood_group = $info['blood_group'] ?? null;
        $this->religion = $info['religion'] ?? null;
        $this->address = $info['address'] ?? null;

        $this->service = $this->client->service ?? null;
    }

    public function saveService()
    {
        $this->validate([
            'service' => 'required',
        ]);

        $this->client->update([
            'service' => $this->service,
        ]);

        $this->showServiceWizard = false;

        session()->flash('success', 'Service selected successfully!');
    }

    public function edit()
    {
        if($this->openEdit  == FALSE){
            $this->openEdit = TRUE;
        }else{
            $this->openEdit = FALSE;
        }
    }

    public function save()
    {
        $this->validate();

        $personalData = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'nationality' => $this->nationality,
            'marital_status' => $this->marital_status,
            'blood_group' => $this->blood_group,
            'religion' => $this->religion,
            'address' => $this->address,
        ];

        $this->client->update([
            'service' => $this->service,
            'data->personals' => $personalData,
        ]);

        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        if ($this->avatar instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $fileName = Carbon::now()->timestamp . '.' . $this->avatar->getClientOriginalExtension();
            $path = $this->avatar->storeAs('profile', $fileName, 'public');
            $userData['avatar'] = '/storage/' . $path;
        }

        $this->client->user->update($userData);
        
        ProfileCompletionService::calculate($this->client);

        session()->flash('success','Personal Information Updated Successfully');
    }

    public function render()
    {
        return view('livewire.frontend.client.personal-information-component')        
        ->layout('layouts.client.app', [
            'title' => "Personal Information | Let's Go China"
        ]);
    }
}
