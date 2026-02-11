<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        <base href="../../../"/>
		<title>{{ $title ?? config('app.name') }}</title>
		<meta charset="utf-8" />
		<meta name="description" content="@yield('page-title') - {{ config('setting.name') }}" />
		<meta name="keywords" content="monarchy, marketing, google, facebook" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="@yield('page-title') - {{ config('setting.name') }}" />
		<meta property="og:url" content="{{config('setting.website')}}" />
		<meta property="og:site_name" content="@yield('page-title') - {{ config('setting.name') }}" />
		<link rel="canonical" href="{{config('setting.website')}}" />
		<link rel="shortcut icon" href="{{ asset(config('setting.favicon'))}}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{asset('assets/backend/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/backend/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		@stack('styles')
        @livewireStyles
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank">
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			{{$slot}}
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		{{-- <script>var hostUrl = "assets/";</script> --}}
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{asset('assets/backend/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/backend/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{asset('assets/backend/js/custom/authentication/sign-in/general.js')}}"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->

        @stack('scripts')
        @livewireScripts
	</body>
	<!--end::Body-->
</html>
