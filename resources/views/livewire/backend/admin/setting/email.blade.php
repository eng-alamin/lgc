@section('page-title') Settings @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Settings</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Email</li>
@endsection

<div id="kt_app_content_container" class="app-container  container-xxl ">
    @include('livewire.backend.admin.setting.navbar')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Email Settings <br><span style="font-size: 0.8rem">SMTP Mail Driver</span></h3>
                @php $smtp = json_decode($data->smtp) @endphp
            </div>
        </div>
        <div id="kt_account_settings_profile_details" class="collapse show">
            <form role="form" id="kt_account_profile_details_form" method="POST" action="{{route('admin.setting.email.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Host</label>
                        <div class="col-lg-8">
                            <input type="text" name="smtp_host" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="SMTP host name" value="{{$smtp->host}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Port</label>
                        <div class="col-lg-8">
                            <input type="text" name="smtp_port" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="SMTP port name" value="{{$smtp->port}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">User Name</label>
                        <div class="col-lg-8">
                            <input type="text" name="smtp_username" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="SMTP user name" value="{{$smtp->username}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Password</label>
                        <div class="col-lg-8">
                            <input type="text" name="smtp_password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="SMTP user name" value="{{$smtp->password}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Encryption</label>
                        <div class="col-lg-8">
                            <select name="smtp_encryption" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                <option value="">Select</option>
                                <option @if($smtp->encryption == 'ssl') selected @endif value="ssl">SSL</option>
                                <option @if($smtp->encryption == 'tls') selected @endif value="tls">TLS</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">From Name</label>
                        <div class="col-lg-8">
                            <input type="text" name="smtp_from_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="SMTP from name" value="{{$smtp->name}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">From Email</label>
                        <div class="col-lg-8">
                            <input type="text" name="smtp_from_email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="SMTP from email" value="{{$smtp->email}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">To Email</label>
                        <div class="col-lg-8">
                            <input type="text" name="smtp_to_email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="SMTP to email" value="{{$smtp->to_email}}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">CC Email</label>
                    <div class="col-lg-8">
                        <input type="text" name="smtp_cc_email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="CC Email" value="@if(isset($smtp->cc_email)) {{$smtp->cc_email}} @endif" />
                        @error('smtp_cc_email') <span class="text-danger">{{ $message }}</span> @enderror
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
