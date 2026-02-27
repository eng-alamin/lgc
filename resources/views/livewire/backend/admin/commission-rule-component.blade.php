@section('page-title') Commission @endsection
@section('page-breadcrumb') Commission @endsection
@section('breadcrumb-slah-one') <span class="bullet bg-gray-400 w-5px h-2px"></span> @endsection
@section('breadcrumb-name-one') Commission @endsection
@section('breadcrumb-slah-two') <span class="bullet bg-gray-400 w-5px h-2px"></span> @endsection
@section('breadcrumb-name-two') Rules @endsection

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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Commission Rule</button>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Service Type</th>
                        <th class="min-w-125px">Commission Value</th>
                        <th class="min-w-125px">Commission Value</th>
                        <th class="min-w-125px">Status</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($item->service_type) }}</td>
                        <td>{{ $item->commission_type }}</td>
                        <td>{{ $item->commission_value }}</td>
                        <td>
                            @if ($item->status == 1)
                                <a href="#" class="btn btn-sm btn-success btn-flex btn-center btn-active-light-success dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Active</a>
                            @else
                                <a href="#" class="btn btn-sm btn-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Inactive</a>
                            @endif
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <div class="menu-item px-3">
                                    <a href="javascript:;"  wire:click="statusClick({{ $item->id }}, 1)" class="menu-link px-3">Active</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:;"  wire:click="statusClick({{ $item->id }}, 0)" class="menu-link px-3">Inactive</a>
                                </div>
                            </div>
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
    <div wire:ignore.self class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form wire:submit="store" class="form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Commission Rule</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <div wire:ignore>
                                    <label class="required fs-6 fw-semibold mb-2">Select Service Type</label>
                                    <select class="form-select form-select-solid service_type" data-control="select2" data-hide-search="true" data-placeholder="Select Service Type" wire:model="service_type">
                                        <option value="">Select Service Type...</option>
                                        <option value="education">Education</option>
                                        <option value="healthcare">Healthcare</option>
                                        <option value="business">Business</option>
                                        <option value="travel">Travel</option>
                                        <option value="job">Job</option>
                                    </select>
                                </div>
                                @error('service_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <div wire:ignore>
                                    <label class="required fs-6 fw-semibold mb-2">Select Commission Type</label>
                                    <select class="form-select form-select-solid commission_type" data-control="select2" data-hide-search="true" data-placeholder="Select Commission Type" wire:model="commission_type">
                                        <option value="">Select Commission Type...</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                                @error('commission_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Commission Value</label>
                                <input type="text" wire:model="commission_value" class="form-control form-control-solid" placeholder="Enter Commission Value" />
                                @error('commission_value') <span class="text-danger">{{ $message }}</span> @enderror
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
                        <h2 class="fw-bold">Edit Commission Rule</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                         <div class="scroll-y me-n7 pe-7">
                            <div class="fv-row mb-7">
                                <div wire:ignore>
                                    <label class="required fs-6 fw-semibold mb-2">Select Service Type</label>
                                    <select class="form-select form-select-solid service_type" data-control="select2" data-hide-search="true" data-placeholder="Select Service Type" wire:model="service_type">
                                        <option value="">Select Service Type...</option>
                                        <option value="education">Education</option>
                                        <option value="healthcare">Healthcare</option>
                                        <option value="business">Business</option>
                                        <option value="travel">Travel</option>
                                        <option value="job">Job</option>
                                    </select>
                                </div>
                                @error('service_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <div wire:ignore>
                                    <label class="required fs-6 fw-semibold mb-2">Select Commission Type</label>
                                    <select class="form-select form-select-solid commission_type" data-control="select2" data-hide-search="true" data-placeholder="Select Commission Type" wire:model="commission_type">
                                        <option value="">Select Commission Type...</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                                @error('commission_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Commission Value</label>
                                <input type="text" wire:model="commission_value" class="form-control form-control-solid" placeholder="Enter Commission Value" />
                                @error('commission_value') <span class="text-danger">{{ $message }}</span> @enderror
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
        document.addEventListener('livewire:init', () => {
            $('.service_type').on('change', function () {
                @this.set('service_type', $(this).val());
            });
            $('.commission_type').on('change', function () {
                @this.set('commission_type', $(this).val());
            });

            Livewire.on('refreshSelect', () => {
                setTimeout(() => {
                    $('.service_type').val(@this.get('service_type')).trigger('change');
                    $('.commission_type').val(@this.get('commission_type')).trigger('change');
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
                    { orderable: false, targets: 0 },
                    { orderable: false, targets: 5 },
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

