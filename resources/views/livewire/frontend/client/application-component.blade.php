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
                        <h5>Academic Information </h5>
                    </div>
                    <div class="card-body p-4">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                        <h5 class="mb-3">Upload Document</h5>

                        <select wire:model="document_type" class="form-control mb-2 document_type">
                            <option value="">Select Type</option>
                            <option value="passport">Passport</option>
                            <option value="nid">NID</option>
                            <option value="ssc_certificate">SSC Certificate</option>
                            <option value="hsc_certificate">HSC Certificate</option>
                            <option value="ielts_certificate">IELTS</option>
                        </select>

                        <input type="text" wire:model="document_name" class="form-control mb-2" placeholder="Custom Name">

                        <input type="file" wire:model="file" class="form-control mb-2">

                        @if ($file)
                            <div class="mb-2">
                                <strong>Preview:</strong>
                                <br>
                                <img src="{{ $file->temporaryUrl() }}" width="120" class="rounded shadow">
                            </div>
                        @endif

                        <textarea wire:model="notes" class="form-control mb-2" placeholder="Notes"></textarea>

                        <button type="button" wire:click="save" class="btn btn-primary">
                            Upload
                        </button>
                    </div>
                </div>
                <div class="card p-4 border-0  shadow-sm">
                    <h5 class="mb-4">Uploaded Documents</h5>
                    <table class="table border-0">
                        <thead>
                            <tr>
                                <th class="border-0">SL</th>
                                <th class="border-0">Type</th>
                                <th class="border-0">Name</th>
                                <th class="border-0">Stats</th>
                                <th class="border-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $item)
                                <tr>
                                    <td class="border-0">{{ $loop->iteration }}</td>
                                    <td class="border-0">{{ strtoupper(str_replace('_', ' ', $item->document_type)) }}</td>
                                    <td class="border-0">{{ $item->document_name }}</td>
                                    <td class="border-0">
                                        @if($item->status == "pending")
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($item->status == "verified")
                                            <span class="badge bg-success">Verified</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="border-0">
                                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="badge bg-info mt-2"> View</a>
                                        @if($item->status == "pending")
                                            <button wire:click="verify({{ $item->id }})" class="badge bg-success mt-2">Verify</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </section>