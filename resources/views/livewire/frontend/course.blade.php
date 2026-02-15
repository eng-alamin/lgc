<div>
    <!-- Timeline -->
     @php $course = $sections->where('type', 'course')->first(); @endphp
    <section class="wptb-team-one mt-5">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                            </svg>
                        </span>
                        {{$course->name}}
                    </h6>
                    <h1 class="wptb-item--title"> <span>{!! $course->title !!}</span></h1>
                </div>
            </div>

            <!-- Section: Timeline -->
            <div class="py-5 d-flex justify-content-center">
                <ul class="timeline">
                     @forelse ($data as $item)
                        <li class="timeline-item mb-5">
                        <h5 class="fw-bold">Top {{$item->number}}</h5>
                        <p class="text-muted mb-2 fw-bold">{{$item->title}}</p>
                        <p class="text-muted">{{$item->description}}</p>
                        </li>
                     @empty
                        <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                            <p class="wptb-item--description">No Data Found</p>
                        </div>
                    @endforelse
                </ul>
            </div>

            <style>
                .timeline {
                    border-left: 1px solid var(--color-one);
                    position: relative;
                    list-style: none;
                }
                .timeline h5{
                    color: var(--color-one);
                }

                .timeline .timeline-item {
                position: relative;
                }

                .timeline .timeline-item:after {
                position: absolute;
                display: block;
                top: 0;
                }

                .timeline .timeline-item:after {
                background-color: var(--color-one);
                left: -38px;
                border-radius: 50%;
                height: 11px;
                width: 11px;
                content: "";
                }
            </style>
            <!-- Section: Timeline -->
        </div>
    </section>
</div>
