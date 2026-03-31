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
                        <th class="min-w-100px">Number</th>
                        <th class="min-w-100px">Total</th>
                        <th class="min-w-100px">Paid</th>
                        <th class="min-w-100px">Due</th>
                        <th class="w-70px">Payment</th>
                        <th class="w-70px">Status</th>
                        <th class="text-end w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($invoices as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="d-flex align-items-center border-0">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="{{route('admin.client.overview', $item->form?->client?->id)}}" target="_blank">
                                    @if($item->form?->client?->user->avatar)
                                        <div class="symbol-label">
                                            <img src="{{asset($item->form?->client?->user->avatar)}}" alt="{{$item->form?->client?->user->name}}" class="w-100" />
                                        </div>
                                    @else
                                        <div class="symbol-label fs-3 bg-light-danger text-danger"> {{substr($item->form?->client?->user->name,0,1)}} </div>
                                    @endif
                                </a>
                                @if($item->form?->client?->user->isOnline())
                                    <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                @else
                                    <div class="bg-danger position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                                @endif
                            </div>
                            <div class="d-flex flex-column">
                                <a href="{{route('admin.client.overview', $item->form?->client?->id)}}" target="_blank" class="text-gray-800 text-hover-primary mb-1">{{$item->form?->client?->user->name}}</a>
                                <div>{{$item->form?->client?->user->email}}</div>
                                <div>{{$item->form?->client?->user->phone}}</div>
                            </div>
                        </td>
                        <td><a href="{{ route('invoices.view', $item->id) }}" target="_blank">{{$item->number}}</a></td>
                        <td>{{$item->total_amount}}</td>
                        <td>{{$item->paid_amount}}</td>
                        <td>{{$item->due_amount}}</td>
                        <td>
                            @if($item->payment_status == 'paid')
                                <span class="badge badge-light-success">Paid</span>
                            @elseif($item->payment_status == 'partial')
                                <span class="badge badge-light-warning">Partial</span>
                            @else
                                <span class="badge badge-light-danger">Due</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $current = $item->invoice_status;
                                $flow = config('status_flow.invoice');
                                $allowed = $flow[$current] ?? [];
                            @endphp

                            @if ($item->invoice_status == 'pending')
                                <a href="#" class="btn btn-sm btn-light-warning btn-flex btn-center btn-active-light-warning dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->invoice_status) }}</a>
                            @elseif ($item->invoice_status == 'processing')
                                <a href="#" class="btn btn-sm btn-light-primary btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->invoice_status) }}</a>
                            @elseif ($item->invoice_status == 'approved')
                                <a href="#" class="btn btn-sm btn-light-success btn-flex btn-center btn-active-light-success dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->invoice_status) }}</a>
                            @else
                                <a href="#" class="btn btn-sm btn-light-danger btn-flex btn-center btn-active-light-danger dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ ucfirst($item->invoice_status) }}</a>
                            @endif
                            
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach (['pending','processing','approved','cancelled'] as $status)
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
 
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <div class="menu-item px-3">
                                    <a href="{{ route('invoices.view', $item->id) }}" target="_blank"  class="menu-link px-3">View</a>
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
                                    <label class="required fs-6 fw-semibold mb-2">Select Application</label>
                                    <select wire:ignore class="form-select p-0 w-100 border-0 selectpicker" data-live-search="true" title="Select Application" wire:model="form_id">
                                        <option value="">Select Apllication...</option>
                                        @foreach ($forms as $item)
                                            <option value="{{$item->id}}">{{$item->number}} - {{$item->client->user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('form_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Number</label>
                                    <input type="text" wire:model="serial" class="form-control form-control-solid" disabled />
                                    @error('serial') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Date</label>
                                    <input type="date" wire:model="date" class="form-control form-control-solid" disabled/>
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Select Method</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" multiple title="Select Method" wire:model.live="method">
                                        <option value="cash" selected>Cash</option>
                                        <option value="bank">Bank</option>
                                        <option value="mobile">Mobile</option>
                                    </select>
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
                                    <label class="required fs-6 fw-semibold mb-2">Select Application</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" data-live-search="true" title="Select Application" wire:model="form_id">
                                        <option value="">Select Apllication...</option>
                                        @foreach ($forms as $item)
                                            <option value="{{$item->id}}">{{$item->number}} - {{$item->client->user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('form_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Number</label>
                                    <input type="text" wire:model="serial" class="form-control form-control-solid" disabled />
                                    @error('serial') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Date</label>
                                    <input type="date" wire:model="date" class="form-control form-control-solid" disabled/>
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Select Method</label>
                                    <select class="form-select p-0 w-100 border-0 selectpicker" multiple title="Select Method" wire:model="method">
                                        <option value="cash">Cash</option>
                                        <option value="bank">Bank</option>
                                        <option value="mobile">Mobile</option>
                                    </select>
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

