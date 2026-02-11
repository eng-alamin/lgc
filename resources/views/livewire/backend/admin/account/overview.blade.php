@section('page-title') Account @endsection
@section('page-breadcrumb') Account @endsection
@section('breadcrumb-slah-one') <span class="bullet bg-gray-400 w-5px h-2px"></span> @endsection
@section('breadcrumb-name-one') Account @endsection
@section('breadcrumb-slah-two') <span class="bullet bg-gray-400 w-5px h-2px"></span> @endsection
@section('breadcrumb-name-two') Overview @endsection


<div id="kt_app_content" class="app-content  flex-column-fluid ">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <!--begin::Navbar-->
        @include('livewire.backend.admin.account.navbar')
        <!--end::Navbar-->
        <!--begin::details View-->
        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Profile Details</h3>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="{{route('admin.account.setting')}}" class="btn btn-sm btn-primary align-self-center">Edit Profile</a>
                    <!--end::Action-->
            </div>
            <!--begin::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-semibold text-muted">Name</label>
                    <div class="col-lg-8">
                        <span class="fw-bold fs-6 text-gray-800">{{$data->name}}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-semibold text-muted">Email</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-semibold text-gray-800 fs-6">{{$data->email}}</span>
                        @if($data->email_verified_at)
                            <span class="badge badge-success">Verified</span>
                        @else
                            <a href="{{route('email.verification.resend')}}">
                                <span class="badge badge-danger">Unverified</span>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-semibold text-muted"> Phone </label>
                    <div class="col-lg-8 d-flex align-items-center">
                        <span class="fw-bold fs-6 text-gray-800 me-2">{{$data->phone}}</span>
                    </div>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::details View-->
    </div>
    <!--end::Content container-->
</div>

