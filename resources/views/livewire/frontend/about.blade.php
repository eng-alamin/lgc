<div>

    <div class="mt-lg-5 pt-lg-5"></div>

    <!-- Intro -->
    @php $intro = $sections->where('type', 'intro')->first(); @endphp
    <section class="wptb-intro-one pb-0">
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
                               {{$intro->name}}
                            </h6>
                            <h1 class="wptb-item--title"> <span>{!! $intro->title !!}</span></h1>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <p class="wptb-item--description">{!! $intro->description !!}</p>
                    </div>
                </div>
            </div>

            <!-- Slider Image -->
            <div class="wptb-image-single wow fadeInUp">
                <div class="wptb-item--inner">
                    <div class="wptb-item--image">
                        <img src="{{ asset($intro->file) }}" alt="{!! $intro->title !!}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Company -->
     @php $about = $sections->where('type', 'about')->first(); @endphp
    <section class="wptb-about-company-one bg-image pd-more" style="background-image: url('{{asset('assets/frontend/assets/img/background/bg-7.jpg')}}');">
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
                            </div>
                        </div>

                        <div>
                            {!! $about->description !!}
                        </div>

                        {{-- <p class="wptb-item--description pb-2">Let's Go China Visa Consultancy was created to provide uniquely des igned premium services in the world of education and migration. As people are dreaming more.</p>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="wptb-icon-box1 wow fadeInLeft">
                                    <div class="wptb-item--inner flex-start">
                                        <div class="wptb-item--icon"><i class="bi bi-globe"></i></div>
                                        <div class="wptb-item--holder">
                                            <h5 class="wptb-item--title">Checking all Visa Eligibilities</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="wptb-icon-box1 wow fadeInLeft">
                                    <div class="wptb-item--inner flex-start">
                                        <div class="wptb-item--icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                                        <div class="wptb-item--holder">
                                            <h5 class="wptb-item--title">Approved Exam Facilitation</h5>
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
                        </div> --}}

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


    <!-- Why Choose -->
    @php $choose = $sections->where('type', 'choose')->first(); @endphp
    <section class="wptb-why-choose-two pb-0 bg-image" style="background-image: url('{{asset('assets/frontend/assets/img/background/bg-11.jp')}}g');">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner">
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
                <div class="col-lg-6">
                    @forelse ($chooses as $item)
                        <div class="wptb-icon-box3 wow fadeInLeft">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--icon"><img src="{{ asset($item->file) }}" alt="icon"></div>
                                <div class="wptb-item--holder">
                                    <h4 class="wptb-item--title">{!! $item->title !!}</h4>
                                    <p class="wptb-item--description">{!! $item->description !!} </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse
                </div>

                <div class="col-lg-6 d-none d-lg-block ">
                    <div class="wptb-image-single wow skewIn">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image">
                                <img src="{{ asset('assets/frontend/assets/img/slider/image-1.png') }}" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="wptb-image-single wptb-image-single--two h-100 position-absolute end-0 top-0 bottom-0 d-none d-md-block wow skewIn">
            <div class="wptb-item--inner h-100">
                <div class="wptb-item--image h-100">
                    <img src="{{ asset('assets/frontend/assets/img/flag.jpg') }}" alt="img" class=" h-100">
                </div>
            </div>
        </div>
    </section>

    <!-- Team Grid -->
    @php $team = $sections->where('type', 'team')->first(); @endphp
    <section class="wptb-service-two bg-image-3" style="background-image: url('{{asset('assets/frontend/assets/img/background/bg-9.jpg')}}');">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                            </svg>
                        </span>
                        {{$team->name}}
                    </h6>
                    <h1 class="wptb-item--title"> <span>{!! $team->title !!}</span></h1>
                </div>
            </div>

            <div class="row justify-content-center clearfix">
                    @forelse ($teams as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="wptb-team-grid1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="{{ asset($item->image) }}" alt="{{$item->name}}">
                                    </div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--social">
                                            @if(!empty($item->social['facebook']))
                                                <a href="{{ $item->social['facebook'] }}" target="_blank">
                                                    <i class="bi bi-facebook"></i>
                                                </a>
                                            @endif
                                            @if(!empty($item->social['instagram']))
                                                <a href="{{ $item->social['instagram'] }}" target="_blank">
                                                    <i class="bi bi-instagram"></i>
                                                </a>
                                            @endif
                                            @if(!empty($item->social['x']))
                                                <a href="{{ $item->social['x'] }}" target="_blank">
                                                    <i class="bi bi-twitter"></i>
                                                </a>
                                            @endif
                                            @if(!empty($item->social['linkedin']))
                                                <a href="{{ $item->social['linkedin'] }}" target="_blank">
                                                    <i class="bi bi-linkedin"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="wptb-item--meta">
                                            <h5 class="wptb-item--title"><a href="team-details.html">{{$item->name}}</a></h5>
                                            <p class="wptb-item--position">{{$item->position}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse
            </div>

            <!-- Funfacts -->
            @php $funfact = $sections->where('type', 'funfact')->first(); @endphp
            @php $json_funfact = json_decode($funfact->json ?? '[]', true); @endphp
            <div class="wptb-funfacts-two less-gap">
                <div class="row">
                    @foreach ($json_funfact as $item)
                        <div class="col-md-3 col-sm-6">
                            <div class="wptb-counter1 style1 wow skewIn">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--value"><span class="odometer" data-count="{{ preg_replace('/[^0-9]/', '', $item['value']) }}"></span><span class="suffix">{{ preg_replace('/[0-9]/', '', $item['value']) }}</span></div>
                                    <div class="wptb-item--text">{{ $item['text'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>


    <!-- Work Process -->
    @php $process = $sections->where('type', 'process')->first(); @endphp
    <section class="wptb-work-process-one">
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
                                {{$process->name}}
                            </h6>
                            <h1 class="wptb-item--title"> <span>{!! $process->title !!}</span></h1>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <p class="wptb-item--description">{!! $process->description !!}</p>
                    </div>
                </div>
            </div>

            <div class="wptb-work-process-one--inner">
                <div class="row">
                    @forelse ($processes as $item)
                        <div class="col-md-4">
                            <div class="wptb-process">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="{{ asset($item->file) }}" alt="img">
                                    </div>
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--icon"><span></span></div>
                                        <h4 class="wptb-item--title">{!! $item->title !!}</h4>
                                        <div class="wptb-item--description">{!! $item->description!!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse

                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial -->
    @php $testimonial = $sections->where('type', 'testimonial')->first(); @endphp
    <section class="wptb-testimonial-one bg-image pb-0" style="background-image: url('{{asset('assets/frontend/assets/img/background/bg-4.jpg')}}');">
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
                                    <img src="{{asset($item->image)}}" alt="{{$item->name}}">
                                    <div class="wptb-item--icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                                            <path d="M26.2324 22.8729C28.6698 20.2276 28.4244 16.8305 28.4167 16.7917V6.45841C28.4167 6.11584 28.2806 5.7873 28.0383 5.54507C27.7961 5.30283 27.4676 5.16675 27.125 5.16675H19.375C17.9503 5.16675 16.7917 6.32537 16.7917 7.75008V16.7917C16.7917 17.1343 16.9277 17.4629 17.17 17.7051C17.4122 17.9473 17.7408 18.0834 18.0833 18.0834H22.0591C22.0318 18.722 21.841 19.3429 21.5049 19.8866C20.8488 20.9212 19.6127 21.6277 17.8289 21.9842L16.7917 22.1909V25.8334H18.0833C21.678 25.8334 24.4202 24.8375 26.2324 22.8729ZM12.0151 22.8729C14.4537 20.2276 14.207 16.8305 14.1993 16.7917V6.45841C14.1993 6.11584 14.0632 5.7873 13.821 5.54507C13.5787 5.30283 13.2502 5.16675 12.9076 5.16675H5.15761C3.7329 5.16675 2.57428 6.32537 2.57428 7.75008V16.7917C2.57428 17.1343 2.71037 17.4629 2.9526 17.7051C3.19483 17.9473 3.52338 18.0834 3.86595 18.0834H7.8417C7.81441 18.722 7.62361 19.3429 7.28757 19.8866C6.63141 20.9212 5.39528 21.6277 3.61149 21.9842L2.57428 22.1909V25.8334H3.86595C7.46066 25.8334 10.2029 24.8375 12.0151 22.8729Z" fill="#00255C"/>
                                        </svg>
                                    </div>
                                </div>
    
                                <div class="wptb-item--holder">
                                    <p class="wptb-item--description"> {{$item->comment}}</p>
                                    <div class="wptb-item--meta">
                                        <div class="wptb-item--meta-left">
                                            <h4 class="wptb-item--title">{{$item->name}}</h4>
                                            <h6 class="wptb-item--designation">{{$item->position}}</h6>
                                        </div>
                                        <div class="wptb-item--meta-right">
                                            <i class="bi bi-star-fill"></i> {{$item->review}}
                                        </div>
                                    </div>
                                </div>
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
        </div>
    </section>
</div>
