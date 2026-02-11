<div>
    <div class="mt-lg-5 pt-lg-5"></div>

    <!-- Work Process -->
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
                                {{$section->name}}
                            </h6>
                            <h1 class="wptb-item--title"> <span>{!! $section->title !!}</span></h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="wptb-item--description">{!! $section->description !!}</p>
                    </div>
                </div>
            </div>

            <div class="wptb-work-process-one--inner">
                <div class="row">
                    @forelse ($data as $item)
                         <div class="col-md-4">
                            <div class="wptb-process">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="{{asset($item->file)}}" alt="{{$item->title}}">
                                    </div>
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--icon"><span></span></div>
                                        <h4 class="wptb-item--title">{{$item->title}}</h4>
                                        <div class="wptb-item--description">{{$item->description}}</div>
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
        </div>
    </section>

</div>
