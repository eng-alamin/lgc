<div>
    <div class="header-space"></div>

    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h6>Total Applications</h6>
                        <h3 class="text-primary">{{ $form_total }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h6>In Process</h6>
                        <h3 class="text-warning">{{ $form_process }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h6>Approved</h6>
                        <h3 class="text-success">{{ $form_approved }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h6>Rejected</h6>
                        <h3 class="text-danger">{{ $form_rejected }}</h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex align-items-start p-5">
                <div class="nav flex-column align-items-start nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-one-tab" data-bs-toggle="pill" data-bs-target="#v-pills-one" type="button" role="tab" aria-controls="v-pills-one" aria-selected="true">Application Progress Tracker</button>
                    <button class="nav-link" id="v-pills-two-tab" data-bs-toggle="pill" data-bs-target="#v-pills-two" type="button" role="tab" aria-controls="v-pills-two" aria-selected="false">Payment Status</button>
                    <button class="nav-link" id="v-pills-three-tab" data-bs-toggle="pill" data-bs-target="#v-pills-three" type="button" role="tab" aria-controls="v-pills-three" aria-selected="false">My Application</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-one" role="tabpanel" aria-labelledby="v-pills-one-tab">
                        <section class="p-0">
                            <h4>Application Progress Tracker</h4>
                            @foreach($forms as $form)
                                <div class="card w-100 shadow p-3 mt-2">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p><strong>Form ID:</strong> {{ $form->serial }}</p>
                                            <p><strong>Track ID:</strong> {{ $form->number }}</p>
                                        </div>
                                        <div>
                                            <p><strong>Form Name: </strong> {{ ucfirst($form->type) }}</p>
                                            <p><p><strong>Status: </strong span class="badge bg-info"> {{ ucfirst($form->formStatuses->first()?->status ?? 'draft') }}</span></p>
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($form->formStatuses as $status)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $status->status }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($status->created_at)->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-two" role="tabpanel" aria-labelledby="v-pills-two-tab">
                        <section class="p-0">
                            <h4>Payment Status</h4>
                            <div class="card w-100 shadow p-3 mt-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($payments as $p)
                                            <tr>
                                                <td>{{ $p->invoice_number }}</td>
                                                <td>{{ $p->amount }}</td>
                                                <td>
                                                    @if($p->status == 'paid')
                                                        <span class="badge bg-success">Paid</span>
                                                    @else
                                                        <span class="badge bg-danger">Pending</span>
                                                    @endif
                                                </td>
                                                <td>{{ $p->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="v-pills-three" role="tabpanel" aria-labelledby="v-pills-three-tab">
                        <section class="p-0">
                            <h4>My Application</h4>
                            <div class="card w-100 shadow p-3 mt-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Form ID</th>
                                            <th>Track ID</th>
                                            <th>From Name</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($forms as $item)
                                            <tr>
                                                <td>{{ $item->serial }}</td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{ ucfirst($item->type) }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                                <td><a href="{{route('application.view', $item->id)}}" target="_blank">View</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
    </div>
</div>
