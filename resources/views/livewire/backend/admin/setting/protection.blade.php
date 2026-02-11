@section('page-title') Settings @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Settings</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Protection</li>
@endsection

<div id="kt_app_content_container" class="app-container  container-xxl ">
    @include('livewire.backend.admin.setting.navbar')

    <form role="form" id="kt_account_profile_details_form" method="POST" action="{{route('admin.setting.protection.update')}}">
        @csrf
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Protection Settings <br><span style="font-size: 0.8rem">Site Protection</span></h3>
                    @php $protection = json_decode($data->protection) @endphp
                </div>
            </div>
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Password</label>
                    <div class="col-lg-8">
                        <input type="text" name="password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="passpp1,passpp2" value="@if(isset($protection->password)) {{$protection->password}} @endif" />
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Lifetime</label>
                    <div class="col-lg-8">
                        <input type="text" name="lifetime" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="604800" value="@if(isset($protection->lifetime)) {{$protection->lifetime}} @endif" />
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
