<section class="wptb-credential bg-image" style="background-image: url('{{ asset('assets/frontend/assets/img/background/bg-9.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 offset-lg-2 offset-md-1">
                <div class="wptb-item--inner">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner text-center">
                            <h1 class="wptb-item--title"> <span>Log In</span></h1>

                            @if (session()->has('error'))
                                <div class="text-center text-danger fw-semibold fs-6 mb-4">{{ session('error') }}</div>
                            @endif
                            @if (session()->has('success'))
                                <div class="text-center text-success fw-semibold fs-6 mb-4">{{ session('success') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <!--begin::Google link=-->
                            <a href="{{ url('auth/google') }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo" src="{{ asset('assets/backend/media/svg/brand-logos/google-icon.svg')}}" class="h-15px me-3" />Sign in with Google</a>
                            <!--end::Google link=-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 mt-3 mt-md-0">
                            <!--begin::Google link=-->
                            <a href="{{ url('auth/facebook') }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo" src="{{ asset('assets/backend/media/svg/brand-logos/facebook-4.svg')}}" class="h-15px me-3" />Sign in with Facebook</a>
                            <!--end::Google link=-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        {{-- <div class="col-md-6">
                            <!--begin::Apple link=-->
                            <a href="{{ url('auth/apple') }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo" src="{{ asset('assets/backend/media/svg/brand-logos/apple-black.svg')}}" class="theme-light-show h-15px me-3" />
                            <img alt="Logo" src="{{ asset('assets/backend/media/svg/brand-logos/apple-black-dark.svg')}}" class="theme-dark-show h-15px me-3" />Sign in with Apple</a>
                            <!--end::Apple link=-->
                        </div> --}}
                        <!--end::Col-->
                    </div>

                    <div class="separator separator-content my-4 text-center">
                        <span class="w-125px text-white fw-semibold fs-6">Or with email</span>
                    </div>

                    <form wire:submit.prevent="store" class="credential-form" method="post">
                        <div class="form-group mb-4">
                            <input type="email" wire:model="email" class="form-control" placeholder="Email Address">
                        </div>

                        <div class="form-group mb-4">
                            <input type="password" wire:model="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group mb-2 ms-4">
                            <input type="checkbox" wire:model="remember">
                            <label for="remmeber" class="text-white">Remmeber Password</label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="mb-4 btn mr-top-30">
                                <span class="btn-readmore--text"> Log In </span>
                            </button>

                            <div class="form-group">
                                <a href="{{route('forget.password')}}" class="text-danger">Forgot Password?</a>
                            </div>
                            <div class="form-group">
                                <div class="text-white fw-semibold fs-6">Not a Member yet?
                                <a href="{{route('signup')}}" class="text-danger">Sign up</a></div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        input[type="submit"], .btn {
            padding: 14px 50px;
        }
        .credential-form .form-control {
            height: 56px;
        }
        .btn:before {
            background: none;
        }
    </style>
@endpush