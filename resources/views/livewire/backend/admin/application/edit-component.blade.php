@section('page-title') Registration Form @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted"> Edit Form</li>
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card mb-2">
        <div class="card-body">

            @if ($service == "education")
                @include('livewire.backend.admin.application.education')
            @endif
            
        </div>
    </div>
</div>