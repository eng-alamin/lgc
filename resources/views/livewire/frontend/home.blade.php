<div>

    <!-- Slider Section -->
    <section class="wptb-slider pb-0">
        <div class="swiper-container swiper-main-slider">    
            <!-- swiper slides -->
            <div class="swiper-wrapper">
                @forelse ($sliders as $item)
                    <div class="swiper-slide">
                        <div class="wptb-slider--item">
                            <div class="wptb-slider--image" style="background-image: url('assets/frontend/assets/img/slider/1.jpg');"></div>
                            <div class="container">
                                <div class="row">
                                    <!-- Content Column -->
                                    <div class="col-xxl-7 col-lg-6 col-md-10 col-sm-12">
                                        <div class="wptb-heading">
                                            <div class="wptb-item--inner">
                                                <h6 class="wptb-item--subtitle"> {{$item->subtitle}} </h6>
                                                <h1 class="wptb-item--title"> {!! $item->title !!} </h1>
                                                <p class="wptb-item--description">{!! $item->description !!} </p>
                                                    <div class="wptb-item--button"> <a class="btn-readmore style-default" href="{{$item->link}}"> <span class="btn-readmore--text"> Get Started </span> </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Slider Image -->
                            <div class="wptb-image-single d-none d-lg-flex wow skewIn">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="{{ asset($item->file1) }}" alt="{{ $item->title }}">
                                    </div>
                                </div>
                            </div>

                            <div class="wptb-item-layer wptb-item-layer-one">
                                <img src="{{ asset($item->file2) }}" alt="{{ $item->title }}">
                            </div>
                            <div class="wptb-item-layer wptb-item-layer-two">
                                <img src="{{ asset($item->file3) }}" alt="{{ $item->title }}">
                            </div>
                            <div class="wptb-item-layer wptb-item-layer-three">
                                <img src="{{ asset($item->file4) }}" alt="{{ $item->title }}">
                            </div>
                        </div>
                    </div>
                @empty
                    
                @endforelse
            </div>

            <!-- pagination dots -->
            <div class="wptb-swiper-dots">
                <div class="swiper-pagination"></div>
            </div>
            <!-- !pagination dots -->
        </div>
    </section>

    <!-- Features Section -->
    @php $feature = $sections->where('type', 'feature')->first(); @endphp
    <section class="wptb-features-one bg-image" style="background-image: url('{{ asset('assets/frontend/assets/img/background/bg-6.jpg') }}');">
        <div class="container">
            <div class="wptb-features-wrapper">
                <div class="wptb-heading d-flex align-items-center justify-content-between flex-wrap">
                    <div class="wptb-item--inner">
                        <h6 class="wptb-item--subtitle text-white">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                                </svg>
                            </span>
                            {{$feature->name}}
                        </h6>
                        <h1 class="wptb-item--title text-white"> <span>{!! $feature->title !!} </span></h1>
                    </div>

                    <div class="wptb-item--button">
                        <a class="btn-readmore style-default" href="#{{$feature->link}}">
                            <span class="btn-readmore--text"> Get Started </span>
                        </a>
                    </div>
                </div>

                <div class="row">
                    @forelse ($features as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="wptb-list1 text-white">
                                <div class="wptb--item wow skewIn" data-wow-delay="700ms">
                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                    <div class="wptb-item--text">{{$item->title}}</div>
                                </div>
                                <p>{{$item->description}}</p>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                            <p class="wptb-item--description">No Data Found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>


    <!-- Essential Carousel -->
    @php $essential = $sections->where('type', 'essential')->first(); @endphp
    <section class="wptb-service-one pb-0">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                            </svg>
                        </span>
                        {{$essential->name}}
                    </h6>
                    <h1 class="wptb-item--title"> <span>{!! $essential->title !!}</span></h1>
                </div>
            </div>

            <div class="swiper-container swiper-imagebox">    
                <!-- swiper slides -->
                <div class="swiper-wrapper">
                    @forelse ($essentials as $item)
                        <div class="swiper-slide">
                            <div class="wptb-image-box1 wow fadeInLeft">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <a href="service-details.html" class="wptb-item-link"><img src="{{ asset($item->file) }}" alt="img"></a>
                                    </div>
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"> <path d="M0 9C6 9 8.5 3 9 0V9H0Z"></path> </svg>
                                            <img src="{{ asset('assets/frontend/assets/img/services/icon-1.png') }}" alt="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"> <path d="M9 9C3 9 0.5 3 0 0V9H9Z"></path> </svg>
                                        </div>
                                        <h4 class="wptb-item--title"><a href="service-details.html">{{$item->title}}</a></h4>
                                        <div class="wptb-line-paper"></div>
                                        <p class="wptb-item--description"> {{$item->description}}</p>
                                        
                                        <div class="wptb-item--button">
                                            <a class="btn--readmore" href="service-details.html">
                                                <span class="btn-readmore--text"> View More </span> <span class="btn-readmore--icon"> <i class="bi bi-arrow-right"></i> </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                            <p class="wptb-item--description">No Data Found</p>
                        </div>
                    @endforelse
                </div>

                <!-- pagination dots -->
                <div class="wptb-swiper-dots">
                    <div class="swiper-pagination"></div>
                </div>
                <!-- !pagination dots -->
            </div>
        </div>
    </section>


    <!-- About Company -->
    @php $about = $sections->where('type', 'about')->first(); @endphp
    <section class="wptb-about-company-one bg-image pd-more" style="background-image: url({{asset('assets/frontend/assets/img/background/bg-7.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Single Image -->
                    <div class="wptb-image-single wow skewIn">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image">
                                <img src="{{ asset('assets/frontend/assets/img/1.jpg') }}" alt="img" class="image-main">

                                <div class="wptb-item-layer">
                                    <div class="wptb-icon-box1 wow fadeInLeft">
                                        <div class="wptb-item--inner flex-start">
                                            <div class="wptb-item--icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="26" viewBox="0 0 29 26" fill="none">
                                                    <path d="M0 3.25C0 2.38805 0.34241 1.5614 0.951903 0.951903C1.5614 0.34241 2.38805 0 3.25 0H24.75C25.612 0 26.4386 0.34241 27.0481 0.951903C27.6576 1.5614 28 2.38805 28 3.25V10.123C27.9556 10.101 27.911 10.0797 27.866 10.059L27.351 9.821C26.9268 9.62433 26.4673 9.51548 26 9.501V3.25C26 2.56 25.44 2 24.75 2H3.25C2.56 2 2 2.56 2 3.25V20.75C2 21.44 2.56 22 3.25 22H6V18.5C6 17.837 6.26339 17.2011 6.73223 16.7322C7.20107 16.2634 7.83696 16 8.5 16H19.5C19.8283 16 20.1534 16.0647 20.4567 16.1903C20.76 16.3159 21.0356 16.5001 21.2678 16.7322C21.4999 16.9644 21.6841 17.24 21.8097 17.5433C21.9353 17.8466 22 18.1717 22 18.5V19.248L21.293 19.063C20.7489 18.9202 20.1754 18.9345 19.6391 19.1044C19.1027 19.2744 18.6256 19.5929 18.263 20.023L17.327 21.132C16.9956 21.5241 16.7544 21.9842 16.6205 22.4798C16.4866 22.9754 16.4632 23.4944 16.552 24H3.25C2.8232 24 2.40059 23.9159 2.00628 23.7526C1.61197 23.5893 1.25369 23.3499 0.951903 23.0481C0.650112 22.7463 0.410719 22.388 0.247391 21.9937C0.0840637 21.5994 0 21.1768 0 20.75V3.25ZM14 14C15.3261 14 16.5979 13.4732 17.5355 12.5355C18.4732 11.5979 19 10.3261 19 9C19 7.67392 18.4732 6.40215 17.5355 5.46447C16.5979 4.52678 15.3261 4 14 4C12.6739 4 11.4021 4.52678 10.4645 5.46447C9.52678 6.40215 9 7.67392 9 9C9 10.3261 9.52678 11.5979 10.4645 12.5355C11.4021 13.4732 12.6739 14 14 14ZM23.55 13.713L24.029 12.335C24.1184 12.0737 24.2616 11.8342 24.4494 11.6318C24.6372 11.4294 24.8654 11.2687 25.1193 11.1601C25.3732 11.0515 25.647 10.9974 25.9231 11.0014C26.1992 11.0053 26.4713 11.0672 26.722 11.183L27.237 11.421C28.077 11.808 28.781 12.502 28.917 13.424C29.589 17.939 26.036 24.184 21.847 25.851C20.992 26.191 20.047 25.921 19.297 25.376L18.837 25.042C18.6122 24.8786 18.4233 24.6707 18.2822 24.4312C18.141 24.1918 18.0506 23.9259 18.0165 23.65C17.9823 23.3742 18.0052 23.0942 18.0838 22.8276C18.1623 22.561 18.2948 22.3133 18.473 22.1L19.41 20.99C19.778 20.554 20.36 20.37 20.913 20.514L22.934 21.044C24.462 20.045 25.27 18.625 25.358 16.784L23.895 15.272C23.699 15.0693 23.5629 14.8161 23.502 14.5408C23.4411 14.2654 23.4577 13.9795 23.55 13.713Z" fill="#E13833"/>
                                                </svg>
                                            </div>
                                            <div class="wptb-item--holder">
                                                <h5 class="wptb-item--title">Call For Consultation</h5>
                                                <p class="wptb-item--description">
                                                    <a href="tel:{{config('setting.phone')}}">{{config('setting.phone')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wptb-client-review2 wow fadeInLeft">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon"><i class="bi bi-airplane"></i></div>
                                        <h5 class="wptb-item--title">Served Client</h5>
                                        <div class="wptb-piechart wow fadeInLeft" data-wow-delay="600ms">
                                            <div class="wrap-meta">
                                                <div class="wrap-meta--inner">
                                                    <span class="wptb--rating-label">Successful</span> <span class="wptb--counter-number"> <span class="wptb--counter-value odometer" data-count="127865"></span> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wptb-item--images">
                                            <div class="wptb-item--img"><img src="{{ asset('assets/frontend/assets/img/visa/student.avif') }}" alt="Student Visa"></div>
                                            <div class="wptb-item--img"><img src="{{ asset('assets/frontend/assets/img/visa/tourist.jpg') }}" alt="Tourist Visa"></div>
                                            <div class="wptb-item--img"><img src="{{ asset('assets/frontend/assets/img/visa/student.avif') }}" alt="Student Visa"></div>
                                            <div class="wptb-item--img"><img src="{{ asset('assets/frontend/assets/img/visa/tourist.jpg') }}" alt="Tourist"></div>
                                            <a class="wptb-item--img wptb-item--link" href="country-list-2.html"><i class="bi bi-plus"></i></a> <span class="wptb-item--text">4 Visa</span>
                                        </div>
                                        <span class="wptb-item--desc">We are serving for 20 Years</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <div class="wptb-about-company-one--inner">
                        <div class="wptb-heading">
                            <div class="wptb-item--inner">
                                <h6 class="wptb-item--subtitle">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                                        </svg>
                                    </span>
                                    {{$about->name}}
                                </h6>
                                <h1 class="wptb-item--title has-line"> <span>{!! $about->title !!}</span></h1>
                                <p class="wptb-item--description">{!! $about->description !!}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="wptb-icon-box1 wow fadeInLeft">
                                    <div class="wptb-item--inner flex-start">
                                        <div class="wptb-item--icon"><i class="bi bi-globe"></i></div>
                                        <div class="wptb-item--holder">
                                            <h5 class="wptb-item--title">Checking all Visa
                                                Eligibilities</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="wptb-icon-box1 wow fadeInLeft">
                                    <div class="wptb-item--inner flex-start">
                                        <div class="wptb-item--icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                                        <div class="wptb-item--holder">
                                            <h5 class="wptb-item--title">Approved Exam
                                                Facilitation</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wptb-list1">
                            <div class="wptb--item wow skewIn" data-wow-delay="700ms">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">Fastest Visa form processing with expert immigration agents</div>
                            </div>
                            <div class="wptb--item wow skewIn" data-wow-delay="700ms">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">Affiliation with Educational Institutions from over the world</div>
                            </div>
                        </div>

                        <div class="wptb-item--button">
                            <a href="{{$about->link}}" class="btn">
                                <span class="btn-wrap">
                                    <span class="text-first">Get Started</span>
                                    <span class="text-second">Get Started</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Province List -Tab -->
    <div class="wptb-country-tab-one">
        <div class="wptb-country-tab">
            @forelse ($provinces as $item)
                <div class="wptb-country-tab--item {{ $loop->first ? 'active' : '' }}">
                    <h2 class="wptb-country-tab--title">
                        <span>{{$item->name}}</span> 
                        <div class="wptb-item-featured">
                            <img src="{{ asset($item->image) }}" alt="{{$item->title}}">
                        </div>
                    </h2>
                    <div class="wptb-country-tab--details">
                        <div class="row align-items-center">
                            <div class="col-xxl-7 col-lg-12">
                                <div class="wptb-heading">
                                    <div class="wptb-item--inner">
                                        <h6 class="wptb-item--subtitle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                                <path d="M14.9119 0.107265L0.787131 5.08487C0.559931 5.16487 0.509531 5.36087 0.779131 5.46806L3.81593 6.68486L5.61593 7.40566L14.4031 0.952865C14.5215 0.866465 14.6575 1.02886 14.5719 1.12166L8.27513 7.93207V7.93366L7.91353 8.33607L8.39273 8.59367L12.3783 10.7393C12.6111 10.8641 12.9127 10.7609 12.9799 10.4721L15.3047 0.452065C15.3679 0.177665 15.1863 0.0104648 14.9119 0.107265ZM5.59993 11.7297C5.59993 11.9265 5.71113 11.9817 5.86473 11.8425C6.06553 11.6593 8.14473 9.79366 8.14473 9.79366L5.59993 8.47847V11.7297Z" fill="#E13833"/>
                                            </svg>
                                            {{$item->name}}</h6>
                                        <h1 class="wptb-item--title"> {{$item->title}}</h1>
                                        <p class="wptb-item--description">{{$item->description}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="wptb-list1">
                                            @php
                                                $items = json_decode($item->json, true);
                                            @endphp
                                            @foreach (array_slice($items, 0, 3) as $province)
                                                <div class="wptb--item" data-wow-delay="700ms">
                                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                                    <div class="wptb-item--text">{{$province}}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="wptb-list1">
                                            @foreach (array_slice($items, 3, 3) as $province)
                                                <div class="wptb--item" data-wow-delay="700ms">
                                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                                    <div class="wptb-item--text">{{$province}}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="wptb-item--button">
                                    <a class="btn--readmore" href="#">
                                        <span class="btn-readmore--text"> Contact Us </span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-xxl-5 d-none d-xxl-block">
                                <div class="wptb-image-single">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <img src="{{ asset($item->image) }}" alt="{{$item->image}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                    <p class="wptb-item--description">No Data Found</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Why Choose -->
    @php $choose = $sections->where('type', 'choose')->first(); @endphp
    <section class="wptb-why-choose-one">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                            </svg>
                        </span>
                        {{$choose->name}}
                    </h6>
                    <h1 class="wptb-item--title"> <span>{!! $choose->title !!}</span></h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 pe-md-5">
                    <div class="wptb-client-review bg-white wow skewIn">
                        <div class="wptb-item--inner">
                            <div class="wptb-heading">
                                <div class="wptb-item--inner text-center">
                                    <h6 class="wptb-item--subtitle">CREATING GREAT OPPORTUNITIES</h6>
                                    <h1 class="wptb-item--title"> <span>We help Making your dream into Reality</span></h1>
                                </div>
                            </div>
                            
                            <div class="wptb-item--images">
                                <div class="wptb-counter1">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--value"><span class="odometer" data-count="4.6"></span><span class="suffix"></span></div>
                                    </div>
                                </div>

                                <div class="wptb-avatar avatar-group">
                                    <!-- Avatar Group -->
                                    <span class="avatar rounded-circle">
                                        <img class="avatar-img rounded-circle" src="{{asset('assets/frontend/assets/img/avatar/1.jpg') }}" alt="Avatar">
                                    </span>
                                    <span class="avatar rounded-circle">
                                        <img class="avatar-img rounded-circle" src="{{asset('assets/frontend/assets/img/avatar/2.jpg') }}" alt="Avatar">
                                    </span>
                                    <span class="avatar rounded-circle">
                                        <img class="avatar-img rounded-circle" src="{{asset('assets/frontend/assets/img/avatar/3.jpg') }}" alt="Avatar">
                                    </span>
                                    <span class="avatar rounded-circle">
                                        <span class="avatar-initials rounded-circle"><a href="#">12+</a></span>
                                    </span>
                                </div>
                            </div>
                            <div class="wptb--rating-label">Creating Great opportunities</div>
                            <div class="wptb-item--star">
                                <div class="item-star"> <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i> </div> 
                                <div class="wptb--star-label">Score on App Store</div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="wptb-why-choose--inner">
                         <div class="row g-0">
                              <!-- Iconbox -->
                            <div class="col-sm-6 wptb-icon-box2 mb-0 border-1 border-end border-bottom p-5 ps-sm-0 pt-sm-0 wow fadeInLeft">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="44" viewBox="0 0 40 44" fill="none">
                                                <mask id="mask0_46_1597" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="40" height="44">
                                                    <path d="M40 0.666992H0V43.3337H40V0.666992Z" fill="white"/>
                                                </mask>
                                                <g mask="url(#mask0_46_1597)">
                                                    <path d="M37.1578 30.6325C38.9489 27.587 39.8922 24.1192 39.8922 20.5603C39.8922 11.6759 33.7478 3.64477 25.1689 1.34366C23.4878 0.892548 21.7411 0.666992 20 0.666992C9.15669 0.666992 0.106689 9.71588 0.106689 20.5603C0.106689 24.4392 1.22336 28.1992 3.3378 31.4314C6.9478 36.9537 13.4922 40.677 20.1634 40.4514C22.1911 40.4348 24.1889 40.1092 26.0911 39.497L28.41 41.8192C29.2445 42.6537 30.3489 43.1814 31.52 43.3059C33.0622 43.4692 34.63 42.9159 35.7267 41.8192L38.3778 39.1692C39.3545 38.1914 39.8934 36.8925 39.8934 35.5103C39.8934 34.1281 39.3556 32.8292 38.3778 31.8514L37.1578 30.6325ZM24.7389 10.857L21.65 7.77033C21.3878 7.50699 21.2434 7.15921 21.2434 6.78921V2.37699C25.4156 2.65477 29.41 4.39699 32.4578 7.2581L30.2867 9.42921C29.7167 9.99588 29.39 10.7837 29.39 11.5892V13.2614C29.39 14.077 29.7078 14.8425 30.2845 15.4181L32.8811 18.0159C33.1389 18.2737 33.2867 18.6303 33.2867 18.9959V21.8959C33.2867 22.2648 33.1422 22.6125 32.8811 22.8748L31.1411 24.6137L26.0489 19.5214L27.7467 17.8237C27.9845 17.5859 28.0567 17.227 27.9267 16.9159C27.7978 16.6048 27.4945 16.4014 27.1567 16.4014H25.63V13.0159C25.6322 12.2003 25.3156 11.4348 24.7389 10.857ZM35.9378 29.4103L32.3222 25.7914L34.0622 24.0514C34.6389 23.4737 34.9556 22.7081 34.9556 21.8948V18.9948C34.9556 18.1914 34.63 17.4048 34.0611 16.837L31.4645 14.2392C31.2022 13.9781 31.0589 13.6303 31.0589 13.2614V11.5892C31.0589 11.2237 31.2067 10.867 31.4656 10.6092L33.6234 8.45144C36.5978 11.7903 38.2267 16.0581 38.2267 20.5592C38.2267 23.6748 37.4378 26.7125 35.9378 29.4103ZM2.4078 15.7814C3.47336 11.8403 5.89336 8.32032 9.17669 5.89699L12.5 9.22033C12.7378 9.4581 12.8689 9.77477 12.8689 10.1114V16.1514C12.8689 16.4881 12.7378 16.8048 12.5 17.0425L11.0534 18.4892C10.8156 18.7281 10.4989 18.8592 10.1622 18.8592C9.82558 18.8592 9.51002 18.7281 9.27113 18.4892L7.62558 16.8437C7.07224 16.2914 6.33669 15.987 5.55558 15.987H2.35336C2.37113 15.9181 2.38891 15.8503 2.4078 15.7814ZM17.3067 35.5625L18.9811 37.2703C19.1978 37.4914 19.32 37.7959 19.3178 38.1059L19.3111 38.7725C15.64 38.6292 12.0722 37.3792 9.12336 35.1814L12.6256 31.727C12.8478 31.5092 13.1389 31.3903 13.4489 31.3903C13.4534 31.3903 13.4578 31.3903 13.4622 31.3903L15.3389 31.4092C15.9878 31.4148 16.5111 31.9492 16.5045 32.5981L16.4945 33.5437C16.4856 34.2925 16.7822 35.0281 17.3067 35.5625ZM29.5889 40.6414L27.8111 38.8603C29.4234 38.1725 30.9422 37.2681 32.3167 36.1814L33.1811 37.0492C34.2789 38.1459 34.5278 39.8681 33.77 41.227C32.42 41.977 30.6911 41.7437 29.5889 40.6414ZM37.1989 37.9903L35.8711 39.3181C35.82 38.0303 35.2722 36.7825 34.3611 35.8714L30.3078 31.8137C29.9822 31.4881 29.4545 31.4881 29.1289 31.8137C28.8034 32.1392 28.8034 32.667 29.1289 32.9925L31.13 34.9948C31.1267 34.9981 31.1222 35.0003 31.1178 35.0037C28.2011 37.2514 24.66 38.5625 20.9778 38.7603L20.9834 38.1237C20.9911 37.3637 20.7022 36.647 20.17 36.1048L18.4956 34.397C18.2789 34.1759 18.1556 33.8703 18.1589 33.5614L18.1689 32.6159C18.1845 31.047 16.9211 29.7592 15.3534 29.7437L13.4778 29.7259C13.4678 29.7259 13.4567 29.7259 13.4467 29.7259C12.6989 29.7259 11.9945 30.0137 11.4556 30.5414L7.82558 34.1225C6.65002 33.067 5.60669 31.8581 4.73336 30.5214C2.79669 27.5603 1.77447 24.1159 1.77447 20.5614C1.77447 19.5859 1.85336 18.6114 2.00669 17.6559H5.55558C5.88669 17.6559 6.21224 17.7903 6.44669 18.0248L8.09113 19.6692C8.64336 20.2225 9.37891 20.527 10.1611 20.527C10.9434 20.527 11.6778 20.2225 12.2311 19.6692L13.6778 18.2225C14.2311 17.6692 14.5356 16.9348 14.5356 16.1525V10.1114C14.5356 9.32921 14.2311 8.59366 13.6778 8.04144L10.5867 4.95033C13.3022 3.3081 16.3822 2.41255 19.5767 2.33921V6.78921C19.5767 7.60255 19.8934 8.3681 20.47 8.9481L23.5589 12.0359C23.8211 12.2981 23.9645 12.6459 23.9645 13.0159V16.4014H18.4922C18.0322 16.4014 17.6589 16.7748 17.6589 17.2348V25.9003C17.6589 26.6259 18.5678 27.0037 19.0822 26.4892L20.8534 24.7181L23.9422 27.807C24.2634 28.1281 24.8 28.1281 25.1211 27.807C25.4456 27.4814 25.4456 26.9537 25.1211 26.6281L21.4434 22.9503C21.1222 22.6292 20.5867 22.6292 20.2645 22.9503L19.3267 23.8881V18.067H25.1467L24.2822 18.9314C23.9611 19.2525 23.9611 19.7892 24.2822 20.1103L37.1989 33.0314C38.5511 34.3825 38.5511 36.6392 37.1989 37.9903Z" fill="#e13833"/>
                                                </g>
                                                <path d="M26.9622 28.9914C26.6222 29.0603 26.3555 29.3392 26.3022 29.6814C26.2455 30.0503 26.4477 30.4181 26.7877 30.5703C27.4855 30.8803 28.2066 30.1248 27.8722 29.4414C27.7089 29.107 27.3266 28.9192 26.9622 28.9914Z" fill="#e13833"/>
                                            </svg>
                                        </div>
                                        <h3 class="wptb-item--title">{{ optional($chooses->get(0))->title }}</h3>
                                        <p class="wptb-item--description mb-0"> {{ optional($chooses->get(0))->description }} </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Iconbox -->
                            <div class="col-sm-6 wptb-icon-box2 mb-0 border-1 border-bottom p-5 pt-sm-0 pe-sm-0 wow fadeInLeft">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="42" viewBox="0 0 38 42" fill="none">
                                                <g clip-path="url(#clip0_46_1623)">
                                                    <path d="M5.49316 5.84619V12.3934C5.49316 12.8462 5.86066 13.2137 6.31348 13.2137H12.7229C13.1768 13.2137 13.5432 12.8462 13.5432 12.3934V5.84619C13.5432 5.39338 13.1768 5.02588 12.7229 5.02588H6.31348C5.86066 5.02588 5.49316 5.39338 5.49316 5.84619ZM7.13379 6.6665H11.9025V11.5731H7.13379V6.6665Z" fill="#e13833"/>
                                                    <path d="M17.1724 6.6665H21.4106C21.8635 6.6665 22.231 6.299 22.231 5.84619C22.231 5.39338 21.8635 5.02588 21.4106 5.02588H17.1724C16.7196 5.02588 16.3521 5.39338 16.3521 5.84619C16.3521 6.299 16.7196 6.6665 17.1724 6.6665Z" fill="#e13833"/>
                                                    <path d="M5.49316 17.1665C5.49316 17.6193 5.86066 17.9868 6.31348 17.9868H25.6499C26.1027 17.9868 26.4702 17.6193 26.4702 17.1665C26.4702 16.7137 26.1027 16.3462 25.6499 16.3462H6.31348C5.86066 16.3462 5.49316 16.7126 5.49316 17.1665Z" fill="#e13833"/>
                                                    <mask id="mask0_46_1623" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="38" height="42">
                                                    <path d="M37.8125 0H0.1875V42H37.8125V0Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask0_46_1623)">
                                                    <path d="M17.1724 10.4629H21.4106C21.8635 10.4629 22.231 10.0954 22.231 9.64258C22.231 9.18977 21.8635 8.82227 21.4106 8.82227H17.1724C16.7196 8.82227 16.3521 9.18977 16.3521 9.64258C16.3521 10.0954 16.7196 10.4629 17.1724 10.4629Z" fill="#e13833"/>
                                                    </g>
                                                    <mask id="mask1_46_1623" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="38" height="42">
                                                    <path d="M37.8125 0H0.1875V42H37.8125V0Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask1_46_1623)">
                                                    <path d="M37.7982 6.70469C37.7982 3.00781 34.7904 0 31.0935 0H18.7287C18.2759 0 17.9084 0.3675 17.9084 0.820312C17.9084 1.27312 18.2759 1.64062 18.7287 1.64062H26.7032C25.2463 2.905 24.3878 4.77531 24.3878 6.70469C24.3878 10.0406 26.9603 12.9544 30.2732 13.3602V38.1052H19.2592C19.1301 37.6348 19.0579 37.1602 19.3718 36.738L21.2454 34.2114H22.1718C25.2824 34.2114 27.8123 31.6805 27.8123 28.5698V27.5516C27.8123 24.4409 25.2813 21.91 22.1718 21.91H20.0456C19.2428 20.9136 18.2234 20.2223 16.8868 20.2814C15.9046 20.3252 15.0428 20.8348 14.5287 21.6595C13.926 21.1597 13.1549 20.8961 12.3718 20.918C11.5078 20.942 10.7246 21.3194 10.1548 21.91H10.0443C8.53822 21.91 7.12072 22.4963 6.05541 23.5627C4.9901 24.628 4.40275 26.0444 4.40275 27.5516V28.5709C4.40275 31.4027 6.50057 33.7531 9.22291 34.1512V38.1063H1.84229V1.64062H11.5099C11.9628 1.64062 12.3303 1.27312 12.3303 0.820312C12.3303 0.3675 11.9628 0 11.5099 0H1.02197C0.568066 0 0.20166 0.3675 0.20166 0.820312V38.9255C0.20166 39.3783 0.568066 39.7458 1.02197 39.7458H9.22291V41.1797C9.22291 41.6325 9.59041 42 10.0432 42C10.496 42 10.8635 41.6325 10.8635 41.1797V24.208C10.8635 23.3548 11.5493 22.5827 12.4178 22.5575C13.3059 22.5345 14.0638 23.2684 14.0638 24.1577V28.7591C14.0638 29.8069 14.9159 30.6589 15.9637 30.6589H17.0738C18.5515 30.6381 19.5424 28.898 18.6237 27.6598L15.9407 24.0341C15.6629 23.6239 15.6334 23.0902 15.8532 22.6472C15.9571 22.4383 16.2732 21.9494 16.959 21.9187C17.5715 21.8925 18.1545 22.178 18.5351 22.6516L22.139 27.1261C22.7198 27.8742 22.9407 29.1583 22.3457 29.9688L18.0528 35.7602C17.4512 36.5717 17.4151 37.5244 17.659 38.4738L18.3721 41.3755C18.4771 41.8064 18.9332 42.082 19.3642 41.977C19.8038 41.8688 20.0729 41.4247 19.9657 40.985L19.6617 39.7469H31.0935C31.5463 39.7469 31.9138 39.3794 31.9138 38.9266V13.358C35.2246 12.9522 37.7982 10.1248 37.7982 6.70469ZM21.3668 23.5506H22.1718C24.3779 23.5506 26.1717 25.3455 26.1717 27.5516V28.5709C26.1717 30.6764 24.5376 32.4067 22.4704 32.5598L23.7895 30.7814C24.7651 29.4645 24.3713 27.3033 23.4231 26.1034L22.4048 24.8391L21.3668 23.5506ZM6.04338 28.5698V27.5505C6.04338 26.4819 6.4601 25.4778 7.21588 24.722C7.78572 24.1511 8.49885 23.7748 9.27432 23.6239C9.24041 23.8153 9.22291 24.0122 9.22291 24.2069V32.4855C7.40947 32.1059 6.04338 30.4937 6.04338 28.5698ZM15.9648 29.0183C15.8215 29.0183 15.7056 28.9023 15.7056 28.7591V26.4742L17.2948 28.6213C17.4042 28.793 17.2773 29.0183 17.0749 29.0183H15.9648ZM31.0935 11.7698C28.3373 11.7698 26.0284 9.45875 26.0284 6.70578C26.0284 3.95172 28.3373 1.64172 31.0935 1.64172C33.8859 1.64172 36.1576 3.91344 36.1576 6.70578C36.1576 9.49813 33.8859 11.7698 31.0935 11.7698Z" fill="#e13833"/>
                                                    </g>
                                                    <mask id="mask2_46_1623" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="38" height="42">
                                                    <path d="M37.8125 0H0.1875V42H37.8125V0Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask2_46_1623)">
                                                    <path d="M32.7024 4.6702L30.0621 7.31051L29.279 6.52848C28.9585 6.20801 28.439 6.20801 28.1185 6.52848C27.7981 6.84785 27.7981 7.36738 28.1185 7.68785L29.4813 9.05066C29.6356 9.20488 29.8434 9.29129 30.061 9.29129C30.2787 9.29129 30.4865 9.20488 30.6407 9.05066L33.8607 5.83066C34.1812 5.5102 34.1812 4.99066 33.8607 4.6702C33.5424 4.35082 33.0229 4.35082 32.7024 4.6702Z" fill="#e13833"/>
                                                    </g>
                                                    <mask id="mask3_46_1623" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="38" height="42">
                                                    <path d="M37.8125 0H0.1875V42H37.8125V0Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask3_46_1623)">
                                                    <path d="M14.4204 1.13288C14.5833 1.54851 15.0832 1.74648 15.4912 1.57694C15.9046 1.40523 16.1058 0.919601 15.9352 0.506164C15.7646 0.0938199 15.2768 -0.109618 14.8633 0.0631949C14.451 0.234914 14.2476 0.720539 14.4204 1.13288Z" fill="#e13833"/>
                                                    </g>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_46_1623">
                                                    <rect width="37.625" height="42" fill="white" transform="translate(0.1875)"/>
                                                    </clipPath>
                                                </defs>
                                                </svg>
                                        </div>
                                        <h3 class="wptb-item--title">{{ optional($chooses->get(1))->title }}</h3>
                                        <p class="wptb-item--description mb-0"> {{ optional($chooses->get(1))->description }} </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Iconbox -->
                            <div class="col-sm-6 wptb-icon-box2 mb-0 border-1 border-end p-5 ps-sm-0 pb-sm-0 wow fadeInLeft">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="43" viewBox="0 0 48 43" fill="none">
                                                <g clip-path="url(#clip0_46_1586)">
                                                    <path d="M41.8641 22.8809V10.4985C41.8641 8.36594 40.129 6.63078 37.9952 6.63078H28.5063V3.61486C28.5063 1.79246 27.0244 0.310547 25.2008 0.310547H17.3975C15.5751 0.310547 14.0931 1.79246 14.0931 3.61486V6.63078H4.6031C2.47051 6.63078 0.735352 8.36594 0.735352 10.4985V32.4606C0.735352 34.5944 2.47051 36.3296 4.6031 36.3296H11.734C12.2356 36.3296 12.6427 35.9225 12.6427 35.4208C12.6427 34.9192 12.2356 34.512 11.734 34.512H4.6031C3.47258 34.512 2.5529 33.5924 2.5529 32.4606V10.4985C2.5529 9.36802 3.47258 8.44834 4.6031 8.44834H37.9952C39.1257 8.44834 40.0466 9.36802 40.0466 10.4985V22.1018C39.0396 21.7819 37.9782 21.622 36.9204 21.622C31.2181 21.622 26.5773 26.2604 26.5761 31.9638C26.5761 32.8205 26.6815 33.6808 26.8911 34.5132H19.7276C19.2259 34.5132 18.8188 34.9204 18.8188 35.422C18.8188 35.9237 19.2259 36.3308 19.7276 36.3308H27.5418C29.1909 39.8605 32.7739 42.3118 36.9192 42.3118C42.6226 42.3118 47.2635 37.6709 47.2635 31.9675C47.2647 28.0512 45.0788 24.6379 41.8641 22.8809ZM15.9107 3.61486C15.9107 2.79454 16.5771 2.1281 17.3975 2.1281H25.2008C26.0211 2.1281 26.6888 2.79575 26.6888 3.61486V6.63078H15.9107V3.61486ZM37.8292 40.4445V39.9768C37.8292 39.4752 37.422 39.068 36.9204 39.068C36.4187 39.068 36.0116 39.4752 36.0116 39.9768V40.4445C32.0772 40.0253 28.8589 36.8094 28.4433 32.875H28.9086C29.4103 32.875 29.8174 32.4679 29.8174 31.9663C29.8174 31.4646 29.4103 31.0575 28.9086 31.0575H28.4421C28.865 27.0807 32.0336 23.9121 36.0104 23.4892V23.9557C36.0104 24.4573 36.4175 24.8645 36.9192 24.8645C37.4208 24.8645 37.8279 24.4573 37.8279 23.9557V23.4892C41.7635 23.9072 44.9794 27.1231 45.3974 31.0587H44.9297C44.4281 31.0587 44.021 31.4658 44.021 31.9675C44.021 32.4691 44.4281 32.8762 44.9297 32.8762H45.3974C44.9758 36.8518 41.806 40.0204 37.8292 40.4445Z" fill="#e13833"/>
                                                    <path d="M21.4591 30.8856C21.4155 31.409 21.8408 31.8695 22.3667 31.8695C22.8344 31.8695 23.2319 31.5108 23.2718 31.0358C23.5614 27.5268 25.15 24.2733 27.7442 21.8717C29.8586 19.9148 32.4893 18.6716 35.3028 18.2706L34.5637 19.1975C34.2499 19.5901 34.3141 20.162 34.7067 20.4746C35.0932 20.7836 35.6748 20.7182 35.9838 20.3317L38.0158 17.7871C38.3309 17.3933 38.2557 16.7959 37.851 16.493L35.0641 14.4016C34.663 14.0999 34.0935 14.1811 33.7918 14.5821C33.4913 14.9832 33.5713 15.5527 33.9736 15.8544L34.8375 16.5027C31.738 16.9874 28.8445 18.3772 26.5095 20.5377C23.5808 23.247 21.7875 26.9221 21.4591 30.8856Z" fill="#e13833"/>
                                                    <path d="M36.9203 26.3599C36.4187 26.3599 36.0115 26.7658 36.0115 27.2686V31.5896L33.6003 34.0009C33.2452 34.3559 33.2452 34.9314 33.6003 35.2865C33.9504 35.6367 34.5357 35.6367 34.8859 35.2865L37.5625 32.6086C37.7334 32.4378 37.8291 32.2075 37.8291 31.9664V27.2686C37.8291 26.767 37.422 26.3599 36.9203 26.3599Z" fill="#e13833"/>
                                                    <path d="M16.633 35.073C16.4839 34.7156 16.1144 34.4866 15.7266 34.5157C15.3473 34.5435 15.0202 34.8125 14.9184 35.1785C14.6991 35.9661 15.5982 36.6204 16.2816 36.1866C16.6511 35.9527 16.7978 35.4753 16.633 35.073Z" fill="#e13833"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_46_1586">
                                                    <rect width="46.5293" height="42" fill="white" transform="translate(0.735352 0.310547)"/>
                                                    </clipPath>
                                                </defs>
                                                </svg>
                                        </div>
                                        <h3 class="wptb-item--title">{{ optional($chooses->get(2))->title }}</h3>
                                        <p class="wptb-item--description mb-0"> {{ optional($chooses->get(2))->description }} </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Iconbox -->
                            <div class="col-sm-6 wptb-icon-box2 mb-0 p-5 pe-sm-0 pb-sm-0 wow fadeInLeft">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42" fill="none">
                                                <g clip-path="url(#clip0_46_1651)">
                                                    <mask id="mask0_46_1651" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="42" height="42">
                                                    <path d="M42 0H0V42H42V0Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask0_46_1651)">
                                                    <path d="M20.6359 21.166H21.8357C22.2886 21.166 22.6561 20.7985 22.6561 20.3457C22.6561 19.8929 22.2886 19.5254 21.8357 19.5254H21.4562L21.9375 18.1134C22.084 17.6846 21.8543 17.2187 21.4256 17.0721C20.9968 16.9267 20.5309 17.1552 20.3843 17.584L19.6384 19.7715C19.4098 20.4442 19.9282 21.166 20.6359 21.166Z" fill="#e13833"/>
                                                    </g>
                                                    <mask id="mask1_46_1651" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="42" height="42">
                                                    <path d="M42 0H0V42H42V0Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask1_46_1651)">
                                                    <path d="M37.5353 30.3395C39.0447 27.7845 39.8497 24.7756 39.9777 21.8203H41.1808C41.6336 21.8203 42.0011 21.4528 42.0011 21C42.0011 20.5472 41.6336 20.1797 41.1808 20.1797H39.9798C39.842 16.9739 38.8992 13.8589 37.2323 11.1245C36.9961 10.7373 36.4919 10.6148 36.1047 10.8511C35.7186 11.0873 35.595 11.5916 35.8312 11.9787C37.3417 14.4572 38.2014 17.2758 38.337 20.1797H37.1219C36.6691 20.1797 36.3016 20.5472 36.3016 21C36.3016 21.4528 36.6691 21.8203 37.1219 21.8203H38.3348C38.2222 24.2025 37.6206 26.5453 36.5717 28.6737C35.28 26.5191 32.0414 26.5475 30.7825 28.7186C30.0278 28.6464 29.2348 28.6092 28.4189 28.6092H26.2073L25.7053 25.4538C26.1297 25.1683 26.5311 24.8423 26.9041 24.4759C28.443 22.9644 29.3333 20.9584 29.4098 18.8267C29.4098 18.8169 29.4109 18.807 29.4109 18.7972V15.5859H29.4525C29.5203 15.6034 29.5914 15.6133 29.6592 15.6133C30.1842 15.6133 30.5616 15.1091 30.4598 14.6038C30.3997 14.1138 30.2116 13.0113 29.6636 11.9033C28.8575 10.2758 27.5898 9.26297 25.9831 8.95562C25.4198 8.26984 23.8569 6.87859 20.5483 7.07656C16.683 7.30844 14.5381 9.35375 13.4192 11.0283C12.2205 12.8231 11.9306 14.5622 11.9197 14.6355C11.8409 15.1266 12.2314 15.5859 12.7302 15.5859H12.8297V18.7961C12.8297 18.8059 12.8297 18.8158 12.8297 18.8256C12.9292 21.5873 14.4134 24.0275 16.5878 25.4723L16.0858 28.6092H13.9212C11.2339 28.6092 8.76641 29.5619 7.00328 31.2528C5.04328 28.5852 3.82703 25.3378 3.66188 21.8214H4.87812C5.33094 21.8214 5.69844 21.4539 5.69844 21.0011C5.69844 20.5483 5.33094 20.1808 4.87812 20.1808H3.66297C4.07969 11.2602 11.2602 4.07969 20.1797 3.66297V4.87812C20.1797 5.33094 20.5472 5.69844 21 5.69844C21.4528 5.69844 21.8203 5.33094 21.8203 4.87812V3.66297C25.1978 3.81938 28.4123 4.93937 31.1609 6.92781C31.5284 7.19359 32.0403 7.11156 32.3061 6.74406C32.5719 6.37656 32.4898 5.86469 32.1223 5.59891C29.0916 3.40703 25.5456 2.17766 21.8203 2.02016V0.820312C21.8203 0.3675 21.4528 0 21 0C20.5472 0 20.1797 0.3675 20.1797 0.820312V2.02125C15.4131 2.2225 10.9605 4.17266 7.56656 7.56656C4.17266 10.9616 2.2225 15.4131 2.02125 20.1797H0.820312C0.3675 20.1797 0 20.5472 0 21C0 21.4528 0.3675 21.8203 0.820312 21.8203H2.02125C2.33734 29.2961 7.19797 36.0588 14.1848 38.7428C16.0989 39.4778 18.1322 39.8934 20.1808 39.9787V41.1797C20.1808 41.6325 20.5483 42 21.0011 42C21.4539 42 21.8214 41.6325 21.8214 41.1797V39.9831C23.1055 39.9339 24.395 39.7545 25.6736 39.4494C26.0498 40.9358 27.4039 42 28.9373 42H38.4464C40.985 42 42.6322 39.1661 41.3569 36.9589L37.5353 30.3395ZM28.6694 13.9442H26.2752C25.6484 13.9442 25.3564 13.2562 25.2459 12.7411L26.0389 10.6564C27.7047 11.1759 28.3927 12.8406 28.6694 13.9442ZM14.7831 11.9383C16.1098 9.95094 18.083 8.86594 20.6467 8.71281C23.0333 8.56953 24.162 9.39969 24.5908 9.84813L23.6414 12.3452C23.3177 13.1381 22.7927 13.9453 21.8345 13.9453H13.7966C13.9825 13.3973 14.2909 12.6755 14.7831 11.9383ZM14.4692 18.7797V15.5848H21.8334C22.7609 15.5848 23.6239 15.1878 24.2484 14.5053C24.7231 15.1769 25.4439 15.5848 26.2741 15.5848H27.7692V18.7797C27.6806 21.1028 26.3353 23.2597 24.3042 24.3863C22.2939 25.5019 19.8789 25.4439 17.8795 24.3447C15.9261 23.2313 14.56 21.1542 14.4692 18.7797ZM18.4592 26.4009C20.3088 27.0397 22.3563 26.9927 24.1741 26.2642L24.6313 29.1419C22.6942 30.9422 19.5956 30.9422 17.6619 29.1419L18.1202 26.2741C18.2317 26.32 18.3455 26.3616 18.4592 26.4009ZM13.9223 30.2487H16.4434C19.0356 32.7469 23.2662 32.7513 25.8497 30.2487H28.42C28.9166 30.2487 29.4022 30.263 29.8747 30.2914L26.0258 36.9578C25.8694 37.1919 25.7655 37.4828 25.6911 37.753C25.4013 37.8284 25.1103 37.8973 24.8161 37.9586C23.8219 38.1675 22.8113 38.2966 21.8203 38.3392V37.1219C21.8203 36.6691 21.4539 36.3016 21 36.3016C20.5472 36.3016 20.1797 36.6691 20.1797 37.1219V38.337C15.5433 38.1194 11.1267 35.9975 8.04125 32.5325C9.50578 31.0734 11.6102 30.2487 13.9223 30.2487ZM39.9361 39.4997C39.6255 40.0378 39.0677 40.3594 38.4453 40.3594H28.9362C27.638 40.3594 26.7947 38.908 27.4466 37.7792L32.2011 29.5444C32.8519 28.4167 34.5297 28.4167 35.1805 29.5444L39.935 37.7792C40.2456 38.3173 40.2456 38.9605 39.9361 39.4997Z" fill="#e13833"/>
                                                    </g>
                                                    <path d="M33.6907 30.6919C33.2379 30.6919 32.8704 31.0594 32.8704 31.5122V35.2528C32.8704 35.7056 33.2379 36.0731 33.6907 36.0731C34.1435 36.0731 34.511 35.7056 34.511 35.2528V31.5122C34.511 31.0594 34.1435 30.6919 33.6907 30.6919Z" fill="#e13833"/>
                                                    <path d="M34.4476 37.6818C34.1665 37.0058 33.1668 37.0266 32.9185 37.7189C32.8004 38.0482 32.9109 38.4277 33.1865 38.6421C33.4534 38.8488 33.8263 38.8718 34.1162 38.6968C34.4574 38.49 34.6018 38.0503 34.4476 37.6818Z" fill="#e13833"/>
                                                    <path d="M33.6305 9.02024C33.7651 9.34289 34.0998 9.5518 34.4487 9.52445C34.7976 9.49711 35.0973 9.24555 35.1837 8.90539C35.3598 8.20867 34.5799 7.63774 33.9663 8.00195C33.6229 8.20758 33.4774 8.65055 33.6305 9.02024Z" fill="#e13833"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_46_1651">
                                                    <rect width="42" height="42" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                                </svg>
                                        </div>
                                        <h3 class="wptb-item--title">{{ optional($chooses->get(3))->title }}</h3>
                                        <p class="wptb-item--description mb-0"> {{ optional($chooses->get(3))->description }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- Funfacts -->
    @php 
        $funfact = $sections->where('type', 'funfact')->first(); 
        $funfactjson = json_decode($funfact->json, true);
    @endphp
    <div class="wptb-funfacts-one position-absolute start-0 end-0 transform-top-reverse">
        <div class="container">
            <div class="wptb-funfacts--inner">
                <div class="row">
                    @foreach ($funfactjson as $item)
                        <div class="col-md-3 col-sm-6">
                            <div class="wptb-counter1 style1 wow skewIn">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--value"><span class="odometer" data-count="{{ $item['value'] }}"></span><span class="suffix">+</span></div>
                                    <div class="wptb-item--text">{{ $item['text'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ's -->
    @php $faq = $sections->where('type', 'faq')->first(); @endphp
    <section class="wptb-faq-one pd-top-more">
        <div class="container">
            <!-- FAQ's -->
            <div class="wptb-faq--inner">
                <div class="wptb-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="wptb-item--inner">
                                <h6 class="wptb-item--subtitle">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                                        </svg>
                                    </span>
                                    {{$faq->name}}
                                </h6>
                                <h1 class="wptb-item--title"> <span>{{$faq->title}}</span></h1>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <p class="wptb-item--description">{{$faq->description}}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Faqs --}}
                    <div class="col-md-6">
                        <div class="wptb-accordion wptb-accordion1 wow fadeInUp">
                            @forelse ($faqs as $item)
                                <div class="wptb--item {{ $loop->first ? 'active' : '' }}">
                                    <h6 class="wptb-item-title"><span>{{$item->question}}</span> <i class="bi bi-chevron-down"></i></h6>
                                    <div class="wptb-item--content">{{$item->answer}}</div>
                                </div>
                            @empty
                                 <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                                    <p class="wptb-item--description">No Data Found</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    {{-- Appointment --}}
                    <div class="col-md-5 offset-md-1">
                        <div class="wptb-appointment-form-one">
                            <div class="wptb-form--wrapper">
                                <form wire:submit.prevent="appointment" class="wptb-form">
                                    <div class="wptb-form--inner">
                                        <div class="wptb-heading">
                                            <div class="wptb-item--inner text-center">
                                                <h2 class="wptb-item--title"> <span>Book An Appointment</span></h2>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="form-group" wire:ignore>
                                                    <input type="text" wire:model="date" class="flatpickr form-control" placeholder="Select Date" required>
                                                </div>
                                                @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>

                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="form-group" wire:ignore>
                                                    <select wire:model="service" class="form-control" id="service">
                                                        <option value="">Select Service</option>
                                                        <option value="education">Education</option>
                                                        <option value="healthcare">Healthcare</option>
                                                        <option value="business">Business</option>
                                                        <option value="travel">Travel</option>
                                                    </select>
                                                </div>
                                                @error('service') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>

                                            @push('scripts')
                                                <script>
                                                    document.addEventListener('livewire:init', function () {

                                                        $('#service').niceSelect();

                                                        $('#service').on('change', function () {
                                                            @this.set('service', $(this).val());
                                                        });

                                                    });
                                                </script>
                                            @endpush

                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <input type="text" wire:model="name" class="form-control" placeholder="Your Full Name*" required>
                                                </div>
                                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>

                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <input type="email" wire:model="email" class="form-control" placeholder="E-mail*" required>
                                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <input type="number" wire:model="phone" class="form-control" placeholder="Phone No">
                                                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <input type="text" wire:model="address" class="form-control" placeholder="Address">
                                                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-12">
                                                  @if (session()->has('success'))
                                                    <div class="alert alert-success">
                                                        {{ session('success') }}
                                                    </div>
                                                    @else
                                                    <div class="wptb-item--button text-center">
                                                        <input class="btn" type="submit" value="Make Appointment" name="submit">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="wptb-form--bottom">
                                    <div class="wptb-heading">
                                        <div class="wptb-item--inner">
                                            <h6 class="wptb-item--subtitle">Or just Give us a call</h6>
                                            <h1 class="wptb-item--title"> <span>{{config('setting.phone')}} </span></h1>
                                            <p class="wptb-item--description"> <span>The Support Centre is abailable 24/7</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Radial Progress -->
    <div class="wptb-radial-progress-one">
        <div class="container">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="wptb-radial-progress">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <svg class="radial-progress" data-countervalue="75" viewBox="0 0 80 80">
                                        <circle class="bar-static" cx="40" cy="40" r="35"></circle>
                                        <circle class="bar--animated" cx="40" cy="40" r="35" style="stroke-dashoffset: 217.8;"></circle>
                                        <text class="countervalue start" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">75</text>
                                    </svg>
                                </div>
                                <div class="wptb-item--holder">
                                    <h5 class="wptb-item--title">Quickest Response</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="wptb-radial-progress">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <svg class="radial-progress" data-countervalue="95" viewBox="0 0 80 80">
                                        <circle class="bar-static" cx="40" cy="40" r="35"></circle>
                                        <circle class="bar--animated" cx="40" cy="40" r="35" style="stroke-dashoffset: 217.8;"></circle>
                                        <text class="countervalue start" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">95</text>
                                    </svg>
                                </div>
                                <div class="wptb-item--holder">
                                    <h5 class="wptb-item--title">Customer Satisfaction</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Packages -->
    {{-- <section class="wptb-pricing-package-one">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                            </svg>
                        </span>
                        Pricing Packages
                    </h6>
                    <h1 class="wptb-item--title"> <span>Get the best packages For every <br>
                        Exam preparation</span></h1>
                </div>
            </div>

            <div class="wptb-packages1 active highlight wow fadeInLeft">
                <div class="wptb-item--inner">
                    <div class="wptb-item--left-part">
                        <div class="wptb-item--holder">
                            <h6 class="wptb-item--category"><a href="#">IELTS</a></h6>
                            <h4 class="wptb-item--title"><a href="#">IELTS Exam Preparation</a></h4>
                            <p class="wptb-item--description"> Let's Go ChinaVisa Consultancy takes great
                                pride in its commitment for helping interna
                                tional students from all over...</p>
                        </div>

                        <div class="wptb-item--image">
                            <a href="#" class="wptb-item-link"><img src="{{ asset('assets/frontend/assets/img/packages/1.jpg') }}" alt="img"></a>
                        </div>
                    </div>

                    <div class="wptb-item--right-part">
                        <div class="wptb-list1">
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Exam Preparation Manual</div>
                            </div>
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Exam Preparation Mock Test</div>
                            </div>
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Preparation Consultation</div>
                            </div>
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Exam Venue & Arrangement</div>
                            </div>
                        </div>

                        <div class="wptb-item--price">
                            <span class="wptb-service-price">$645.00</span> <span class="wptb-service-price-for">Per Attempt</span>
                            <div class="wptb-item--button">
                                
                                <a class="btn--readmore" href="contact-1.html"> 
                                    <span class="btn-readmore--text"> Get Started </span> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wptb-packages1 wow fadeInLeft">
                <div class="wptb-item--inner">
                    <div class="wptb-item--left-part">
                        <div class="wptb-item--holder">
                            <h6 class="wptb-item--category"><a href="#">TOEFL</a></h6>
                            <h4 class="wptb-item--title"><a href="#">TOEFL Exam Preparation</a></h4>
                            <p class="wptb-item--description"> Let's Go ChinaVisa Consultancy takes great
                                pride in its commitment for helping interna
                                tional students from all over...</p>
                        </div>

                        <div class="wptb-item--image">
                            <a href="#" class="wptb-item-link"><img src="{{ asset('assets/frontend/assets/img/packages/2.jpg') }}" alt="img"></a>
                        </div>
                    </div>

                    <div class="wptb-item--right-part">
                        <div class="wptb-list1">
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Exam Preparation Manual</div>
                            </div>
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Exam Preparation Mock Test</div>
                            </div>
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Preparation Consultation</div>
                            </div>
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Exam Venue & Arrangement</div>
                            </div>
                        </div>

                        <div class="wptb-item--price">
                            <span class="wptb-service-price">$645.00</span> <span class="wptb-service-price-for">Per Attempt</span>
                            <div class="wptb-item--button"> 
                                <a class="btn--readmore" href="contact-1.html"> 
                                    <span class="btn-readmore--text"> Get Started </span> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wptb-packages1 wow fadeInLeft">
                <div class="wptb-item--inner">
                    <div class="wptb-item--left-part">
                        <div class="wptb-item--holder">
                            <h6 class="wptb-item--category"><a href="#">PTE</a></h6>
                            <h4 class="wptb-item--title"><a href="#">PTE Exam Preparation</a></h4>
                            <p class="wptb-item--description"> Let's Go ChinaVisa Consultancy takes great
                                pride in its commitment for helping interna
                                tional students from all over...</p>
                        </div>

                        <div class="wptb-item--image">
                            <a href="#" class="wptb-item-link"><img src="{{ asset('assets/frontend/assets/img/packages/3.jpg') }}" alt="img"></a>
                        </div>
                    </div>

                    <div class="wptb-item--right-part">
                        <div class="wptb-list1">
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Exam Preparation Manual</div>
                            </div>
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Exam Preparation Mock Test</div>
                            </div>
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Preparation Consultation</div>
                            </div>
                            <div class="wptb--item wow skewIn animated">
                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                <div class="wptb-item--text">IELTS Exam Venue & Arrangement</div>
                            </div>
                        </div>

                        <div class="wptb-item--price">
                            <span class="wptb-service-price">$645.00</span> <span class="wptb-service-price-for">Per Attempt</span>
                            <div class="wptb-item--button"> 
                                <a class="btn--readmore" href="contact-1.html"> 
                                    <span class="btn-readmore--text"> Get Started </span> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Testimonial -->
    @php $testimonial = $sections->where('type', 'testimonial')->first(); @endphp
    <section class="wptb-testimonial-one bg-image" style="background-image: url('{{asset('assets/frontend/assets/img/background/bg-4.jpg')}}');">
        <div class="container">
            <div class="wptb-heading">
                <div class="row">
                    <div class="col-md-6">
                        <div class="wptb-item--inner">
                            <h6 class="wptb-item--subtitle">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                                    </svg>
                                </span>
                                {{$testimonial->name}}
                            </h6>
                            <h1 class="wptb-item--title"> <span>{!! $testimonial->title !!}</span></h1>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <p class="wptb-item--description">{!! $testimonial->description !!}</p>
                    </div>
                </div>
            </div>

            <div class="swiper-container swiper-testimonial">    
                <!-- swiper slides -->
                <div class="swiper-wrapper">
                    @forelse ($testimonials as $item)
                        <div class="swiper-slide">
                            <div class="wptb-testimonial1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="{{ asset($item->image) }}" alt="{{$item->file}}">
                                        <div class="wptb-item--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                                                <path d="M26.2324 22.8729C28.6698 20.2276 28.4244 16.8305 28.4167 16.7917V6.45841C28.4167 6.11584 28.2806 5.7873 28.0383 5.54507C27.7961 5.30283 27.4676 5.16675 27.125 5.16675H19.375C17.9503 5.16675 16.7917 6.32537 16.7917 7.75008V16.7917C16.7917 17.1343 16.9277 17.4629 17.17 17.7051C17.4122 17.9473 17.7408 18.0834 18.0833 18.0834H22.0591C22.0318 18.722 21.841 19.3429 21.5049 19.8866C20.8488 20.9212 19.6127 21.6277 17.8289 21.9842L16.7917 22.1909V25.8334H18.0833C21.678 25.8334 24.4202 24.8375 26.2324 22.8729ZM12.0151 22.8729C14.4537 20.2276 14.207 16.8305 14.1993 16.7917V6.45841C14.1993 6.11584 14.0632 5.7873 13.821 5.54507C13.5787 5.30283 13.2502 5.16675 12.9076 5.16675H5.15761C3.7329 5.16675 2.57428 6.32537 2.57428 7.75008V16.7917C2.57428 17.1343 2.71037 17.4629 2.9526 17.7051C3.19483 17.9473 3.52338 18.0834 3.86595 18.0834H7.8417C7.81441 18.722 7.62361 19.3429 7.28757 19.8866C6.63141 20.9212 5.39528 21.6277 3.61149 21.9842L2.57428 22.1909V25.8334H3.86595C7.46066 25.8334 10.2029 24.8375 12.0151 22.8729Z" fill="#00255C"/>
                                            </svg>
                                        </div>
                                    </div>
        
                                    <div class="wptb-item--holder">
                                        <p class="wptb-item--description"> {{ $item->comment }} </p>
                                        <div class="wptb-item--meta">
                                            <div class="wptb-item--meta-left">
                                                <h4 class="wptb-item--title"> {{ $item->name }} </h4>
                                                <h6 class="wptb-item--designation"> {{ $item->position }} </h6>
                                            </div>
                                            <div class="wptb-item--meta-right">
                                                <i class="bi bi-star-fill"></i> {{ $item->review }} 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                         <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                            <p class="wptb-item--description">No Data Found</p>
                        </div>
                    @endforelse
                </div>

                <!-- pagination dots -->
                <div class="wptb-swiper-dots">
                    <div class="swiper-pagination"></div>
                </div>
                <!-- !pagination dots -->
            </div>
        </div>
    </section>

    <!-- Clients Logo -->
    <div class="wptb-partners-one bg-image" style="background-image: url('{{asset('assets/frontend/assets/img/background/bg-8.jpg')}}');">    
        <div class="container">    
            <div class="swiper-container swiper-clients">    
                <!-- swiper slides -->
                <div class="swiper-wrapper">
                    @forelse ($logos as $item)
                        <div class="swiper-slide">
                            <div class="wptb-partner--image1">
                                <a href="#">
                                    <img src="{{ asset($item->file) }}" alt="Let's Go China" class="img-fluid">
                                    <img src="{{ asset($item->file) }}" alt="Let's Go China" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                            <p class="wptb-item--description">No Data Found</p>
                        </div>
                    @endforelse
                </div>
                <!-- !swiper slides -->
            </div>
        </div>
    </div>

    <!-- Blog Grid -->
    @php $blog = $sections->where('type', 'blog')->first(); @endphp
    <section class="wptb-blog-grid-one">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                            </svg>
                        </span>
                        {{$blog->name}}
                    </h6>
                    <h1 class="wptb-item--title"> <span>{!! $blog->title !!}</span></h1>
                </div>
            </div>
            
            <div class="row">
                @forelse ($blogs as $item)
                    <div class="col-sm-6">
                        <div class="wptb-blog-grid1 active highlight wow fadeInLeft">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <a href="blog-details.html" class="wptb-item-link"><img src="{{ asset($item->file) }}" alt="{{$item->title}}"></a>
                                </div>
                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <div class="wptb-item--date">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</div>
                                        <div class="wptb-item-comment"><a href="#comments">0</a></div>
                                    </div>
                                    
                                    <h5 class="wptb-item--title"><a href="blog-details.html">{{$item->title}}</a></h5>
                                    <p class="wptb-item--description"> {{$item->short_description}}</p>
                                    
                                    <div class="wptb-item--button"> 
                                        <a class="btn--readmore" href="blog-details.html"> 
                                            <span class="btn-readmore--text"> Read More </span> 
                                            <span class="btn-readmore--icon"> <i class="bi bi-arrow-right"></i> </span> 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                        <p class="wptb-item--description">No Data Found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
