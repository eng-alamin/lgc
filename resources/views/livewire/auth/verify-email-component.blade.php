@section('page-title') Verify @endsection

<style>body { background-image: url({{asset('assets/backend/media/auth/bg5.jpg')}}); } [data-bs-theme="dark"] body { background-image: url({{asset('assets/backend/media/auth/bg5-dark.jpg')}}); }</style>

    <div class="d-flex flex-column flex-center flex-column-fluid">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center text-center p-10">
            <!--begin::Wrapper-->
            <div class="card card-flush w-lg-650px py-5">
                <div class="card-body py-15 py-lg-20">
                    <!--begin::Logo-->
                    <div class="mb-14">
                        <a href="{{route('home')}}" class="">
                            <img alt="{{config('setting.name')}}" src="{{config('setting.logo')}}" class="h-40px" />
                        </a>
                    </div>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="fw-bolder text-success mb-5">Verify your email successfully</h1>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <div class="mb-11">
                        <a href="{{route('dashboard')}}" class="btn btn-sm btn-primary">Dashboard</a>
                    </div>
                    <!--end::Link-->
                    <!--begin::Illustration-->
                    <div class="mb-0">
                        <img src="{{asset('assets/backend/media/auth/please-verify-your-email.png')}}" class="mw-100 mh-300px theme-light-show" alt="" />
                        <img src="{{asset('assets/backend/media/auth/please-verify-your-email-dark.png')}}" class="mw-100 mh-300px theme-dark-show" alt="" />
                    </div>
                    <!--end::Illustration-->
                </div>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>

