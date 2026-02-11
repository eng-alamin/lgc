@section('page-title') Settings @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Settings</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Meta</li>
@endsection

<div id="kt_app_content_container" class="app-container  container-xxl ">
    @include('livewire.backend.admin.setting.navbar')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Meta Settings <br><span style="font-size: 0.8rem">Update Meta settings</span></h3>
            </div>
        </div>
        <div class="">
            <form role="form" method="POST" action="{{route('admin.setting.meta.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body border-top p-9">
                    @php $meta = json_decode($data->meta) @endphp
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Title</label>
                        <div class="col-lg-8">
                            <input type="text" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Title" value="@isset($meta->title) {{$meta->title}} @endisset" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Description</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="description" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Discription" value="@isset($meta->description) {{$meta->description}} @endisset" />
                            {{-- <textarea name="description" class="form-control form-control-lg form-control-solid" cols="30" rows="10" default="@isset($meta->description) {{$meta->description}} @endisset"></textarea> --}}
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Keyword</label>
                        <div class="col-lg-8">
                            <input type="text" name="keyword" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="keyword, keyword" value="@isset($meta->keyword) {{$meta->keyword}} @endisset" />
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
