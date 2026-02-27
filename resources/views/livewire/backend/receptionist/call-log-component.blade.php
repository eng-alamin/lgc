@section('page-title') Call Logs @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted">Call Logs</li>
@endsection

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card mb-4">
        <form wire:submit.prevent="store" class="form">
            <div class="card-header border-0 pt-6">
                <div class="card-title">New Entry</div>
            </div>
            <div class="card-body py-10 px-lg-17">
                
                <div class="row me-n7 pe-7">
                    <div class="col-md-4">
                        <div wire:ignore>
                            <label class="required fs-6 fw-semibold mb-2">Type</label>
                            <select class="form-select form-select-solid type" data-control="select2" data-hide-search="true" data-placeholder="Select a type" name="type"  wire:model="type">
                                <option value="">Select Type...</option>
                                <option value="call">Incoming Call</option>
                                <option value="visitor">Walk-in Visitor</option>
                            </select>
                        </div>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="required fs-6 fw-semibold mb-2">Name</label>
                        <input type="text" wire:model="name" name="name" class="form-control form-control-solid"/>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="fs-6 fw-semibold mb-2">Phone</label>
                        <input type="text" wire:model="phone" name="phone" class="form-control form-control-solid"/>
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="fs-6 fw-semibold mb-2">Purpose</label>
                        <input type="text" wire:model="purpose" name="purpose" class="form-control form-control-solid"/>
                        @error('purpose') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="fs-6 fw-semibold mb-2">Follow-up Date</label>
                        <input type="date" wire:model="follow_up_date" name="follow_up_date" class="form-control form-control-solid"/>
                        @error('follow_up_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <div wire:ignore>
                            <label class="fs-6 fw-semibold mb-2">Assigned Staff</label>
                            <select class="form-select form-select-solid assigned_to" data-control="select2" data-hide-search="true" data-placeholder="Select a staff" name="assigned_to"  wire:model="assigned_to">
                                <option value="">Select Staff...</option>
                                @foreach ($staffs as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('assigned_to') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="fs-6 fw-semibold mb-2">Remarks</label> 
                        <textarea wire:model="remarks" class="form-control"></textarea>
                        @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 pb-6 text-end">
                <button type="submit" class="btn btn-sm btn-primary">Save Entry</button>
            </div>
        </form>
    </div>

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
                        <th class="min-w-125px">Type</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Phone</th>
                        <th class="min-w-125px">Follow-up</th>
                        <th class="min-w-125px">Staff</th>
                        <th class="min-w-125px">Status</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @forelse ($logs as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{$item->type}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->follow_up_date}}</td>
                        <td>{{ optional($item->staff)->name }}</td>
                        <td>
                            <select wire:change="updateStatus({{ $item->id }}, $event.target.value)" class="form-control">
                                <option value="new" {{ $item->status=='new'?'selected':'' }}>New</option>
                                <option value="contacted" {{ $item->status=='contacted'?'selected':'' }}>Contacted</option>
                                <option value="follow_up" {{ $item->status=='follow_up'?'selected':'' }}>Follow-up</option>
                                <option value="closed" {{ $item->status=='closed'?'selected':'' }}>Closed</option>
                            </select>
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
        document.addEventListener('livewire:init', () => {
            $('.type').on('change', function () {
                @this.set('type', $(this).val());
            });
            $('.assigned_to').on('change', function () {
                @this.set('assigned_to', $(this).val());
            });

            Livewire.on('refreshSelect', () => {
                setTimeout(() => {
                    $('.type').val(@this.get('type')).trigger('change');
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
                    { orderable: false, targets: 6 },
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

