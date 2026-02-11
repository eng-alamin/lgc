@push('styles')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

<style>
    .note-editor{
        width: 100%
    }
</style>
@endpush


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
                    <div class="card-toolbar">
                        @if(empty($selectedItems))
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
                            </div>
                        @else
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="fw-bold me-5">
                                <span class="me-2">{{ $this->selectedItemsCount() }}</span>Selected</div>
                                <button type="button" wire:click="deleteSelectedItems"  class="btn btn-danger">Delete Selected</button>
                            </div>
                        @endif
                    </div>
                </div>
                <div wire:ignore class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input wire:click="selectedItemsAll" class="form-check-input" type="checkbox" wire:model.defer="selectAll"/>
                                    </div>
                                </th>
                                <th class="min-w-125px">File</th>
                                <th class="min-w-125px">Icon</th>
                                <th class="min-w-125px">Title</th>
                                <th class="min-w-125px">Date Added</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse ($essentials as $item)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input wire:click="selectedItemsClick" wire:model.defer="selectedItems" class="form-check-input" type="checkbox" value="{{ $item->id }}" />
                                    </div>
                                </td>
                                <td>
                                    <div class="symbol symbol-25px symbol-lg-50px symbol-fixed position-relative">
                                        <img src="{{asset($item->file)}}" alt="file">
                                    </div>
                                </td>
                                <td>
                                    <div class="symbol symbol-25px symbol-lg-50px symbol-fixed position-relative">
                                        <img src="{{asset($item->icon)}}" alt="icon">
                                    </div>
                                </td>
                                <td>{{$item->title}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
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
        </div>
    </div>

    <!--begin::Modals-->
        <div wire:ignore.self class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <form class="form" role="form" wire:submit.prevent="store">
                        <div class="modal-header">
                            <h2 class="fw-bold">Add Essential</h2>
                            <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body py-10 px-lg-17">
                            <div class="scroll-y me-n7 pe-7">
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">File</label>
                                    <input type="file" wire:model="file" name="file" />
                                    @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Icon</label>
                                    <input type="file" wire:model="icon" name="icon" />
                                    @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Title</label>
                                    <input type="text" wire:model="title" name="title" class="form-control form-control-solid" placeholder="Enter Title" />
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Description</label>
                                    <textarea wire:model="description" name="description" cols="30" rows="10" class="form-control form-control-solid"></textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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
                    <form class="form" role="form" wire:submit.prevent="update">
                        <div class="modal-header">
                            <h2 class="fw-bold">Edit Essential</h2>
                            <div wire:click="close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body py-10 px-lg-17">
                            <div class="scroll-y me-n7 pe-7">
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{asset($file)}}" alt="file">
                                    </div>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">New File</label> <br>
                                    <input type="file" wire:model="newfile" name="newfile"/>
                                    @error('newfile') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{asset($icon)}}" alt="icon">
                                    </div>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">New Icon</label> <br>
                                    <input type="file" wire:model="newicon" name="newicon"/>
                                    @error('newicon') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Title</label>
                                    <input type="text" wire:model="title" name="title" class="form-control form-control-solid" placeholder="Enter Title" />
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="required fs-6 fw-semibold mb-2">Description</label>
                                    <textarea wire:model="description" name="description" cols="30" rows="10" class="form-control form-control-solid"></textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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

