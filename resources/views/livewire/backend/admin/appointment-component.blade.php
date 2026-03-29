@section('page-title') Appointments @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Appointments</li>
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" datatable-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search" />
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addAppointment">Add Appointment</button>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Agent</th>
                        <th class="min-w-125px">Date &Time</th>
                        <th class="min-w-125px">Service</th>
                        <th class="min-w-125px">Type</th>
                        <th class="min-w-125px">Status</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="d-flex align-items-center border-0">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="{{route('admin.client.overview', $item->client->id)}}" target="_blank">
                                    @if($item->client->user->avatar)
                                        <div class="symbol-label">
                                            <img src="{{asset($item->client->user->avatar)}}" alt="{{$item->client->user->name}}" class="w-100" />
                                        </div>
                                    @else
                                        <div class="symbol-label fs-3 bg-light-danger text-danger"> {{substr($item->client->user->name,0,1)}} </div>
                                    @endif
                                </a>
                                @if($item->client->user->isOnline())
                                    <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                @else
                                    <div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                @endif
                            </div>
                            <div class="d-flex flex-column">
                                <div>
                                    <a href="{{route('admin.client.overview', $item->client->id)}}" target="_blank" class="text-gray-800 text-hover-primary mb-1">{{$item->client->user->name}}</a>
                                </div>
                                <div>{{$item->client->user->email}}</div>
                                <div>{{$item->client->user->phone}}</div>
                            </div>
                        </td>
                        <td>{{$item->agent?->user->name ?? 'N/L'}}</td>
                        <td>{{$item->appointment_date}} <br> {{$item->appointment_time}}</td>
                        <td>{{$item->service}}</td>
                        <td>{{$item->type}}</td>
                        <td>
                            @if($item->status == 'completed')
                                <span class="badge badge-light-success">Completed</span>
                            @elseif($item->status == 'cancelled')
                                <span class="badge badge-light-warning">Cancelled</span>
                            @else
                                <span class="badge badge-light-info">{{$item->status}}</span>
                            @endif
                        </td>
 
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <div class="menu-item px-3">
                                    <a href="javascript:;" wire:click="edit({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#editModal" class="menu-link px-3">Edit</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:;"  wire:click="deleteConfirmation({{ $item->id }})" class="menu-link px-3">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!--begin::Modals-->
    <div wire:ignore.self class="modal fade" id="addAppointment" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <form wire:submit.prevent="store" class="form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Appointment</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Client</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" data-live-search="true" title="Select a client"  wire:model="client_id">
                                    <option value="">Select Client...</option>
                                    @foreach ($clients as $item)
                                        <option value="{{$item->id}}">{{$item->user->name}}</option>
                                    @endforeach
                                </select>
                                @error('client_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Date</label>
                                <input type="date" wire:model="appointment_date" name="appointment_date" class="form-control form-control-solid"/>
                                @error('appointment_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Time</label>
                                <input type="time" wire:model="appointment_time" name="appointment_time" class="form-control form-control-solid"/>
                                @error('appointment_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Agent</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" data-live-search="true" title="Select a client" wire:model="agent_id">
                                    <option value="">Select Agent...</option>
                                    @foreach ($agents as $item)
                                        <option value="{{$item->id}}">{{$item->user->name}}</option>
                                    @endforeach
                                </select>
                                @error('agent_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Type</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" title="Select a type" wire:model="type">
                                    <option value="">Select Type...</option>
                                    <option value="office">Office</option>
                                    <option value="online">Online</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Service</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" title="Select a service"  wire:model="service">
                                    <option value="">Select Service...</option>
                                    <option value="Education">Education</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Business">Business</option>
                                    <option value="Travel">Travel</option>
                                </select>
                                @error('service') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Notes</label>
                                <textarea wire:model="notes" class="form-control"></textarea>
                                @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
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
     <!--end::Modals-->
    <!--begin::Modals-->
    <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <form wire:submit.prevent="update" class="form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Edit Appointment</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Client</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" data-live-search="true" title="Select a client" wire:model="client_id">
                                    <option value="">Select Client...</option>
                                    @foreach ($clients as $item)
                                        <option value="{{$item->id}}">{{$item->user->name}}</option>
                                    @endforeach
                                </select>
                                @error('client_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Date</label>
                                <input type="date" wire:model="appointment_date" class="form-control form-control-solid"/>
                                @error('appointment_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Time</label>
                                <input type="time" wire:model="appointment_time" class="form-control form-control-solid"/>
                                @error('appointment_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Agent</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" data-live-search="true" title="Select a client" wire:model="agent_id">
                                    <option value="">Select Agent...</option>
                                    @foreach ($agents as $item)
                                        <option value="{{$item->id}}">{{$item->user->name}}</option>
                                    @endforeach
                                </select>
                                @error('agent_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Type</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" title="Select a type" wire:model="type">
                                    <option value="">Select Type...</option>
                                    <option value="office">Office</option>
                                    <option value="online">Online</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Service</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" title="Select a service"  wire:model="service">
                                    <option value="">Select Service...</option>
                                    <option value="Education">Education</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Business">Business</option>
                                    <option value="Travel">Travel</option>
                                </select>
                                @error('service') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Notes</label>
                                <textarea wire:model="notes" class="form-control"></textarea>
                                @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-end">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <!--end::Modals-->
</div>

@push('scripts')
    <script>
        "use strict";
        var KTDatatable = function () {
            // Define shared variables
            var table = document.getElementById('datatable');
            var datatable;
            // Private functions
            var initDataTable = function () {
                datatable = $(table).DataTable({
                    "responsive": true,
                    "info": true,
                    'order': [],
                    "pageLength": 10,
                    "lengthChange": false,
                    'columnDefs': [
                    { orderable: false, targets: 0 },
                    { orderable: false, targets: 7 },
                    ],
                    'dom': `<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                    'language': {
                        paginate: {
                            previous: '<',
                            next: '>'
                        },
                    }
                });
            }

            // Search Datatable
            var handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[datatable-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    datatable.search(e.target.value).draw();
                });
            }

            return {
                // Public functions
                init: function () {
                    if (!table) {
                        return;
                    }
                    initDataTable();
                    handleSearchDatatable();
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatable.init();
        });
    </script>
@endpush

