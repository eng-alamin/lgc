<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="#">
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
                        <a class="menu-link {{ str_contains(request()->url(), 'admin/dashboard') == true ? 'active' : '' }}" href="{{route('admin.dashboard')}}">
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
                        <a class="menu-link {{ str_contains(request()->url(), 'admin/appointments') == true ? 'active' : '' }}" href="{{route('admin.appointments')}}">
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
                        <a class="menu-link {{ str_contains(request()->url(), 'admin/contacts') == true ? 'active' : '' }}" href="{{route('admin.contacts')}}">
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
                        <a class="menu-link {{ str_contains(request()->url(), 'admin/subscribers') == true ? 'active' : '' }}" href="{{route('admin.subscribers')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Subscribers</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'admin/clients') == true ? 'active' : '' }}" href="{{route('admin.clients')}}">
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
                        <a class="menu-link {{ str_contains(request()->url(), 'admin/employees') == true ? 'active' : '' }}" href="{{route('admin.employees')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-address-book fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Employees</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(request()->url(), 'admin/activities') == true ? 'active' : '' }}" href="{{route('admin.activities')}}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-menu fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Activities</span>
                        </a>
                    </div>

                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Frontend Development</span>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ str_contains(request()->url(), 'admin/crud/') == true ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-7 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">CRUD Operation</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/sliders') == true ? 'active' : '' }}" href="{{route('admin.crud.slider')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Sliders</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/features') == true ? 'active' : '' }}" href="{{route('admin.crud.feature')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Features</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/essentials') == true ? 'active' : '' }}" href="{{route('admin.crud.essential')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Essentials</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/provinces') == true ? 'active' : '' }}" href="{{route('admin.crud.province')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Provinces</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/chooses') == true ? 'active' : '' }}" href="{{route('admin.crud.choose')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Chooses</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/faqs') == true ? 'active' : '' }}" href="{{route('admin.crud.faq')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Faqs</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/testimonials') == true ? 'active' : '' }}" href="{{route('admin.crud.testimonial')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Testimonials</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/logos') == true ? 'active' : '' }}" href="{{route('admin.crud.logo')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Logos</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/blogs') == true ? 'active' : '' }}" href="{{route('admin.crud.blog')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Blogs</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/workprocesses') == true ? 'active' : '' }}" href="{{route('admin.crud.workprocess')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Work Processes</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/visas') == true ? 'active' : '' }}" href="{{route('admin.crud.visa')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Visas</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/teams') == true ? 'active' : '' }}" href="{{route('admin.crud.teams')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Teams</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/casestudies') == true ? 'active' : '' }}" href="{{route('admin.crud.casestudies')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Case Studies</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/universities') == true ? 'active' : '' }}" href="{{route('admin.crud.universities')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Universities</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/crud/courses') == true ? 'active' : '' }}" href="{{route('admin.crud.courses')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Courses</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ str_contains(request()->url(), 'admin/section/') == true ? 'here show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-file fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Section Development</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/feature') == true ? 'active' : '' }}" href="{{route('admin.section.feature')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Features</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/essential') == true ? 'active' : '' }}" href="{{route('admin.section.essential')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Essentials</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/intro') == true ? 'active' : '' }}" href="{{route('admin.section.intro')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Intro</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/about') == true ? 'active' : '' }}" href="{{route('admin.section.about')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">About</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/choose') == true ? 'active' : '' }}" href="{{route('admin.section.choose')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Chooses</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/funfact') == true ? 'active' : '' }}" href="{{route('admin.section.funfact')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Funfacts</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/faq') == true ? 'active' : '' }}" href="{{route('admin.section.faq')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Faqs</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/process') == true ? 'active' : '' }}" href="{{route('admin.section.process')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Work Processes</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/visa') == true ? 'active' : '' }}" href="{{route('admin.section.visa')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Visas</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/testimonial') == true ? 'active' : '' }}" href="{{route('admin.section.testimonial')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Testimonial</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/team') == true ? 'active' : '' }}" href="{{route('admin.section.team')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Teams</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/blog') == true ? 'active' : '' }}" href="{{route('admin.section.blog')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Blogs</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/casestudies') == true ? 'active' : '' }}" href="{{route('admin.section.casestudies')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Case Studies</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/contact') == true ? 'active' : '' }}" href="{{route('admin.section.contact')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Contact</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/subscriber') == true ? 'active' : '' }}" href="{{route('admin.section.subscriber')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Subscriber</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/university') == true ? 'active' : '' }}" href="{{route('admin.section.university')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">University</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/course') == true ? 'active' : '' }}" href="{{route('admin.section.course')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Course</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(request()->url(), 'admin/section/footer') == true ? 'active' : '' }}" href="{{route('admin.section.footer')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Footer Section</span>
                                </a>
                            </div>
                        </div>
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
                                <a class="menu-link {{ Route::is('admin.account.overview') == true ? 'active' : '' }}" href="{{ route('admin.account.overview') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Overview</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('admin.account.setting') == true ? 'active' : '' }}" href="{{ route('admin.account.setting') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Settings</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('admin.account.activity') == true ? 'active' : '' }}" href="{{ route('admin.account.activity') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Activity</span>
                                </a>
                            </div>
                        </div>

                    </div>
                    
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ str_contains(request()->url(), 'admin/setting/') == true ? 'here show' : '' }}">
                        <span class="menu-link  {{ str_contains(request()->url(), 'admin/setting/') == true ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-color-swatch fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                    <span class="path9"></span>
                                    <span class="path10"></span>
                                    <span class="path11"></span>
                                    <span class="path12"></span>
                                    <span class="path13"></span>
                                    <span class="path14"></span>
                                    <span class="path15"></span>
                                    <span class="path16"></span>
                                    <span class="path17"></span>
                                    <span class="path18"></span>
                                    <span class="path19"></span>
                                    <span class="path20"></span>
                                    <span class="path21"></span>
                                </i>
                            </span>
                            <span class="menu-title">Settings</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a href="{{route('admin.setting.app')}}" class="menu-link {{ str_contains(request()->url(), 'admin/setting/app') == true ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">App Settings</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="{{route('admin.setting.auth')}}" class="menu-link {{ str_contains(request()->url(), 'admin/setting/auth') == true ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Auth Settings</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="{{route('admin.setting.email')}}" class="menu-link {{ str_contains(request()->url(), 'admin/setting/email') == true ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Email Settings</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="{{route('admin.setting.protection')}}" class="menu-link {{ str_contains(request()->url(), 'admin/setting/protection') == true ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Protection Settings</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="{{route('admin.setting.meta')}}" class="menu-link {{ str_contains(request()->url(), 'admin/setting/meta') == true ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Meta Settings</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="{{route('admin.setting.other')}}" class="menu-link {{ str_contains(request()->url(), 'admin/setting/other') == true ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Other Settings</span>
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
        <a href="https://preview.keenthemes.com/html/metronic/docs" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
            <span class="btn-label">Docs & Components</span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div>
    <!--end::Footer-->
</div>