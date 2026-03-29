<div class="col-lg-12">
    <div class="card mb-5 mb-xxl-8">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        @if ($client->user->avatar)
                            <img src="{{asset($client->user->avatar)}}" alt="{{$client->user->name}}" />
                        @else
                            <img src="{{asset('assets\backend\media\avatars\blank.png')}}" alt="avatar" />
                        @endif

                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="javascript:;" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{$client->user->name}}</a>
                                <a href="javascript:;">
                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i></a>
                            </div>
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="javascript:;" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>{{ucfirst($client->service ?? 'N/L')}}</a>
                                <a href="javascript:;" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-phone fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>{{$client->user->phone}}</a>
                                <a href="javascript:;" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>{{$client->user->email}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-stack">
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                           @php
                                $total_amount = $this->form?->invoices->sum('total_amount') ?? 0;
                                $due_amount = $this->form?->invoices->sum('due_amount') ?? 0;
                                $paid_amount = $this->form?->invoices->sum('paid_amount') ?? 0;
                                $paidPercent = $total_amount > 0 ? ($paid_amount / $total_amount) * 100 : 0;
                            @endphp
                            <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $total_amount }}" data-kt-countup-prefix="৳">0</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">Price</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $due_amount }}" data-kt-countup-prefix="৳">0</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">Due</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $paidPercent }}" data-kt-countup-prefix="%">0</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">Paid</div>
                                </div>
                            </div>
                        </div>
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-semibold fs-6 text-gray-400">Profile Compleation</span>
                                <span class="fw-bold fs-6">{{ $this->client?->profile_completion ?? 0 }}%</span>
                            </div>
                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                <div class="bg-success rounded h-5px" role="progressbar" style="width: {{ $this->client?->profile_completion ?? 0 }}%;" aria-valuenow="{{ $this->client?->profile_completion ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
            <!--begin::Navs-->
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <!--begin::Nav item-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="../../demo1/dist/pages/user-profile/overview.html">Overview</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                {{-- <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5" href="Documentations.html">Documentations</a>
                </li> --}}
                <!--end::Nav item-->
            </ul>
            <!--begin::Navs-->
        </div>
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
