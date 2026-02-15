<div>
    <!-- Case Studies -->
    @php $cases = $sections->where('type', 'case')->first(); @endphp
    <section class="wptb-case-studies-one mt-5">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                            </svg>
                        </span>
                       {!! $cases->name !!}
                    </h6>
                    <h1 class="wptb-item--title"> <span>{!! $cases->title !!}</span></h1>
                </div>
            </div>

            <div class="wptb-case-studies--inner">
                <div class="grid grid-4 gutter-15 clearfix"> 
                    <div class="grid-sizer"></div>  

                    @forelse ($data as $item)
                        <div class="grid-item refugee">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="{{asset($item->file)}}" alt="{{$item->title}}"/>
                                </div>
                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <h3 class="wptb-item--title"><a href="{{ route('casestudies.detail', $item->id) }}">{!! $item->title !!}</a></h3>
                                        <div class="wptb-item--divider"></div>
                                        <p class="wptb-item--description"> {!! $item->subtitle !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse

                </div>

                {{-- <button id="load-more" class="btn text-center w-100 mt-3">
                    <span class="btn-wrap">
                        <span class="text-first">Load More</span>
                        <span class="text-second">Load More</span>
                    </span>
                </button> --}}
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    @php $subscriber = $sections->where('type', 'subscriber')->first(); @endphp
    <div class="wptb-newsletter bg-image" style="background-image: url('{{ asset('assets/frontend/assets/img/background/bg-16.jpg') }}');">
        <div class="container">
            <div class="wptb-item--inner">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h1 class="wptb-item--title wow fadeInLeft">{{$subscriber->title}}</h1>
                    </div>
                    <div class="col-md-6">
                        <form wire:submit.prevent="subscribe" class="newsletter-form">
                            <div class="form-group">
                                <input type="email" wire:model.defer="subscribe_email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <button type="submit" class="btn-readmore style-icon" wire:loading.attr="disabled">
                                <span wire:loading.remove class="btn-readmore--icon"> <i class="bi bi-send"></i> </span>
                                <span wire:loading>Subscribing...</span>
                            </button>
                        </form>

                        @error('subscribe_email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        @if (session()->has('success'))
                            <div class="alert alert-success mt-2">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/frontend/plugins/isotope/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/plugins/isotope/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/plugins/isotope/jquery.hoverdir.js') }}"></script>
        <script src="{{ asset('assets/frontend/plugins/isotope/modernizr-custom.js') }}"></script>
        <script src="{{ asset('assets/frontend/plugins/isotope/isotope-init.js') }}"></script>
    @endpush
</div>
