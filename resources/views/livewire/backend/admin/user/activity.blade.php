@section('page-title') Activity @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Users</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Activity</li>
@endsection

    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

           @include('livewire.backend.admin.user.navbar')

            <div class="card">
                <div class="card-header card-header-stretch">
                <div class="card-title d-flex align-items-center">
                    <h3 class="fw-bold m-0 text-gray-800">Activity logs</h3>
                </div>
                </div>
                <div wire:ignore class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-25px"></th>
                                <th class="min-w-125px">Log Name</th>
                                <th class="min-w-125px">Event</th>
                                <th class="min-w-125px">Description</th>
                                <th class="min-w-125px">Date At</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse ($data as $key => $item)
                            <tr>
                                <td>
                                    <div class="timeline-item">
                                        <div class="timeline-line w-40px"></div>
                                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                                            @if ($item->event == "created")
                                                <div class="symbol-label bg-light"><i class="ki-duotone ki-book fs-2 text-gray-500"><span class="path1"></span><span class="path2"></span></i></div>
                                            @elseif ($item->event == "updated")
                                                <div class="symbol-label bg-light"><i class="ki-duotone ki-pencil fs-2 text-gray-500"><span class="path1"></span><span class="path2"></span></i></div>
                                            @elseif ($item->event == "deleted")
                                                <div class="symbol-label bg-light"><i class="ki-duotone ki-delete-files fs-2 text-gray-500"><span class="path1"></span><span class="path2"></span></i></div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{$item->log_name}}</td>
                                <td>{{$item->event}}</td>
                                <td>{{$item->description}}</td>
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
