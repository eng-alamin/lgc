<section class="blog-details">
    <div class="header-space"></div>
    <div class="container">
        <div class="row">
            <!-- Service Navigation List -->
            <div class="col-lg-4 col-md-5 pe-md-5">
                <div class="sidebar">
                    @include('frontend.client.sidebar')
                    @include('frontend.client.banner')
                </div>
            </div>
            <div class="col-lg-8 col-md-7 mt-5 mt-md-0">
                <div class="card p-4 border-0  shadow-sm">
                    <h5 class="mb-4">Notices</h5>
                    <div class="card-body">
                        {!! $this->notice->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>