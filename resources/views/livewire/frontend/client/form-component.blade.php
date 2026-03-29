<div>
    @push('styles')
        <style>
            .section, section
            {
                padding: 5px 0px;
            }
        </style>
    @endpush

    <div class="header-space"></div>

    <div class="container" wire:poll.40000000ms="checkFormAvailability">
        @if (session()->has('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif
        @if($showForm)
            @if ($this->data)<div class="d-flex justify-content-end"><button type="button" class="btn btn-secondary btn-sm" wire:click="view"> View </button></div>@endif
            
            <section class="wptb-make-appointment p-5">
                <div class="container">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner text-center">
                            <h6 class="wptb-item--subtitle">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                                    </svg>
                                </span>
                                Application Form
                            </h6>
                            <h1 class="wptb-item--title"> <span>Want to meet us for your need?</span></h1>
                        </div>
                    </div>
                    <div class="wptb-contact-form-two mr-top-100">
                        <div class="wptb-form--wrapper">
                            <form @if($data) wire:submit.prevent="update" @else wire:submit.prevent="store" @endif class="wptb-form">
                                <div class="wptb-form--inner">
                                    <h4 class="mb-4">Personal Information</h4>     
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Full Name (as per Passport)</label>
                                                <input type="text" wire:model="name" class="form-control ms-1" required>
                                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <label for="" class="labell">Gender</label>
                                            <div class="wptb-radio-list d-flex align-items-center ms-5">
                                                <div class="form-group">
                                                    <input type="radio" wire:model="gender" value="male">
                                                    <label class="labelll" for="male">Male</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model="gender" value="femail">
                                                    <label class="labelll" for="femail">Femail</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model="gender" value="other">
                                                    <label class="labelll" for="other">Other</label>
                                                </div>
                                            </div>
                                            @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Date of Birth</label>
                                                <input type="date" wire:model="date_of_birth" class="form-control ms-1" required>
                                                @error('date_of_birth') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Nationality</label>
                                                <input type="text" wire:model="nationality" class="form-control ms-1" required>
                                                @error('nationality') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <label for="" class="labell">Marital Status</label>
                                            <div class="wptb-radio-list d-flex align-items-center ms-5">
                                                <div class="form-group">
                                                    <input type="radio" wire:model="marital_status" value="single">
                                                    <label class="labelll" for="male">Single</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model="marital_status" value="married">
                                                    <label class="labelll" for="married">Married</label>
                                                </div>
                                            </div>
                                            @error('marital_status') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Religion (optional)</label>
                                                <input type="text" wire:model="religion" class="form-control ms-1">
                                                @error('religion') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wptb-form--inner">
                                    <h4 class="mb-4">Contact Details</h4>     
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Mobile Number (WhatsApp)</label>
                                                <input type="text" wire:model="number" class="form-control ms-1" required>
                                                @error('number') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Email Address</label>
                                                <input type="text" wire:model="email" class="form-control ms-1" required>
                                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Current Address</label>
                                                <input type="text" wire:model="current_address" class="form-control ms-1">
                                                @error('current_address') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Permanent Address</label>
                                                <input type="text" wire:model="permanent_address" class="form-control ms-1">
                                                @error('permanent_address') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wptb-form--inner">
                                    <h4 class="mb-4">Passport Information</h4>     
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Passport Number</label>
                                                <input type="text" wire:model="passport_number" class="form-control ms-1" required>
                                                @error('passport_number') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Date of Issue</label>
                                                <input type="date" wire:model="date_of_issue" class="form-control ms-1" required>
                                                @error('date_of_issue') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Date of Expiry</label>
                                                <input type="date" wire:model="date_of_expiry" class="form-control ms-1" required>
                                                @error('date_of_expiry') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Place of Issue</label>
                                                <input type="date" wire:model="place_of_issue" class="form-control ms-1" required>
                                                @error('place_of_issue') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wptb-form--inner">
                                    <h4 class="mb-4">English Language Proficiency</h4>     
                                    <div class="row">

                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <label for="" class="labell">Medium of Instrution</label>
                                            <div class="wptb-radio-list d-flex align-items-center ms-5">
                                                <div class="form-group">
                                                    <input type="checkbox" wire:model="medium_of_instruction" value="english">
                                                    <label class="labelll" for="english">English</label>
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" wire:model="medium_of_instruction" value="bangla">
                                                    <label class="labelll" for="bangla">Bangla</label>
                                                </div>

                                                <div class="form-group">
                                                    <input type="checkbox" wire:model="medium_of_instruction" value="other">
                                                    <label class="labelll" for="other">Other</label>
                                                </div>
                                            </div>
                                            @error('medium_of_instruction') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>

                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Duolingo</label>
                                                <input type="text" wire:model="duolingo" class="form-control ms-1" required>
                                                @error('duolingo') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Score</label>
                                                <input type="text" wire:model="score" class="form-control ms-1" required>
                                                @error('score') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wptb-form--inner">
                                    <h4 class="mb-4">Intended Study Plan in China</h4>     
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <label for="" class="labell">Intended Level of Study</label>
                                            <div class="wptb-radio-list d-flex align-items-center ms-5">
                                                <div class="form-group">
                                                    <input type="radio" wire:model="intended_level_of_study" value="Language">
                                                    <label class="labelll" for="Language">Language</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model="intended_level_of_study" value="Bachelor">
                                                    <label class="labelll" for="Bachelor">Bachelor</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model="intended_level_of_study" value="Master">
                                                    <label class="labelll" for="Master">Master</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model="intended_level_of_study" value="PhD">
                                                    <label class="labelll" for="PhD">PhD</label>
                                                </div>
                                            </div>
                                            @error('intended_level_of_study') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Preferred Field of Study</label>
                                                <input type="text" wire:model="preferred_field_of_study" class="form-control ms-1" required>
                                                @error('preferred_field_of_study') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <label for="" class="labell">Preferred Intake</label>
                                            <div class="wptb-radio-list d-flex align-items-center ms-5">
                                                <div class="form-group">
                                                    <input type="radio" wire:model="preferred_intake" value="March">
                                                    <label class="labelll" for="March">March</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model="preferred_intake" value="September">
                                                    <label class="labelll" for="September">September</label>
                                                </div>
                                            </div>
                                            @error('preferred_intake') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Preferred City/University (if any)</label>
                                                <input type="text" wire:model="preferred_university" class="form-control ms-1" required>
                                                @error('preferred_university') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wptb-form--inner">
                                    <h4 class="mb-4">Guardian/Emergency Contact</h4>     
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Name</label>
                                                <input type="text" wire:model="guardian_name" class="form-control ms-1" required>
                                                @error('guardian_name') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Relationship</label>
                                                <input type="text" wire:model="guardian_relationship" class="form-control ms-1" required>
                                                @error('guardian_relationship') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Contact Number</label>
                                                <input type="text" wire:model="guardian_number" class="form-control ms-1" required>
                                                @error('guardian_number') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="" class="labell">Address</label>
                                                <input type="text" wire:model="guardian_address" class="form-control ms-1" required>
                                                @error('guardian_address') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wptb-form--inner">
                                    <h4 class="mb-4">Medical Information (Basic)</h4>     
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <label for="" class="labell">DO you have any medical conditions?</label>
                                            <div class="wptb-radio-list d-flex align-items-center ms-5">
                                                <div class="form-group">
                                                    <input type="radio" wire:model.live="have_medical_condition" value="Yes">
                                                    <label class="labelll" for="Yes">Yes</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model.live="have_medical_condition" value="No">
                                                    <label class="labelll" for="No">No</label>
                                                </div>
                                            </div>
                                            @error('have_medical_condition') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        @if($have_medical_condition === 'Yes')
                                            <div class="col-lg-12 col-md-12 mb-4">
                                                <div class="form-group">
                                                    <label for="" class="labell">Please describe your medical condition</label>
                                                    <input type="text" wire:model="medical_condition_detail" class="form-control ms-1" required>
                                                    @error('medical_condition_detail') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="wptb-form--inner">
                                    <h4 class="mb-4">Visa information</h4>     
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <label for="" class="labell">Have any Visa:</label>
                                            <div class="wptb-radio-list d-flex align-items-center ms-5">
                                                <div class="form-group">
                                                    <input type="radio" wire:model.live="have_visa_condition" value="Yes">
                                                    <label class="labelll" for="Yes">Yes</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model.live="have_visa_condition" value="No">
                                                    <label class="labelll" for="No">No</label>
                                                </div>
                                            </div>
                                            @error('have_visa_condition') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        @if($have_visa_condition === 'Yes')
                                            <div class="col-lg-12 col-md-12 mb-4">
                                                <div class="form-group">
                                                    <label for="" class="labell">Please describe your visa condition</label>
                                                    <input type="text" wire:model="visa_condition_detail" class="form-control ms-1" required>
                                                    @error('visa_condition_detail') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <label for="" class="labell">Have any Visa Refusal:</label>
                                            <div class="wptb-radio-list d-flex align-items-center ms-5">
                                                <div class="form-group">
                                                    <input type="radio" wire:model.live="have_visa_refusal_condition" value="Yes">
                                                    <label class="labelll" for="Yes">Yes</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" wire:model.live="have_visa_refusal_condition" value="No">
                                                    <label class="labelll" for="No">No</label>
                                                </div>
                                            </div>
                                            @error('have_visa_refusal_condition') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        @if($have_visa_refusal_condition === 'Yes')
                                            <div class="col-lg-12 col-md-12 mb-4">
                                                <div class="form-group">
                                                    <label for="" class="labell">Please describe your visa refusal condition</label>
                                                    <input type="text" wire:model="visa_refusal_condition_detail" class="form-control ms-1" required>
                                                    @error('visa_refusal_condition_detail') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="wptb-form--inner">
                                    <h4 class="mb-4">Educational Background</h4>
                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr class="text-muted text-uppercase">
                                                    <th>Degree</th>
                                                    <th>Institution</th>
                                                    <th>Year</th>
                                                    <th>Grade/CGPA</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($educations as $index => $education)
                                                    <tr>
                                                        <td>
                                                            <input type="text" wire:model="educations.{{ $index }}.degree" class="form-control form-control-solid">
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="educations.{{ $index }}.institution" class="form-control form-control-solid">
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="educations.{{ $index }}.year" class="form-control form-control-solid">
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="educations.{{ $index }}.grade" class="form-control form-control-solid">
                                                        </td>
                                                        <td class="text-end">
                                                            @if(count($educations) > 1)
                                                                <button type="button" wire:click="removeRow({{ $index }})" class="btn btn-sm btn-danger">Remove</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-4 text-end">
                                        <button type="button" wire:click="addRow" class="btn btn-light-primary"> + Add More </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-lg-12 mt-4 text-center">
                                    <button type="submit" class="btn w-25">
                                        <span class="btn-readmore--text">@if($data) Update @else Submit @endif </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>                
                </div>
            </section>
        @else
            <div class="text-center alert alert-warning">আপনি ফর্ম আগে জমা দিয়েছেন।   নতুন ফর্ম দিতে পারবেন:   <strong>{{ $remainingTime }}</strong> পরে। </div>
            <div class="d-flex justify-content-end"><button type="button" class="btn btn-secondary btn-sm" wire:click="edit">Edit</div>

            <div class="d-flex align-items-start p-5">
                <div class="nav flex-column align-items-start nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-one-tab" data-bs-toggle="pill" data-bs-target="#v-pills-one" type="button" role="tab" aria-controls="v-pills-one" aria-selected="true">Personal Information</button>
                    <button class="nav-link" id="v-pills-two-tab" data-bs-toggle="pill" data-bs-target="#v-pills-two" type="button" role="tab" aria-controls="v-pills-two" aria-selected="false">Contact Details</button>
                    <button class="nav-link" id="v-pills-three-tab" data-bs-toggle="pill" data-bs-target="#v-pills-three" type="button" role="tab" aria-controls="v-pills-three" aria-selected="false">Passport Information</button>
                    <button class="nav-link" id="v-pills-four-tab" data-bs-toggle="pill" data-bs-target="#v-pills-four" type="button" role="tab" aria-controls="v-pills-four" aria-selected="false">English Language Proficiency</button>
                    <button class="nav-link" id="v-pills-five-tab" data-bs-toggle="pill" data-bs-target="#v-pills-five" type="button" role="tab" aria-controls="v-pills-five" aria-selected="false">Intended Study Plan in China</button>
                    <button class="nav-link" id="v-pills-six-tab" data-bs-toggle="pill" data-bs-target="#v-pills-six" type="button" role="tab" aria-controls="v-pills-six" aria-selected="false">Guardian/Emargency Contact</button>
                    <button class="nav-link" id="v-pills-seven-tab" data-bs-toggle="pill" data-bs-target="#v-pills-seven" type="button" role="tab" aria-controls="v-pills-seven" aria-selected="false">Medical Information (Basic)</button>
                    <button class="nav-link" id="v-pills-eight-tab" data-bs-toggle="pill" data-bs-target="#v-pills-eight" type="button" role="tab" aria-controls="v-pills-eight" aria-selected="false">Visa Information</button>
                    <button class="nav-link" id="v-pills-nine-tab" data-bs-toggle="pill" data-bs-target="#v-pills-nine" type="button" role="tab" aria-controls="v-pills-nine" aria-selected="false">Education Background</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-one" role="tabpanel" aria-labelledby="v-pills-one-tab">
                        <section class="p-0">
                            <h4 class="pb-2">Personal Information</h4>
                            <div class="card w-100 shadow p-3">
                                <p><strong>Name:</strong> {{$data->data['name'] ?? '-' }}</p>
                                <p><strong>Gender:</strong> {{$data->data['gender'] ?? '-' }}</p>
                                <p><strong>Date of Birth:</strong> {{$data->data['date_of_birth'] ?? '-' }}</p>
                                <p><strong>Nationality:</strong> {{$data->data['nationality'] ?? '-' }}</p>
                                <p><strong>Marital Status:</strong> {{$data->data['marital_status'] ?? '-' }}</p>
                                <p><strong>Religion:</strong> {{$data->data['religion'] ?? '-' }}</p>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-two" role="tabpanel" aria-labelledby="v-pills-two-tab">
                        <section class="p-0">
                            <h4 class="pb-2">Contact Details</h4>
                            <div class="card w-100 shadow p-3">
                                <p><strong>Number:</strong> {{$data->data['number'] ?? '-' }}</p>
                                <p><strong>Email:</strong> {{$data->data['email'] ?? '-' }}</p>
                                <p><strong>Current Address:</strong> {{$data->data['current_address'] ?? '-' }}</p>
                                <p><strong>Permanent Address:</strong> {{$data->data['permanent_address'] ?? '-' }}</p>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-three" role="tabpanel" aria-labelledby="v-pills-three-tab">
                        <section class="p-0">
                            <h4 class="pb-2">Passport Information</h4>
                            <div class="card w-100 shadow p-3">
                                <p><strong>Passport Number:</strong> {{$data->data['passport_number'] ?? '-' }}</p>
                                <p><strong>Date of Issue:</strong> {{$data->data['date_of_issue'] ?? '-' }}</p>
                                <p><strong>Date of Expiry:</strong> {{$data->data['date_of_expiry'] ?? '-' }}</p>
                                <p><strong>Place of Issue:</strong> {{$data->data['place_of_issue'] ?? '-' }}</p>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-four" role="tabpanel" aria-labelledby="v-pills-four-tab">
                        <section class="p-0">
                            <h4 class="pb-2">English Language Proficiency</h4>
                            <div class="card w-100 shadow p-3">
                                <p><strong>medium Of Instruction:</strong> {{$data->data['medium_of_instruction'] ?? '-' }}</p>
                                <p><strong>Duolingo:</strong> {{$data->data['duolingo'] ?? '-' }}</p>
                                <p><strong>Score:</strong> {{$data->data['score'] ?? '-' }}</p>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-five" role="tabpanel" aria-labelledby="v-pills-five-tab">
                        <section class="p-0">
                            <h4 class="pb-2">Intended Study Plan in China</h4>
                            <div class="card w-100 shadow p-3">
                                <p><strong>Intended Level of Study:</strong> {{$data->data['intended_level_of_study'] ?? '-' }}</p>
                                <p><strong>Preferred Field of Study:</strong> {{$data->data['preferred_field_of_study'] ?? '-' }}</p>
                                <p><strong>Preferred Intake:</strong> {{$data->data['preferred_intake'] ?? '-' }}</p>
                                <p><strong>Preferred University:</strong> {{$data->data['preferred_university'] ?? '-' }}</p>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-six" role="tabpanel" aria-labelledby="v-pills-six-tab">
                        <section class="p-0">
                            <h4 class="pb-2">Guardian/Emargency Contact</h4>
                            <div class="card w-100 shadow p-3">
                                <p><strong>Guardian Name:</strong> {{$data->data['guardian_name'] ?? '-' }}</p>
                                <p><strong>Guardian Relationship:</strong> {{$data->data['guardian_relationship'] ?? '-' }}</p>
                                <p><strong>Guardian Number:</strong> {{$data->data['guardian_number'] ?? '-' }}</p>
                                <p><strong>Guardian Address:</strong> {{$data->data['guardian_address'] ?? '-' }}</p>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-seven" role="tabpanel" aria-labelledby="v-pills-seven-tab">
                        <section class="p-0">
                            <h4 class="pb-2">Medical Information (Basic)</h4>
                            <div class="card w-100 shadow p-3">
                                <p><strong>Have Medical Condition:</strong> {{$data->data['have_medical_condition'] ?? '-' }}</p>
                                @if ($data->data['have_medical_condition'] === "Yes")
                                    <p> {{$data->data['medical_condition_detail'] ?? '-' }}</p>
                                @endif
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-eight" role="tabpanel" aria-labelledby="v-pills-eight-tab">
                        <section class="p-0">
                            <h4 class="pb-2">Visa Information</h4>
                            <div class="card w-100 shadow p-3">
                                <p><strong>Have Visa Condition:</strong> {{$data->data['have_visa_condition'] ?? '-' }}</p>
                                @if ($data->data['have_visa_condition'] === "Yes")
                                    <p> {{$data->data['visa_condition_detail'] ?? '-' }}</p>
                                @endif
                                <p><strong>Have Visa Refusal Condition:</strong> {{$data->data['have_visa_refusal_condition'] ?? '-' }}</p>
                                @if ($data->data['have_visa_refusal_condition'] === "Yes")
                                    <p> {{$data->data['visa_refusal_condition_detail'] ?? '-' }}</p>
                                @endif
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-nine" role="tabpanel" aria-labelledby="v-pills-nine-tab">
                        <section class="p-0">
                            <h4 class="pb-2">Education Background</h4>
                            <div class="card w-100 shadow p-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Degree</th>
                                            <th>Institution</th>
                                            <th>Year</th>
                                            <th>Grade/CGPA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($data->data['educations']))
                                            @foreach($data->data['educations'] as $item)
                                                <tr>
                                                    <td>{{ $item['degree'] ?? '-' }}</td>
                                                    <td>{{ $item['institution'] ?? '-' }}</td>
                                                    <td>{{ $item['year'] ?? '-' }}</td>
                                                    <td>{{ $item['grade'] ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No education records found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
