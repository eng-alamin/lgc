<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Immigway - Immigration & Visa Solutions Template">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon and touch Icons -->
    <link href="{{ asset(config('setting.favicon')) }}" rel="shortcut icon" type="image/png">
    <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon.html') }}" rel="apple-touch-icon">
    <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon-72x72.html') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon-114x114.html') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ asset('assets/frontend/assets/img/apple-touch-icon-144x144.html') }}" rel="apple-touch-icon" sizes="144x144">

    <title>{{ $title ?? config('app.name') }}</title>
        
    <!-- Styles Include -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/main.css') }}">
    {{-- <script src="{{ asset('js/custom.js') }}" defer></script> --}}
    

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
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
                <p><a href="mailto:support@immigway.com">support@letsgochinaofficial.com</a></p>
                <p><a href="tel:(+987) 654 321 228 14">(+987) 654 321 228 14</a></p>
                <p>House-4, Road-3, Nigunjo-2, Khilkhet, Dhaka, Bangladesh</p>
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

    @stack('scripts')
    @livewireScripts
</body>
</html>
