@section('page-title') Section Development @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Section</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Process</li>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
@endpush

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-2">
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('admin.section.process.update', $section->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row p-2">
                            {{-- <div class="col-md-12">
                                <div wire:ignore class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">File</label>
                                    <input type="file" name="file" class="dropify" data-default-file="{{asset($section->file)}}" />
                                    @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <script> $('.dropify').dropify(); </script>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Name</label>
                                    <div class="input-group date" >
                                        <input type="text" name="name" value="{{$section->name}}" class="form-control form-control-solid" />
                                    </div>
                                    @error('name') <span class="form-text text-danger pt-2 pr-4">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Title</label>
                                    <div class="input-group date" >
                                        <input type="text" name="title" value="{{$section->title}}" class="form-control form-control-solid" />
                                    </div>
                                    @error('title') <span class="form-text text-danger pt-2 pr-4">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Description</label>
                                    <textarea name="description" cols="30" rows="10" class="form-control form-control-solid">{{$section->description}}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Link</label>
                                    <div class="input-group date" >
                                        <input type="text" name="link" value="{{$section->link}}" class="form-control form-control-solid" />
                                    </div>
                                    @error('link') <span class="form-text text-danger pt-2 pr-4">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

