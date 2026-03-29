<div id="kt_app_sidebar" class="app-sidebar flex-column no-print" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{route('home')}}">
            <img alt="Logo" src="{{asset('assets/backend/media/logos/default-dark.png')}}" class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="{{asset('assets/backend/media/logos/default-small.png')}}" class="h-20px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <!--begin::Minimized sidebar setup:
            if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") {
                1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
            }
        -->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/dashboard') == true ? 'active' : '' }}" href="{{route('receptionist.dashboard')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/client/list') == true ? 'active' : '' }}" href="{{route('receptionist.client.list')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Clients</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/agents') == true ? 'active' : '' }}" href="{{route('receptionist.agents')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Agents</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/application/') == true ? 'active' : '' }}" href="{{route('receptionist.application.list')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Registration</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/appointments') == true ? 'active' : '' }}" href="{{route('receptionist.appointments')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Appointments</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/invoices') == true ? 'active' : '' }}" href="{{route('receptionist.invoices')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Invoices</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/calendars') == true ? 'active' : '' }}" href="{{route('receptionist.calendars')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Calendars</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/contacts') == true ? 'active' : '' }}" href="{{route('receptionist.contacts')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Contacts</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/calllogs') == true ? 'active' : '' }}" href="{{route('receptionist.calllogs')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Calll Logs</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/followups') == true ? 'active' : '' }}" href="{{route('receptionist.followups')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Follow Ups</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'receptionist/documents') == true ? 'active' : '' }}" href="{{route('receptionist.documents')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Documents</span>
                        </a>
                    </div>

                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">More</span>
                        </div>
                    </div>

                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ str_contains(request()->url(), 'admin/account') == true ? 'here show' : '' }}">
                        <span class="menu-link {{ str_contains(request()->url(), 'admin/account') == true ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-plus fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Account</span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('receptionist.account.overview') == true ? 'active' : '' }}" href="{{ route('receptionist.account.overview') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Overview</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('receptionist.account.setting') == true ? 'active' : '' }}" href="{{ route('receptionist.account.setting') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Settings</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('receptionist.account.activity') == true ? 'active' : '' }}" href="{{ route('receptionist.account.activity') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Activity</span>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{route('clear')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-rocket fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Clear</span>
                        </a>
                    </div>
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="{{route('home')}}" target="_blank" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100">
            <span class="btn-label">Let's Go China</span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div>
    <!--end::Footer-->
</div>