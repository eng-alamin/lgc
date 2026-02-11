<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('admin.setting.app') == true ? 'active' : '' }}" href="{{route('admin.setting.app')}}"> App Settings </a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('admin.setting.auth') == true ? 'active' : '' }}" href="{{route('admin.setting.auth')}}"> Auth Settings </a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('admin.setting.email') == true ? 'active' : '' }}" href="{{route('admin.setting.email')}}"> Email Settings </a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('admin.setting.protection') == true ? 'active' : '' }}" href="{{route('admin.setting.protection')}}"> Protection Settings </a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('admin.setting.meta') == true ? 'active' : '' }}" href="{{route('admin.setting.meta')}}"> Meta Settings </a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::is('admin.setting.other') == true ? 'active' : '' }}" href="{{route('admin.setting.other')}}"> Other Settings </a>
            </li>
        </ul>
    </div>
</div>
