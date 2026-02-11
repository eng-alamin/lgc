@section('page-title') Section Development @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Section</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Funfact</li>
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-2">
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('admin.section.funfact.update', $section->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row p-2">
                            <div class="col-md-12">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Data Value 1</label>
                                    <div class="input-group date" >
                                        <input type="text" name="datavalue1" value="{{ $items[0]['value'] ?? '' }}" class="form-control form-control-solid" />
                                    </div>
                                    <label class="fs-6 fw-semibold mb-2">Data Text 1</label>
                                    <div class="input-group date" >
                                        <input type="text" name="datatext1" value="{{ $items[0]['text'] ?? '' }}" class="form-control form-control-solid" />
                                    </div>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Data Value 2</label>
                                    <div class="input-group date" >
                                        <input type="text" name="datavalue2" value="{{ $items[1]['value'] ?? '' }}" class="form-control form-control-solid" />
                                    </div>
                                    <label class="fs-6 fw-semibold mb-2">Data Text 2</label>
                                    <div class="input-group date" >
                                        <input type="text" name="datatext2" value="{{ $items[1]['text'] ?? '' }}" class="form-control form-control-solid" />
                                    </div>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Data Value 3</label>
                                    <div class="input-group date" >
                                        <input type="text" name="datavalue3" value="{{ $items[2]['value'] ?? '' }}" class="form-control form-control-solid" />
                                    </div>
                                    <label class="fs-6 fw-semibold mb-2">Data Text 3</label>
                                    <div class="input-group date" >
                                        <input type="text" name="datatext3" value="{{ $items[2]['text'] ?? '' }}" class="form-control form-control-solid" />
                                    </div>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Data Value 4</label>
                                    <div class="input-group date" >
                                        <input type="text" name="datavalue4" value="{{ $items[3]['value'] ?? '' }}" class="form-control form-control-solid" />
                                    </div>
                                    <label class="fs-6 fw-semibold mb-2">Data Text 4</label>
                                    <div class="input-group date" >
                                        <input type="text" name="datatext4" value="{{ $items[3]['text'] ?? '' }}" class="form-control form-control-solid" />
                                    </div>
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