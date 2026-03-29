<!DOCTYPE html>
<html lang="en">
	<head>
		<base href=""/>
		<title>{{ $title ?? config('app.name') }}</title>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset(config('setting.favicon'))}}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="{{asset('assets/backend/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/backend/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/backend/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        @stack('styles')
        @livewireStyles
    </head>
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script >
			var defaultThemeMode = "light";
			var themeMode;
			if (document.documentElement) {
				if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
					themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
				} else {
					if (localStorage.getItem("data-bs-theme") !== null) {
						themeMode = localStorage.getItem("data-bs-theme");
					} else {
						themeMode = defaultThemeMode;
					}
				}
				if (themeMode === "system") {
					themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
				}
				document.documentElement.setAttribute("data-bs-theme", themeMode);
			} 
		</script>
		<!--end::Theme mode setup on page load-->

		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header no-print" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
					@include('layouts.receptionist.header')
				</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

					<!--begin::Sidebar-->
					    @include('layouts.receptionist.sidebar')
					<!--end::Sidebar-->

					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Toolbar-->
							<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 no-print">
								@include('layouts.receptionist.toolbar')
							</div>
							<!--end::Toolbar-->

							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">
								{{ $slot }}
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->

						<!--begin::Footer-->
						<div id="kt_app_footer" class="app-footer no-print">
							@include('layouts.receptionist.footer')
						</div>
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Scrolltop-->

		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ asset('assets/backend/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('assets/backend/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->


        <script>
            // Close Modal
            window.addEventListener('closeModal', event => {
                $('#addModal').modal('hide');
                $('#editModal').modal('hide');
            });
            // Open Modal
            window.addEventListener('openModal', event => {
                $('#addModal').modal('show');
                $('#editModal').modal('show');
            })
            // selectpicker
            window.addEventListener('render-selectpicker', event => {
              $('.selectpicker').selectpicker();
            });

            //Side menu active hack
            $('a').click(function(){
              $('a.menu-item-active').each(function(){
                $(this).removeClass('menu-item-active');
              });
              $(this).addClass('menu-item-active');
            });

            $(function() {
                  bsCustomFileInput.init();
              });
        </script>

        {{-- Toast Notification --}}
        <script>
            @if(Session::has('success'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.success("{{ session('success') }}");
            @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.error("{{ session('error') }}");
            @endif

            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.info("{{ session('info') }}");
            @endif

            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.warning("{{ session('warning') }}");
            @endif
        </script>

        {{-- Sweet Alert Delete Script  --}}
        <script>
            window.addEventListener('showDeleteConfirmation', event =>{
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteConfirmed')
                }
                })
            });
            window.addEventListener('showDeleteConfirmation2', event =>{
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteConfirmed2')
                }
                })
            });
            window.addEventListener('doneDeleteSuccessful', event =>{
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            });
        </script>

		{{-- Start Vendor --}}
		<script src="{{ asset('assets/backend/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		{{-- End Vendor --}}

		{{-- Start Selectpicker --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
        {{-- End selectpicker --}}
        
        @stack('scripts')
        @livewireScripts
	</body>
	<!--end::Body-->
</html>