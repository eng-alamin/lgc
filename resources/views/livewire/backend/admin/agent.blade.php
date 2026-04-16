@section('page-title') Agents @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Agents</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">List</li>
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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Agent</button>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Type</th>
                        <th class="min-w-125px">Rate</th>
                        <th class="min-w-125px">Verified</th>
                        <th class="min-w-125px">Last Active</th>
                        <th class="min-w-125px">Account Status</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="d-flex align-items-center border-0">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="{{route('admin.user.overview', $item->user->id)}}" target="_blank">
                                    @if($item->user->avatar)
                                        <div class="symbol-label">
                                            <img src="{{asset($item->user->avatar)}}" alt="{{$item->user->name}}" class="w-100" />
                                        </div>
                                    @else
                                        <div class="symbol-label fs-3 bg-light-danger text-danger"> {{substr($item->user->name,0,1)}} </div>
                                    @endif
                                </a>
                                @if($item->user->isOnline())
                                    <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                @else
                                    <div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                @endif
                            </div>
                            <div class="d-flex flex-column">
                                <div>
                                    <a href="{{route('admin.user.overview', $item->user->id)}}" target="_blank" class="text-gray-800 text-hover-primary mb-1">{{$item->user->name}}</a>
                                    @if ($item->user->account_status == 0)
                                        <a wire:click="approved({{$item->user->id}})" href="javascript:;" class="menu-link badge badge-light-warning"> Approved </a>
                                    @endif
                                </div>
                                <div>{{$item->user->email}}</div>
                                <div>{{$item->user->phone}}</div>
                            </div>
                        </td>
                        <td>{{ucfirst($item->type)}}</td>
                        <td>{{$item->commission_rate}} %</td>
                        <td><i class="fa fa-check-circle {{$item->user->email_verified_at ? 'text-success' : 'text-danger'}}"></i></td>
                        <td>@if($item->user->last_seen) {{ \Carbon\Carbon::parse($item->user->last_seen)->diffForHumans() }} @else N/L @endif</td>
                        <td>
                            @if ($item->user->account_status == 0)
                                <a href="#" class="btn btn-sm btn-warning btn-flex btn-center btn-active-light-warning dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Pending</a>
                            @elseif ($item->user->account_status == 1)
                                <a href="#" class="btn btn-sm btn-success btn-flex btn-center btn-active-light-success dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Approved</a>
                            @elseif ($item->user->account_status == 2)
                                <a href="#" class="btn btn-sm btn-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Deactive</a>
                            @elseif ($item->user->account_status == 3)
                                <a href="#" class="btn btn-sm btn-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Suspended</a>
                            @elseif ($item->user->account_status == 4)
                                <a href="#" class="btn btn-sm btn-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Banned</a>
                            @else
                                <a href="#" class="btn btn-sm btn-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Deleted</a>
                            @endif
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <div class="menu-item px-3">
                                    <a href="javascript:;"  wire:click="statusClick({{ $item->user->id }}, 0)" class="menu-link px-3">Pending</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:;"  wire:click="statusClick({{ $item->user->id }}, 1)" class="menu-link px-3">Approved</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:;"  wire:click="statusClick({{ $item->user->id }}, 2)" class="menu-link px-3">Deactive</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:;"  wire:click="statusClick({{ $item->user->id }}, 3)" class="menu-link px-3">Suspended</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:;"  wire:click="statusClick({{ $item->user->id }}, 4)" class="menu-link px-3">Banned</a>
                                </div>
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @if ($item->user->account_status == 0)
                                    <div class="menu-item px-3">
                                        <a href="javascript:;" wire:click="approved({{ $item->user->id }})" class="menu-link px-3">Approved</a>
                                    </div>
                                @endif
                                <div class="menu-item px-3">
                                    <a href="javascript:;" wire:click="edit({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#editModal" class="menu-link px-3">Edit</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:;"  wire:click="deleteConfirmation({{ $item->user->id }})" class="menu-link px-3">Delete</a>
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form wire:submit="store" class="form" action="#">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Agent</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Name</label>
                                <input type="text" wire:model="name" name="name" class="form-control form-control-solid" placeholder="Enter Name" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Email</label>
                                <input type="email" wire:model="email" name="email" class="form-control form-control-solid" placeholder="Enter Email" />
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Phone</label>
                                <input type="tel" wire:model="phone" name="phone" class="form-control form-control-solid" placeholder="Enter Phone" />
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Select Type</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" wire:model="type" title="Select a type">
                                    <option value="">Select type...</option>
                                        <option value="individual" selected>Individual</option>
                                        <option value="company">Company</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Commission Rate</label>
                                <input type="text" wire:model="commission_rate" name="commission_rate" class="form-control form-control-solid" placeholder="Enter commission rate" />
                                @error('commission_rate') <span class="text-danger">{{ $message }}</span> @enderror
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form wire:submit="update" class="form" action="#">
                    <div class="modal-header">
                        <h2 class="fw-bold">Edit Agent</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Name</label>
                                <input type="text" wire:model="name" name="name" class="form-control form-control-solid" placeholder="Enter Name" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Email</label>
                                <input type="email" wire:model="email" name="email" class="form-control form-control-solid" placeholder="Enter Email" />
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Phone</label>
                                <input type="tel" wire:model="phone" name="phone" class="form-control form-control-solid" placeholder="Enter Phone" />
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Select Type</label>
                                <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" wire:model="type" title="Select a type">
                                    <option value="">Select type...</option>
                                        <option value="individual">Individual</option>
                                        <option value="company">Company</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Commission Rate</label>
                                <input type="text" wire:model="commission_rate" name="commission_rate" class="form-control form-control-solid" placeholder="Enter commission rate" />
                                @error('commission_rate') <span class="text-danger">{{ $message }}</span> @enderror
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

