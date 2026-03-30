@section('page-title') Registration Form @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted"> Add Form</li>
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card mb-2">
        <div class="card-body">
            <div class="col-md-8 offset-md-2">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Client</label>
                    <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" data-live-search="true" title="Select a client" wire:model.live="client_id" wire:change="getEventClient">
                        <option value="" class="text-muted d-none"></option>
                        @foreach ($clients as $item)
                                <option value="{{$item->id}}">{{$item->user->name}} - {{$item->user->email}}</option>
                        @endforeach
                    </select>
                    @error('client_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Service</label>
                    <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" title="Select a service"  wire:model.live="service">
                        <option value="" class="text-muted d-none"></option>
                        <option value="education">Education</option>
                        <option value="healthcare">Healthcare</option>
                        <option value="business">Business</option>
                        <option value="travel">Travel</option>
                        <option value="career">Career</option>
                    </select>
                    @error('service') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            @if ($service == "education")
                @include('livewire.backend.admin.application.education')
            @endif
            
        </div>
    </div>
</div>