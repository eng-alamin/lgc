 <!-- Footer -->
        <footer class="footer style1" style="background-image: url('{{ asset('assets/frontend/assets/img/background/bg-1.jpg') }}');">
            <div class="footer-top">
                <div class="container">
                    <div class="footer-upper-contact">
                        <div class="row">
                            <!-- Left Box -->
                            <div class="col-lg-3 col-sm-6 mb-4 mb-sm-0">
                                <div class="logo">
                                    <a href="{{ route('home') }}" class="light_logo"><img src="{{ asset(config('setting.logo')) }}" alt="{{config('setting.name')}}"></a>
                                </div>
                            </div>
                            
                            <!-- Right Box -->
                            <div class="col-lg-3 col-sm-6 mb-4 mb-sm-0">
                                <div class="wptb-icon-box1 wow fadeInLeft">
                                    <div class="wptb-item--inner flex-start">
                                        <div class="wptb-item--icon"><i class="bi bi-buildings"></i></div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">{!! config('setting.address') !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-sm-6 mb-4 mb-sm-0">
                                <div class="wptb-icon-box1 wow fadeInLeft">
                                    <div class="wptb-item--inner flex-start">
                                        <div class="wptb-item--icon"><i class="bi bi-telephone-fill"></i></div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">{{config('setting.phone')}}</p>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-sm-6 mb-4 mb-sm-0">
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-5 mb-5 mb-xl-0">
                            @php
                                use Illuminate\Support\Facades\DB;
                                $footer = DB::table('sections')->where('type', 'footer')->first();
                            @endphp
                            <h3 class="text-two">{{ $footer->title ?? '' }}</h3>
                            <p class="text-two">{{ $footer->description ?? '' }}</p>
                    

                            <a href="{{$footer->link}}" class="btn mt-4">
                                <span class="btn-wrap">
                                    <span class="text-first">Get Consultancy</span>
                                    <span class="text-second">Get Consultancy</span>
                                </span>
                            </a>
                        </div>

                        <div class="col-xl-7">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-5 mb-md-0">
                                    <div class="footer-widget footer-links">
                                        <div class="footer-nav">
                                            <ul>
                                                <li class="menu-item"><a href="{{ route('home') }}"><i class="bi bi-circle-fill"></i> Home </a></li>
                                                <li class="menu-item"><a href="{{ route('about') }}"><i class="bi bi-circle-fill"></i> About Company</a></li>
                                                {{-- <li class="menu-item"><a href="timeline.html"><i class="bi bi-circle-fill"></i> Our Experience</a></li> --}}
                                                <li class="menu-item"><a href="{{route('casestudies')}}"><i class="bi bi-circle-fill"></i> Case Studies</a></li>
                                                <li class="menu-item"><a href="{{ route('appointment') }}"><i class="bi bi-circle-fill"></i> Get Appointment</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-md-4 col-sm-6 mb-5 mb-md-0">
                                    <div class="footer-widget footer-links">
                                        <div class="footer-nav">
                                            <ul>
                                                <li class="menu-item"><a href="{{ route('workprocess') }}"><i class="bi bi-circle-fill"></i> Work Process</a></li>
                                                <li class="menu-item"><a href="{{ route('essential') }}"><i class="bi bi-circle-fill"></i> Essentials</a></li>
                                                <li class="menu-item"><a href="{{ route('visa') }}"><i class="bi bi-circle-fill"></i> Visa</a></li>
                                                <li class="menu-item"><a href="{{ route('blogs') }}"><i class="bi bi-circle-fill"></i> Blogs</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-md-4 col-sm-6 mb-5 mb-md-0">
                                    <div class="footer-widget footer-links">
                                        <div class="footer-nav">
                                            <ul>
                                                <li class="menu-item"><a href="{{ route('universities') }}"><i class="bi bi-circle-fill"></i> Top Universities</a></li>
                                                <li class="menu-item"><a href="{{ route('courses') }}"><i class="bi bi-circle-fill"></i> Top Courses</a></li>
                                                <li class="menu-item"><a href="{{ route('teams') }}"><i class="bi bi-circle-fill"></i> Meet Our Team</a></li>
                                                <li class="menu-item"><a href="{{ route('contact') }}"><i class="bi bi-circle-fill"></i> Contact Us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom Part -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-bottom-inner">
                        <div class="copyright">
                            <p>&copy;copyright {{ date('Y') }} <a href="https://monarchysolutions.com/" class="text-capitalize">Monarchy Solutions</a>. All rights reserved</p>
                        </div>
                        <div class="footer-nav-bottom">
                            <ul>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Term of Use</a></li>
                                <li><a href="#">Support</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>