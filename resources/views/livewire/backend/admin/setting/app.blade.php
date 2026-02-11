@section('page-title') Settings @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Settings</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">App</li>
@endsection

<div id="kt_app_content_container" class="app-container  container-xxl ">
    @include('livewire.backend.admin.setting.navbar')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">App Settings <br><span style="font-size: 0.8rem">Update Organization settings</span></h3>
            </div>
        </div>
        <div id="kt_account_settings_profile_details" class="collapse show">
            <form role="form" id="kt_account_profile_details_form" method="POST" action="{{route('admin.setting.app.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Logo</label>
                        <div class="col-lg-8">
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('/assets/media/svg/avatars/blank.svg')">
                                <div class="image-input-wrapper w-125px h-125px" @if($data->logo) style="background-image: url({{asset($data->logo)}})" @else style="background-image: url(/assets/media/default.png)" @endif></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="image_remove" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Favicon</label>
                        <div class="col-lg-8">
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('/assets/media/svg/avatars/blank.svg')">
                                <div class="image-input-wrapper w-125px h-125px" @if($data->favicon) style="background-image: url({{asset($data->favicon)}})" @else style="background-image: url(/assets/media/default.png)" @endif></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="file" name="favicon" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="image_remove" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Name</label>
                        <div class="col-lg-8">
                            <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Name" value="{{$data->name}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Detail</label>
                        <div class="col-lg-8">
                            <textarea name="detail" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" cols="30" rows="10">{{$data->detail}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                        <div class="col-lg-8 fv-row">
                            <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{$data->email}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Phone</label>
                        <div class="col-lg-8 fv-row">
                            <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone" value="{{$data->phone}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Fax</label>
                        <div class="col-lg-8 fv-row">
                            <input type="tel" name="fax" class="form-control form-control-lg form-control-solid" placeholder="Fax" value="{{$data->fax}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Address</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Ex. F/3, R/5, City, US" value="{{$data->address}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Time</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="time" class="form-control form-control-lg form-control-solid" placeholder="Ex. Mon-Sat : 08:00-20:00" value="{{$data->time}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Website</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="website" class="form-control form-control-lg form-control-solid" placeholder="Website" value="{{$data->website}}" />
                        </div>
                    </div>

                    @php $json_social = json_decode($data->social) @endphp
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Facebook</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="facebook" class="form-control form-control-lg form-control-solid" placeholder="Ex. https://www.facebook.com/example" value="@if(isset($json_social->facebook)) {{$json_social->facebook}} @endif" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Youtube</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="youtube" class="form-control form-control-lg form-control-solid" placeholder="Ex. https://www.youtube.com/example" value="@if(isset($json_social->youtube)) {{$json_social->youtube}} @endif" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">X</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="x" class="form-control form-control-lg form-control-solid" placeholder="Ex. https://www.x.com/example" value="@if(isset($json_social->x)) {{$json_social->x}} @endif" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Linkedin</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="linkedin" class="form-control form-control-lg form-control-solid" placeholder="Ex. https://www.linkedin.com/example" value="@if(isset($json_social->linkedin)) {{$json_social->linkedin}} @endif" />
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
