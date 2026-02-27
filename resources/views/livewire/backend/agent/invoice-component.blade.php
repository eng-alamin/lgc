@section('page-title') Invoices @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Invoices</li>
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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModel">Add Invoice</button>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">SL</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Number</th>
                        <th class="min-w-125px">Total</th>
                        <th class="min-w-125px">Paid</th>
                        <th class="min-w-125px">Due</th>
                        <th class="min-w-125px">Status</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($invoices as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="d-flex align-items-center border-0">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="#">
                                    @if($item->form?->client?->avatar)
                                        <div class="symbol-label">
                                            <img src="{{asset($item->form->client->avatar)}}" alt="{{$item->form->client->name}}" class="w-100" />
                                        </div>
                                    @elseif($item->form?->client?->name)
                                        <div class="symbol-label fs-3 bg-light-danger text-danger"> {{substr($item->form->client->name,0,1)}} </div>
                                    @else
                                        <div class="symbol-label fs-3 bg-light-secondary text-muted">N</div>
                                    @endif
                                </a>
                            </div>
                            <div class="d-flex flex-column">
                                <div>{{$item->form?->client?->email ?? 'N/L'}}</div>
                                <div>{{$item->form?->client?->phone ?? 'N/L'}}</div>
                            </div>
                        </td>
                        <td><a href="{{ route('receptionist.invoices.print', $item->id) }}" target="_blank">{{$item->number}}</a></td>
                        <td>{{$item->total_amount}}</td>
                        <td>{{$item->paid_amount}}</td>
                        <td>{{$item->due_amount}}</td>
                        <td>
                            @if($item->status == 'paid')
                                <span class="badge badge-light-success">Paid</span>
                            @elseif($item->status == 'partial')
                                <span class="badge badge-light-warning">Partial</span>
                            @else
                                <span class="badge badge-light-danger">Due</span>
                            @endif
                        </td>
 
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <div class="menu-item px-3">
                                    <a href="{{ route('receptionist.invoices.print', $item->id) }}" target="_blank"  class="menu-link px-3">Print</a>
                                </div>
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
    <div wire:ignore.self class="modal fade" id="addModel" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form wire:submit.prevent="store" class="form">
                    <div class="modal-header">
                        <h2 class="fw-bold">Add Invoice</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="row">
                                <div class="col-md-6 mb-7">
                                    <div wire:ignore>
                                        <label class="required fs-6 fw-semibold mb-2">Select Application</label>
                                        <select class="form-select form-select-solid form_id" data-control="select2" data-placeholder="Select Application" wire:model="form_id">
                                            <option value="">Select Apllication...</option>
                                            @foreach ($forms as $item)
                                                <option value="{{$item->id}}">{{$item->number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('form_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Number</label>
                                    <input type="text" wire:model="number" class="form-control form-control-solid" disabled />
                                    @error('number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Date</label>
                                    <input type="date" wire:model="date" class="form-control form-control-solid"/>
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <div wire:ignore>
                                        <label class="required fs-6 fw-semibold mb-2">Select Method</label>
                                        <select class="form-select form-select-solid method" data-control="select2" data-hide-search="true" data-placeholder="Select Method" wire:model="method">
                                            <option value="">Select Method...</option>
                                            <option value="cash">Cash</option>
                                            <option value="bank">Bank</option>
                                            <option value="mobile">Mobile</option>
                                        </select>
                                    </div>
                                    @error('method') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Items</label>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fw-semibold fs-6 gy-5">
                                            <thead>
                                                <tr class="text-muted fw-bold fs-7 text-uppercase">
                                                    <th>Name</th>
                                                    <th>Total Amount</th>
                                                    <th>Advance Payment</th>
                                                    @if(count($items) > 1)
                                                        <th class="text-end">Remove</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $index => $education)
                                                    <tr>
                                                        <td>
                                                            <input type="text" wire:model="items.{{ $index }}.name" class="form-control form-control-solid">
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="items.{{ $index }}.total" class="form-control form-control-solid">
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="items.{{ $index }}.advance" class="form-control form-control-solid">
                                                        </td>
                                                        @if(count($items) > 1)
                                                            <td class="text-end">
                                                                <button type="button" wire:click="removeRow({{ $index }})" class="btn btn-sm btn-danger">Remove</button>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2 text-end">
                                        <button type="button" wire:click="addRow" class="btn btn-light-primary"> + Add More </button>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Notes</label>
                                    <textarea wire:model="notes" class="form-control"></textarea>
                                    @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
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
                        <h2 class="fw-bold">Edit Invoice</h2>
                        <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7">
                            <div class="row">
                                <div class="col-md-6 mb-7">
                                    <div wire:ignore>
                                        <label class="required fs-6 fw-semibold mb-2">Select Application</label>
                                        <select class="form-select form-select-solid form_id" data-control="select2" data-placeholder="Select Application" wire:model="form_id">
                                            <option value="">Select Apllication...</option>
                                            @foreach ($forms as $item)
                                                <option value="{{$item->id}}">{{$item->number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('form_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Number</label>
                                    <input type="text" wire:model="number" class="form-control form-control-solid" disabled />
                                    @error('number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Date</label>
                                    <input type="date" wire:model="date" class="form-control form-control-solid"/>
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <div wire:ignore>
                                        <label class="required fs-6 fw-semibold mb-2">Select Method</label>
                                        <select class="form-select form-select-solid method" data-control="select2" data-hide-search="true" data-placeholder="Select Method" wire:model="method">
                                            <option value="">Select Method...</option>
                                            <option value="cash">Cash</option>
                                            <option value="bank">Bank</option>
                                            <option value="mobile">Mobile</option>
                                        </select>
                                    </div>
                                    @error('method') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Items</label>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fw-semibold fs-6 gy-5">
                                            <thead>
                                                <tr class="text-muted fw-bold fs-7 text-uppercase">
                                                    <th>Name</th>
                                                    <th>Total Amount</th>
                                                    <th>Advance Payment</th>
                                                    @if(count($items) > 1)
                                                        <th class="text-end">Remove</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $index => $education)
                                                    <tr>
                                                        <td>
                                                            <input type="text" wire:model="items.{{ $index }}.name" class="form-control form-control-solid">
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="items.{{ $index }}.total" class="form-control form-control-solid">
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="items.{{ $index }}.advance" class="form-control form-control-solid">
                                                        </td>
                                                        @if(count($items) > 1)
                                                            <td class="text-end">
                                                                <button type="button" wire:click="removeRow({{ $index }})" class="btn btn-sm btn-danger">Remove</button>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2 text-end">
                                        <button type="button" wire:click="addRow" class="btn btn-light-primary"> + Add More </button>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-7">
                                    <label class="fs-6 fw-semibold mb-2">Notes</label>
                                    <textarea wire:model="notes" class="form-control"></textarea>
                                    @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
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
            $('.form_id').on('change', function () {
                @this.set('form_id', $(this).val());
            });
            $('.method').on('change', function () {
                @this.set('method', $(this).val());
            });

            Livewire.on('refreshSelect', () => {
                setTimeout(() => {
                    $('.form_id').val(@this.get('form_id')).trigger('change');
                    $('.method').val(@this.get('method')).trigger('change');
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

