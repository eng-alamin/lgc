@section('page-title') Settings @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Settings</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Other</li>
@endsection

<div id="kt_app_content_container" class="app-container  container-xxl ">
    @include('livewire.backend.admin.setting.navbar')

    <form role="form" id="kt_account_profile_details_form" method="POST" action="{{route('admin.setting.other.update')}}">
        @csrf
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Other Settings <br><span style="font-size: 0.8rem">Site Other</span></h3>
                    @php $other = json_decode($data->other) @endphp
                </div>
            </div>
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Whatsapp</label>
                    <div class="col-lg-8">
                        <input type="text" name="whatsapp" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Whatsapp" value="@if(isset($other->whatsapp)) {{$other->whatsapp}} @endif" />
                        @error('whatsapp') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email Notification</label>
                    <div class="col-lg-8">
                        <select name="notification_id" aria-label="Select a email id" data-control="select2" data-placeholder="Select Email..." class="form-select form-select-solid form-select-lg fw-semibold">
                                <option value="">Select Email...</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" @if($other->notification_id == $user->id) selected {{$user->email}} @endif>{{$user->email}}</option>
                                @endforeach
                        </select>
                        @error('notification_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Google maps api key</label>
                    <div class="col-lg-8">
                        <input type="text" name="google_maps_api_key" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Google maps api key" value="@if(isset($other->google_maps_api_key)) {{$other->google_maps_api_key}} @endif" />
                        @error('google_maps_api_key') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
