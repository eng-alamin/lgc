@section('page-title') Application @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Application</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Add New</li>
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card mb-2">
        <div class="card-body">
            <div class="col-md-8 offset-md-2">
                <div class="fv-row mb-7">
                    <div wire:ignore>
                        <label class="fs-6 fw-semibold mb-2">Client</label>
                        <select class="form-select form-select-solid client_id" data-control="select2" data-hide-search="true" data-placeholder="Select a client" wire:model="client_id" wire:change="getEventClient">
                            <option value="">Select Client...</option>
                            @foreach ($clients as $item)
                                 <option value="{{$item->id}}">{{$item->name}} - {{$item->email}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('client_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="fv-row mb-7">
                    <div wire:ignore>
                        <label class="fs-6 fw-semibold mb-2">Service</label>
                        <select class="form-select form-select-solid service" data-control="select2" data-hide-search="true" data-placeholder="Select a service"  wire:model="service">
                            <option value="">Select Service...</option>
                            <option value="education">Education</option>
                            <option value="healthcare">Healthcare</option>
                            <option value="business">Business</option>
                            <option value="travel">Travel</option>
                        </select>
                    </div>
                    @error('service') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            @if ($service == "education")
                @include('livewire.backend.agent.application.education')
            @endif
            
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            $('.client_id').on('change', function () {
                @this.set('client_id', $(this).val());
                @this.getEventClient();  
            });
            $('.service').on('change', function () {
                @this.set('service', $(this).val());
            });

            Livewire.on('refreshSelect', () => {
                setTimeout(() => {
                    $('.client_id').val(@this.get('client_id')).trigger('change');
                    $('.service').val(@this.get('service')).trigger('change');
                }, 100);
            });
        });
    </script>
@endpush