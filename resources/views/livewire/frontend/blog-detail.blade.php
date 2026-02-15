<div>
    <!-- Details Content -->
    <section class="blog-details mt-5">
        <div class="container">
            <div class="row mt-5">

                <div class="col-lg-8 col-md-7">
                    <div class="blog-details-inner">
                        <div class="post-content">
                            <figure class="block-gallery mb-0">
                                <ul class="blocks-gallery-grid">
                                    <li class="blocks-gallery-item mb-0 me-0">
                                        <figure>
                                            <a href="#"><img src="{{asset($blog->file)}}" alt="{{$blog->title}}" class="block-image"></a>
                                        </figure>
                                    </li>
                                </ul>
                            </figure>

                            <div class="post-header">
                                <div class="post-date">{{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}</div>
                                <h2 class="post-title">{{$blog->title}}</h2>
                            </div>

                            <div class="fulltext">
                                {!! $blog->description !!}

                                {{-- <div class="post-footer">
                                    <div class="post-share">
                                        <ul class="share-list">
                                            <li>Share:</li>
                                            <li class="facebook"><a href="#">Facebook</a></li>
                                            <li class="twitter"><a href="#">Twitter</a></li>
                                            <li class="pinterest"><a href="#">Pinterest</a></li>
                                            <li class="instagram"><a href="#">Instagram</a></li>
                                            <li class="linkedin"><a href="#">Linkedin</a></li>
                                        </ul>
                                    </div>
                                </div> --}}

                                <!-- Author Section  -->
                                {{-- <div class="author-div">
                                    <div class="author">
                                        <img alt="img" src="assets/img/blog/author-1.jpg" class="avatar">
                                    </div>
                                    <div class="author-block">
                                        <h5 class="author-name">Rayan Kellar</h5>
                                        <p class="author-intro">By thinking on behalf of our clients every daywe anticipate what they 
                                            want provide what they need & build lasting relationships.</p>
                                        <div class="social-media">
                                            <ul class="social-list">
                                                <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                                                <li><a href="#"><i class="bi bi-twitter-x"></i></a></li>
                                                <li><a href="#"><i class="bi bi-dribbble"></i></a></li>
                                                <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Comment List -->
                                {{-- <div class="comments-area">
                                    <h3 class="comments-title">Comments</h3>
                                    <ul class="comment-list">
                                        <li class="comment even thread-even depth-1">
                                            <div class="commenter-block">
                                                <div class="comment-avatar">
                                                    <img alt="img" src="assets/img/blog/commenter-1.jpg" class="avatar">
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-author-name">Mellisa Doe <span class="comment-date">January 29, 2023</span></div>
                                                    <div class="comment-author-comment">
                                                        <p>Lorem ipsum dolor sit amet, consectetur. Ut enim ad minima veniam quis nostrum exercitationem mosequatu autem.</p>
                                                        <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <ul class="children">
                                                <li class="comment even thread-even depth-2">
                                                    <div class="commenter-block">
                                                        <div class="comment-avatar">
                                                            <img alt="img" src="assets/img/blog/commenter-2.jpg" class="avatar">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="comment-author-name">Rayan Kellar <span class="comment-date">January 22, 2023</span></div>
                                                            <div class="comment-author-comment">
                                                                <p>Lorem ipsum dolor sit amet, consectetur. Ut enim ad minima veniam quis nostrum exercitationem mosequatu autem.</p>
                                                                <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li><!-- #comment-## -->
                                            </ul><!-- .children -->
                                        </li><!-- #comment-## -->
                                        <li class="comment odd thread-odd depth-1">
                                            <div class="commenter-block">
                                                <div class="comment-avatar">
                                                    <img alt="img" src="assets/img/blog/commenter-1.jpg" class="avatar">
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-author-name">Mellisa Doe <span class="comment-date">January 01, 2023</span></div>
                                                    <div class="comment-author-comment">
                                                        <p>Lorem ipsum dolor sit amet, consectetur. Ut enim ad minima veniam quis nostrum exercitationem mosequatu autem.</p>
                                                        <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li><!-- #comment-## -->
                                    </ul>
                                    <div class="comments-pagination">
                                        <a class="page-numbers" href="#">1</a>
                                        <span aria-current="page" class="page-numbers current">2</span>
                                    </div>
                                </div> --}}

                                {{-- <div class="comment-respond">
                                    <h3 class="comment-reply-title">Make A Comment <span class="title-line"></span></h3>
                                    <form class="comment-form" action="https://wpthemebooster.com/demo/themeforest/html/immigway/register.php" method="post">
                                        <p class="logged-in-as">Your email address will not be published. Required fields are marked *</p>
                                        <div class="form-container">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" name="name" class="form-control" placeholder="Name*" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="form-control" placeholder="E-mail*" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <textarea name="message" class="form-control" placeholder="Text Here*" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="wptb-item--button">
                                                        <input class="btn" type="submit" value="Make Comment" name="submit">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}
                            </div>
                        </div>
                    </div>

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

                        <div class="widget widget_block">
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
                        </div>
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
    <!-- End Details Content -->
</div>
