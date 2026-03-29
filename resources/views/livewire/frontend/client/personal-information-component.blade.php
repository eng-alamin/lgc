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
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-0">
                            <h5>Personal Information <a href="#" wire:click="edit" class="badge bg-secondary"> @if ($openEdit == FALSE) Edit @else View @endif</a></h5>
                            <span class="badge bg-success"> {{ $client->profile_completion }}% Complete</span>
                        </div>
                        @if ($openEdit == FALSE)
                            <div class="card-body border-0">
                                <div>
                                    @if ($this->client->user?->avatar)
                                        <img src="{{ asset( $this->client->user?->avatar) }}" alt="{{$this->client->user?->name}}" class="w-25 pb-4">
                                    @else
                                        <img src="{{asset('assets/backend//media/avatars/blank.png')}}" alt="Profile Photo" class="w-25 pb-4">
                                    @endif
                                </div>
                                <p class="fw-bold">Full Name <span class="fw-normal"> : {{ $this->name }}</span></p>
                                <p class="fw-bold">Email Name <span class="fw-normal"> : {{ $this->email }}</span></p>
                                <p class="fw-bold">Phone Name <span class="fw-normal"> : {{ $this->phone }}</span></p>
                                <p class="fw-bold">Date of Birth <span class="fw-normal"> : {{ $this->date_of_birth }}</span></p>
                                <p class="fw-bold">Gender <span class="fw-normal"> : {{ ucfirst($this->gender )}}</span></p>
                                <p class="fw-bold">Marital Status <span class="fw-normal"> : {{ ucfirst($this->marital_status )}}</span></p>
                                <p class="fw-bold">Nationality <span class="fw-normal"> : {{ ucfirst($this->nationality )}}</span></p>
                                <p class="fw-bold">Religion <span class="fw-normal"> : {{$this->religion }}</span></p>
                                <p class="fw-bold">Blood Group <span class="fw-normal"> : {{$this->blood_group }}</span></p>
                            </div>
                        @else
                            <div class="card-body border-0">
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent="save">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <input type="text" wire:model="name" class="form-control" placeholder="Full Name">
                                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" wire:model="email" class="form-control" placeholder="Email Name">
                                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" wire:model="phone" class="form-control" placeholder="Phone Name">
                                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="date" wire:model="date_of_birth" class="form-control">
                                            @error('date_of_birth') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <select wire:model="gender" class="form-select">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <select wire:model="marital_status" class="form-select">
                                                <option value="">Select Marital Status</option>
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                            </select>
                                            @error('marital_status') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" wire:model="nationality" class="form-control" placeholder="Nationality">
                                            @error('nationality') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" wire:model="religion" class="form-control" placeholder="Religion">
                                            @error('religion') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" wire:model="blood_group" class="form-control" placeholder="Blood Group">
                                            @error('blood_group') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" wire:model="address" class="form-control" placeholder="Address Name">
                                            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="file" wire:model="avatar" class="form-control">
                                            @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <select wire:model="service" class="form-select">
                                                <option value="">Select Service</option>
                                                <option value="education">Education</option>
                                                <option value="healthcare">Healthcare</option>
                                                <option value="business">Business</option>
                                                <option value="travel">Travel</option>
                                                <option value="career">Career</option>
                                            </select>
                                            @error('service') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Update Information</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                @if($showServiceWizard)
                    <!-- Bootstrap Modal -->
                    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Select Your Service</h5>
                                    <button type="button" class="btn-close" wire:click="$set('showServiceWizard', false)"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="service" class="form-label">Service</label>
                                        <select wire:model="service" class="form-select w-100">
                                            <option value="">Select Service...</option>
                                            <option value="education">Education</option>
                                            <option value="healthcare">Healthcare</option>
                                            <option value="business">Business</option>
                                            <option value="travel">Travel</option>
                                            <option value="career">Career</option>
                                        </select>
                                        @error('service') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button wire:click="saveService" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>