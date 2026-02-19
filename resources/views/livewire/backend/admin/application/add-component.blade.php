@section('page-title') Application @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Application</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Add New</li>
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-2">
                <div class="card-body">
                    <form class="form" role="form" wire:submit.prevent="store">
                        <div class="row p-2">
                            <div class="col-md-12">
                                <h2 class="mb-4">Personal Information</h2>   
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Full Name (as per Passport)</label>
                                    <input type="text" wire:model="name" class="form-control form-control-solid" />
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Gender</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="gender" name="gender" id="male" value="Male">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="gender" name="gender" id="female" value="Femail">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                    </div>
                                    @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Date of Birth</label>
                                    <input type="date" wire:model="date_of_birth" class="form-control form-control-solid" />
                                    @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                  <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Nationality</label>
                                    <input type="text" wire:model="nationality" class="form-control form-control-solid" />
                                    @error('nationality') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Marital Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="marital_status" name="marital_status" id="Single" value="Single">
                                            <label class="form-check-label" for="Single">Single</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="marital_status" name="marital_status" id="Married" value="Married">
                                            <label class="form-check-label" for="Married">Married</label>
                                        </div>
                                    </div>
                                    @error('marital_status') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Religion (optional)</label>
                                    <input type="text" wire:model="religion" class="form-control form-control-solid" />
                                    @error('religion') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h2 class="mb-4">Contact Details</h2>   
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Mobile Number (WhatsApp)</label>
                                    <input type="text" wire:model="number" class="form-control form-control-solid" />
                                    @error('number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Email Address</label>
                                    <input type="text" wire:model="email" class="form-control form-control-solid" />
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Permanent Address</label>
                                    <input type="text" wire:model="permanent_address" class="form-control form-control-solid" />
                                    @error('permanent_address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Current Address</label>
                                    <input type="text" wire:model="current_address" class="form-control form-control-solid" />
                                    @error('current_address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h2 class="mb-4">Passport Information</h2>   
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Passport Number</label>
                                    <input type="text" wire:model="passport_number" class="form-control form-control-solid" />
                                    @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Date of Issue</label>
                                    <input type="date" wire:model="date_of_issue" class="form-control form-control-solid" />
                                    @error('date_of_issue') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Date of Expiry</label>
                                    <input type="date" wire:model="date_of_expiry" class="form-control form-control-solid" />
                                    @error('date_of_expiry') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Place of Issue</label>
                                    <input type="date" wire:model="place_of_issue" class="form-control form-control-solid" />
                                    @error('place_of_issue') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h2 class="mb-4">English Language Proficiency</h2>   
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Medium of Instrution</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="medium_of_instruction" name="medium_of_instruction" id="English" value="English">
                                            <label class="form-check-label" for="English">English</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="medium_of_instruction" name="medium_of_instruction" id="Bangla" value="Bangla">
                                            <label class="form-check-label" for="Bangla">Bangla</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="medium_of_instruction" name="medium_of_instruction" id="Other" value="Other">
                                            <label class="form-check-label" for="Other">Other</label>
                                        </div>
                                    </div>
                                    @error('medium_of_instruction') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Duolingo</label>
                                    <input type="text" wire:model="duolingo" class="form-control form-control-solid" />
                                    @error('duolingo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Score</label>
                                    <input type="text" wire:model="score" class="form-control form-control-solid" />
                                    @error('score') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h2 class="mb-4">Intended Study Plan in China</h2>   
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Intended Level of Study</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="intended_level_of_study" name="intended_level_of_study" id="Language" value="Language">
                                            <label class="form-check-label" for="Language">Language</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="intended_level_of_study" name="intended_level_of_study" id="Bachelor" value="Bachelor">
                                            <label class="form-check-label" for="Bachelor">Bachelor</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="intended_level_of_study" name="intended_level_of_study" id="Master" value="Master">
                                            <label class="form-check-label" for="Master">Master</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="intended_level_of_study" name="intended_level_of_study" id="PhD" value="PhD">
                                            <label class="form-check-label" for="PhD">PhD</label>
                                        </div>
                                    </div>
                                    @error('intended_level_of_study') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Preferred Field of Study</label>
                                    <input type="text" wire:model="preferred_field_of_study" class="form-control form-control-solid" />
                                    @error('preferred_field_of_study') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Preferred Intake</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="preferred_intake" name="preferred_intake" id="March" value="March">
                                            <label class="form-check-label" for="March">March</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="preferred_intake" name="preferred_intake" id="September" value="September">
                                            <label class="form-check-label" for="September">September</label>
                                        </div>
                                    </div>
                                    @error('preferred_intake') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Preferred City/University (if any)</label>
                                    <input type="text" wire:model="preferred_university" class="form-control form-control-solid" />
                                    @error('preferred_university') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h2 class="mb-4">Guardian/Emergency Contact</h2>   
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Name</label>
                                    <input type="text" wire:model="guardian_name" class="form-control form-control-solid" />
                                    @error('guardian_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Relationship</label>
                                    <input type="text" wire:model="guardian_relationship" class="form-control form-control-solid" />
                                    @error('guardian_relationship') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Contact Number</label>
                                    <input type="text" wire:model="guardian_number" class="form-control form-control-solid" />
                                    @error('guardian_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Address</label>
                                    <input type="text" wire:model="guardian_address" class="form-control form-control-solid" />
                                    @error('guardian_address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h2 class="mb-4">Medical Information (Basic)</h2>   
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">DO you have any medical conditions?</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="have_medical_condition" name="have_medical_condition" id="Yes" value="Yes">
                                            <label class="form-check-label" for="Yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="have_medical_condition" name="have_medical_condition" id="No" value="No">
                                            <label class="form-check-label" for="No">No</label>
                                        </div>
                                    </div>
                                    @error('have_medical_condition') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            @if($have_medical_condition === 'Yes')
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Please describe your medical condition</label>
                                    <input type="text" wire:model="medical_condition_detail" class="form-control">
                                    @error('medical_condition_detail') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif

                            <div class="col-md-12">
                                <h2 class="mb-4">Visa information</h2>   
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Have any Visa:</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="have_visa_condition" name="have_visa_condition" id="Yes" value="Yes">
                                            <label class="form-check-label" for="Yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="have_visa_condition" name="have_visa_condition" id="No" value="No">
                                            <label class="form-check-label" for="No">No</label>
                                        </div>
                                    </div>
                                    @error('have_visa_condition') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                @if($have_visa_condition === 'Yes')
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold mb-2">Please describe your visa condition</label>
                                        <input type="text" wire:model="visa_condition_detail" class="form-control">
                                        @error('visa_condition_detail') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                @endif
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Have any Visa Refusal:</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="have_visa_refusal_condition" name="have_visa_refusal_condition" id="Yes" value="Yes">
                                            <label class="form-check-label" for="Yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="have_visa_refusal_condition" name="have_visa_refusal_condition" id="No" value="No">
                                            <label class="form-check-label" for="No">No</label>
                                        </div>
                                    </div>
                                    @error('have_visa_refusal_condition') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                @if($have_visa_refusal_condition === 'Yes')
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold mb-2">Please describe your visa refusal condition</label>
                                        <input type="text" wire:model="visa_refusal_condition_detail" class="form-control">
                                        @error('visa_refusal_condition_detail') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                @endif

                                <div class="card card-flush pt-3 mb-5">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2 class="fw-bold">Educational Background</h2>
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
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
{{-- <script>
    "use strict";
    var KTSubscriptionsAdvanced = function() {
        var t, e, n = function() {
            t.querySelectorAll("tbody tr").forEach(((t, e) => {
                const n = t.querySelector("td:first-child input"),
                    o = t.querySelector("td:nth-child(2) input"),
                    i = n.getAttribute("id"),
                    r = o.getAttribute("id");
                n.setAttribute("name", i + "-" + e), o.setAttribute("name", r + "-" + e)
            }))
        };
        return {
            init: function() {
                t = document.getElementById("kt_create_new_custom_fields"),
                    function() {
                        const o = document.getElementById("kt_create_new_custom_fields_add"),
                            i = t.querySelector("tbody tr td:first-child").innerHTML,
                            r = t.querySelector("tbody tr td:nth-child(2)").innerHTML,
                            c = t.querySelector("tbody tr td:last-child").innerHTML;
                        var d;
                        e = $(t).DataTable({
                            info: !1,
                            order: [],
                            ordering: !1,
                            paging: !1,
                            lengthChange: !1
                        }), o.addEventListener("click", (function(t) {
                            t.preventDefault(), d = e.row.add([i, r, c]).draw().node(), $(d).find("td").eq(2).addClass("text-end"), n()
                        }))
                    }(), n(), KTUtil.on(t, '[data-kt-action="field_remove"]', "click", (function(t) {
                        t.preventDefault();
                        const n = t.target.closest("tr");
                        Swal.fire({
                            text: "Are you sure you want to delete this field ?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then((function(t) {
                            t.value ? Swal.fire({
                                text: "You have deleted it!.",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            }).then((function() {
                                e.row($(n)).remove().draw()
                            })) : "cancel" === t.dismiss && Swal.fire({
                                text: "It was not deleted.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            })
                        }))
                    }))
            }
        }
    }();
    KTUtil.onDOMContentLoaded((function() {
        KTSubscriptionsAdvanced.init()
    })); 
</script> --}}
@endpush