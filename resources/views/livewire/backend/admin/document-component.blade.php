@section('page-title') Documents @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Documents</li>
@endsection


<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row justify-content-between">
        <div class="col-md-12">
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
                </div>
                <div wire:ignore class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">SL</th>
                                <th class="min-w-125px">Client</th>
                                <th class="min-w-125px">Type</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-125px">View</th>
                                <th class="min-w-125px">Date Added</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse ($documents as $index => $item)
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
                                            @if ($item->client->user->account_status == 0)
                                                <a wire:click="approved({{$item->client->user->id}})" href="javascript:;" class="menu-link badge badge-light-warning"> Approved </a>
                                            @endif
                                        </div>
                                        <div>{{$item->client->user->email}}</div>
                                        <div>{{$item->client->user->phone}}</div>
                                    </div>
                                </td>
                                <td>{{$item->document_type}}</td>
                                <td>
                                    @php
                                        $current = $item->status;
                                        $flow = config('status_flow.document');
                                        $allowed = $flow[$current] ?? [];
                                    @endphp

                                    @if ($item->status == 'pending')
                                        <a href="#" class="btn btn-sm btn-light-warning btn-flex btn-center btn-active-light-warning dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                    @elseif ($item->status == 'uploaded')
                                        <a href="#" class="btn btn-sm btn-light-primary btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                    @elseif ($item->status == 'verified')
                                        <a href="#" class="btn btn-sm btn-light-success btn-flex btn-center btn-active-light-success dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                    @else
                                        <a href="#" class="btn btn-sm btn-light-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->status) }}</a>
                                    @endif
                                    
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        @foreach (['pending','uploaded','verified','declined'] as $status)
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
                                <td>
                                    @if($item->file)
                                        @php
                                            $filePath = public_path($item->file);
                                            $fileName = basename($item->file);
                                            $fileSize = file_exists($filePath) ? round(filesize($filePath) / 1024, 2) : 0;
                                        @endphp
                                        <a href="{{ asset($item->file) }}" target="_blank" class="text-muted">
                                            {{ $fileName }} ({{ $fileSize }} KB)
                                        </a>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
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

