<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href=""/>
		<title>{{ $title ?? config('app.name') }}</title>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
		{{-- <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." /> --}}
		{{-- <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" /> --}}

		{{-- <link rel="canonical" href="#" /> --}}
		<link rel="shortcut icon" href="{{ asset(config('setting.favicon'))}}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		{{-- <link href="{{asset('assets/backend/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
		<link href="{{asset('assets/backend/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{asset('assets/backend/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/backend/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	
        <style>
            .print-header{
                display: none !important;
            }
            .print-footer{
                display: none !important;
            }
            @media print {
                @page {
                    margin: 130px 40px 90px 40px;
                }
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
                .print-content-margin-top {
                    margin-top: 108px; 
                }
                .print-header{
                    display: inline-flex !important;
                }
                .print-footer{
                    display: inline-flex !important;
                }
                .pageNumber:after {
                    content: counter(page);
                }
            }

            .print-bg-wrapper {
                max-width: 880px;
                padding: 30px 15px;
                margin-left: auto;
                margin-right: auto;
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
            .card{
                background: inherit !important;
                box-shadow: none !important;
            }
            .print-header {
                position: fixed;
                left: 0;
                right: 0;
                top: 0;
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
        </style>
    </head>
        <div id="kt_app_content_container" class="app-container container">
            <div class="card print-bg-wrapper">
                <div class="card-header border-0 pt-6 no-print">
                    <div class="card-title">
                        <h2 class="d-flex align-items-center position-relative my-1"> {{ucfirst($application->type ?? '-') }} Application View </h2>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end">
                            <a href="javascript:void(0);" onclick="window.print()" class="btn btn-sm btn-primary me-2">Print</a>
                            <a href="{{route('agent.application.list')}}" class="btn btn-sm btn-primary">Return Back</a>
                        </div>
                    </div>
                </div>
                <div wire:ignore class="card-body pt-0 print-content">
                    <div class="print-content-margin-top"></div>

                    <section class="p-4">
                        <h4>Personal Information</h4>
                        <div class="card w-100 shadow p-5">
                            <p><strong>Name:</strong> {{$application->data['name'] ?? '-' }}</p>
                            <p><strong>Gender:</strong> {{$application->data['gender'] ?? '-' }}</p>
                            <p><strong>Date of Birth:</strong> {{$application->data['date_of_birth'] ?? '-' }}</p>
                            <p><strong>Nationality:</strong> {{$application->data['nationality'] ?? '-' }}</p>
                            <p><strong>Marital Status:</strong> {{$application->data['marital_status'] ?? '-' }}</p>
                            <p><strong>Religion:</strong> {{$application->data['religion'] ?? '-' }}</p>
                        </div>
                    </section>
                    <section class="p-4">
                        <h4>Contact Details</h4>
                        <div class="card w-100 shadow p-5">
                            <p><strong>Number:</strong> {{$application->data['number'] ?? '-' }}</p>
                            <p><strong>Email:</strong> {{$application->data['email'] ?? '-' }}</p>
                            <p><strong>Current Address:</strong> {{$application->data['current_address'] ?? '-' }}</p>
                            <p><strong>Permanent Address:</strong> {{$application->data['permanent_address'] ?? '-' }}</p>
                        </div>
                    </section>
                    <section class="p-4">
                        <h4>Passport Information</h4>
                        <div class="card w-100 shadow p-5">
                            <p><strong>Passport Number:</strong> {{$application->data['passport_number'] ?? '-' }}</p>
                            <p><strong>Date of Issue:</strong> {{$application->data['date_of_issue'] ?? '-' }}</p>
                            <p><strong>Date of Expiry:</strong> {{$application->data['date_of_expiry'] ?? '-' }}</p>
                            <p><strong>Place of Issue:</strong> {{$application->data['place_of_issue'] ?? '-' }}</p>
                        </div>
                    </section>
                    <section class="p-4">
                        <h4>English Language Proficiency</h4>
                        <div class="card w-100 shadow p-5">
                            <p><strong>medium Of Instruction:</strong> 
                                @foreach ($application->data['medium_of_instruction'] as $item)
                                    {{ ucfirst($item) }}@if(!$loop->last), @endif
                                @endforeach
                            </p>
                            <p><strong>Duolingo:</strong> {{$application->data['duolingo'] ?? '-' }}</p>
                            <p><strong>Score:</strong> {{$application->data['score'] ?? '-' }}</p>
                        </div>
                    </section>

                    <div class="pagebreak"></div>
                    <div class="print-content-margin-top"></div>

                    <section class="p-4">
                        <h4>Intended Study Plan in China</h4>
                        <div class="card w-100 shadow p-5">
                            <p><strong>Intended Level of Study:</strong> {{$application->data['intended_level_of_study'] ?? '-' }}</p>
                            <p><strong>Preferred Field of Study:</strong> {{$application->data['preferred_field_of_study'] ?? '-' }}</p>
                            <p><strong>Preferred Intake:</strong> {{$application->data['preferred_intake'] ?? '-' }}</p>
                            <p><strong>Preferred University:</strong> {{$application->data['preferred_university'] ?? '-' }}</p>
                        </div>
                    </section>
                    <section class="p-4">
                        <h4>Guardian/Emargency Contact</h4>
                        <div class="card w-100 shadow p-5">
                            <p><strong>Guardian Name:</strong> {{$application->data['guardian_name'] ?? '-' }}</p>
                            <p><strong>Guardian Relationship:</strong> {{$application->data['guardian_relationship'] ?? '-' }}</p>
                            <p><strong>Guardian Number:</strong> {{$application->data['guardian_number'] ?? '-' }}</p>
                            <p><strong>Guardian Address:</strong> {{$application->data['guardian_address'] ?? '-' }}</p>
                        </div>
                    </section>
                    <section class="p-4">
                        <h4>Medical Information (Basic)</h4>
                        <div class="card w-100 shadow p-5">
                            <p><strong>Have Medical Condition:</strong> {{$application->data['have_medical_condition'] ?? '-' }}</p>
                            @if ($application->data['have_medical_condition'] === "Yes")
                                <p> {{$application->data['medical_condition_detail'] ?? '-' }}</p>
                            @endif
                        </div>
                    </section>
                    <section class="p-4">
                        <h4>Visa Information</h4>
                        <div class="card w-100 shadow p-5">
                            <p><strong>Have Visa Condition:</strong> {{$application->data['have_visa_condition'] ?? '-' }}</p>
                            @if ($application->data['have_visa_condition'] === "Yes")
                                <p> {{$application->data['visa_condition_detail'] ?? '-' }}</p>
                            @endif
                            <p><strong>Have Visa Refusal Condition:</strong> {{$application->data['have_visa_refusal_condition'] ?? '-' }}</p>
                            @if ($application->data['have_visa_refusal_condition'] === "Yes")
                                <p> {{$application->data['visa_refusal_condition_detail'] ?? '-' }}</p>
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
                                    @if(!empty($application->data['educations']))
                                        @foreach($application->data['educations'] as $item)
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
	</body>
</html>