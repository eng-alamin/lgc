@section('page-title') Follow Up @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted"> Follow Up</li>
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card mb-2">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    Today’s Tasks
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Form Number</th>
                        <th class="min-w-125px">Date</th>
                        <th class="min-w-125px">Priority</th>
                        <th class="min-w-125px">Assign</th>
                        <th class="min-w-125px">Status</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($todayTasks as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="d-flex align-items-center border-0">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="#">
                                    @if($item->form?->client?->user->avatar)
                                        <div class="symbol-label">
                                            <img src="{{asset($item->form?->client?->user->avatar)}}" alt="{{$item->form?->client?->user->name}}" class="w-100" />
                                        </div>
                                    @elseif($item->form?->client?->user->name)
                                        <div class="symbol-label fs-3 bg-light-danger text-danger"> {{substr($item->form?->client?->user->name,0,1)}} </div>
                                    @else
                                        <div class="symbol-label fs-3 bg-light-secondary text-muted">N</div>
                                    @endif
                                </a>
                            </div>
                            <div class="d-flex flex-column">
                                <div><a href="{{route('admin.client.overview', $item->id)}}" target="_blank" class="text-gray-800 text-hover-primary mb-1">{{$item->form?->client?->user->name}}</a></div>
                                <div>{{$item->form?->client?->user->email ?? 'N/L'}}</div>
                                <div>{{$item->form?->client?->user->phone ?? 'N/L'}}</div>
                            </div>
                        </td>
                        <td>{{$item->form->number}}</td>
                        <td>{{$item->follow_up_date}}</td>
                        <td>{{$item->priority}}</td>
                        <td>{{$item->assign->name}}</td>
                        <td>
                            @if($item->status=='pending')
                                <button wire:click="markDone({{ $item->id }})" class="btn btn-sm btn-success">Mark Done</button>
                            @else
                                <span class="badge badge-light-success">Done</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                     <p>No tasks for today.</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    Overdue Tasks
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Form Number</th>
                        <th class="min-w-125px">Date</th>
                        <th class="min-w-125px">Priority</th>
                        <th class="min-w-125px">Assign</th>
                        <th class="min-w-125px">Status</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($overdueTasks as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="d-flex align-items-center border-0">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="#">
                                    @if($item->form?->client?->user->avatar)
                                        <div class="symbol-label">
                                            <img src="{{asset($item->form?->client?->user->avatar)}}" alt="{{$item->form?->client?->user->name}}" class="w-100" />
                                        </div>
                                    @elseif($item->form?->client?->user->name)
                                        <div class="symbol-label fs-3 bg-light-danger text-danger"> {{substr($item->form?->client?->user->name,0,1)}} </div>
                                    @else
                                        <div class="symbol-label fs-3 bg-light-secondary text-muted">N</div>
                                    @endif
                                </a>
                            </div>
                            <div class="d-flex flex-column">
                                <div><a href="{{route('admin.client.overview', $item->id)}}" target="_blank" class="text-gray-800 text-hover-primary mb-1">{{$item->form?->client?->user->name}}</a></div>
                                <div>{{$item->form?->client?->user->email ?? 'N/L'}}</div>
                                <div>{{$item->form?->client?->user->phone ?? 'N/L'}}</div>
                            </div>
                        </td>
                        <td>{{$item->form->number}}</td>
                        <td>{{$item->follow_up_date}}</td>
                        <td>{{$item->priority}}</td>
                        <td>{{$item->assign->name}}</td>
                        <td>
                            @if($item->status=='pending')
                                <button wire:click="markDone({{ $item->id }})" class="btn btn-sm btn-success">Mark Done</button>
                            @else
                                <span class="badge badge-light-success">Done</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                     <p>No Overdue Tasks.</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Form Number</th>
                        <th class="min-w-125px">Date</th>
                        <th class="min-w-125px">Priority</th>
                        <th class="min-w-125px">Status</th>
                        <th class="min-w-125px">Assign</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($followUps as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="d-flex align-items-center border-0">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="#">
                                    @if($item->form?->client?->user->avatar)
                                        <div class="symbol-label">
                                            <img src="{{asset($item->form?->client?->user->avatar)}}" alt="{{$item->form?->client?->user->name}}" class="w-100" />
                                        </div>
                                    @elseif($item->form?->client?->user->name)
                                        <div class="symbol-label fs-3 bg-light-danger text-danger"> {{substr($item->form?->client?->user->name,0,1)}} </div>
                                    @else
                                        <div class="symbol-label fs-3 bg-light-secondary text-muted">N</div>
                                    @endif
                                </a>
                            </div>
                            <div class="d-flex flex-column">
                                <div><a href="{{route('admin.client.overview', $item->id)}}" target="_blank" class="text-gray-800 text-hover-primary mb-1">{{$item->form?->client?->user->name}}</a></div>
                                <div>{{$item->form?->client?->user->email ?? 'N/L'}}</div>
                                <div>{{$item->form?->client?->user->phone ?? 'N/L'}}</div>
                            </div>
                        </td>
                        <td>{{$item->form->number}}</td>
                        <td>{{$item->follow_up_date}}</td>
                        <td>{{$item->priority}}</td>
                        <td>
                            @if($item->status == 'pending')
                                <span class="badge badge-light-warning">Pending</span>
                            @else
                                <span class="badge badge-light-success">Done</span>
                            @endif
                        </td>
                        
                        <td>{{$item->assign->name}}</td>
 
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
    <div wire:ignore.self class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form class="form" role="form" wire:submit.prevent="store">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Task</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Select Apllication</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" wire:model="form_id" data-live-search="true" title="Select a form">
                                    <option value="">Select Apllication...</option>
                                    @foreach ($forms as $item)
                                        <option value="{{$item->id}}">{{$item->number}}</option>
                                    @endforeach
                                </select>
                                @error('form_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Select Assign</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" wire:model="assign_id" data-live-search="true" title="Select a assign">
                                    <option value="">Select Assign...</option>
                                    @foreach ($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('assign_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Follow-up Date</label>
                                <input type="date" wire:model="follow_up_date" class="form-control form-control-solid"/>
                                @error('follow_up_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Priority</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" wire:model="priority" title="Select Priority">
                                    <option value="">Select Priority...</option>
                                    <option value="normal">Normal</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                                @error('priority') <span class="text-danger">{{ $message }}</span> @enderror
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
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form wire:submit.prevent="update" class="form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Edit Task</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                       <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Select Apllication</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" wire:model="form_id" data-live-search="true" title="Select a form">
                                    <option value="">Select Apllication...</option>
                                    @foreach ($forms as $item)
                                        <option value="{{$item->id}}">{{$item->number}}</option>
                                    @endforeach
                                </select>
                                @error('form_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Select Assign</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" wire:model="assign_id" data-live-search="true" title="Select a assign">
                                    <option value="">Select Assign...</option>
                                    @foreach ($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('assign_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Follow-up Date</label>
                                <input type="date" wire:model="follow_up_date" class="form-control form-control-solid"/>
                                @error('follow_up_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Priority</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" wire:model="priority" title="Select Priority">
                                    <option value="">Select Priority...</option>
                                    <option value="normal">Normal</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                                @error('priority') <span class="text-danger">{{ $message }}</span> @enderror
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
                    { orderable: false, targets: 6 },
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