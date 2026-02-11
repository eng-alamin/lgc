<!-- Main Header -->
<header class="header">
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
                            <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('workprocess') ? 'active' : '' }}">
                                <a href="{{ route('workprocess') }}">Work Process</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('essential') ? 'active' : '' }}">
                                <a href="{{ route('essential') }}">Essentials</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('visa') ? 'active' : '' }}">
                                <a href="{{ route('visa') }}">Visa</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('blog') ? 'active' : '' }}">
                                <a href="{{ route('blog') }}">Blog</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                                <a href="{{ route('contact') }}">Contact</a>
                            </li>

                            {{-- <li class="menu-item menu-item-has-children"><a href="#">Visa</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="visa-list.html">Visa List</a></li>
                                    <li class="menu-item"><a href="tourist-visa.html">Tourist Visa</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="header_search">
                        <form class="search_form" action="https://wpthemebooster.com/demo/themeforest/html/immigway/search.php">
                            <input type="text" name="search" class="keyword form-control" placeholder="Search..." />
                            <button type="submit" class="form-control-submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>

                    <button class="aside_open">
                        <img src="{{ asset('assets/frontend/assets/img/icon_grid.png') }}" alt="img">
                    </button>

                    <button type="button" class="mr_menu_toggle d-xl-none">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Main Header -->	