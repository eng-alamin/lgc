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
                    <h5 class="mb-4">Invoices</h5>
                    <table class="table border-0">
                        <thead>
                            <tr class="border">
                                <th class="border-0">SL</th>
                                <th class="border-0">Number</th>
                                <th class="border-0">Total</th>
                                <th class="border-0">Paid</th>
                                <th class="border-0">Due</th>
                                <th class="border-0">Payment</th>
                                <th class="border-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->invoices as $item)
                                <tr class="border">
                                    <td class="border-0">{{ $loop->iteration }}</td>
                                    <td class="border-0"><a href="{{route('invoices.view', $item->id)}}" target="_blank">{{ $item->number }}</a></td>
                                    <td class="border-0">{{ $item->total_amount }}</td>
                                    <td class="border-0">{{ $item->paid_amount }}</td>
                                    <td class="border-0">{{ $item->due_amount }}</td>
                                    <td class="border-0">
                                        @if($item->payment_status == "paid")
                                            <span class="badge bg-success">Paid</span>
                                        @elseif($item->payment_status == "partial")
                                            <span class="badge bg-warning">Partial</span>
                                        @else
                                            <span class="badge bg-danger">Due</span>
                                        @endif
                                    </td>
                                    <td class="border-0">
                                        @if ($item->invoice_status == "pending")
                                            <span class="badge bg-warning me-2">Pending</span>
                                        @elseif($item->invoice_status == "processing")
                                            <span class="badge bg-primary me-2">Processing</span>
                                        @elseif($item->invoice_status == "approved")
                                            <span class="badge bg-success me-2">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            <tr class="border">
                                <td class="border-0 text-center fw-bold" colspan="7"> No Records Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </section>