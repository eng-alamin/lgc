<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row g-5 g-xl-8">

        @include('livewire.backend.admin.client.navbar')

        <div class="col-lg-12">
            <div class="card">		
                @if($timeline)	
                    <div class="card-header card-header-stretch">
                        <div class="card-title d-flex align-items-center">
                            <i class="ki-duotone ki-calendar-8 fs-1 text-primary me-3 lh-0">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                                <span class="path6"></span>
                            </i>
                            <h3 class="fw-bold m-0 text-gray-800">Progress Compleation<br>
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <div class="text-muted me-2 fs-7">{{ \Carbon\Carbon::parse($this->form?->created_at)->format('M d Y - h:i A') }}</div>
                                </div>    
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex align-items-center justify-content-end">
                                <a href="javascript:;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addStage">Add Stage</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-body p-0 tab-pane fade show active">
                            <div class="timeline">
                                @foreach($timeline as $item)
                                    <div class="timeline-item">
                                        <div class="timeline-line w-40px"></div>
                                        <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                            <div class="symbol-label bg-light">{!! $item->stage->icon !!}</div>
                                        </div>
                                        @if($item->stage->type == "lead")
                                            <div class="timeline-content mb-10 mt-n1">
                                                <div class="pe-3 mb-5">
                                                    <div class="fs-5 fw-semibold mb-2">{{$item->stage->name}}</div>
                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                        @if($item->form?->agent)
                                                            @if($item->form?->counselor->user->avatar)
                                                                <div class="text-muted me-2 fs-7">Added at {{ \Carbon\Carbon::parse($item->created_at)->format('M d Y - h:i A') }} by </div>
                                                                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="{{$item->form?->agent->user->name}}">
                                                                    <img src="{{asset($item->form?->agent->avatar)}}" alt="{{$item->form?->agent->name}}" />
                                                                </div>
                                                            @else
                                                                <div class="text-muted me-2 fs-7">Added at {{ \Carbon\Carbon::parse($item->created_at)->format('M d Y - h:i A') }} by </div>
                                                                <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="{{$item->form?->agent->user->name}}">
                                                                    <img src="{{asset('assets\backend\media\avatars\blank.png')}}" alt="img" />
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="text-muted me-2 fs-7">Added at {{ \Carbon\Carbon::parse($item->created_at)->format('M d Y - h:i A') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="overflow-auto pb-5">
                                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                        <a href="javascript:;" class="fs-5 text-dark text-hover-primary fw-semibold w-375px min-w-200px">{{ $item->title }}</a>
                                                        
                                                        <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2">
                                                            <div class=" symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="{{$item->form?->counselor->user->name}}">
                                                                @if($item->form?->counselor->user->avatar)
                                                                    <img src="{{asset($item->form?->counselor->user->avatar)}}" alt="{{$item->form?->counselor->user->name}}" />
                                                                @else
                                                                    <img src="{{asset('assets\backend\media\avatars\blank.png')}}" alt="img" />
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="min-w-125px pe-2">
                                                            @if ($item->status == 'pending')
                                                                <a href="javascript:;" class="btn btn-sm btn-light-warning btn-flex btn-center btn-active-light-warning dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                                            @elseif ($item->status == 'processing')
                                                                <a href="javascript:;" class="btn btn-sm btn-light-primary btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                                            @elseif ($item->status == 'completed')
                                                                <a href="javascript:;" class="btn btn-sm btn-light-success btn-flex btn-center btn-active-light-success dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                                            @else
                                                                <a href="javascript:;" class="btn btn-sm btn-light-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                                            @endif
                                                            
                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <div class="menu-item px-3">
                                                                    <a href="javascript:;" class="menu-link px-3" wire:click="statusClick({{$item->id}}, 'pending')">Pending</a>
                                                                    <a href="javascript:;" class="menu-link px-3" wire:click="statusClick({{$item->id}}, 'processing')">Processing</a>
                                                                    <a href="javascript:;" class="menu-link px-3" wire:click="statusClick({{$item->id}}, 'completed')">Completed</a>
                                                                    <a href="javascript:;" class="menu-link px-3" wire:click="statusClick({{$item->id}}, 'declined')">Declined</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        @elseif($item->stage->type == "invoice")
                                            <div class="timeline-content mb-10 mt-n1">
                                                <div class="pe-3 mb-5 d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <div class="fs-5 fw-semibold mb-2">{{$item->stage->name}}</div>
                                                        <div class="d-flex align-items-center mt-1 fs-6">
                                                            <div class="text-muted me-2 fs-7">Added at {{ \Carbon\Carbon::parse($item->created_at)->format('M d Y - h:i A') }}</div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addInvoice">Add Invoice</a>
                                                    </div>
                                                </div>
                                                <div class="overflow-auto pb-5">
                                                    @foreach ($item->form->invoices as $inv)
                                                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                            <a href="javascript:;" class="fs-5 text-dark text-hover-primary fw-semibold w-375px min-w-200px"  data-bs-toggle="modal" data-bs-target="#viewInvoice" wire:click="viewInvoice({{ $inv->id }})">{{ $inv->number }}</a>
                                                            
                                                            <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2">
                                                                <div class="symbol symbol-circle symbol-25px"></div>
                                                            </div>

                                                            <div class="min-w-125px pe-2">
                                                                @if ($inv->payment_status == 'paid')
                                                                    <span class="badge badge-light-success">{{ucfirst(str_replace('_', ' ', $inv->payment_status))}}</span>
                                                                @elseif ($inv->payment_status == 'partial')
                                                                    <span class="badge badge-light-primary">{{ucfirst(str_replace('_', ' ', $inv->payment_status))}}</span>
                                                                @else
                                                                    <span class="badge badge-light-danger">{{ucfirst(str_replace('_', ' ', $inv->payment_status))}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @elseif($item->stage->type == "documentation")
                                            <div class="timeline-content mb-10 mt-n1">
                                                <div class="mb-5 pe-3">
                                                    <a href="javascript:;" class="fs-5 fw-semibold text-gray-800 text-hover-primary mb-2">Documentation</a>
                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                        <div class="text-muted me-2 fs-7">Added at {{ \Carbon\Carbon::parse($item->created_at)->format('M d Y - h:i A') }}</div>
                                                    </div>
                                                </div>
                                                <div class="overflow-auto pb-5">
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
                                                            <div class="ms-auto">
                                                                @if ($passport?->status == "uploaded")
                                                                    <a href="javascript:;" class="badge badge-light-primary ms-auto" wire:click="declinedDocument({{$passport->id}})">Declined</a>
                                                                    <a href="javascript:;" class="badge badge-light-primary ms-auto" wire:click="verifiedDocument({{$passport->id}})">Verified</a>
                                                                @endif
                                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"  data-bs-toggle="modal" data-bs-target="#addDocument" wire:click="typeDocument('passport')">
                                                                    <i class="ki-duotone ki-element-plus fs-3">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                    </i>
                                                                </button>
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
                                                            <div class="ms-auto">
                                                                @if ($photo?->status == "uploaded")
                                                                    <a href="javascript:;" class="badge badge-light-danger ms-auto" wire:click="declinedDocument({{$photo->id}})">Declined</a>
                                                                    <a href="javascript:;" class="badge badge-light-primary ms-auto" wire:click="verifiedDocument({{$photo->id}})">Verified</a>
                                                                @endif
                                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"  data-bs-toggle="modal" data-bs-target="#addDocument"  wire:click="typeDocument('photo')">
                                                                    <i class="ki-duotone ki-element-plus fs-3">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                    </i>
                                                                </button>
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
                                                            <div class="ms-auto">
                                                                @if ($transcript?->status == "uploaded")
                                                                    <a href="javascript:;" class="badge badge-light-danger ms-auto" wire:click="declinedDocument({{$transcript->id}})">Declined</a>
                                                                    <a href="javascript:;" class="badge badge-light-primary ms-auto" wire:click="verifiedDocument({{$transcript->id}})">Verified</a>
                                                                @endif
                                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"  data-bs-toggle="modal" data-bs-target="#addDocument"  wire:click="typeDocument('transcript')">
                                                                    <i class="ki-duotone ki-element-plus fs-3">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                    </i>
                                                                </button>
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
                                                            <div class="ms-auto">
                                                                @if ($graduation?->status == "uploaded")
                                                                    <a href="javascript:;" class="badge badge-light-danger ms-auto" wire:click="declinedDocument({{$graduation->id}})">Declined</a>
                                                                    <a href="javascript:;" class="badge badge-light-primary ms-auto" wire:click="verifiedDocument({{$graduation->id}})">Verified</a>
                                                                @endif
                                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"  data-bs-toggle="modal" data-bs-target="#addDocument" wire:click="typeDocument('graduation')">
                                                                    <i class="ki-duotone ki-element-plus fs-3">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                    </i>
                                                                </button>
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
                                                            <div class="ms-auto">
                                                                @if ($medical?->status == "uploaded")
                                                                    <a href="javascript:;" class="badge badge-light-danger ms-auto" wire:click="declinedDocument({{$medical->id}})">Declined</a>
                                                                    <a href="javascript:;" class="badge badge-light-primary ms-auto" wire:click="verifiedDocument({{$medical->id}})">Verified</a>
                                                                @endif
                                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"  data-bs-toggle="modal" data-bs-target="#addDocument" wire:click="typeDocument('medical')">
                                                                    <i class="ki-duotone ki-element-plus fs-3">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                    </i>
                                                                </button>
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
                                                            <div class="ms-auto">
                                                                @if ($police_clearance?->status == "uploaded")
                                                                    <a href="javascript:;" class="badge badge-light-danger ms-auto" wire:click="declinedDocument({{$police_clearance->id}})">Declined</a>
                                                                    <a href="javascript:;" class="badge badge-light-primary ms-auto" wire:click="verifiedDocument({{$police_clearance?->id}})">Verified</a>
                                                                @endif
                                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"  data-bs-toggle="modal" data-bs-target="#addDocument" wire:click="typeDocument('police_clearance')">
                                                                    <i class="ki-duotone ki-element-plus fs-3">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                    </i>
                                                                </button>
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
                                                            <div class="ms-auto">
                                                                @if ($bank_statement?->status == "uploaded")
                                                                    <a href="javascript:;" class="badge badge-light-danger ms-auto" wire:click="declinedDocument({{$bank_statement->id}})">Declined</a>
                                                                    <a href="javascript:;" class="badge badge-light-primary ms-auto" wire:click="verifiedDocument({{$bank_statement->id}})">Verified</a>
                                                                @endif
                                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"  data-bs-toggle="modal" data-bs-target="#addDocument" wire:click="typeDocument('bank_statement')">
                                                                    <i class="ki-duotone ki-element-plus fs-3">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                    </i>
                                                                </button>
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
                                                            <div class="ms-auto">
                                                                @if ($property_asset?->status == "uploaded")
                                                                    <a href="javascript:;" class="badge badge-light-danger ms-auto" wire:click="declinedDocument({{$property_asset->id}})">Declined</a>
                                                                    <a href="javascript:;" class="badge badge-light-primary ms-auto" wire:click="verifiedDocument({{$property_asset?->id}})">Verified</a>
                                                                @endif
                                                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"  data-bs-toggle="modal" data-bs-target="#addDocument" wire:click="typeDocument('property_asset')">
                                                                    <i class="ki-duotone ki-element-plus fs-3">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                        <span class="path4"></span>
                                                                        <span class="path5"></span>
                                                                    </i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif ($item->stage->type == "flight")
                                            <div class="timeline-content mb-10 mt-n1">
                                                <div class="pe-3 mb-5 d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <div class="fs-5 fw-semibold mb-2">{{$item->stage->name}}</div>
                                                        <div class="d-flex align-items-center mt-1 fs-6">
                                                            <div class="text-muted me-2 fs-7">Added at {{ \Carbon\Carbon::parse($item->created_at)->format('M d Y - h:i A') }}</div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addFlight" wire:click="addFlight({{ $item->form->flight?->id ?? 'null' }})">Add Flight</a>
                                                    </div>
                                                </div>

                                                <table class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3">
                                                    <tbody>
                                                        <tr>
                                                            <td class="min-w-175px">
                                                                <div class="position-relative ps-6 pe-3 py-2">
                                                                    <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-info"></div>
                                                                    <a href="javascript:;" class="mb-1 text-dark text-hover-primary fw-bold">{{$item->form->flight?->airline}}</a>
                                                                    <div class="fs-7 text-muted fw-bold">Flight Number ( <a href="javascript:;" target="_blank" rel="noopener noreferrer">{{$item->form->flight?->flight_number}}</a> )</div>
                                                                </div>
                                                            </td>
                                                            <td class="min-w-150px">
                                                                <div class="mb-2 fw-bold">Departure</div>
                                                                <div class="fs-7 fw-bold text-muted">
                                                                    @if($item->form->flight?->departure_time){{ \Carbon\Carbon::parse($item->form->flight?->departure_time)->format('M d Y - h:i A') }} @endif
                                                                    <br> {{$item->form->flight?->departure_city ?? ''}}
                                                                </div>
                                                            </td>
                                                            <td class="min-w-150px">
                                                                <div class="mb-2 fw-bold">Transit</div>
                                                                <div class="fs-7 fw-bold text-muted">
                                                                    @if($item->form->flight?->transit_time){{ \Carbon\Carbon::parse($item->form->flight?->transit_time)->format('M d Y - h:i A') }} @endif
                                                                    <br> {{$item->form->flight?->transit_city ?? ''}}
                                                                </div>
                                                            </td>
                                                            <td class="min-w-150px">
                                                                <div class="mb-2 fw-bold">Arrival</div>
                                                                <div class="fs-7 fw-bold text-muted">
                                                                    @if($item->form->flight?->arrival_time){{ \Carbon\Carbon::parse($item->form->flight?->arrival_time)->format('M d Y - h:i A') }} @endif
                                                                    <br> {{$item->form->flight?->arrival_city ?? ''}}
                                                                </div>
                                                            </td>
                                                            <td class="d-none">Pending</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="timeline-content mb-10 mt-n1">
                                                <div class="pe-3 mb-5">
                                                    <div class="fs-5 fw-semibold mb-2">{{$item->stage->name}}</div>
                                                    <div class="d-flex align-items-center mt-1 fs-6">
                                                        <div class="text-muted me-2 fs-7">Added at {{ \Carbon\Carbon::parse($item->created_at)->format('M d Y - h:i A') }}</div>
                                                    </div>
                                                </div>
                                                <div class="overflow-auto pb-5">
                                                    
                                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                        @if ($item->stage->type == "invoice")
                                                            <a href="{{route('admin.application.view', $this->form?->id)}}" target="_blank"  class="fs-5 text-dark text-hover-primary fw-semibold w-375px min-w-200px">{{ $item->title }}</a>
                                                        @else
                                                            <a href="javascript:;" class="fs-5 text-dark text-hover-primary fw-semibold w-375px min-w-200px">{{ $item->title }}</a>
                                                        @endif

                                                        <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2">
                                                            {{-- <div class=" symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Consultant Name">
                                                                <img src="{{asset('assets/backend/media/avatars/300-2.jpg')}}" alt="img" />
                                                            </div> --}}
                                                        </div>

                                                        <div class="min-w-125px pe-2">
                                                            @if ($item->status == 'pending')
                                                                <a href="javascript:;" class="btn btn-sm btn-light-warning btn-flex btn-center btn-active-light-warning dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                                            @elseif ($item->status == 'processing')
                                                                <a href="javascript:;" class="btn btn-sm btn-light-primary btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                                            @elseif ($item->status == 'completed')
                                                                <a href="javascript:;" class="btn btn-sm btn-light-success btn-flex btn-center btn-active-light-success dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                                            @else
                                                                <a href="javascript:;" class="btn btn-sm btn-light-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                                            @endif
                                                            
                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <div class="menu-item px-3">
                                                                    <a href="javascript:;" class="menu-link px-3" wire:click="statusClick({{$item->id}}, 'pending')">Pending</a>
                                                                    <a href="javascript:;" class="menu-link px-3" wire:click="statusClick({{$item->id}}, 'processing')">Processing</a>
                                                                    <a href="javascript:;" class="menu-link px-3" wire:click="statusClick({{$item->id}}, 'completed')">Completed</a>
                                                                    <a href="javascript:;" class="menu-link px-3" wire:click="statusClick({{$item->id}}, 'declined')">Declined</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card-header justify-content-evenly card-header-stretch">
                        <div class="card-title d-flex align-items-center">
                            <h3 class="fw-bold m-0 text-gray-800">No Records Found </h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!--begin::Stage Modals-->
    <div wire:ignore.self class="modal fade" id="addStage" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <form wire:submit="addStage" class="form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Stage</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">

                            @php
                                $current = $this->timelineLast->last()?->stage->type ?? 'start';
                                $flow = config('status_flow.stage');
                                $allowed = $flow[$current] ?? [];
                            @endphp

                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Stage</label>
                                <select class="form-select p-0 w-100 border-0 selectpicker" title="Select a stage" wire:model.live="stage_id">
                                    <option value="">Select Stage...</option>
                                    @foreach ($stages as $item)
                                        <option value="{{$item->id}}" {{ !in_array($item->type, $allowed) ? 'disabled text-muted' : '' }}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('stage_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            @if ($this->stage_id == 1)
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Counselor</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" data-live-search="true" title="Select a Counselor" wire:model="counselor_id">
                                        <option value="">Select Counselor...</option>
                                        @foreach ($counselors as $item)
                                            <option value="{{$item->id}}">{{$item->user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('counselor_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Agent</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" data-live-search="true" title="Select a Agent" wire:model="agent_id">
                                        <option value="">Select Agent...</option>
                                        @foreach ($agents as $item)
                                            <option value="{{$item->id}}">{{$item->user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('agent_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif

                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Title</label>
                                <input type="text" wire:model="title" class="form-control form-control-solid" placeholder="Title" />
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Status</label>
                                <select class="form-select p-0 w-100 border-0 selectpicker" title="Select a status" wire:model="status">
                                    <option value="">Select Status...</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="completed">Completed</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-end">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Stage Modals-->

    <!--begin::AddInvoiceModals-->
    <div wire:ignore.self class="modal fade" id="addInvoice" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form wire:submit.prevent="storeInvoice" class="form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Invoice</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="row">
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Date</label>
                                    <input type="date" wire:model="date" class="form-control form-control-solid" disabled/>
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <div wire:ignore>
                                        <label class="required fs-6 fw-semibold mb-2">Select Method</label>
                                        <select class="form-select form-select-solid method" data-control="select2" data-hide-search="true" data-placeholder="Select Method" multiple wire:model="method">
                                            <option value="">Select Method...</option>
                                            <option value="cash">Cash</option>
                                            <option value="bank">Bank</option>
                                            <option value="mobile">Mobile</option>
                                        </select>
                                    </div>
                                    @error('method') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Items</label>
                                    <div class="table-responsive">
                                        @error('items.*') <span class="text-danger">{{ $message }}</span> @enderror
                                        <table class="table align-middle table-row-dashed fw-semibold fs-6 gy-5">
                                            <thead>
                                                <tr class="text-muted fw-bold fs-7 text-uppercase">
                                                    <th>Name</th>
                                                    <th>Total Amount</th>
                                                    <th>Advance Payment</th>
                                                    @if(count($items) > 1)
                                                        <th class="text-end">Remove</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $index => $education)
                                                    <tr>
                                                        <td>
                                                            <input type="text" wire:model="items.{{ $index }}.name" class="form-control form-control-solid">
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="items.{{ $index }}.total" class="form-control form-control-solid">
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="items.{{ $index }}.advance" class="form-control form-control-solid">
                                                        </td>
                                                        @if(count($items) > 1)
                                                            <td class="text-end">
                                                                <button type="button" wire:click="removeRow({{ $index }})" class="btn btn-sm btn-danger">Remove</button>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2 text-end">
                                        <button type="button" wire:click="addRow" class="btn btn-light-primary"> + Add More </button>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Notes</label>
                                    <textarea wire:model="notes" class="form-control"></textarea>
                                    @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-end">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <!--end::AddInvoiceModals-->
    <!--begin::ViewInvoiceModals-->
    <div wire:ignore.self class="modal fade" id="viewInvoice" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">View Invoice</h2>
                    <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="scroll-y me-n7 pe-7">
                        <div class="row">
                            <div class="col-md-4 mb-7">
                                <label class="fs-6 fw-semibold mb-2">Form Number :</label>
                                <div>{{ $this->invoice?->form?->number ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-4 mb-7">
                                <label class="fs-6 fw-semibold mb-2">Agent :</label>
                                <div>{{ $this->invoice?->form->agent->user->name ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-4 mb-7">
                                <label class="fs-6 fw-semibold mb-2">Invoice Number :</label>
                                <div>{{ $this->invoice?->number ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-4 mb-7">
                                <label class="fs-6 fw-semibold mb-2">Status :</label>
                                <div>{{ ucfirst($this->invoice?->payment_status) ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-4 mb-7">
                                <label class="fs-6 fw-semibold mb-2">Date :</label>
                                <div>{{ $this->invoice?->date ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-4 mb-7">
                                <label class="fs-6 fw-semibold mb-2">Method :</label>
                                <div> 
                                    @if(is_array($this->invoice?->method))
                                        {{ implode(', ', $this->invoice?->method) }}
                                    @elseif($this->invoice?->method)
                                        {{ $this->invoice?->method }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-7">
                                <label class="fs-6 fw-semibold mb-2">Items :</label>
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fw-semibold fs-6 gy-5">
                                        <thead>
                                            <tr class="text-muted fw-bold fs-7 text-uppercase">
                                                <th>Name</th>
                                                <th>Total Amount</th>
                                                <th>Advance Payment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($this->invoice?->items ?? [] as $education)
                                                <tr>
                                                    <td>{{ $education['name'] ?? '-' }}</td>
                                                    <td>৳ {{ number_format($education['total'] ?? 0, 2) }}</td>
                                                    <td>৳ {{ number_format($education['advance'] ?? 0, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">No items found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12 mb-7">
                                <label class="fs-6 fw-semibold mb-2">Notes :</label>
                                <div>{{$notes}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-end">
                    <a href="javascript:;" class="btn btn-sm btn-primary">Print</a>
                </div>
            </div>
        </div>
    </div>
     <!--end::ViewInvoiceModals-->

    <!--begin::DocumentModals-->
    <div wire:ignore.self class="modal fade" id="addDocument" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <form class="form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Upload files</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body pt-10 pb-15 px-lg-17">
                        <div class="form-group">
                            <div wire:ignore class="dropzone" id="document_dropzone"></div>
                            @if ($file)
                                <div class="mt-3">
                                    Uploaded File: {{ $file->getClientOriginalName() }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer flex-end">
                        <button wire:click="storeDocument" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::DocumentModals-->

    <!--begin::FlightModals-->
    <div wire:ignore.self class="modal fade" id="addFlight" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form wire:submit="storeFlight" class="form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Flight</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Airline</label>
                                <input type="text" wire:model="airline" class="form-control form-control-solid" placeholder="Enter airline" />
                                @error('airline') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Flight Number</label>
                                <input type="text" wire:model="flight_number" class="form-control form-control-solid" placeholder="Enter flight number" />
                                @error('flight_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Departure City</label>
                                <input type="text" wire:model="departure_city" class="form-control form-control-solid" placeholder="Enter departure city" />
                                @error('departure_city') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Departure Time</label>
                                <input type="datetime-local" wire:model="departure_time" class="form-control form-control-solid" placeholder="Enter departure time" />
                                @error('departure_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Transit City</label>
                                <input type="text" wire:model="transit_city" class="form-control form-control-solid" placeholder="Enter transit city" />
                                @error('transit_city') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Transit Time</label>
                                <input type="datetime-local" wire:model="transit_time" class="form-control form-control-solid" placeholder="Enter transit time" />
                                @error('transit_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">ArrivalV City</label>
                                <input type="text" wire:model="arrival_city" class="form-control form-control-solid" placeholder="Enter arrival city" />
                                @error('arrival_city') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Arrival Time</label>
                                <input type="datetime-local" wire:model="arrival_time" class="form-control form-control-solid" placeholder="Enter arrival time" />
                                @error('arrival_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-end">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <!--end::FlightModals-->

</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            $('.method').on('change', function () {
                @this.set('method', $(this).val());
            });
            $('.status').on('change', function () {
                @this.set('status', $(this).val());
            });
            Livewire.on('refreshSelect', () => {
                setTimeout(() => {
                    $('.status').val(@this.get('status')).trigger('change');
                    $('.method').val(@this.get('method')).trigger('change');
                }, 100);
            });
        });
    </script>
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
    <script>
        document.addEventListener('livewire:init', () => {
            // success toast
            Livewire.on('success', (event) => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: event.message,
                    showConfirmButton: false,
                    timer: 3000
                });
            });
            // modal close
            Livewire.on('closeModal', () => {
                document.querySelectorAll('.modal.show').forEach((modal) => {
                    bootstrap.Modal.getInstance(modal).hide();
                });
            });
            // Livewire.on('closeModal', () => {
            //     var modal = bootstrap.Modal.getInstance(document.getElementById('addDocument'));
            //     modal.hide();
            // });
        });
    </script>
@endpush