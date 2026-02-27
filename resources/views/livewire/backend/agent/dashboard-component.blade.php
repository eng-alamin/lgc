<div id="kt_app_content_container" class="app-container container-fluid" wire:poll.30s>
    <!--begin::Row-->
    <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 20-->
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" style="background-color: #8f9925;background-image:url('{{asset("assets/backend/media/patterns/vector-1.png")}}')">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"></span>
                        <span class="text-gray-400 pt-1 fw-semibold fs-6"></span>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column align-items-center pt-0">
                    <div>
                        <span class="fs-2hx fw-bold text-white me-2">{{$activeOnline}}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>Active Online Now</span>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
            <!--begin::Card widget 20-->
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" style="background-color: #f14141;background-image:url('{{asset("assets/backend/media/patterns/vector-1.png")}}')">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"></span>
                        <span class="text-gray-400 pt-1 fw-semibold fs-6"></span>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column align-items-center pt-0">
                    <div>
                        <span class="fs-2hx fw-bold text-white me-2">{{$applicationsToday}}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>New Applications Today</span>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 20-->
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" style="background-color: #e2771c; background-image:url('{{asset("assets/backend/media/patterns/vector-1.png")}}')">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"></span>
                        <span class="text-gray-400 pt-1 fw-semibold fs-6"></span>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column align-items-center pt-0">
                    <div>
                        <span class="fs-2hx fw-bold text-white me-2">{{$clientsToday}}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>Clients Today </span>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
            <!--begin::Card widget 20-->
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" style="background-color: #F1416C;background-image:url('{{asset("assets/backend/media/patterns/vector-1.png")}}')">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"></span>
                        <span class="text-gray-400 pt-1 fw-semibold fs-6"></span>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column align-items-center pt-0">
                    <div>
                        <span class="fs-2hx fw-bold text-white me-2">{{$followupsToday }}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>Follow Ups Today</span>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-6">
            <div class="card bg-danger">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title font-weight-bolder text-white">Overview</h3>
                    <div>
                        <input class="form-control form-control-solid" placeholder="Pick date rage" id="kt_daterangepicker_4"/>
                    </div>
                </div>
                <div class="card-body p-0 position-relative overflow-hidden">
                    <div class="row justify-content-center py-5 my-5">
                        <div class="col-10 col-md-5 bg-light px-6 py-8 rounded my-3 mx-5 d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column text-center">
                                <i class="ki-duotone ki-user fs-4x text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <a href="#" class="text-primary fs-4 fw-bold">Total Client</a>
                                <span class="badge badge-light-primary">Approved</span>
                            </div>
                            <div class="">
                                <span class="text-primary fs-3 fw-bold">{{ $total_client }}</span>
                            </div>
                        </div>
                        <div class="col-10 col-md-5 bg-light px-6 py-8 rounded my-3 mx-5 d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column text-center">
                                <i class="ki-duotone ki-color-swatch fs-4x text-success">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                    <span class="path9"></span>
                                    <span class="path10"></span>
                                    <span class="path11"></span>
                                    <span class="path12"></span>
                                    <span class="path13"></span>
                                    <span class="path14"></span>
                                    <span class="path15"></span>
                                    <span class="path16"></span>
                                    <span class="path17"></span>
                                    <span class="path18"></span>
                                    <span class="path19"></span>
                                    <span class="path20"></span>
                                    <span class="path21"></span>
                                </i>
                                <a href="#" class="text-success fs-4 fw-bold">Total Application</a>
                                <span class="badge badge-light-success">Approved</span>
                            </div>
                            <div class="">
                                <span class="text-success fs-3 fw-bold">{{ $total_application }}</span>
                            </div>
                        </div>
                        <div class="col-10 col-md-5 bg-light px-6 py-8 rounded my-3 mx-5 d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column text-center">
                                {{-- <i class="ki-duotone ki-ship fs-4x text-danger">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i> --}}
                                <a href="#" class="text-danger fs-4 fw-bold">Coming</a>
                                {{-- <span class="badge badge-light-danger">Done</span> --}}
                            </div>
                            {{-- <div class="">
                                <span class="text-danger fs-3 fw-bold">{{ $total_followup }}</span>
                            </div> --}}
                        </div>
                        <div class="col-10 col-md-5 bg-light px-6 py-8 rounded my-3 mx-5 d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column text-center">
                                {{-- <i class="ki-duotone ki-message-text-2 fs-4x text-warning">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i> --}}
                                <a href="#" class="text-warning fs-4 fw-bold">Coming</a>
                                {{-- <span class="badge badge-light-warning">Contacted</span> --}}
                            </div>
                            {{-- <div class="">
                                <span class="text-warning fs-3 fw-bold">{{ $total_calllogs }}</span>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Application-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <div class="col-xl-4">
            <div class="card card-flush h-md-100">
                <div class="card-header pt-5 mb-6">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Applications</span>
                        <span class="fs-6 fw-semibold text-gray-400">Pending - {{$applications->where('status', 'pending')->count()}}</span>
                    </h3>
                </div>
                <div class="card-body py-0 px-0">
                    <div class="table-responsive mx-9 mt-n6">
                        <table class="table align-middle gs-0 gy-4">
                            <thead>
                                <tr>
                                    <th class="min-w-100px"></th>
                                    <th class="min-w-50px text-end pe-0"></th>
                                    <th class="text-end min-w-100px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications->where('status', 'pending')->take(6) as $item)
                                    <tr>
                                        <td>
                                            <a href="{{route('receptionist.application.view', $item->id)}}" target="_blank"><span class="text-gray-800 fw-bold fs-6 me-1">{{$item->number}}</span></a>
                                        </td>
                                        <td class="pe-0 text-end">
                                            <span class="badge badge-light-primary fs-7">{{ucfirst($item->status)}}</span>
                                        </td>
                                        <td class="pe-0 text-end">
                                            <a href="#" class="text-gray-600 fw-bold fs-6">{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card card-flush h-md-100">
                <div class="card-header pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Applications</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ucfirst($applicationFilter)}} {{$this->invoices->count()}} Data</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav" id="kt_chart_widget_8_tabs">
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 {{ $applicationFilter == 'today' ? 'active' : '' }}"  wire:click="setFilterApplication('today')">Today</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 {{ $applicationFilter == 'yesterday' ? 'active' : '' }}"  wire:click="setFilterApplication('yesterday')">Yesterday</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 {{ $applicationFilter == 'week' ? 'active' : '' }}"  wire:click="setFilterApplication('week')">Week</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body pt-6">
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                    <th class="p-0 pb-3 min-w-200px text-start">ITEM</th>
                                    <th class="p-0 pb-3 min-w-100px text-end">NUMBER</th>
                                    <th class="p-0 pb-3 min-w-100px text-end">SERVICE</th>
                                    <th class="p-0 pb-3 min-w-175px text-end pe-12">STATUS</th>
                                    <th class="p-0 pb-3 w-50px text-end">VIEW</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->applications as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-3">
                                                    <img src="{{asset('assets/backend/media/stock/600x600/img-49.jpg')}}" class="" alt="" />
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{$item->user?->name ?? 'N/L'}}</a>
                                                    <span class="text-gray-400 fw-semibold d-block fs-7">{{$item->user?->email ?? 'N/A'}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">{{$item->number}}</span>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">{{ ucfirst($item->type) }}</span>
                                        </td>
                                        <td class="text-end pe-12">
                                            @if ($item->status == 'pending')
                                                <span class="badge py-3 px-4 fs-7 badge-light-primary">Pending</span>
                                            @elseif($item->status == 'processing')
                                                <span class="badge py-3 px-4 fs-7 badge-light-warning">Processing</span>
                                            @elseif($item->status == 'approved')
                                                <span class="badge py-3 px-4 fs-7 badge-light-success">Approved</span>
                                            @elseif($item->status == 'declined')
                                                <span class="badge py-3 px-4 fs-7 badge-light-danger">Declined</span>
                                            @else
                                                <span class="badge py-3 px-4 fs-7 badge-light-danger">Declined</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{route('receptionist.application.view', $item->id)}}" target="_blank" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Application-->
    <!--begin::Invoice-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <div class="col-xl-8">
            <div class="card card-flush h-md-100">
                <div class="card-header pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Invoices</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ucfirst($invoiceFilter)}} {{$this->invoices->count()}} Data</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav" id="kt_chart_widget_8_tabs">
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 {{ $invoiceFilter == 'today' ? 'active' : '' }}"  wire:click="setFilterInvoice('today')">Today</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 {{ $invoiceFilter == 'yesterday' ? 'active' : '' }}"  wire:click="setFilterInvoice('yesterday')">Yesterday</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 {{ $invoiceFilter == 'week' ? 'active' : '' }}"  wire:click="setFilterInvoice('week')">Week</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body pt-6">
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                    <th class="p-0 pb-3 min-w-200px text-start">ITEM</th>
                                    <th class="p-0 pb-3 min-w-100px text-end">NUMBER</th>
                                    <th class="p-0 pb-3 min-w-100px text-end">TOTAL</th>
                                    <th class="p-0 pb-3 min-w-175px text-end pe-12">STATUS</th>
                                    <th class="p-0 pb-3 w-50px text-end">VIEW</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->invoices as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-3">
                                                    <img src="{{asset('assets/backend/media/stock/600x600/img-49.jpg')}}" class="" alt="" />
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{$item->form?->client?->name ?? 'N/L'}}</a>
                                                    <span class="text-gray-400 fw-semibold d-block fs-7">{{$item->form?->client?->email ?? 'N/A'}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">{{$item->number}}</span>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-600 fw-bold fs-6">{{ ($item->total_amount) }}</span>
                                        </td>
                                        <td class="text-end pe-12">
                                            @if($item->status == 'paid')
                                                <span class="badge py-3 px-4 fs-7 badge-light-success">Paid</span>
                                            @elseif($item->status == 'partial')
                                                <span class="badge py-3 px-4 fs-7 badge-light-warning">Partial</span>
                                           @else
                                                <span class="badge py-3 px-4 fs-7 badge-light-danger">Due</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{route('receptionist.application.view', $item->id)}}" target="_blank" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card-flush h-md-100">
                <div class="card-header pt-5 mb-6">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Invoices</span>
                        <span class="fs-6 fw-semibold text-gray-400">Due - {{$invoices->where('status', 'due')->count()}}</span>
                    </h3>
                </div>
                <div class="card-body py-0 px-0">
                    <div class="table-responsive mx-9 mt-n6">
                        <table class="table align-middle gs-0 gy-4">
                            <thead>
                                <tr>
                                    <th class="min-w-100px"></th>
                                    <th class="min-w-50px text-end pe-0"></th>
                                    <th class="text-end min-w-100px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices->where('status', 'due')->take(6) as $item)
                                    <tr>
                                        <td>
                                            <a href="{{route('receptionist.application.view', $item->id)}}" target="_blank"><span class="text-gray-800 fw-bold fs-6 me-1">{{$item->number}}</span></a>
                                        </td>
                                        <td class="pe-0 text-end">
                                            <span class="badge badge-light-danger fs-7">{{ucfirst($item->status)}}</span>
                                        </td>
                                        <td class="pe-0 text-end">
                                            <a href="#" class="text-gray-600 fw-bold fs-6">{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Invoice-->
</div>

@push('scripts')
    <script>
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#kt_daterangepicker_4").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));

            var range = [start.format('Y-M-D'), end.format('Y-M-D')];
            Livewire.dispatch('getEventByDate', range, true)
        }

        $("#kt_daterangepicker_4").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            }
        }, cb);

        cb(start, end);
    </script>
@endpush