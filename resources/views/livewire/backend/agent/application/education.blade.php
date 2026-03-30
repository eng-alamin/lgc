<form class="form" wire:submit.prevent="education">
    <div class="row justify-content-evenly p-2">
        <div class="col-md-12 d-flex align-items-center flex-column text-center pb-5 mb-5">
            <h1>Registration Form For Education</h1>
            <div class="border-bottom border-2 border-gray-400 w-50 my-5"></div>
        </div>
        <div class="col-md-5">
            <h2 class="mb-4">1. Personal Information</h2>   
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Full Name (as per Passport)</label>
                <input type="text" wire:model="e_name" class="form-control form-control-solid" />
                @error('e_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Gender</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_gender" id="male" value="male">
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_gender" id="female" value="femail">
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>
                @error('e_gender') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Date of Birth</label>
                <input type="date" wire:model="e_date_of_birth" class="form-control form-control-solid" />
                @error('e_date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
                <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Nationality</label>
                <input type="text" wire:model="e_nationality" class="form-control form-control-solid" />
                @error('e_nationality') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Marital Status</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_marital_status" id="Single" value="single">
                        <label class="form-check-label" for="Single">Single</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_marital_status" id="Married" value="married">
                        <label class="form-check-label" for="Married">Married</label>
                    </div>
                </div>
                @error('e_marital_status') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-semibold mb-2">Religion (optional)</label>
                <input type="text" wire:model="e_religion" class="form-control form-control-solid" />
                @error('e_religion') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-5">
            <h2 class="mb-4">2. Contact Details</h2>   
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Mobile Number (WhatsApp)</label>
                <input type="text" wire:model="e_number" class="form-control form-control-solid" />
                @error('e_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Email Address</label>
                <input type="text" wire:model="e_email" class="form-control form-control-solid" />
                @error('e_email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Permanent Address</label>
                <input type="text" wire:model="e_permanent_address" class="form-control form-control-solid" />
                @error('e_permanent_address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Current Address</label>
                <input type="text" wire:model="e_current_address" class="form-control form-control-solid" />
                @error('e_current_address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-5">
            <h2 class="mb-4">3. Passport Information</h2>   
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Passport Number</label>
                <input type="text" wire:model="e_passport_number" class="form-control form-control-solid" />
                @error('e_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Date of Issue</label>
                <input type="date" wire:model="e_date_of_issue" class="form-control form-control-solid" />
                @error('e_date_of_issue') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Date of Expiry</label>
                <input type="date" wire:model="e_date_of_expiry" class="form-control form-control-solid" />
                @error('e_date_of_expiry') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-5">
            <h2 class="mb-4">4. English Language Proficiency</h2>   
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Medium of Instruction</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" wire:model="e_medium_of_instruction" id="english" value="english">
                        <label class="form-check-label" for="english">English</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" wire:model="e_medium_of_instruction" id="bangla" value="bangla">
                        <label class="form-check-label" for="bangla">Bangla</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" wire:model="e_medium_of_instruction" id="other" value="other">
                        <label class="form-check-label" for="other">Other</label>
                    </div>
                </div>
                @error('e_medium_of_instruction') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Duolingo</label>
                <input type="text" wire:model="e_duolingo" class="form-control form-control-solid" />
                @error('e_duolingo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Score</label>
                <input type="text" wire:model="e_score" class="form-control form-control-solid" />
                @error('e_score') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-5">
            <h2 class="mb-4">5. Intended Study Plan in China</h2>   
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Intended Level of Study</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_intended_level_of_study" id="Language" value="Language">
                        <label class="form-check-label" for="Language">Language</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_intended_level_of_study" id="Bachelor" value="Bachelor">
                        <label class="form-check-label" for="Bachelor">Bachelor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_intended_level_of_study" id="Master" value="Master">
                        <label class="form-check-label" for="Master">Master</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_intended_level_of_study" id="PhD" value="PhD">
                        <label class="form-check-label" for="PhD">PhD</label>
                    </div>
                </div>
                @error('e_intended_level_of_study') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Preferred Field of Study</label>
                <input type="text" wire:model="e_preferred_field_of_study" class="form-control form-control-solid" />
                @error('e_preferred_field_of_study') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Preferred Intake</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_preferred_intake" id="march" value="march">
                        <label class="form-check-label" for="march">March</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="e_preferred_intake" id="september" value="september">
                        <label class="form-check-label" for="september">September</label>
                    </div>
                </div>
                @error('e_preferred_intake') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Preferred City/University (if any)</label>
                <input type="text" wire:model="e_preferred_university" class="form-control form-control-solid" />
                @error('e_preferred_university') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-5">
            <h2 class="mb-4">6. Guardian/Emergency Contact</h2>   
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Name</label>
                <input type="text" wire:model="e_guardian_name" class="form-control form-control-solid" />
                @error('e_guardian_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Relationship</label>
                <input type="text" wire:model="e_guardian_relationship" class="form-control form-control-solid" />
                @error('e_guardian_relationship') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Contact Number</label>
                <input type="text" wire:model="e_guardian_number" class="form-control form-control-solid" />
                @error('e_guardian_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Address</label>
                <input type="text" wire:model="e_guardian_address" class="form-control form-control-solid" />
                @error('e_guardian_address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-5">
            <h2 class="mb-4">7. Medical Information (Basic)</h2>   
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">DO you have any medical conditions?</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.live="e_have_medical_condition" id="Yes" value="Yes">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.live="e_have_medical_condition" id="No" value="No">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                </div>
                @error('e_have_medical_condition') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            @if($e_have_medical_condition === 'Yes')
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Please describe your medical condition</label>
                    <input type="text" wire:model="e_medical_condition_detail" class="form-control">
                    @error('e_medical_condition_detail') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            @endif
        </div>

        <div class="col-md-5">
            <h2 class="mb-4">8. Visa information</h2>   
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Have any Visa:</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.live="e_have_visa_condition" id="Yes" value="Yes">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.live="e_have_visa_condition" id="No" value="No">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                </div>
                @error('e_have_visa_condition') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            @if($e_have_visa_condition === 'Yes')
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Please describe your visa condition</label>
                    <input type="text" wire:model="e_visa_condition_detail" class="form-control">
                    @error('e_visa_condition_detail') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            @endif
            <div class="fv-row mb-7">
                <label class="required fs-6 fw-semibold mb-2">Have any Visa Refusal:</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.live="e_have_visa_refusal_condition" id="Yes" value="Yes">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.live="e_have_visa_refusal_condition" id="No" value="No">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                </div>
                @error('e_have_visa_refusal_condition') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            @if($e_have_visa_refusal_condition === 'Yes')
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Please describe your visa refusal condition</label>
                    <input type="text" wire:model="e_visa_refusal_condition_detail" class="form-control">
                    @error('e_visa_refusal_condition_detail') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            @endif
        </div>

        <div class="col-md-12">
            <div class="card card-flush pt-3 mb-5">
                <div class="card-header d-flex flex-column">
                    <div class="card-title">
                        <h2 class="fw-bold">Educational Background</h2>
                    </div>
                    <div>
                        @error('e_educations.*') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fw-semibold fs-6 gy-5">
                            <thead>
                                <tr class="text-muted fw-bold fs-7 text-uppercase">
                                    <th>Degree</th>
                                    <th>Institution</th>
                                    <th>Year</th>
                                    <th>Grade/CGPA</th>
                                    <th class="text-end">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($e_educations as $index => $education)
                                    <tr>
                                        <td>
                                            <input type="text" wire:model="e_educations.{{ $index }}.degree" class="form-control form-control-solid">
                                        </td>
                                        <td>
                                            <input type="text" wire:model="e_educations.{{ $index }}.institution" class="form-control form-control-solid">
                                        </td>
                                        <td>
                                            <input type="text" wire:model="e_educations.{{ $index }}.year" class="form-control form-control-solid">
                                        </td>
                                        <td>
                                            <input type="text" wire:model="e_educations.{{ $index }}.grade" class="form-control form-control-solid">
                                        </td>
                                        <td class="text-end">
                                            @if(count($e_educations) > 1)
                                                <button type="button" wire:click="removeRow({{ $index }})" class="btn btn-sm btn-danger">Remove</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <button type="button" wire:click="addRow" class="btn btn-light-primary"> + Add More </button>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="text-end">
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </div>
    </div>
</form>