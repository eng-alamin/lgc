@section('page-title') Settings @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Settings</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Auth</li>
@endsection

<div id="kt_app_content_container" class="app-container  container-xxl ">
    @include('livewire.backend.admin.setting.navbar')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Auth Settings <br><span style="font-size: 0.8rem">Update Auth settings</span></h3>
            </div>
        </div>
        <div class="">
            <form role="form" method="POST" action="{{route('admin.setting.auth.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Background Image</label>
                        <div class="col-lg-8">
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('/assets/media/svg/avatars/blank.svg')">
                                <div class="image-input-wrapper w-125px h-125px" @if($data->auth_bg_image) style="background-image: url({{asset($data->auth_bg_image)}})" @else style="background-image: url(/assets/media/default.png)" @endif></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="file" name="auth_bg_image" accept=".png, .jpg, .jpeg" />
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
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Forground Image</label>
                        <div class="col-lg-8">
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('/assets/media/svg/avatars/blank.svg')">
                                <div class="image-input-wrapper w-125px h-125px" @if($data->auth_fg_image) style="background-image: url({{asset($data->auth_fg_image)}})" @else style="background-image: url(/assets/media/default.png)" @endif></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="file" name="auth_fg_image" accept=".png, .jpg, .jpeg" />
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
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Title</label>
                        <div class="col-lg-8">
                            <input type="text" name="auth_title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Title" value="{{$data->auth_title}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Detail</label>
                        <div class="col-lg-8 fv-row">
                            <textarea name="auth_detail" class="form-control form-control-lg form-control-solid" cols="30" rows="10">{{$data->auth_detail}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Socialite</label>
                        @php  $socialite = (array)json_decode($data->socialite); @endphp
                        <div class="col-lg-8 fv-row">
                            <div class="d-flex align-items-center mt-3">
                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox" name="socialite[]" @if(in_array('google', $socialite)) checked @endif value="google" />
                                    <span class="fw-semibold ps-2 fs-6"> Google </span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="socialite[]" @if(in_array('apple', $socialite)) checked @endif value="apple" />
                                    <span class="fw-semibold ps-2 fs-6"> Apple </span>
                                </label>
                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="socialite[]" @if(in_array('facebook', $socialite)) checked @endif value="facebook" />
                                    <span class="fw-semibold ps-2 fs-6"> Facebook </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top p-9">
                    <h3 class="fw-bold pb-5">Google Auth</h3>
                    @php $google = json_decode($data->google) @endphp
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Client Id</label>
                        <div class="col-lg-8">
                            <input type="text" name="google_client_id" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Client Id" value="@if(isset($google->client_id)) {{$google->client_id}} @endif" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Client Secret</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="google_client_secret" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Client Secret" value="@if(isset($google->client_secret)) {{$google->client_secret}} @endif" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Callback Url</label>
                        <div class="col-lg-8">
                            <input type="text" name="google_callback_url" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Callback Url" value="@if(isset($google->callback_url)) {{$google->callback_url}} @endif" />
                        </div>
                    </div>
                </div>
                <div class="card-body border-top p-9">
                    <h3 class="fw-bold pb-5">Facebook Auth</h3>
                    @php $facebook = json_decode($data->facebook) @endphp
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Client Id</label>
                        <div class="col-lg-8">
                            <input type="text" name="facebook_client_id" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Client Id" value="@if(isset($facebook->client_id)) {{$facebook->client_id}} @endif" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Client Secret</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="facebook_client_secret" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Client Secret" value="@if(isset($facebook->client_secret)) {{$facebook->client_secret}} @endif" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Callback Url</label>
                        <div class="col-lg-8">
                            <input type="text" name="facebook_callback_url" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Callback Url" value="@if(isset($facebook->callback_url)) {{$facebook->callback_url}} @endif" />
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
