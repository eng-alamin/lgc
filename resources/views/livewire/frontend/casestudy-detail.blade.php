<div>
    <!-- Details Content -->
    <section class="blog-details mt-5">
        <div class="container">
            <div class="row">
                    
                <!-- Service Navigation List -->
                <div class="col-lg-4 col-md-5 pe-md-5">
                    <div class="sidebar mt-5">                           
                        <div class="wptb-banner2 mr-top-30"> 
                            <div class="wptb-banner-inner"> 
                                <a class="wptb-item--link" href="tel:23456781199"></a>
                                <div class="wptb-item--image">
                                    <div class="wptb-item-img-primary " data-wow-delay="ms"> 
                                        <img src="{{asset('assets/frontend/assets/img/more/banner.jpg')}}" alt="">
                                    </div>
                                </div>
                        
                                <div class="wptb-wrap-content">
                                    <div class="wptb-wrap-shape"> 
                                        <svg class="wptb-svg-1" width="422" height="328" viewBox="0 0 422 328" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.287109 240.142C20.2871 205.285 96.63 135.228 242.001 133.856C385.076 132.507 421.433 46.9123 422.001 2.26061V0.14209C422.01 0.837364 422.011 1.54371 422.001 2.26061V327.571H0.287109V240.142Z"></path>
                                        </svg>
                                        <svg class="wptb-svg-2" width="422" height="329" viewBox="0 0 422 329" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M199.142 146.428C96.2852 139.571 23.7137 193.857 0.285156 221.857V328.142H421.999V0.713623C387.714 112.142 327.714 154.999 199.142 146.428Z"></path>
                                        </svg>
                                    </div>
                                <div class="wptb-content">
                                    <div class="wptb-item--title">Visa &amp; Let's Go China</div>
                                    <div class="wptb-item-contact-info">
                                            <div class="wptb-item--icon"> 
                                                <i class="bi bi-telephone-fill"></i>
                                            </div> 
                                            <span class="wptb-item--desc">Need Help? Book Lab Visit</span>
                                            <h5 class="wptb-item--number">{{config('setting.phone')}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-7 mt-5 mt-md-0">
                    <div class="blog-details-inner">
                        <div class="post-content">
                            <div class="post-header mt-0">
                                <h1 class="post-title">{{ strip_tags($case->title) }}</h1>
                            </div>
                            <div class="fulltext">
                                {!! $case->description !!}

                                <div class="wptb-accordion wptb-accordion2 wow fadeInUp">
                                    @forelse ($faqs as $item)
                                        <div class="wptb--item {{ $loop->first ? 'active' : '' }}">
                                            <h6 class="wptb-item-title"><span>{{$item->question}}</span> <i class="plus bi bi-plus"></i> <i class="minus bi bi-dash"></i></h6>
                                            <div class="wptb-item--content">{{$item->answer}} </div>
                                        </div>
                                    @empty
                                        <div>N/L</div>
                                    @endforelse
                                </div>

                                {{-- <h4 class="widget-title">Service Options</h4>
                                <div class="image-post">
                                    <img src="{{asset('assets/frontend/assets/img/services/15.jpg')}}" alt="img">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="process-step d-flex">
                                            <div class="serial">1</div>
                                            <div class="process-step-content">
                                                <h5>Documentation List</h5>
                                                <p>These are the concepts that shape our distinctive culture & differentiate us from others.</p>
                                            </div>
                                        </div>
                                        <div class="process-step d-flex">
                                            <div class="serial">2</div>
                                            <div class="process-step-content">
                                                <h5>IELTS Score</h5>
                                                <p>These are the concepts that shape our distinctive culture & differentiate us from others.</p>
                                            </div>
                                        </div>
                                        <div class="process-step d-flex">
                                            <div class="serial">3</div>
                                            <div class="process-step-content">
                                                <h5>NOC Collection</h5>
                                                <p>These are the concepts that shape our distinctive culture & differentiate us from others.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="process-step d-flex">
                                            <div class="serial">4</div>
                                            <div class="process-step-content">
                                                <h5>Offer Letters</h5>
                                                <p>These are the concepts that shape our distinctive culture & differentiate us from others.</p>
                                            </div>
                                        </div>
                                        <div class="process-step d-flex">
                                            <div class="serial">5</div>
                                            <div class="process-step-content">
                                                <h5>CA report Submission</h5>
                                                <p>These are the concepts that shape our distinctive culture & differentiate us from others.</p>
                                            </div>
                                        </div>
                                        <div class="process-step d-flex">
                                            <div class="serial">6</div>
                                            <div class="process-step-content">
                                                <h5>Study Permit</h5>
                                                <p>These are the concepts that shape our distinctive culture & differentiate us from others.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Testimonial -->
                                {{-- <h4 class="widget-title">Clients Testimonial</h4>
                                <div class="wptb-testimonial-two">
                                    <div class="swiper-container swiper-testimonial2">    
                                        <!-- swiper slides -->
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="wptb-testimonial2">
                                                    <div class="wptb-item--inner">
                                                        <img src="{{asset('assets/frontend/assets/img/background/bg-12.jpg')}}" alt="img">

                                                        <div class="wptb-item--image d-none d-md-block">
                                                            <img src="{{asset('assets/frontend/assets/img/avatar/client-1.png')}}" alt="img">
                                                        </div>

                                                        <div class="wptb-item--button wptb-video-btn--two">
                                                            <a class="btn--readmore" data-fancybox href="https://www.youtube.com/watch?v=SF4aHwxHtZ0">
                                                                <span class="btn-readmore--icon"> <i class="bi bi-play-fill"></i> </span>
                                                            </a>
                                                        </div>
                            
                                                        <div class="wptb-item--holder d-none d-md-block">
                                                            <p class="wptb-item--description"> “I am extremely grateful to Immigway Visa Consultancy for making my dream true. The helped me process my visa for Canada. It has accepted in record time. Immigway are amazing so I Highly recommend them.”</p>
                                                            <div class="wptb-item--meta">
                                                                <div class="wptb-item--meta-left">
                                                                    <h4 class="wptb-item--title">Noah Garrison</h4>
                                                                    <h6 class="wptb-item--designation">Student, Thompson River University</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide">
                                                <div class="wptb-testimonial2">
                                                    <div class="wptb-item--inner">
                                                        <img src="{{asset('assets/frontend/assets/img/background/bg-12.jpg')}}" alt="img">

                                                        <div class="wptb-item--image d-none d-md-block">
                                                            <img src="{{asset('assets/frontend/assets/img/avatar/client-1.png')}}" alt="img">
                                                        </div>

                                                        <div class="wptb-item--button wptb-video-btn--two">
                                                            <a class="btn--readmore" data-fancybox href="https://www.youtube.com/watch?v=SF4aHwxHtZ0">
                                                                <span class="btn-readmore--icon"> <i class="bi bi-play-fill"></i> </span>
                                                            </a>
                                                        </div>
                            
                                                        <div class="wptb-item--holder d-none d-md-block">
                                                            <p class="wptb-item--description"> “I am extremely grateful to Immigway Visa Consultancy for making my dream true. The helped me process my visa for Canada. It has accepted in record time. Immigway are amazing so I Highly recommend them.”</p>
                                                            <div class="wptb-item--meta">
                                                                <div class="wptb-item--meta-left">
                                                                    <h4 class="wptb-item--title">Bob Garrison</h4>
                                                                    <h6 class="wptb-item--designation">Student, San-Fransisco University</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide">
                                                <div class="wptb-testimonial2">
                                                    <div class="wptb-item--inner">
                                                        <img src="{{asset('assets/frontend/assets/img/background/bg-12.jpg')}}" alt="img">

                                                        <div class="wptb-item--image d-none d-md-block">
                                                            <img src="{{asset('assets/frontend/assets/img/avatar/client-1.png')}}" alt="img">
                                                        </div>

                                                        <div class="wptb-item--button wptb-video-btn--two">
                                                            <a class="btn--readmore" data-fancybox href="https://www.youtube.com/watch?v=SF4aHwxHtZ0">
                                                                <span class="btn-readmore--icon"> <i class="bi bi-play-fill"></i> </span>
                                                            </a>
                                                        </div>
                            
                                                        <div class="wptb-item--holder d-none d-md-block">
                                                            <p class="wptb-item--description"> “I am extremely grateful to Immigway Visa Consultancy for making my dream true. The helped me process my visa for Canada. It has accepted in record time. Immigway are amazing so I Highly recommend them.”</p>
                                                            <div class="wptb-item--meta">
                                                                <div class="wptb-item--meta-left">
                                                                    <h4 class="wptb-item--title">Bob Garrison</h4>
                                                                    <h6 class="wptb-item--designation">Student, San-Fransisco University</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- pagination dots -->
                                        <div class="wptb-swiper-dots">
                                            <div class="swiper-pagination"></div>
                                        </div>
                                        <!-- !pagination dots -->
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
<!-- End Details Content -->
</div>
