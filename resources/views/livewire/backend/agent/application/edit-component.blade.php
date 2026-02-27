@section('page-title') Application @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Application</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Edit</li>
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card mb-2">
        <div class="card-body">

            @if ($service == "education")
                @include('livewire.backend.agent.application.education')
            @endif
            
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            $('.service').on('change', function () {
                @this.set('service', $(this).val());
            });

            Livewire.on('refreshSelect', () => {
                setTimeout(() => {
                    $('.service')
                        .val(@this.get('service'))
                        .trigger('change');
                }, 100);
            });
        });
    </script>
@endpush