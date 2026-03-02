@section('page-title') Attendances  @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Human Resource</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Attendances</li>
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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Attendance</button>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Date</th>
                        <th class="min-w-125px">Check In</th>
                        <th class="min-w-125px">Check Out</th>
                        <th class="min-w-125px">Total Hours</th>
                        <th class="min-w-125px">Total OT</th>
                        <th class="min-w-125px">Status</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($attendances as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->date)->format('d M, Y') }}
                            @if ($item->is_late == TRUE)
                                <br>
                                <span class="badge badge-light-danger">Late {{$item->late_minutes}} Minutes</span>
                            @endif
                        </td>
                        <td>{{$item->check_in}}</td>
                        <td>{{$item->check_out}}</td>
                        <td>{{$item->work_hours}}</td>
                        <td>{{$item->overtime_hours}}</td>
                        <td>
                            @if ($item->status == 'present')
                                <span class="badge badge-light-success">Present</span>
                            @elseif($item->status == 'half_day')
                                <span class="badge badge-light-warning">Half Day</span>
                            @else
                                 <span class="badge badge-light-danger">{{ucfirst($item->status)}}</span>
                            @endif
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
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <form wire:submit="store" class="form" action="#">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Attendance</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Date</label>
                                <input type="date" wire:model="date" class="form-control form-control-solid">
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Check In</label>
                                <input type="time" wire:model="check_in" class="form-control form-control-solid">
                                @error('check_in') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Check Out</label>
                                <input type="time" wire:model="check_out" class="form-control form-control-solid">
                                @error('check_out') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <div wire:ignore>
                                    <label class="required fs-6 fw-semibold mb-2">Select Status</label>
                                    <select class="form-select form-select-solid status" data-control="select2" data-placeholder="Select Status" wire:model="status">
                                        <option value="">Select Status...</option>
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="half_day">Half Day</option>
                                        <option value="leave">Leave</option>
                                    </select>
                                </div>
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
     <!--end::Modals-->
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            $('.status').on('change', function () {
                @this.set('status', $(this).val());
            });

            Livewire.on('refreshSelect', () => {
                setTimeout(() => {
                    $('.status').val(@this.get('status')).trigger('change');
                }, 100);
            });
        });
    </script>

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
                    // { orderable: false, targets: 0 },
                    // { orderable: false, targets: 7 },
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

