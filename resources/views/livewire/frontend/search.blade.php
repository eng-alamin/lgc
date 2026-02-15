<div>
    <!-- Blog Grid -->
    <section class="mt-5">
        <div class="container mt-5">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        Search Results for: "{{ $q }}"
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        @if($data->count())
                            @forelse ($data as $item)
                                <div class="col-md-6 col-sm-6">
                                    <div class="wptb-blog-grid1 style2 active highlight wow fadeInLeft">
                                        <div class="wptb-item--inner">
                                            <div class="wptb-item--image">
                                                <a href="{{ route('blog.detail', $item->id) }}" class="wptb-item-link"><img src="{{ asset($item->file) }}" alt="{{$item->title}}"></a>
                                            </div>
                                            <div class="wptb-item--holder">
                                                <div class="wptb-item--meta">
                                                    <div class="wptb-item--date">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</div>
                                                    <div class="wptb-item-comment"><a href="#comments">0</a></div>
                                                </div>
                                                
                                                <h5 class="wptb-item--title"><a href="{{ route('blog.detail', $item->id) }}">{{$item->title}}</a></h5>
                                                <p class="wptb-item--description">  {{$item->short_description}} </p>
                                                
                                                <div class="wptb-item--button"> 
                                                    <a class="btn--readmore" href="{{ route('blog.detail', $item->id) }}"> 
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
                                    <p class="wptb-item--description">No Data Found.</p>
                                </div>
                            @endforelse
                        @else
                            <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                                    <p class="wptb-item--description">No Data Found.</p>
                                </div>
                        @endif
                    </div>

                    {{-- <div class="wptb-pagination-wrap text-center">
                        <ul class="pagination">
                            <li><a class="disabled page-number previous" href="#"><i class="bi bi-chevron-left"></i></a></li>
                            <li><span class="page-number current">1</span></li>
                            <li><a class="page-number" href="#">2</a></li>
                            <li><a class="page-number" href="#">3</a></li>
                            <li>.....</li>
                            <li><a class="page-number" href="#">9</a></li>
                            <li><a class="page-number next" href="#"><i class="bi bi-chevron-right"></i></a></li>
                        </ul>
                    </div> --}}
                </div>

                <!-- Sidebar  -->
                <div class="col-lg-4 col-md-5 mt-5 mt-md-0 ps-md-5">

                    <div class="sidebar">
                        
                        <div class="widget widget_block widget_search">
                            <form action="{{ route('search') }}" method="get" class="wp-block-search">
                                <div class="wp-block-search__inside-wrapper ">
                                    <input type="search" class="wp-block-search__input" name="q" placeholder="Search" required="">
                                    <button type="submit" class="wp-block-search__button"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <!-- end widget -->

                        {{-- <div class="widget widget_block widget_custom">
                            <h2 class="widget-title">About Author</h2>
                            <div class="sidebar_author">
                                <img src="{{ asset('assets/frontend/assets/img/blog/author-2.jpg') }}" alt="img">
                                <p class="intro">Sed ut perspiciatis unde omnis iste natus err or sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt</p>
                                <div class="author_social">
                                    <ul>
                                        <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                                        <li><a href="#"><i class="bi bi-twitter-x"></i></a></li>
                                        <li><a href="#"><i class="bi bi-pinterest"></i></a></li>
                                        <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                                        <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <!-- end widget -->

                        {{-- <div class="widget widget_block">
                            <div class="wp-block-group__inner-container">
                                <h2 class="widget-title">Recent Posts</h2>
                                <ul class="wp-block-latest-posts__list wp-block-latest-posts">
                                    @forelse ($latest_blogs as $item)
                                        <li>
                                            <div class="latest-posts-image">
                                                <img src="{{asset($item->file)}}" alt="{{$item->title}}">
                                            </div>
                                            <div class="latest-posts-content">
                                                <h5><a href="{{ route('blog.detail', $item->id) }}">{{$item->title}}</a></h5>
                                                <h6>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</h6>
                                            </div>
                                        </li>
                                    @empty
                                        
                                    @endforelse
                                </ul>
                            </div>
                        </div> --}}
                        <!-- end widget -->

                        {{-- <div class="widget widget_block">
                            <div class="wp-block-group__inner-container">
                                <h2 class="widget-title">Categories</h2>
                                <ul class="wp-block-categories-list wp-block-categories">
                                    <li class="cat-item"><a href="#">Consultaion</a> (10)</li>
                                    <li class="cat-item"><a href="#">Business</a> (12)</li>
                                    <li class="cat-item"><a href="#">Marketing</a> (08)</li>
                                    <li class="cat-item"><a href="#">Finance</a> (15)</li>
                                    <li class="cat-item"><a href="#">Campaign</a> (21)</li>
                                </ul>
                            </div>
                        </div> --}}
                        <!-- end widget -->

                        {{-- <div class="widget widget_block widget_tag_cloud">
                            <div class="wp-block-group__inner-container">
                                <h2 class="widget-title">Tag Cloud</h2>
                                <ul class="wp-block-tag-list wp-block-tag">
                                    <p class="wp-block-tag-cloud">
                                        <a href="#" class="tag-cloud-link">Business</a>
                                        <a href="#" class="tag-cloud-link">Finance</a>
                                        <a href="#" class="tag-cloud-link">Marketing</a>
                                        <a href="#" class="tag-cloud-link">Consultancy</a>
                                        <a href="#" class="tag-cloud-link">Process</a>
                                        <a href="#" class="tag-cloud-link">Meeting</a>
                                        <a href="#" class="tag-cloud-link">Campaign</a>
                                    </p>
                                </ul>
                            </div>
                        </div> --}}
                        <!-- end widget -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
