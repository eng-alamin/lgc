@section('page-title') Fotgot Password @endsection

<!--begin::Authentication - Sign-in -->
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Body-->
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
        <!--begin::Form-->
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10">
                <!--begin::Form-->
                <form action="{{ route('forget.password') }}" method="POST" class="form w-100" novalidate="novalidate">
                    @csrf
                    <div class="text-center mb-11">
                        <h1 class="text-dark fw-bolder mb-3">Forget Password</h1>
                    </div>

                    @if (session()->has('error'))
                        <div class="text-center text-danger fw-semibold fs-6 mb-4">{{ session('error') }}</div>
                    @endif
                    @if (session()->has('success'))
                        <div class="text-center text-success fw-semibold fs-6 mb-4">{{ session('success') }}</div>
                    @endif

                    <div class="fv-row mb-8">
                        <input type="text" wire:model="email" name="email" autocomplete="off" class="form-control bg-transparent" placeholder="Email" />
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
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
