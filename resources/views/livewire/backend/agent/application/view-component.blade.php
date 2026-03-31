@section('page-title') Registration Form @endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted text-hover-primary">Home</a></li>
    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
    <li class="breadcrumb-item text-muted"> View Form</li>
@endsection

@push('styles')
    <style>
        .print-header{
            display: none !important;
        }
        .print-footer{
            display: none !important;
        }
        @media print {
             /* @page {
                margin: 130px 40px 90px 40px;
            } */
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print {
                display: none !important;
            }
            .pagebreak {
                clear: both;
                page-break-after: always;
            }
            .print-header{
                display: inline-flex !important;
            }
            .print-footer{
                display: inline-flex !important;
            }
            .card{
                background: inherit !important;
                box-shadow: none !important;
            }
            .print-bg-wrapper {
                position: relative;
                z-index: 1;
            }
            .print-bg-wrapper::before {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('{{ config('setting.logo') ? asset(config('setting.logo')) : '' }}');
                background-repeat: no-repeat;
                background-position: center;
                background-size: 50% 50%;
                opacity: 0.08; /* এখানে transparency control করবেন */
                z-index: -1;
            }
            .print-content-margin-top {
                margin-top: 108px; 
            }
        }

        .print-header {
            position: fixed;
            left: 0;
            right: 0;
            height: 100px;
            border-bottom: 1px solid #ddd;
            background: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .print-footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: 50px;
                border-top: 1px solid #ddd;
                background: #fff;
                display: flex;
                justify-content: space-between;
                align-items: center;
        }

        /* Page number */
        .pageNumber:after {
            content: counter(page);
        }
    </style>
@endpush

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card print-bg-wrapper">
        <div class="card-header border-0 pt-6 no-print">
            <div class="card-title">
                <h2 class="d-flex align-items-center position-relative my-1"> {{ucfirst($data->type ?? '-') }} Form View </h2>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end">
                    <a href="javascript:void(0);" onclick="window.print()" class="btn btn-sm btn-primary me-2">Print</a>
                    <a href="{{route('admin.application.list')}}" class="btn btn-sm btn-primary">Return Back</a>
                </div>
            </div>
        </div>
        <div wire:ignore class="card-body pt-0 print-content">
            <div class="print-content-margin-top"></div>

            <section class="p-4">
                <h4>Personal Information</h4>
                <div class="card w-100 shadow p-5">
                    <p><strong>Name:</strong> {{$data->data['name'] ?? '-' }}</p>
                    <p><strong>Gender:</strong> {{$data->data['gender'] ?? '-' }}</p>
                    <p><strong>Date of Birth:</strong> {{$data->data['date_of_birth'] ?? '-' }}</p>
                    <p><strong>Nationality:</strong> {{$data->data['nationality'] ?? '-' }}</p>
                    <p><strong>Marital Status:</strong> {{$data->data['marital_status'] ?? '-' }}</p>
                    <p><strong>Religion:</strong> {{$data->data['religion'] ?? '-' }}</p>
                </div>
            </section>
            <section class="p-4">
                <h4>Contact Details</h4>
                <div class="card w-100 shadow p-5">
                    <p><strong>Number:</strong> {{$data->data['number'] ?? '-' }}</p>
                    <p><strong>Email:</strong> {{$data->data['email'] ?? '-' }}</p>
                    <p><strong>Current Address:</strong> {{$data->data['current_address'] ?? '-' }}</p>
                    <p><strong>Permanent Address:</strong> {{$data->data['permanent_address'] ?? '-' }}</p>
                </div>
            </section>
            <section class="p-4">
                <h4>Passport Information</h4>
                <div class="card w-100 shadow p-5">
                    <p><strong>Passport Number:</strong> {{$data->data['passport_number'] ?? '-' }}</p>
                    <p><strong>Date of Issue:</strong> {{$data->data['date_of_issue'] ?? '-' }}</p>
                    <p><strong>Date of Expiry:</strong> {{$data->data['date_of_expiry'] ?? '-' }}</p>
                </div>
            </section>
            <section class="p-4">
                <h4>English Language Proficiency</h4>
                <div class="card w-100 shadow p-5">
                    <p><strong>medium Of Instruction:</strong> 
                        @foreach ($data->data['medium_of_instruction'] as $item)
                            {{ ucfirst($item) }}@if(!$loop->last), @endif
                        @endforeach
                    </p>
                    <p><strong>Duolingo:</strong> {{$data->data['duolingo'] ?? '-' }}</p>
                    <p><strong>Score:</strong> {{$data->data['score'] ?? '-' }}</p>
                </div>
            </section>

            <div class="pagebreak"></div>
            <div class="print-content-margin-top"></div>

            <section class="p-4">
                <h4>Intended Study Plan in China</h4>
                <div class="card w-100 shadow p-5">
                    <p><strong>Intended Level of Study:</strong> {{$data->data['intended_level_of_study'] ?? '-' }}</p>
                    <p><strong>Preferred Field of Study:</strong> {{$data->data['preferred_field_of_study'] ?? '-' }}</p>
                    <p><strong>Preferred Intake:</strong> {{$data->data['preferred_intake'] ?? '-' }}</p>
                    <p><strong>Preferred University:</strong> {{$data->data['preferred_university'] ?? '-' }}</p>
                </div>
            </section>
            <section class="p-4">
                <h4>Guardian/Emargency Contact</h4>
                <div class="card w-100 shadow p-5">
                    <p><strong>Guardian Name:</strong> {{$data->data['guardian_name'] ?? '-' }}</p>
                    <p><strong>Guardian Relationship:</strong> {{$data->data['guardian_relationship'] ?? '-' }}</p>
                    <p><strong>Guardian Number:</strong> {{$data->data['guardian_number'] ?? '-' }}</p>
                    <p><strong>Guardian Address:</strong> {{$data->data['guardian_address'] ?? '-' }}</p>
                </div>
            </section>
            <section class="p-4">
                <h4>Medical Information (Basic)</h4>
                <div class="card w-100 shadow p-5">
                    <p><strong>Have Medical Condition:</strong> {{$data->data['have_medical_condition'] ?? '-' }}</p>
                    @if ($data->data['have_medical_condition'] === "Yes")
                        <p> {{$data->data['medical_condition_detail'] ?? '-' }}</p>
                    @endif
                </div>
            </section>
            <section class="p-4">
                <h4>Visa Information</h4>
                <div class="card w-100 shadow p-5">
                    <p><strong>Have Visa Condition:</strong> {{$data->data['have_visa_condition'] ?? '-' }}</p>
                    @if ($data->data['have_visa_condition'] === "Yes")
                        <p> {{$data->data['visa_condition_detail'] ?? '-' }}</p>
                    @endif
                    <p><strong>Have Visa Refusal Condition:</strong> {{$data->data['have_visa_refusal_condition'] ?? '-' }}</p>
                    @if ($data->data['have_visa_refusal_condition'] === "Yes")
                        <p> {{$data->data['visa_refusal_condition_detail'] ?? '-' }}</p>
                    @endif
                </div>
            </section>

            <div class="pagebreak"></div>
            <div class="print-content-margin-top"></div>

            <section class="p-4">
                <h4>Education Background</h4>
                <div class="card w-100 shadow p-5">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Degree</th>
                                <th>Institution</th>
                                <th>Year</th>
                                <th>Grade/CGPA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data->data['educations']))
                                @foreach($data->data['educations'] as $item)
                                    <tr>
                                        <td>{{ $item['degree'] ?? '-' }}</td>
                                        <td>{{ $item['institution'] ?? '-' }}</td>
                                        <td>{{ $item['year'] ?? '-' }}</td>
                                        <td>{{ $item['grade'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No education records found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

        {{-- Invoice --}}
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h2 class="d-flex align-items-center position-relative my-1"> {{ucfirst($data->type ?? '-') }} Invoice View </h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <section class="p-4">
                <h4>{{ucfirst($data->type ?? '-') }} Invoice</h4>
                <div class="card w-100 shadow p-5">
                    @forelse ($data->invoices as $invoice)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold"><a href="{{ route('invoices.view', $invoice->id) }}" target="_blank">{{ $invoice->number }}</a></td>
                                    <td class="fw-bold">{{ $invoice->total_amount }}</td>
                                    <td class="fw-bold">{{ $invoice->paid_amount }}</td>
                                    <td class="fw-bold">{{ $invoice->due_amount }}</td>
                                    <td class="fw-bold">{{ ucfirst($invoice->status) }}</td>
                                </tr>
                            </tbody>
                         </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->items as $item)
                                    <tr>
                                        <td>{{ $item['name'] ?? '-' }}</td>
                                        <td>{{ $item['total'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        @php
                                            $total = 0;
                                            $paid = 0;

                                            foreach ($invoice->items as $item) {
                                                $total += (float) ($item['total'] ?? 0);
                                                $paid  += (float) ($item['advance'] ?? 0);
                                            }

                                            $due = max($total - $paid, 0);

                                            if ($paid == 0) {
                                                $status = 'due';
                                            } elseif ($paid < $total) {
                                                $status = 'partial';
                                            } else {
                                                $status = 'paid';
                                            }
                                        @endphp
                                        <td></td>
                                        <td class="fw-bold">Total : {{ $total }}</td>
                                    </tr>
                            </tbody>
                        </table>
                    @empty
                       <div class="text-center"> No invoice records found </div>
                    @endforelse
                </div>
            </section>
        </div>

        <div class="print-header">
            <div class="left">
                <img src="{{ asset(config('setting.logo')) }}" height="60">
            </div>
            <div class="center text-center">
                <h3>Let's Go China</h3>
                <p>Moonlit Regency, Flat-5/A, House-2, Road-3, Nikunja-2 <br> Dhaka-1229, Bangladesh</p>
            </div>
            <div class="right">
                <p>Date: {{ now()->format('d M Y') }}</p>
            </div>
        </div>
        <div class="print-footer">
            <div>Generated by System</div>
            <div>Page <span class="pageNumber"></span></div>
        </div>

    </div>
</div>