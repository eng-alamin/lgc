@section('page-title') Applications @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted"> Applications</li>
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
                    <a href="{{route('receptionist.application.add')}}" target="_blank" class="btn btn-sm btn-primary">New Application</a>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">SL</th>
                            <th class="min-w-125px">Client</th>
                            <th class="min-w-125px">Form Number</th>
                            <th class="min-w-125px">Form Type</th>
                            <th class="min-w-125px">Status</th>
                            <th class="min-w-125px">Date At</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="d-flex align-items-center border-0">
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="{{route('receptionist.client.overview', $item->client?->id)}}" target="_blank">
                                        @if($item->client?->user?->avatar)
                                            <div class="symbol-label">
                                                <img src="{{asset($item->client?->user?->avatar)}}" alt="{{$item->client?->user?->name}}" class="w-100" />
                                            </div>
                                        @else
                                            <div class="symbol-label fs-3 bg-light-danger text-danger"> {{substr($item->client?->user?->name ?? 'N',0,1)}} </div>
                                        @endif
                                    </a>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="{{route('receptionist.client.overview', $item->client?->id)}}" target="_blank" class="text-gray-800 text-hover-primary mb-1">{{$item->client?->user?->name ?? 'N/L'}}</a>
                                    <div>{{$item->client?->user?->email ?? 'N/A'}}</div>
                                    <div>{{$item->client?->user?->phone ?? 'N/A'}}</div>
                                </div>
                            </td>
                            <td>{{$item->number}}</td>
                            <td>{{ ucfirst($item->type) }}</td>
                            <td>
                                @php
                                    $current = $item->status;
                                    $flow = config('status_flow.form');
                                    $allowed = $flow[$current] ?? [];
                                @endphp

                                @if ($item->status == 'pending')
                                    <a href="#" class="btn btn-sm btn-light-warning btn-flex btn-center btn-active-light-warning dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                @elseif ($item->status == 'processing')
                                    <a href="#" class="btn btn-sm btn-light-primary btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                @elseif ($item->status == 'approved')
                                    <a href="#" class="btn btn-sm btn-light-success btn-flex btn-center btn-active-light-success dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                @else
                                    <a href="#" class="btn btn-sm btn-light-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                @endif
                                
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @foreach (['pending','processing','approved','declined'] as $status)
                                        <div class="menu-item px-3">
                                            <a href="javascript:;"
                                            class="menu-link px-3 {{ !in_array($status,$allowed) ? 'disabled text-muted' : '' }}"
                                            wire:click="{{ in_array($status,$allowed) ? "statusClick($item->id, '$status')" : '' }}">
                                                {{ ucfirst($status) }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <div class="menu-item px-3">
                                        <a href="{{route('receptionist.application.edit', $item->id)}}" target="_blank" class="menu-link px-3">Edit</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="{{route('receptionist.application.view', $item->id)}}" target="_blank" class="menu-link px-3">View</a>
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
    </div>
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
                    { orderable: false, targets: 4 },
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

