<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content='{{ $seo['description'] ?? config('setting.detail') }}'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $seo['title'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $seo['description'] ?? '' }}">
    <meta property="og:image" content="{{ $seo['image'] ?? '' }}">
    <meta property="og:url" content="{{ $seo['url'] ?? url()->current() }}">
    <meta property="og:type" content="{{ $seo['type'] ?? 'website' }}">

    @if(($seo['type'] ?? '') === 'article')
        <meta property="article:published_time" content="{{ $seo['published_at'] ?? '' }}">
        <meta property="article:author" content="{{ $seo['author'] ?? '' }}">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] ?? '' }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}">
    <meta name="twitter:image" content="{{ $seo['image'] ?? '' }}">
    {{-- <meta name="twitter:site" content="@yourusername">
    <meta name="twitter:creator" content="@yourusername"> --}}

    <!-- Favicon and touch Icons -->
    <link href="{{ asset(config('setting.favicon')) }}" rel="shortcut icon" type="image/png">
    <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon.html') }}" rel="apple-touch-icon">
    <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon-72x72.html') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon-114x114.html') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon-144x144.html') }}" rel="apple-touch-icon" sizes="144x144">

    {{-- CSS File  --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/main.css') }}">

    <!-- Schema -->
    <x-schema :data="\App\Helpers\SchemaHelper::organization()" />
    <x-schema :data="\App\Helpers\SchemaHelper::website()" />
    <x-schema :data="\App\Helpers\SchemaHelper::webpage($title ?? null)" />
    @stack('schemas')

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5GJXFX7P');</script>
    <!-- End Google Tag Manager -->

    <style>
        .blog-details .blog-details-inner .fulltext {
            font-size: 16px !important;
        }
    </style>

    @stack('styles')
    @livewireStyles
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-inner">
            <div class="spinner"></div>
            <div class="loading-text">
                <span data-preloader-text="L" class="characters">L</span>
                
                <span data-preloader-text="E" class="characters">E</span>
                
                <span data-preloader-text="T" class="characters">T</span>
                
                <span data-preloader-text="'" class="characters">'</span>

                <span data-preloader-text="S" class="characters">S</span>

                <span data-preloader-text=" " class="characters"> </span>
                
                <span data-preloader-text="G" class="characters">G</span>

                <span data-preloader-text="O" class="characters">O</span>

                <span data-preloader-text=" " class="characters"> </span>

                <span data-preloader-text="C" class="characters">C</span>

                <span data-preloader-text="H" class="characters">H</span>

                <span data-preloader-text="I" class="characters">I</span>

                <span data-preloader-text="N" class="characters">N</span>

                <span data-preloader-text="A" class="characters">A</span>
            </div>
        </div>
    </div>

    @include('layouts.frontend.header')

    <!-- Mobile Responsive Menu -->
    <div class="mr_menu">
        <button type="button" class="mr_menu_close"><i class="bi bi-x-lg"></i></button>
        <div class="logo"></div> <!-- Keep this div empty. Logo will come here by JavaScript -->
        <div class="mr_navmenu"></div> <!-- Keep this div empty. Menu will come here by JavaScript -->
    </div>

    <!-- Aside Info -->
    <div class="aside_info_wrapper">
        <button class="aside_close"><i class="bi bi-x-lg"></i></button>
        <div class="aside_logo">
            <a href="{{ route('home') }}"><img src="{{ asset( config('setting.logo') ) }}" alt="Let's Go China"></a>
        </div>
        <div class="aside_info_inner">
            
            <h5>About Us</h5>

            <p>Let's Go China a full-service consultation firm with record of winning many successful campaigns. For a growing business firm we provide market research & competitor analysis before a product launch in market.</p>
            
            <div class="aside_info_inner_box">
                <h5>Contact Info</h5>
                <p><a href="mailto:{{config('setting.email')}}">{{config('setting.email')}}</a></p>
                <p><a href="tel:{{config('setting.phone')}}">{{config('setting.phone')}}</a></p>
                <p>{{ strip_tags(config('setting.address')) }}</p>
            </div>
            <div class="social_sites">
                <ul class="d-flex align-items-center justify-content-center">
                    <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                    <li><a href="#"><i class="bi bi-twitter-x"></i></a></li>
                    <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                    <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Main Wrapper-->
    <main class="wrapper">
        {{ $slot }}
    </main>

    @include('layouts.frontend.footer')

    <div class="totop">
        <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>
        

    <!-- Core JS -->
    <script src="{{ asset('assets/frontend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Framework -->
    <script src="{{ asset('assets/frontend/assets/js/bootstrap.min.js') }}"></script>
    
    <!-- WOW Scroll Effect -->
    <script src="{{ asset('assets/frontend/plugins/wow/wow.min.js') }}"></script>

    <!-- Swiper Slider -->
    <script src="{{ asset('assets/frontend/plugins/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Odometer Counter -->
    <script src="{{ asset('assets/frontend/plugins/odometer/appear.js') }}"></script>
    <script src="{{ asset('assets/frontend/plugins/odometer/odometer.js') }}"></script>

    <!-- Fancybox -->
    <script src="{{ asset('assets/frontend/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

    <!-- Flatpickr -->
    <script src="{{ asset('assets/frontend/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Nice Select -->
    <script src="{{ asset('assets/frontend/plugins/nice-select/jquery.nice-select.min.js') }}"></script>

    <!-- Theme Custom JS -->
    <script src="{{ asset('assets/frontend/assets/js/theme.js') }}"></script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5GJXFX7P"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    @stack('scripts')
    @livewireScripts
</body>
</html>
