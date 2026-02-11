@section('page-title') Account @endsection
@section('page-breadcrumb') Account @endsection
@section('breadcrumb-slah-one') <span class="bullet bg-gray-400 w-5px h-2px"></span> @endsection
@section('breadcrumb-name-one') Account @endsection
@section('breadcrumb-slah-two') <span class="bullet bg-gray-400 w-5px h-2px"></span> @endsection
@section('breadcrumb-name-two') Setting @endsection

    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            @include('livewire.backend.admin.account.navbar')
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Profile Details</h3>
                    </div>
                </div>
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <form role="form" method="POST" action="{{ route('admin.account.setting.update', auth()->user()->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="card-body border-top p-9">
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                <div class="col-lg-8">
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('/assets/media/svg/avatars/blank.svg')">
                                        <div class="image-input-wrapper w-125px h-125px" @if($data->avatar) style="background-image: url({{asset($data->avatar)}})" @else style="background-image: url({{asset('assets/media/avatars/blank.png')}})" @endif></div>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="ki-duotone ki-pencil fs-7">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                                <div class="col-lg-8">
                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="{{$data->name}}" />
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Phone</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{$data->phone}}" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
            <!--begin::Sign-in Method-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Sign-in Method</h3>
                        </div>
                </div>
                <div class="card-body border-top p-9">

                    {{-- New Password --}}
                    @if (!$data->password)
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <div class="flex-row-fluid">
                                <form method="POST" action="{{ route('admin.account.setting.password.store') }}" class="form" novalidate="novalidate">
                                    @csrf
                                    @method('PUT')
                                        <div class="row mb-1">
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New Password</label>
                                                    <input type="password" name="password" id="newpassword" class="form-control form-control-lg form-control-solid" />
                                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="password_confirmation" class="form-label fs-6 fw-bold mb-3">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg form-control-solid" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 d-flex align-items-center">
                                                <button type="submit" class="btn btn-primary mt-8 me-2 px-6">Update Password</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    {{-- Change Email --}}
                    @if($data->id > 1)
                        <div class="d-flex flex-wrap align-items-center">
                            <div id="kt_signin_email">
                                <div class="fs-6 fw-bold mb-1">Email Address</div>
                                <div class="fw-semibold text-gray-600">{{$data->email}}</div>
                            </div>
                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                <form class="form" method="POST" action="{{ route('admin.account.setting.email.update') }}" novalidate="novalidate">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-6">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0">
                                                <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Enter New Email Address</label>
                                                <input type="email" class="form-control form-control-lg form-control-solid" id="emailaddress" placeholder="Email Address" name="email" value="{{$data->email}}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fv-row mb-0">
                                                <label for="emailpassword" class="form-label fs-6 fw-bold mb-3">Confirm Password</label>
                                                <input type="password" name="password" id="emailpassword" class="form-control form-control-lg form-control-solid" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary  me-2 px-6">Update Email</button>
                                        <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <div id="kt_signin_email_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">Change Email</button>
                            </div>
                        </div>
                    @endif

                    <div class="separator separator-dashed my-6"></div>

                    {{-- Change Password --}}
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <div id="kt_signin_password">
                            <div class="fs-6 fw-bold mb-1">Password</div>
                            <div class="fw-semibold text-gray-600">************</div>
                        </div>
                        <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                            <form method="POST" action="{{ route('admin.account.setting.password.update') }}" class="form" novalidate="novalidate">
                                @csrf
                                @method('PUT')
                                    <div class="row mb-1">
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Current Password</label>
                                                <input type="password" name="current_password" id="currentpassword" class="form-control form-control-lg form-control-solid" />
                                                @error('current_password')<span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New Password</label>
                                                <input type="password" name="password" id="newpassword" class="form-control form-control-lg form-control-solid" />
                                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Confirm Password</label>
                                                <input type="password" name="password_confirmation" id="confirmpassword" class="form-control form-control-lg form-control-solid" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button id="kt_password_submit" type="submit" class="btn btn-primary me-2 px-6">Update Password</button>
                                        <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                    </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Edit-->
                        <!--begin::Action-->
                        <div id="kt_signin_password_button" class="ms-auto">
                            <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                        </div>
                        <!--end::Action-->
                    </div>

                </div>
            </div>
            <!--end::Sign-in Method-->

            <!--begin::Deactivate Account-->
            @if($data->id > 1)
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Deactivate Account</h3>
                            </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_deactivate" class="collapse show">
                            <form method="POST" action="{{ route('admin.account.setting.deactivate') }}" class="form">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="card-body border-top p-9">
                                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                        <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <div class="d-flex flex-stack flex-grow-1 ">
                                            <div class=" fw-semibold">
                                                <h4 class="text-gray-900 fw-bold">You Are Deactivating Your Account</h4>
                                                <div class="fs-6 text-gray-700 ">For extra security, this requires you to confirm your email or phone number when you reset yousignr password. <br />
                                                    <a class="fw-bold" href="#">Learn more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check form-check-solid fv-row">
                                        <input name="deactivate" class="form-check-input" type="checkbox" value="2" id="deactivate" />
                                        <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">I confirm my account deactivation</label>
                                        @error('deactivate') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button id="kt_account_deactivate_account_submit" type="submit" class="btn btn-danger fw-semibold">Deactivate Account</button>
                                </div>
                            </form>
                    </div>
                    <!--end::Content-->
                </div>
            @endif
            <!--end::Deactivate Account-->
        </div>
        <!--end::Content container-->
    </div>


