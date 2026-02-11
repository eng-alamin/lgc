@push('styles')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
@endpush

<div>

    <div class="mt-5"></div>

    <!-- Contact Us -->
    <section class="wptb-contact-page-wrapper-two">
        <div class="container">
            <div class="wptb-contact-infos">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="wptb-image-box1 wow fadeInLeft">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="{{ asset('assets/frontend/assets/img/more/4.jpg') }}" alt="img">
                                </div>
                                <div class="wptb-item--holder">
                                    <div class="wptb-item--icon">
                                        <img src="{{ asset('assets/frontend/assets/img/more/mail.png') }}" alt="icon">
                                    </div>
                                    <h4 class="wptb-item--title">Send Us Mail</h4>
                                    <p class="wptb-item--description"> 
                                        <a href="mailto:{{config('setting.email')}}">{{config('setting.email')}}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="wptb-image-box1 wow fadeInLeft">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="{{ asset('assets/frontend/assets/img/more/5.jpg') }}" alt="img">
                                </div>
                                <div class="wptb-item--holder">
                                    <div class="wptb-item--icon">
                                        <img src="{{ asset('assets/frontend/assets/img/more/phone.png') }}" alt="icon">
                                    </div>
                                    <h4 class="wptb-item--title">Call Us Anytime</h4>
                                    <p class="wptb-item--description"> 
                                        <a href="tel:{{config('setting.phone')}}">{{config('setting.phone')}}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="wptb-image-box1 wow fadeInLeft">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="{{ asset('assets/frontend/assets/img/more/6.jpg') }}" alt="img">
                                </div>
                                <div class="wptb-item--holder">
                                    <div class="wptb-item--icon">
                                        <img src="{{ asset('assets/frontend/assets/img/more/map-pin.png') }}" alt="icon">
                                    </div>
                                    <h4 class="wptb-item--title">Visit Our Office</h4>
                                    <p class="wptb-item--description">{!! config('setting.address') !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gmapbox mr-top-20 wow fadeInUp">
                {{-- <div id="googleMap" class="map"></div> --}}
                <div id="map" style='height:400px'></div>
            </div>

            @php $contact = $sections->where('type', 'contact')->first(); @endphp
            <div class="wptb-contact-form-two mr-top-100">
                <div class="wptb-form--wrapper">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="wptb-heading pd-right-30">
                                <div class="wptb-item--inner text-end">
                                    <h2 class="wptb-item--title mt-0"> <span> {!! $contact->title !!}</span></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7">
                            @if (session()->has('success'))
                                <div class="alert alert-success mb-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form wire:submit.prevent="store" class="wptb-form">
                                <div class="wptb-form--inner">        
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-4">
                                            <div class="form-group">
                                                <input type="text" wire:model="name" class="form-control" placeholder="Name*" required>
                                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-4">
                                            <div class="form-group">
                                                <input type="number" wire:model="phone" class="form-control" placeholder="Phone No">
                                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-4">
                                            <div class="form-group">
                                                <input type="email" wire:model="email" class="form-control" placeholder="E-mail*" required>
                                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-4">
                                            <div class="form-group">
                                                <input type="text" wire:model="subject" class="form-control" placeholder="Subject">
                                                @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-12 mb-4">
                                            <div class="form-group">
                                                <textarea wire:model="message" class="form-control" placeholder="Text"></textarea>
                                                @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-12">
                                            <div class="wptb-item--button text-center">
                                                <button type="submit" class="btn" wire:loading.attr="disabled" wire:target="submit">
                                                    <span wire:loading.remove wire:target="submit">Contact Us</span>
                                                    <span wire:loading wire:target="submit">Sending...</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
</div>

@push('scripts')
<script type="text/javascript">
    function initializeMap() {
        const locations = <?php echo json_encode($locations) ?>;

        const map = new google.maps.Map(document.getElementById("map"));
        var infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        for (var location of locations) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(location.lat, location.lng),
                map: map
            });
            bounds.extend(marker.position);
            google.maps.event.addListener(marker, 'click', (function(marker, location) {
                return function() {
                    infowindow.setContent(location.lat + " & " + location.lng);
                    infowindow.open(map, marker);
                }
            })(marker, location));

        }
        map.fitBounds(bounds);
    }
</script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ config('setting.other.google_maps_api_key') }}&callback=initializeMap"></script>
@endpush
