@section('page-title') Reset Password @endsection

<!--begin::Authentication - Sign-in -->
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Body-->
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
        <!--begin::Form-->
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10">
                <!--begin::Form-->
                <form action="{{ route('reset.password') }}" method="POST" class="form w-100" novalidate="novalidate">
                {{-- <form wire:submit.prevent="login" > --}}
                    @csrf
                    <div class="text-center mb-11">
                        <h1 class="text-dark fw-bolder mb-3">Reset Password</h1>
                    </div>
                    @if (session()->has('message'))
                        <div class="text-center text-danger fw-semibold fs-6 mb-4">{{ session('message') }}</div>
                    @endif

                    <div class="hidden">
                        <input type="hidden" name="email" value="{{$data->email}}">
                        <input type="hidden" name="token" value="{{$data->token}}">
                    </div>
                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <div class="mb-1">
                            <label class="form-label mb-3">Password</label>
                            <div class="position-relative mb-3">
                                <input type="password" name="password" class="form-control bg-transparent" placeholder="Password" autocomplete="off" />
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="ki-duotone ki-eye-slash fs-2"></i>
                                    <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                </span>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                        </div>
                        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="form-label mb-3">Password Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control bg-transparent" placeholder="Repeat Password" autocomplete="off"/>
                        @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-grid mb-10">
                        <button type="submit" class="btn btn-primary">Send Password Reset Link </button>
                    </div>

                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Form-->
        <!--begin::Footer-->
        <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
            <!--begin::Links-->
            <div class="d-flex fw-semibold text-primary fs-base gap-5">
                <a href="{{route('front.privacypolicy')}}" target="_blank">Privacy Policy</a>
                <a href="{{route('front.about')}}" target="_blank">About Us</a>
                <a href="{{route('front.contact')}}" target="_blank">Contact Us</a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Body-->
    <!--begin::Aside-->
    <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{config('setting.auth_fg_image')}})">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
            <!--begin::Logo-->
            <a href="#" class="mb-0 mb-lg-12">
                <img alt="Logo" src="{{config('setting.logo')}}" class="h-60px h-lg-75px" />
            </a>
            <!--end::Logo-->
            <!--begin::Image-->
            <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{config('setting.auth_bg_image')}}" alt="{{config('setting.name')}}" />
            <!--end::Image-->
            <!--begin::Title-->
            <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">{{config('setting.auth_title')}}</h1>
            <!--end::Title-->
            <!--begin::Text-->
            <div class="d-none d-lg-block text-white fs-base text-center w-75">{{config('setting.auth_detail')}}</div>
            <!--end::Text-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Aside-->
</div>
<!--end::Authentication - Sign-in-->
