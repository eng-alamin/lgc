<div>
    <div class="header-space no-print"></div>

    @push('styles')
        <style>
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
                    display: inline-block !important;
                }
                .print-footer{
                    display: inline-flex !important;
                }
                .card{
                    background: inherit !important;
                    box-shadow: inherit !important;
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
                    opacity: 0.08;
                    z-index: -1;
                }
                .print-content-margin-top {
                    margin-top: 168px; 
                }
            }

            .print-header{
                display: none;
            }
            .print-footer{
                display: none;
            }
            .print-header-content {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                border-bottom: 1px solid #ddd;
                background: #fff;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .print-footer-content {
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
            .pageNumber:after {
                content: counter(page);
            }
        </style>
    @endpush

    <div class="container">
        <div class="card shadow p-4 m-4 border-0 print-bg-wrapper">
            <div class="card-header bg-transparent border-0 pt-6 no-print">
                <div class="card-title">
                    <h2 class="d-flex align-items-center position-relative my-1"> {{ucfirst($data->type ?? '-') }} Application View </h2>
                </div>
            </div>
            <div class="card-body pt-0 print-content">

                <div class="print-content-margin-top"></div>

                <section class="p-2">
                    <h4>1. Personal Information</h4>
                    <div class="p-2">
                        <p><strong>Name:</strong> {{$data->data['name'] ?? '-' }}</p>
                        <p><strong>Gender:</strong> {{$data->data['gender'] ?? '-' }}</p>
                        <p><strong>Date of Birth:</strong> {{$data->data['date_of_birth'] ?? '-' }}</p>
                        <p><strong>Nationality:</strong> {{$data->data['nationality'] ?? '-' }}</p>
                        <p><strong>Marital Status:</strong> {{$data->data['marital_status'] ?? '-' }}</p>
                        <p><strong>Religion:</strong> {{$data->data['religion'] ?? '-' }}</p>
                    </div>
                </section>
                <section class="p-2">
                    <h4>2. Contact Details</h4>
                    <div class="p-2">
                        <p><strong>Number:</strong> {{$data->data['number'] ?? '-' }}</p>
                        <p><strong>Email:</strong> {{$data->data['email'] ?? '-' }}</p>
                        <p><strong>Current Address:</strong> {{$data->data['current_address'] ?? '-' }}</p>
                        <p><strong>Permanent Address:</strong> {{$data->data['permanent_address'] ?? '-' }}</p>
                    </div>
                </section>
                <section class="p-2">
                    <h4>3. Passport Information</h4>
                    <div class="p-2">
                        <p><strong>Passport Number:</strong> {{$data->data['passport_number'] ?? '-' }}</p>
                        <p><strong>Date of Issue:</strong> {{$data->data['date_of_issue'] ?? '-' }}</p>
                        <p><strong>Date of Expiry:</strong> {{$data->data['date_of_expiry'] ?? '-' }}</p>
                    </div>
                </section>

                <div class="pagebreak"></div>
                <div class="print-content-margin-top"></div>

                <section class="p-2">
                    <h4>4. English Language Proficiency</h4>
                    <div class="p-2">
                        <p><strong>medium Of Instruction:</strong> {{$data->data['medium_of_instruction'] ?? '-' }}</p>
                        <p><strong>Duolingo:</strong> {{$data->data['duolingo'] ?? '-' }}</p>
                        <p><strong>Score:</strong> {{$data->data['score'] ?? '-' }}</p>
                    </div>
                </section>
                <section class="p-2">
                    <h4>5. Intended Study Plan in China</h4>
                    <div class="p-2">
                        <p><strong>Intended Level of Study:</strong> {{$data->data['intended_level_of_study'] ?? '-' }}</p>
                        <p><strong>Preferred Field of Study:</strong> {{$data->data['preferred_field_of_study'] ?? '-' }}</p>
                        <p><strong>Preferred Intake:</strong> {{$data->data['preferred_intake'] ?? '-' }}</p>
                        <p><strong>Preferred University:</strong> {{$data->data['preferred_university'] ?? '-' }}</p>
                    </div>
                </section>
                <section class="p-2">
                    <h4>6. Guardian/Emargency Contact</h4>
                    <div class="p-2">
                        <p><strong>Guardian Name:</strong> {{$data->data['guardian_name'] ?? '-' }}</p>
                        <p><strong>Guardian Relationship:</strong> {{$data->data['guardian_relationship'] ?? '-' }}</p>
                        <p><strong>Guardian Number:</strong> {{$data->data['guardian_number'] ?? '-' }}</p>
                        <p><strong>Guardian Address:</strong> {{$data->data['guardian_address'] ?? '-' }}</p>
                    </div>
                </section>
                <section class="p-2">
                    <h4>7. Medical Information (Basic)</h4>
                    <div class="p-2">
                        <p><strong>Have Medical Condition:</strong> {{$data->data['have_medical_condition'] ?? '-' }}</p>
                        @if ($data->data['have_medical_condition'] === "Yes")
                            <p> {{$data->data['medical_condition_detail'] ?? '-' }}</p>
                        @endif
                    </div>
                </section>

                <div class="pagebreak"></div>
                <div class="print-content-margin-top"></div>

                <section class="p-2">
                    <h4>8. Visa Information</h4>
                    <div class="p-2">
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
                <section class="p-2">
                    <h4>9. Education Background</h4>
                    <div class="p-2">
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

            <div class="card-footer bg-transparent border-0 no-print">
                <div class="d-flex justify-content-end">
                    <a href="javascript:void(0);" onclick="window.print()" class="btn btn-sm btn-primary me-2">Print</a>
                </div>
            </div>

            <div class="print-header">
                <div class="print-header-content p-2">
                    <div class="center text-center">
                        <img src="{{ asset(config('setting.logo')) }}" height="60">
                        <p>Moonlit Regency, Flat-5/A, House-2, Road-3, Nikunja-2 <br> Dhaka-1229, Bangladesh</p>
                    </div>
                </div>
            </div>
            <div class="print-header">
                <div class="print-footer-content p-2">
                    <div>Generated by System - Date: {{ now()->format('d M Y') }}</div>
                    <div>Page <span class="pageNumber"></span></div>
                </div>
            </div>
        </div>
    </div>

</div>