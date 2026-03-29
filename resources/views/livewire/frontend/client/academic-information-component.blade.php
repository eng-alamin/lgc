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
                        @if (!empty($this->client->data['educations']))
                            <h5>Academic Information <a href="#" wire:click="edit" class="badge bg-secondary"> @if ($openEdit == FALSE) Edit @else View @endif</a></h5>
                        @else
                            <h5>Academic Information <a href="#" wire:click="edit" class="badge bg-secondary"> @if ($openEdit == FALSE) New @else View @endif</a></h5>
                        @endif
                        <span class="badge bg-success">{{ $client->profile_completion }}% Complete</span>
                    </div>
                    
                    @if ($openEdit == FALSE)
                            <div class="card-body border-0">
                                @foreach ($this->client->data['educations'] ?? [] as $item)
                                    <h5 class="mb-0 text-light bg-danger ps-2 p-1 rounded">{{strtoupper($item['degree'])}}</h5>
                                    <div class="wptb-packages1 highlight wow fadeInLeft p-4">
                                        <div style="border-radius: 5px;" class="wptb-item--inner">
                                            <div class="wptb-item--left-part">
                                                <div class="wptb-item--holder">
                                                    <div class="wptb-list1">
                                                        <div class="wptb--item wow skewIn animated">
                                                            <div class="text-dark">Level / Degree</div>
                                                        </div>
                                                        <div class="wptb--item wow skewIn animated">
                                                            <div class="text-dark">Board / University / Institution</div>
                                                        </div>
                                                        <div class="wptb--item wow skewIn animated">
                                                            <div class="text-dark">Passing Year</div>
                                                        </div>
                                                        <div class="wptb--item wow skewIn animated">
                                                            <div class="text-dark">GPA / CGPA / Grade</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="wptb-item--right-part">
                                                <div class="wptb-list1">
                                                    <div class="wptb--item wow skewIn animated">
                                                        <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                                        <div class="wptb-item--text">{{ucfirst($item['degree'])}}</div>
                                                    </div>
                                                    <div class="wptb--item wow skewIn animated">
                                                        <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                                        <div class="wptb-item--text">{{$item['institution']}}</div>
                                                    </div>
                                                    <div class="wptb--item wow skewIn animated">
                                                        <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                                        <div class="wptb-item--text">{{$item['year']}}</div>
                                                    </div>
                                                    <div class="wptb--item wow skewIn animated">
                                                        <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                                        <div class="wptb-item--text">{{$item['grade']}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    @else
                        <div class="card-body border-0">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @foreach($educations as $index => $education)
                                <div class="border p-3 mb-3 rounded">
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <input type="text" wire:model="educations.{{ $index }}.degree" class="form-control" placeholder="Level / Degree">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <input type="text" wire:model="educations.{{ $index }}.institution" class="form-control" placeholder="Board / University / Institution">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <input type="number" wire:model="educations.{{ $index }}.year" class="form-control" placeholder="Passing Year">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <input type="text" wire:model="educations.{{ $index }}.grade" class="form-control" placeholder="GPA / CGPA">
                                        </div>

                                        <div class="col-md-1 mb-2 d-flex align-items-center">
                                            <button type="button" wire:click="removeRow({{ $index }})" class="btn btn-sm btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                           <div class="d-flex justify-content-between align-items-center">
                                <button type="button" wire:click="addRow" class="btn btn-sm btn-primary">+ Add More</button>
                                <button type="button" wire:click="save" class="btn btn-success">Save Academic Information</button>
                           </div>
                        </div>
                    @endif
                </div>
            </div>
          </div>
        </div>
    </section>