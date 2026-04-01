<section class="blog-details">
    <div class="header-space"></div>
    <div class="container">
        <div class="row">
            <!-- Service Navigation List -->
            <div class="col-lg-4 col-md-5 pe-md-5">
                <div class="sidebar">
                    @include('frontend.client.sidebar')
                    @include('frontend.client.banner')
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow border-0 mb-2">
                            <div class="card-body pt-4 pb-0">
                                <div class="d-flex flex-wrap flex-sm-nowrap align-items-center">
                                    <div class="profile me-4 mb-3 position-relative">
                                        @if ($this->client->user?->avatar)
                                            <img src="{{ asset($this->client->user?->avatar) }}" alt="{{$this->client->users?->name}}" class="rounded" width="120" height="120">
                                        @else
                                            <img src="{{asset('assets/backend//media/avatars/blank.png')}}" alt="Profile Photo" class="rounded" width="120" height="120">
                                        @endif
                                    </div> 

                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-2">
                                                    <h4 class="fw-bold me-2 mb-0">
                                                        {{$this->client->personalInfo?->full_name ?? $this->client->user?->name}}
                                                    </h4>
                                                    <i class="bi bi-patch-check-fill text-primary"></i>
                                                </div>
                                                <div class="d-flex flex-wrap text-muted mb-3">
                                                    <div class="me-4">
                                                        <i class="bi bi-building me-1"></i>
                                                            {{ucfirst($this->client->service)}}
                                                    </div>
                                                    <div class="me-4">
                                                        <i class="bi bi-phone me-1"></i>
                                                        {{$this->client->form?->data['number'] ?? $this->client->user?->phone}}
                                                    </div>
                                                    <div>
                                                        <i class="bi bi-geo-alt me-1"></i>
                                                        {{$this->client->form?->data['current_address'] ?? $this->client->user?->email}}
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- Stats -->
                                        <div class="d-flex flex-wrap">
                                            @php
                                                $service_amount = $this->rule->service_value ?? 0;
                                                $paid_amount = $this->form?->invoices->sum('paid_amount') ?? 0;
                                                $due_amount = $service_amount - $paid_amount;
                                            @endphp

                                            <!-- Price -->
                                            <div class="border rounded p-1 me-3 mb-3 text-center" style="min-width:120px;">
                                                <div class="mb-1 fs-4 fw-bold text-success">৳ {{ $service_amount }}</div>
                                                <div class="fw-semibold fs-6 text-gray">Service</div>
                                            </div>

                                            <!-- Due -->
                                            <div class="border rounded p-1 me-3 mb-3 text-center" style="min-width:120px;">
                                                <div class="mb-1 fs-4 fw-bold text-danger">৳ {{$due_amount}}</div>
                                                <div class="fw-semibold fs-6 text-gray">Due</div>
                                            </div>

                                            <!-- Paid -->
                                            <div class="border rounded p-1 me-3 mb-3 text-center" style="min-width:120px;">
                                                <div class="mb-1 fs-4 fw-bold text-success">৳ {{$paid_amount}}</div>
                                                <div class="fw-semibold fs-6 text-gray">Paid</div>
                                            </div>

                                        </div>

                                        <!-- Profile Completion -->
                                        {{-- <div class="mt-3" style="max-width:300px;">

                                            <div class="d-flex justify-content-between">
                                                <small class="text-muted">Profile Completion</small>
                                                <small class="fw-bold">50%</small>
                                            </div>

                                            <div class="progress" style="height:6px;">
                                                <div class="progress-bar bg-success"
                                                    role="progressbar"
                                                    style="width:50%">
                                                </div>
                                            </div>

                                        </div> --}}

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card shadow border-0 p-5">
                            @if ($timeline)
                                <div class="card-header border-0 bg-transparent">
                                    <h5 class="mb-0">Application Timeline</h5>
                                    <small>Progress Compleation : {{$this->form->completedStage?->stage?->progress_percent ?? 0}}%</small>
                                </div>

                                <div class="card-body">
                                    <div class="timeline">
                                        @foreach ($timeline ?? [] as $item)
                                            @if($item->stage->type == "lead")
                                            @elseif($item->stage->type == "invoice")
                                                <div class="timeline-item">
                                                    <div class="timeline-icon"> {!! $item->stage->icon !!}</div>
                                                    <div class="timeline-content">
                                                        <h6 class="fw-bold">{{$item->stage->name}}</h6>
                                                        <small class="text-muted"> Added at {{ \Carbon\Carbon::parse($item->created_at)->format('M d Y - h:i A') }}</small>
                                                        @forelse ($item->form->invoices as $inv)
                                                            <div class="border rounded p-3 mt-3 d-flex justify-content-between align-items-center">
                                                                <a href="{{route('invoices.view', $inv->id)}}" target="_blank" class="text-muted">{{$inv->number}}</a>
                                                                <p>
                                                                    @foreach ($inv->items as $ii)
                                                                        <span class="badge bg-secondary">{{ ucfirst($ii['name']) }}  @if(!$loop->last), @endif</span>
                                                                    @endforeach
                                                                </p>
                                                                @if ($inv->payment_status == 'paid')
                                                                    <span class="badge bg-primary">{{ ucfirst($inv->payment_status) }}</span>
                                                                @elseif ($inv->payment_status == 'partial')
                                                                    <span class="badge bg-warning">{{ ucfirst($inv->payment_status) }}</span>
                                                                @else
                                                                    <span class="badge bg-danger">{{ ucfirst($inv->payment_status) }}</span>
                                                                @endif
                                                            </div>
                                                        @empty
                                                            <div class="border rounded p-3 mt-3 d-flex justify-content-between align-items-center">
                                                                <a href="#" class="text-muted">{{$item->title}}</a>
                                                                @if ($item->status == 'pending')
                                                                    <span class="badge bg-primary">{{ ucfirst($item->status) }}</span>
                                                                @elseif ($item->status == 'processing')
                                                                    <span class="badge bg-warning">{{ ucfirst($item->status) }}</span>
                                                                @elseif ($item->status == 'completed')
                                                                    <span class="badge bg-success">{{ ucfirst($item->status) }}</span>
                                                                @else
                                                                    <span class="badge bg-danger">{{ ucfirst($item->status) }}</span>
                                                                @endif
                                                            </div>
                                                        @endforelse
                                                        
                                                    </div>
                                                </div>
                                            @elseif($item->stage->type == "documentation")
                                                <div class="timeline-item">
                                                    <div class="timeline-icon"> <i class="bi bi-file-earmark-pdf text-danger"></i></div>
                                                    <div class="timeline-content">
                                                        <h6 class="fw-bold">Documentation</h6>
                                                        @if ($item->form->type == "education")
                                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                                <div class="symbol symbol-30px me-5">
                                                                    <img alt="Icon" src="{{asset('assets/backend/media/svg/files/pdf.svg')}}" />
                                                                </div>
                                                                <div class="fw-semibold">
                                                                    @php $passport = $item->form->documents->where('document_type','passport')->first(); @endphp
                                                                    <a class="fs-6 fw-bold text-dark text-hover-primary" href="{{ asset($passport?->file ?? '#') }}" target="_blank">Passport *</a>
                                                                    @if ($passport)
                                                                        @if ($passport->status == "verified")
                                                                            <div class="text-success"><Var></Var>Verified {{ \Carbon\Carbon::parse($passport->updated_at)->diffForHumans() }}</div>
                                                                        @elseif ($passport?->status == "uploaded")
                                                                            <div class="text-warning">Uploaded {{ \Carbon\Carbon::parse($passport->updated_at)->diffForHumans() }}</div>
                                                                        @else
                                                                            <div class="text-warning">Declined - Again uploaded at {{ \Carbon\Carbon::parse($passport->updated_at)->diffForHumans() }}</div>
                                                                        @endif
                                                                    @else
                                                                        <div class="text-gray-400">Requirements</div>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-auto p-2">
                                                                    <a href="javascript:;" class="badge bg-danger p-2" data-bs-toggle="modal" data-bs-target="#addDocument" wire:click.prevent="typeDocument('passport')">Upload</a>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                                <div class="symbol symbol-30px me-5">
                                                                    <img alt="Icon" src="{{asset('assets/backend/media/svg/files/pdf.svg')}}" />
                                                                </div>
                                                                <div class="fw-semibold">
                                                                    @php $photo = $item->form->documents->where('document_type','photo')->first(); @endphp
                                                                    <a class="fs-6 fw-bold text-dark text-hover-primary" href="{{ asset($photo?->file ?? '#') }}" target="_blank">Passport Sized Photo With White Background *</a>
                                                                    @if ($photo)
                                                                        @if ($photo->status == "verified")
                                                                            <div class="text-success"><Var></Var>Verified {{ \Carbon\Carbon::parse($photo->updated_at)->diffForHumans() }}</div>
                                                                        @elseif ($photo?->status == "uploaded")
                                                                            <div class="text-warning">Uploaded {{ \Carbon\Carbon::parse($photo->updated_at)->diffForHumans() }}</div>
                                                                        @else
                                                                            <div class="text-warning">Declined - Again uploaded at {{ \Carbon\Carbon::parse($photo->updated_at)->diffForHumans() }}</div>
                                                                        @endif
                                                                    @else
                                                                        <div class="text-gray-400">Requirements</div>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-auto p-2">
                                                                    <a href="javascript:;" class="badge bg-danger p-2" data-bs-toggle="modal" data-bs-target="#addDocument" wire:click.prevent="typeDocument('photo')">Upload</a>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                                <div class="symbol symbol-30px me-5">
                                                                    <img alt="Icon" src="{{asset('assets/backend/media/svg/files/pdf.svg')}}" />
                                                                </div>
                                                                <div class="fw-semibold">
                                                                    @php $transcript = $item->form->documents->where('document_type','transcript')->first(); @endphp
                                                                    <a class="fs-6 fw-bold text-dark text-hover-primary" href="{{ asset($transcript?->file ?? '#') }}" target="_blank">Transcript (High School Or Higher) *</a>
                                                                    @if ($transcript)
                                                                        @if ($transcript->status == "verified")
                                                                            <div class="text-success"><Var></Var>Verified {{ \Carbon\Carbon::parse($transcript->updated_at)->diffForHumans() }}</div>
                                                                        @elseif ($transcript?->status == "uploaded")
                                                                            <div class="text-warning">Uploaded {{ \Carbon\Carbon::parse($transcript->updated_at)->diffForHumans() }}</div>
                                                                        @else
                                                                            <div class="text-warning">Declined - Again uploaded at {{ \Carbon\Carbon::parse($transcript->updated_at)->diffForHumans() }}</div>
                                                                        @endif
                                                                    @else
                                                                        <div class="text-gray-400">Requirements</div>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-auto p-2">
                                                                    <a href="javascript:;" class="badge bg-danger p-2" data-bs-toggle="modal" data-bs-target="#addDocument" wire:click.prevent="typeDocument('transcript')">Upload</a>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                                <div class="symbol symbol-30px me-5">
                                                                    <img alt="Icon" src="{{asset('assets/backend/media/svg/files/pdf.svg')}}" />
                                                                </div>
                                                                <div class="fw-semibold">
                                                                    @php $graduation = $item->form->documents->where('document_type','graduation')->first(); @endphp
                                                                    <a class="fs-6 fw-bold text-dark text-hover-primary" href="{{ asset($graduation?->file ?? '#') }}" target="_blank">Graduation Certificate (High School Or Higher)  *</a>
                                                                    @if ($graduation)
                                                                        @if ($graduation->status == "verified")
                                                                            <div class="text-success"><Var></Var>Verified {{ \Carbon\Carbon::parse($graduation->updated_at)->diffForHumans() }}</div>
                                                                        @elseif ($graduation?->status == "uploaded")
                                                                            <div class="text-warning">Uploaded {{ \Carbon\Carbon::parse($graduation->updated_at)->diffForHumans() }}</div>
                                                                        @else
                                                                            <div class="text-warning">Declined - Again uploaded at {{ \Carbon\Carbon::parse($graduation->updated_at)->diffForHumans() }}</div>
                                                                        @endif
                                                                    @else
                                                                        <div class="text-gray-400">Requirements</div>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-auto p-2">
                                                                    <a href="javascript:;" class="badge bg-danger p-2" data-bs-toggle="modal" data-bs-target="#addDocument" wire:click.prevent="typeDocument('graduation')">Upload</a>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                                <div class="symbol symbol-30px me-5">
                                                                    <img alt="Icon" src="{{asset('assets/backend/media/svg/files/pdf.svg')}}" />
                                                                </div>
                                                                <div class="fw-semibold">
                                                                    @php $medical = $item->form->documents->where('document_type','medical')->first(); @endphp
                                                                    <a class="fs-6 fw-bold text-dark text-hover-primary" href="{{ asset($medical?->file ?? '#') }}" target="_blank">Medical *</a>
                                                                    @if ($medical)
                                                                        @if ($medical->status == "verified")
                                                                            <div class="text-success"><Var></Var>Verified {{ \Carbon\Carbon::parse($medical->updated_at)->diffForHumans() }}</div>
                                                                        @elseif ($medical?->status == "uploaded")
                                                                            <div class="text-warning">Uploaded {{ \Carbon\Carbon::parse($medical->updated_at)->diffForHumans() }}</div>
                                                                        @else
                                                                            <div class="text-warning">Declined - Again uploaded at {{ \Carbon\Carbon::parse($medical->updated_at)->diffForHumans() }}</div>
                                                                        @endif
                                                                    @else
                                                                        <div class="text-gray-400">Requirements</div>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-auto p-2">
                                                                    <a href="javascript:;" class="badge bg-danger p-2" data-bs-toggle="modal" data-bs-target="#addDocument" wire:click.prevent="typeDocument('medical')">Upload</a>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                                <div class="symbol symbol-30px me-5">
                                                                    <img alt="Icon" src="{{asset('assets/backend/media/svg/files/pdf.svg')}}" />
                                                                </div>
                                                                <div class="fw-semibold">
                                                                    @php $police_clearance = $item->form->documents->where('document_type','police_clearance')->first(); @endphp
                                                                    <a class="fs-6 fw-bold text-dark text-hover-primary" href="{{ asset($police_clearance?->file ?? '#') }}" target="_blank">Police Clearance *</a>
                                                                    @if ($police_clearance)
                                                                        @if ($police_clearance->status == "verified")
                                                                            <div class="text-success"><Var></Var>Verified {{ \Carbon\Carbon::parse($police_clearance->updated_at)->diffForHumans() }}</div>
                                                                        @elseif ($police_clearance?->status == "uploaded")
                                                                            <div class="text-warning">Uploaded {{ \Carbon\Carbon::parse($police_clearance->updated_at)->diffForHumans() }}</div>
                                                                        @else
                                                                            <div class="text-warning">Declined - Again uploaded at {{ \Carbon\Carbon::parse($police_clearance->updated_at)->diffForHumans() }}</div>
                                                                        @endif
                                                                    @else
                                                                        <div class="text-gray-400">Requirements</div>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-auto p-2">
                                                                    <a href="javascript:;" class="badge bg-danger p-2" data-bs-toggle="modal" data-bs-target="#addDocument" wire:click.prevent="typeDocument('police_clearance')">Upload</a>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                                <div class="symbol symbol-30px me-5">
                                                                    <img alt="Icon" src="{{asset('assets/backend/media/svg/files/pdf.svg')}}" />
                                                                </div>
                                                                <div class="fw-semibold">
                                                                    @php $bank_statement = $item->form->documents->where('document_type','bank_statement')->first(); @endphp
                                                                    <a class="fs-6 fw-bold text-dark text-hover-primary" href="{{ asset($bank_statement?->file ?? '#') }}" target="_blank">Bank Statements (Minimum $400 For Visa) *</a>
                                                                    @if ($bank_statement)
                                                                        @if ($bank_statement->status == "verified")
                                                                            <div class="text-success"><Var></Var>Verified {{ \Carbon\Carbon::parse($bank_statement->updated_at)->diffForHumans() }}</div>
                                                                        @elseif ($bank_statement?->status == "uploaded")
                                                                            <div class="text-warning">Uploaded {{ \Carbon\Carbon::parse($bank_statement->updated_at)->diffForHumans() }}</div>
                                                                        @else
                                                                            <div class="text-warning">Declined - Again uploaded at {{ \Carbon\Carbon::parse($bank_statement->updated_at)->diffForHumans() }}</div>
                                                                        @endif
                                                                    @else
                                                                        <div class="text-gray-400">Requirements</div>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-auto p-2">
                                                                    <a href="javascript:;" class="badge bg-danger p-2" data-bs-toggle="modal" data-bs-target="#addDocument" wire:click.prevent="typeDocument('bank_statement')">Upload</a>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                                <div class="symbol symbol-30px me-5">
                                                                    <img alt="Icon" src="{{asset('assets/backend/media/svg/files/pdf.svg')}}" />
                                                                </div>
                                                                <div class="fw-semibold">
                                                                    @php $property_asset = $item->form->documents->where('document_type','property_asset')->first(); @endphp
                                                                    <a class="fs-6 fw-bold text-dark text-hover-primary" href="{{ asset($property_asset?->file ?? '#') }}" target="_blank">Property Assets (Optional)</a>
                                                                    @if ($property_asset)
                                                                        @if ($property_asset->status == "verified")
                                                                            <div class="text-success"><Var></Var>Verified {{ \Carbon\Carbon::parse($property_asset->updated_at)->diffForHumans() }}</div>
                                                                        @elseif ($property_asset?->status == "uploaded")
                                                                            <div class="text-warning">Uploaded {{ \Carbon\Carbon::parse($property_asset->updated_at)->diffForHumans() }}</div>
                                                                        @else
                                                                            <div class="text-warning">Declined - Again uploaded at {{ \Carbon\Carbon::parse($property_asset->updated_at)->diffForHumans() }}</div>
                                                                        @endif
                                                                    @else
                                                                        <div class="text-gray-400">Requirements</div>
                                                                    @endif
                                                                </div>
                                                                <div class="ms-auto p-2">
                                                                    <a href="javascript:;" class="badge bg-danger p-2" data-bs-toggle="modal" data-bs-target="#addDocument" wire:click.prevent="typeDocument('property_asset')">Upload</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @elseif($item->stage->type == "flight")
                                                <div class="timeline-item">
                                                    <div class="timeline-icon">
                                                        <i class="bi bi-airplane text-primary"></i>
                                                    </div>

                                                    <div class="timeline-content">
                                                        <h6 class="fw-bold"> Flight Details</h6>
                                                        <small class="text-muted"> Added at 4:23 PM</small>
                                                        <div class="table-responsive mt-3">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th>Airline</th>
                                                                    <th>Departure</th>
                                                                    <th>Transit</th>
                                                                    <th>Arrival</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{$item->form->flight?->airline}} <br><small>{{$item->form->flight?->flight_number}}</small></td>
                                                                    <td> @if($item->form->flight?->departure_time){{ \Carbon\Carbon::parse($item->form->flight?->departure_time)->format('M d Y - h:i A') }} @endif
                                                                    <br> {{$item->form->flight?->departure_city ?? ''}} </td>
                                                                    <td> @if($item->form->flight?->transit_time){{ \Carbon\Carbon::parse($item->form->flight?->transit_time)->format('M d Y - h:i A') }} @endif
                                                                    <br> {{$item->form->flight?->transit_city ?? ''}} </td>
                                                                    <td>@if($item->form->flight?->arrival_time){{ \Carbon\Carbon::parse($item->form->flight?->arrival_time)->format('M d Y - h:i A') }} @endif
                                                                    <br> {{$item->form->flight?->arrival_city ?? ''}}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($item->stage->type == "mission")
                                                <div class="timeline-item">
                                                    <div class="timeline-icon">
                                                    <i class="bi bi-check-circle text-success"></i>
                                                    </div>
                                                    <div class="timeline-content">
                                                    <h6 class="fw-bold">
                                                    Mission Accomplished
                                                    </h6>
                                                    <small class="text-muted">
                                                    Received by China Agent
                                                    </small>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="timeline-item">
                                                    <div class="timeline-icon"> {!! $item->stage->icon !!}</div>
                                                    <div class="timeline-content">
                                                        <h6 class="fw-bold">{{$item->stage->name}}</h6>
                                                        <small class="text-muted"> Added at {{ \Carbon\Carbon::parse($item->created_at)->format('M d Y - h:i A') }}</small>
                                                        <div class="border rounded p-3 mt-3 d-flex justify-content-between align-items-center">
                                                            <a href="#" class="text-muted">{{$item->title}}</a>
                                                            @if ($item->status == 'pending')
                                                                <span class="badge bg-primary">{{ ucfirst($item->status) }}</span>
                                                            @elseif ($item->status == 'processing')
                                                                <span class="badge bg-warning">{{ ucfirst($item->status) }}</span>
                                                            @elseif ($item->status == 'completed')
                                                                <span class="badge bg-success">{{ ucfirst($item->status) }}</span>
                                                            @else
                                                                <span class="badge bg-danger">{{ ucfirst($item->status) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="card-header border-0 bg-transparent text-center">
                                    <h5 class="mb-0">No Records Found</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::DocumentModals-->
            <div wire:ignore.self class="modal fade" id="addDocument" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <form class="form" wire:submit.prevent="storeDocument">
                            <div class="modal-header border-0">
                                <h2 class="fw-bold">Upload files</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pt-10 pb-15 px-lg-17">
                                <div class="form-group text-center">
                                    <div wire:ignore class="dropzone" id="document_dropzone"></div>
                                    @if ($file)
                                        <div class="mt-3">
                                            Uploaded File: {{ $file->getClientOriginalName() }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="modal-footer flex-end border-0">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::DocumentModals-->

        </div>
    </div>
</section>


@push('styles')
    <style>
        .modal {
            z-index: 0 !important;
        }
        .modal-backdrop {
            z-index: 0 !important;
    }
    </style>
    <style>
        .profile {
            display: inline-block;
            flex-shrink: 0;
            position: relative;
            border-radius: .475rem;
            position: relative !important;
        }
        .profile img{
            width: 160px;
            height: 160px;
            max-width: none;
        }
        .timeline {
            position: relative;
            padding-left: 4px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 18px;
            top: 0;
            bottom: 17px;
            width: 3px;
            background: #e9ecef;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }
        .timeline-icon {
            position: absolute;
            left: -2px;
            top: 0;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .timeline-content {
            padding-left: 48px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"/>
@endpush

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            Dropzone.autoDiscover = false; // Disable auto-discover

            let myDropzone; // Save Dropzone instance

            const modal = document.getElementById('addDocument');

            // Initialize Dropzone when modal opens
            modal.addEventListener('shown.bs.modal', function () {

                if (myDropzone) return; // Prevent multiple instances

                myDropzone = new Dropzone("#document_dropzone", {
                    url: "#",               // Livewire handles upload
                    clickable: true,
                    maxFiles: 1,
                    maxFilesize: 2,         // MB
                    autoProcessQueue: false,
                    addRemoveLinks: true,

                    init: function() {

                        this.on("addedfile", function(file) {

                            // Remove previous file if exists
                            if (this.files.length > 1) {
                                this.removeFile(this.files[0]);
                            }

                            // Livewire upload
                            @this.upload('file', file,
                                (success) => { console.log("Upload success"); },
                                (error)   => { console.log("Upload error"); },
                                (progress)=> { console.log(progress.detail.progress); }
                            );

                        });
                        // Handle remove file button
                        this.on("removedfile", function(file){
                            // Reset Livewire variable when user clicks remove
                            @this.set('file', null);
                        });
                    }

                });

            });

            // Reset Dropzone when modal closes
            modal.addEventListener('hidden.bs.modal', function () {
                if (myDropzone) {
                    myDropzone.removeAllFiles(true); // Remove previews
                    myDropzone.destroy();            // Destroy instance
                    myDropzone = null;               // Ready for next open
                }
                // Reset Livewire variable so uploaded file name disappears
                this.set('file', null);
            });

        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
@endpush