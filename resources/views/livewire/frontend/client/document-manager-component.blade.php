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
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h5>Document Information</h5>
                         <span class="badge bg-success">{{ $client->profile_completion }}% Complete</span>
                    </div>
                    <div class="card-body p-4">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                        <h6 class="mb-3 fw-bold">Upload Document</h6>

                        <div class="mb-3">
                            <select wire:model.live="document_type" class="form-control mb-2 document_type">
                                <option value="">-- Select Document Type --</option>
                                <option value="passport">Passport</option>
                                <option value="photo">Photo</option>
                                <option value="transcript">Transcript</option>
                                <option value="graduation">Graduation</option>
                                <option value="medical">Medical</option>
                                <option value="police_clearance">Police Clearance</option>
                                <option value="bank_statement">Bank Statement</option>
                                <option value="property_asset">Property / Asset</option>
                                <option value="other">Other</option>
                            </select>
                            @error('document_type') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        @if ($this->document_type == "other")
                            <div class="mb-2">
                                <input type="text" wire:model="document_name" class="form-control" placeholder="Document Name">
                                 @error('document_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        @endif
                        <div class="mb-2">
                            <input type="file" wire:model="file" class="form-control">
                             @error('file') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                       
                        @if ($file)
                            <div class="mb-2">
                                <strong>Preview:</strong>
                                <br>
                                <img src="{{ $file->temporaryUrl() }}" width="120" class="rounded shadow">
                            </div>
                        @endif

                        <button type="button" wire:click="save" class="btn btn-primary">Upload</button>
                    </div>
                </div>
                <div class="card p-4 border-0  shadow-sm">
                    <h6 class="mb-4 fw-bold">Uploaded Documents</h6>
                    <table class="table border-0">
                        <thead>
                            <tr class="border">
                                <th class="border-0">SL</th>
                                <th class="border-0">Name</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documents as $item)
                                 <tr class="border">
                                    <td class="border-0">{{ $loop->iteration }}</td>
                                    <td class="border-0">{{ strtoupper(str_replace('_', ' ', $item->document_type)) }}</td>
                                    <td class="border-0">
                                        @if($item->status == "pending")
                                            <span class="badge bg-primary">Pending</span>
                                        @elseif($item->status == "uploaded")
                                            <span class="badge bg-warning">Uploaded</span>
                                        @elseif($item->status == "verified")
                                            <span class="badge bg-success">Verified</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="border-0">
                                        <a href="{{ asset($item->file) }}" target="_blank" class="badge bg-info mt-2"> View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border">
                                    <td class="border-0 text-center fw-bold" colspan="4"> No Records Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </section>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            $('.document_type').on('change', function () {
                @this.set('document_type', $(this).val());
            });
        });
    </script>
@endpush