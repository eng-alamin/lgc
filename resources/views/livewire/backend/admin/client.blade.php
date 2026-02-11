@section('page-title') Clients @endsection
@section('page-breadcrumb') Client @endsection
@section('breadcrumb-slah-one') <span class="bullet bg-gray-400 w-5px h-2px"></span> @endsection
@section('breadcrumb-name-one') Client @endsection
@section('breadcrumb-slah-two') <span class="bullet bg-gray-400 w-5px h-2px"></span> @endsection
@section('breadcrumb-name-two') List @endsection

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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addClient">Add Client</button>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#ID</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Address</th>
                        <th class="min-w-125px">City</th>
                        <th class="min-w-125px">Verified</th>
                        <th class="min-w-125px">Last Active</th>
                        <th class="min-w-125px">Account Status</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($data as $item)
                    <tr>
                        <td>#{{$item->id}}</td>
                        <td class="d-flex align-items-center border-0">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="#">
                                    @if($item->avatar)
                                        <div class="symbol-label">
                                            <img src="{{asset($item->avatar)}}" alt="{{$item->name}}" class="w-100" />
                                        </div>
                                    @else
                                        <div class="symbol-label fs-3 bg-light-danger text-danger"> {{substr($item->name,0,1)}} </div>
                                    @endif
                                </a>
                                @if($item->isOnline())
                                    <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                @else
                                    <div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                @endif
                            </div>
                            <div class="d-flex flex-column">
                                <div>
                                    <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$item->name}}</a>
                                    @if ($item->account_status == 0)
                                        <a wire:click="approved({{$item->id}})" href="javascript:;" class="menu-link badge badge-light-warning"> Approved </a>
                                    @endif
                                </div>
                                <div>{{$item->email}}</div>
                                <div>{{$item->phone}}</div>
                            </div>
                        </td>

                        @php $data_json = json_decode($item->data) @endphp
                        <td>
                            @if(isset($data_json->address)) {{$data_json->address}}, @endif
                        </td>
                        <td>
                            @if(isset($data_json->city)) {{$data_json->city}} - @endif
                            @if(isset($data_json->postal)) {{$data_json->postal}} @endif
                        </td>
                        <td><i class="fa fa-check-circle {{$item->email_verified_at ? 'text-success' : 'text-danger'}}"></i></td>
                        <td>@if($item->last_seen) {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }} @else N/L @endif</td>
                        <td>
                            @if ($item->account_status == 0)
                                Pending
                            @elseif($item->account_status == 1)
                                Approved
                            @elseif($item->account_status == 2)
                                Deactive
                            @elseif($item->account_status == 3)
                                Suspended
                            @elseif($item->account_status == 4)
                                Banned
                            @else
                                Deleted
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @if ($item->account_status == 0)
                                    <div class="menu-item px-3">
                                        <a href="javascript:;" wire:click="approved({{ $item->id }})" class="menu-link px-3">Approved</a>
                                    </div>
                                @endif
                                <div class="menu-item px-3">
                                    <a href="javascript:;" wire:click="edit({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#editClient" class="menu-link px-3">Edit</a>
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
    <div wire:ignore.self class="modal fade" id="addClient" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form wire:submit="store" class="form" action="#">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Client</h2>
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
                                <label class="fs-6 fw-semibold mb-2">Address</label>
                                <input type="text" wire:model="address" name="address" class="form-control form-control-solid" placeholder="Enter Address" />
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">City</label>
                                <input type="text" wire:model="city" name="city" class="form-control form-control-solid" placeholder="Enter City" />
                                @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Postal</label>
                                <input type="text" wire:model="postal" name="postal" class="form-control form-control-solid" placeholder="Enter Postal" />
                                @error('postal') <span class="text-danger">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="editClient" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form wire:submit="update" class="form" action="#">
                    <div class="modal-header">
                        <h2 class="fw-bold">Edit Client</h2>
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
                                <label class="fs-6 fw-semibold mb-2">Address</label>
                                <input type="text" wire:model="address" name="address" class="form-control form-control-solid" placeholder="Enter Address" />
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">City</label>
                                <input type="text" wire:model="city" name="city" class="form-control form-control-solid" placeholder="Enter City" />
                                @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Postal</label>
                                <input type="text" wire:model="postal" name="postal" class="form-control form-control-solid" placeholder="Enter Postal" />
                                @error('postal') <span class="text-danger">{{ $message }}</span> @enderror
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

