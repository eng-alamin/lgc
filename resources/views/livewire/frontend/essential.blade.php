<div>
    <div class="mt-lg-5 pt-lg-5"></div>

    <!-- Essentials -->
    <section>
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                            </svg>
                        </span>
                        {{$section->name}}
                    </h6>
                    <h1 class="wptb-item--title"> <span>{!! $section->title !!}</span></h1>
                </div>
            </div>

            <div class="wptb-service--inner">
                <div class="row">
                    @forelse ($data as $item)
                        <div class="col-lg-4 col-sm-6">
                            <div class="wptb-image-box1 wow fadeInLeft">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <a href="#" class="wptb-item-link"><img src="{{asset($item->file)}}" alt="{{$item->title}}"></a>
                                    </div>
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"> <path d="M0 9C6 9 8.5 3 9 0V9H0Z"></path> </svg>
                                            <img src="{{asset('assets/frontend/assets/img/services/icon-1.png')}}" alt="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"> <path d="M9 9C3 9 0.5 3 0 0V9H9Z"></path> </svg>
                                        </div>
                                        <h4 class="wptb-item--title"><a href="service-details.html">{{$item->title}}</a></h4>
                                        <div class="wptb-line-paper"></div>
                                        <p class="wptb-item--description">{{$item->description}}</p>
                                        
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
            </div>

            <div class="wptb-pagination-wrap text-center">
                <ul class="pagination">
                    <li><a class="disabled page-number previous" href="#"><i class="bi bi-chevron-left"></i></a></li>
                    <li><span class="page-number current">1</span></li>
                    <li><a class="page-number" href="#">2</a></li>
                    <li><a class="page-number" href="#">3</a></li>
                    <li>.....</li>
                    <li><a class="page-number" href="#">9</a></li>
                    <li><a class="page-number next" href="#"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <div class="wptb-newsletter bg-image" style="background-image: url('{{asset('assets/frontend/assets/img/background/bg-16.jpg')}}');">
        <div class="container">
            <div class="wptb-item--inner">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h1 class="wptb-item--title wow fadeInLeft">Subscribe To Immigway
                            For All the offers</h1>
                    </div>
                    <div class="col-md-6">
                        <form class="newsletter-form" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <button type="submit" class="btn-readmore style-icon">
                                <span class="btn-readmore--icon"> <i class="bi bi-send"></i> </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
