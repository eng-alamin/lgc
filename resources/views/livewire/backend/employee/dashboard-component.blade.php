<div id="kt_app_content_container" class="app-container container-fluid" wire:poll.30s>
    <!--begin::Row-->
    <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-4 mb-md-5 mb-xl-10">
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
                        <span class="fs-2hx fw-bold text-white me-2">{{$totalPresent}}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>Total Present</span>
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
                        <span class="fs-2hx fw-bold text-white me-2">{{$totalAbsent}}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>Total Absent</span>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 mb-md-5 mb-xl-10">
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
                        <span class="fs-2hx fw-bold text-white me-2">{{$totalLeave}}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>Total Leave  </span>
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
                        <span class="fs-2hx fw-bold text-white me-2">{{$totalOvertime}}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>Total Overtime</span>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 mb-md-5 mb-xl-10">
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
                        <span class="fs-2hx fw-bold text-white me-2">{{$thisMonthSalary}}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>This Month Salary</span>
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
                        <span class="fs-2hx fw-bold text-white me-2">{{$todayStatus}}</span>
                    </div>
                    <div class="fw-bold fs-6 text-white opacity-75">
                        <span>Today Status</span>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>