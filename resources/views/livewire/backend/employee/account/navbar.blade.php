<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    @if (auth()->user()->avatar)
                        <img src="{{asset(auth()->user()->avatar)}}" alt="{{auth()->user()->name}}" />
                    @else
                        <img src="{{asset('assets\media\avatars\blank.png')}}" alt="avatar" />
                    @endif

                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{auth()->user()->name}}</a>
                            <a href="#">
                                <i class="ki-duotone ki-verify fs-1  @if(auth()->user()->email_verified_at) text-primary @else text-danger @endif">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                        </div>
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i> {{auth()->user()->type}} </a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i> {{auth()->user()->employee->department->name}}
                            </a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i> {{auth()->user()->employee->designation}}
                            </a>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                </div>
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="fs-2 fw-bold">{{auth()->user()->employee->employee_id}}</div>
                                <div class="fw-semibold fs-6 text-gray-400">Employee ID</div>
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                               <div class="fs-2 fw-bold">৳ {{auth()->user()->employee->basic_salary}}</div>
                                <div class="fw-semibold fs-6 text-gray-400">Basic Salary</div>
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="fs-2 fw-bold">{{ \Carbon\Carbon::parse(auth()->user()->employee->join_date)->format('d M Y') }}</div>
                                <div class="fw-semibold fs-6 text-gray-400">Join Date</div>
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Wrapper-->
                </div>
            </div>
        </div>
        <!--end::Details-->

        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('employee.account.overview') == true ? 'active' : '' }}" href="{{route('employee.account.overview')}}"> Overview </a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('employee.account.setting') == true ? 'active' : '' }}" href="{{route('employee.account.setting')}}"> Settings </a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('employee.account.activity') == true ? 'active' : '' }}" href="{{route('employee.account.activity')}}"> Activity </a>
            </li>
        </ul>

    </div>
</div>


    @push('scripts')
        <script src="{{asset('assets/backend/js/custom/account/settings/signin-methods.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/account/settings/profile-details.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/account/settings/deactivate-account.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/pages/user-profile/general.js')}}"></script>
        <script src="{{asset('assets/backend/js/widgets.bundle.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/widgets.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/apps/chat/chat.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/utilities/modals/create-app.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/utilities/modals/offer-a-deal/type.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/utilities/modals/offer-a-deal/details.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/utilities/modals/offer-a-deal/finance.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/utilities/modals/offer-a-deal/complete.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/utilities/modals/offer-a-deal/main.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/utilities/modals/two-factor-authentication.js')}}"></script>
        <script src="{{asset('assets/backend/js/custom/utilities/modals/users-search.js')}}"></script>
    @endpush
