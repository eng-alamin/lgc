@section('page-title') Commission @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Users</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Commission</li>
@endsection

    <div id="kt_app_content_container" class="app-container container-xxl">

        @include('livewire.backend.admin.user.navbar')

        <div class="card">
             <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" datatable-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search" />
                </div>
            </div>
           <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Number</th>
                        <th class="min-w-125px">Service</th>
                        <th class="min-w-125px">Total</th>
                        <th class="min-w-125px">Commission</th>
                        <th class="min-w-125px">Status</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{route('admin.application.view', $item->form?->id)}}" target="_blank">{{ $item->form?->number ?? 'N/L' }}</a></td>
                        <td>{{ ucfirst($item->form?->type ?? 'N/L') }}</td>
                        <td>{{ $item->total_amount  }}</td>
                        <td>{{ $item->commission_amount  }}</td>
                        <td>
                            @if($item->status == 'pending')
                                <span class="badge badge-warning"> {{ $item->status }} </span>
                            @elseif($item->status == 'approved')
                                <span class="badge badge-success"> {{ $item->status }} </span>
                            @else
                                <span class="badge badge-info"> {{ $item->status }} </span>
                            @endif
                        </td>

                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
                            @if ($item->status != 'paid')
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @if($item->status == 'pending')
                                        <div class="menu-item px-3">
                                            <a href="javascript:;"  wire:click="approve({{ $item->id }})" class="menu-link px-3">Approve</a>
                                        </div>
                                    @endif
                                    @if($item->status == 'approved')
                                        <div class="menu-item px-3">
                                            <a href="javascript:;"  wire:click="markPaid({{ $item->id }})" class="menu-link px-3"> Mark Paid</a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
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