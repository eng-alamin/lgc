<div>
    <div class="mt-lg-5 pt-lg-5"></div>

    <!-- Make Appointmet -->
    <section class="wptb-make-appointment">
        <div class="container">

            {{-- <div class="row">
                <div class="col-md-6">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner">
                            <h6 class="wptb-item--subtitle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                    <path d="M14.9119 0.107265L0.787131 5.08487C0.559931 5.16487 0.509531 5.36087 0.779131 5.46806L3.81593 6.68486L5.61593 7.40566L14.4031 0.952865C14.5215 0.866465 14.6575 1.02886 14.5719 1.12166L8.27513 7.93207V7.93366L7.91353 8.33607L8.39273 8.59367L12.3783 10.7393C12.6111 10.8641 12.9127 10.7609 12.9799 10.4721L15.3047 0.452065C15.3679 0.177665 15.1863 0.0104648 14.9119 0.107265ZM5.59993 11.7297C5.59993 11.9265 5.71113 11.9817 5.86473 11.8425C6.06553 11.6593 8.14473 9.79366 8.14473 9.79366L5.59993 8.47847V11.7297Z" fill="#E13833"/>
                                </svg>
                                Make Appointment
                            </h6>
                            <h2 class="wptb-item--title"> <span>Want to meet us for <br> your need?</span></h2>
                        </div>
                    </div>

                    <div class="wptb-banner">
                        <div class="wptb-banner-inner bg-imager" style="background-image: url('{{asset('assets/frontend/assets/img/more/card.jpg')}}')">
                            <h4 class="wptb-banner-title text-white">Have any questions?</h4>
                            <p class="wptb-banner-desc text-white">24/7 customer support is always ready to answer all your questions</p>
                            <a href="contact-1.html" class="btn">
                                <span class="btn-wrap">
                                    <span class="text-first">Ask Here</span>
                                    <span class="text-second">Ask Here</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <div id="calendar" class="wptb-fullcalendar"></div>
                </div>
            </div> --}}

            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item--subtitle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.9119 2.10726L0.787131 7.08487C0.559931 7.16487 0.509531 7.36087 0.779131 7.46806L3.81593 8.68486L5.61593 9.40566L14.4031 2.95286C14.5215 2.86646 14.6575 3.02886 14.5719 3.12166L8.27513 9.93207V9.93366L7.91353 10.3361L8.39273 10.5937L12.3783 12.7393C12.6111 12.8641 12.9127 12.7609 12.9799 12.4721L15.3047 2.45206C15.3679 2.17766 15.1863 2.01046 14.9119 2.10726ZM5.59993 13.7297C5.59993 13.9265 5.71113 13.9817 5.86473 13.8425C6.06553 13.6593 8.14473 11.7937 8.14473 11.7937L5.59993 10.4785V13.7297Z" fill="#E13833"/>
                            </svg>
                        </span>
                        Make Appointment
                    </h6>
                    <h1 class="wptb-item--title"> <span>Want to meet us for your need?</span></h1>
                </div>
            </div>

            <div class="wptb-contact-form-two mr-top-100">
                <div class="wptb-form--wrapper">
                    @if (session()->has('success'))
                        <div class="alert alert-success mb-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form wire:submit.prevent="store" class="wptb-form">
                        <div class="wptb-form--inner">
                            <h4 class="mb-4">Please confirm that you would like to request the following appointment:</h4>     
                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-4">
                                    <div class="form-group" wire:ignore>
                                        <input class="flatpickr" type="text" wire:model="date" placeholder="Select Date">
                                    </div>
                                    @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="form-group">
                                        <input type="text" wire:model="name" class="form-control" placeholder="Your Full Name*" required>
                                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="form-group">
                                        <input type="email" wire:model="email" class="form-control" placeholder="E-mail*" required>
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="form-group">
                                        <input type="number" wire:model="phone" class="form-control" placeholder="Phone No">
                                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 mb-4">
                                    <div class="form-group">
                                        <input type="text" wire:model="address" class="form-control" placeholder="Address">
                                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-12 mb-4">
                                    <div class="form-group">
                                        <textarea wire:model="message" class="form-control" placeholder="Text"></textarea>
                                        @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mb-4">
                                    <div class="wptb-radio-list d-flex align-items-center">
                                        <div class="form-group">
                                            <input type="radio" wire:model="service" value="education">
                                            <label for="education">Education</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="radio" wire:model="service" value="healthcare">
                                            <label for="healthcare">Healthcare</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="radio" wire:model="service" value="business">
                                            <label for="business">Business</label>
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="radio" wire:model="service" value="travel">
                                            <label for="travel">Travel</label>
                                        </div>
                                    </div>
                                      @error('service') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-12 col-lg-12 mt-4">
                                    <button type="submit" class="btn text-center w-100">
                                        <span class="btn-readmore--text">Request Appointment </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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

        <!-- Full Calendar -->
        <script src="{{ asset('assets/frontend/plugins/fullcalendar/fullcalendar.js') }}"></script>
        <script src="{{ asset('assets/frontend/plugins/fullcalendar/fullcalendar-init.js') }}"></script>
        <script src="{{ asset('assets/frontend/plugins/fullcalendar/moment.js') }}"></script>
</div>
