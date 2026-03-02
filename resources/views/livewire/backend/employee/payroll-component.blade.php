@section('page-title') Payrolls @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Human Resource</li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Payrolls</li>
@endsection

@push('styles')
    <style>
        @media print {

            @page {
                size: A4;
                margin: 15mm;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                width: 210mm;      /* A4 Width */
                min-height: 297mm; /* A4 Height */
                padding: 20px;
            }

        }
    </style>
@endpush

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
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Month</th>
                        <th class="min-w-125px">Basic</th>
                        <th class="min-w-125px">Bonus</th>
                        <th class="min-w-125px">Deduction</th>
                        <th class="min-w-125px">Net Salary</th>
                        <th class="min-w-125px">Status</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($payrolls as $key => $item)
                    <tr>
                    <td>{{ $key + 1 }}</td>
                        <td>{{$item->month}}</td>
                        <td>{{$item->basic_salary }}</td>
                        <td>{{$item->bonus}}</td>
                        <td>{{$item->deduction}}</td>
                        <td><b>{{ $item->net_salary }}</b></td>
                        <td>
                            @if($item->status == 'paid')
                                <span class="badge badge-light-success">Paid</span>
                            @else
                                <span class="badge badge-light-warning">Unpaid</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="javascript:;" wire:click="view({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#viewModal" class="menu-link">View</a>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--begin::Modals-->
    <div wire:ignore.self class="modal fade" id="viewModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">View</h2>
                    <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="scroll-y me-n7 pe-7">
                        @if($payroll)
                            <div id="printSection">
                                <h5 class="mb-3">
                                    {{ $payroll->employee->user->name }}
                                    ({{ $payroll->month }})
                                </h5>

                                <hr>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Present:</strong>
                                        {{ $payroll->present_days }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Absent:</strong>
                                        {{ $payroll->absent_days }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Leave:</strong>
                                        {{ $payroll->leave_days }}
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Basic Salary:
                                            <span class="float-end">
                                                {{ number_format($payroll->basic_salary,2) }}
                                            </span>
                                        </p>

                                        <p>Allowance:
                                            <span class="float-end">
                                                {{ number_format($payroll->allowance,2) }}
                                            </span>
                                        </p>

                                        <p>Bonus:
                                            <span class="float-end">
                                                {{ number_format($payroll->bonus,2) }}
                                            </span>
                                        </p>

                                        <p>Commission:
                                            <span class="float-end">
                                                {{ number_format($payroll->commission,2) }}
                                            </span>
                                        </p>

                                        <p>Overtime:
                                            <span class="float-end">
                                                {{ number_format($payroll->overtime_amount,2) }}
                                            </span>
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <p>Deduction:
                                            <span class="float-end text-danger">
                                                -{{ number_format($payroll->deduction,2) }}
                                            </span>
                                        </p>

                                        <hr>

                                        <h4 class="text-success">
                                            Net Salary:
                                            <span class="float-end">
                                                {{ number_format($payroll->net_salary,2) }}
                                            </span>
                                        </h4>

                                        <div class="mt-3">
                                            @if($payroll->status == 'paid')
                                                <span class="badge badge-success">Paid</span>
                                                <br>
                                                <small>
                                                    Paid At:
                                                    {{ $payroll->paid_at }}
                                                </small>
                                            @else
                                                <span class="badge badge-danger">Unpaid</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer flex-end">
                    <button class="btn btn-sm btn-primary" onclick="printPayroll()">Print/Download</button>
                </div>
            </div>
        </div>
    </div>
     <!--end::Modals-->
</div>

@push('scripts')
    <script>
    function printPayroll() {

        var printContents = document.getElementById('printSection').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

        location.reload();
    }
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