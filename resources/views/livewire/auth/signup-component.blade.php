<section class="wptb-credential bg-image" style="background-image: url('{{ asset('assets/frontend/assets/img/background/bg-9.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 offset-lg-2 offset-md-1">
                <div class="wptb-item--inner">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner text-center">
                            <h1 class="wptb-item--title"> <span>Sign Up</span></h1>
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

                    <form wire:submit.prevent="store" class="credential-form">
                        <div class="form-group mb-4">
                            <input type="text" wire:model="name" class="form-control" placeholder="Name">
                             @error('name') <span class="form-text text-danger pt-2 ps-4">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input type="email" wire:model="email" class="form-control" placeholder="Email">
                             @error('name') <span class="form-text text-danger pt-2 ps-4">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" wire:model="phone" class="form-control" placeholder="Phone">
                             @error('phone') <span class="form-text text-danger pt-2 ps-4">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" wire:model="password" class="form-control" placeholder="Password">
                            @error('password') <span class="form-text text-danger pt-2 ps-4">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" wire:model="password_confirmation" class="form-control" placeholder="Repeat Password">
                            @error('password_confirmation') <span class="form-text text-danger pt-2 ps-4">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2 ms-4">
                            <input type="checkbox" wire:model="toc">
                            <label for="toc" class="text-white">I Accept the <a href="#" target="_blank" class="ms-1 link-primary">Terms</a></label> <br>
                            @error('toc') <span class="form-text text-danger pt-2 ps-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="mb-4 btn mr-top-30">
                                <span class="btn-readmore--text"> Sign up </span>
                            </button>
                            <div class="form-group">
                                <div class="text-white fw-semibold fs-6">Already have an Account?
                                <a href="{{route('signin')}}" class="text-danger">Sign in</a></div>
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