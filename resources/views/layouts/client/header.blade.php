<!-- Main Header -->
<header class="header no-print">
    <!-- Top Bar -->
    <div class="header-top">
        <div class="container">
            <div class="d-none d-xl-flex justify-content-between align-items-center flex-wrap">
                <!-- Left Box -->
                <div class="left-box d-flex align-items-center">
                    <!-- Social Box -->
                    <div class="social-box">
                        <ul>
                            @php $json_social = json_decode(config('setting.social'), true) @endphp
                            <li><a href="{{ $json_social['facebook'] ?? '#' }}" class="bi bi-facebook"></a></li>
                            <li><a href="{{ $json_social['youtube'] ?? '#' }}" class="bi bi-youtube"></a></li>
                            <li><a href="{{ $json_social['x'] ?? '#' }}" class="bi bi-twitter-x"></a></li>
                            <li><a href="{{ $json_social['linkedin'] ?? '#' }}" class="bi bi-linkedin"></a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Right Box -->
                <div class="right-box d-flex align-items-center">
                    <ul class="info-list">
                        <li><a href="mailto:{{ config('setting.email') }}"><span class="icon bi bi-envelope-fill"></span>{{ config('setting.email') }}</a></li>
                        <li><a href="#"><span class="icon bi bi-geo-alt-fill"></span>{{ strip_tags(config('setting.address')) }}</a></li>
                    </ul>

                    <!-- Button Box -->
                    <div class="button-box">
                        <a href="tel:+176845399" class="btn active clearfix">
                            <span><img src="{{ asset('assets/frontend/assets/img/icon_chat.png') }}" alt="chat icon"></span>
                            <span class="btn-wrap">
                                <span class="text-first">{{ config('setting.phone') }}</span>
                                <span class="text-second">{{ config('setting.phone') }}</span>
                            </span>
                        </a>
                    </div>

                     <ul class="info-list">
                        @guest
                            <li><a href="{{ route('login') }}">Signup / Signin</a></li>
                        @else
                            <li><a href="{{ url(auth()->user()->getRedirectRoute()) }}">{{auth()->user()->name}}</a></li>
                        @endguest
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <!-- Lower Bar -->
    <div class="header-inner">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Left Part -->
                <div class="header_left_part d-flex align-items-center">
                    <div class="logo">
                        <a href="{{ route('home') }}" class="light_logo"><img src="{{ asset(config('setting.logo')) }}" alt="{{config('setting.name')}}"></a>
                    </div>
                </div>

                <!-- Right Part -->
                <div class="header_right_part d-flex align-items-center">
                    <div class="mainnav d-none d-xl-block">
                        <ul class="main-menu">
                            <li class="menu-item {{ request()->routeIs('personalinfo') ? 'active' : '' }}">
                                <a href="{{ route('personalinfo') }}">Dashboard</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('form') ? 'active' : '' }}">
                                <a href="{{ route('form') }}">Form</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('logout') ? 'active' : '' }}">
                                <a href="{{ route('logout') }}">Sign Out</a>
                            </li>
                        </ul>
                    </div>

                    <button type="button" class="mr_menu_toggle d-xl-none">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Main Header -->	