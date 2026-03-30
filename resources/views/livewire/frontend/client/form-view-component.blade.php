<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Let's Go China</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="{{asset('assets/backend/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/backend/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    </head>
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="print-content-only app-default">
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<div class="d-flex flex-column flex-column-fluid">
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<div id="kt_app_content_container" class="app-container container-xxl">
									<div class="card">
										<div class="card-body p-lg-20">
											<div class="d-flex flex-column flex-xl-row">
												<div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
													<div class="mt-n1">
														<div class="d-flex flex-stack pb-10">
															<a href="{{route('home')}}">
																<img alt="Logo" src="{{asset('assets/print/img/logo-with-text.png')}}" width="120" />
															</a>
														</div>
														<div class="m-0">
															<section class="p-2">
																<h4>1. Personal Information</h4>
																<div class="p-2">
																	<p><strong>Name:</strong> {{$form->data['name'] ?? '-' }}</p>
																	<p><strong>Gender:</strong> {{$form->data['gender'] ?? '-' }}</p>
																	<p><strong>Date of Birth:</strong> {{$form->data['date_of_birth'] ?? '-' }}</p>
																	<p><strong>Nationality:</strong> {{$form->data['nationality'] ?? '-' }}</p>
																	<p><strong>Marital Status:</strong> {{$form->data['marital_status'] ?? '-' }}</p>
																	<p><strong>Religion:</strong> {{$form->data['religion'] ?? '-' }}</p>
																</div>
															</section>
															<section class="p-2">
																<h4>2. Contact Details</h4>
																<div class="p-2">
																	<p><strong>Number:</strong> {{$form->data['number'] ?? '-' }}</p>
																	<p><strong>Email:</strong> {{$form->data['email'] ?? '-' }}</p>
																	<p><strong>Current Address:</strong> {{$form->data['current_address'] ?? '-' }}</p>
																	<p><strong>Permanent Address:</strong> {{$form->data['permanent_address'] ?? '-' }}</p>
																</div>
															</section>
															<section class="p-2">
																<h4>3. Passport Information</h4>
																<div class="p-2">
																	<p><strong>Passport Number:</strong> {{$form->data['passport_number'] ?? '-' }}</p>
																	<p><strong>Date of Issue:</strong> {{$form->data['date_of_issue'] ?? '-' }}</p>
																	<p><strong>Date of Expiry:</strong> {{$form->data['date_of_expiry'] ?? '-' }}</p>
																	<p><strong>Place of Issue:</strong> {{$form->data['place_of_issue'] ?? '-' }}</p>
																</div>
															</section>
															<section class="p-2">
																<h4>4. English Language Proficiency</h4>
																<div class="p-2">
																	<p><strong>medium Of Instruction:</strong> 
																		@foreach ($form->data['medium_of_instruction'] as $item)
																			{{ ucfirst($item) }}@if(!$loop->last), @endif
																		@endforeach
																	</p>
																	<p><strong>Duolingo:</strong> {{$form->data['duolingo'] ?? '-' }}</p>
																	<p><strong>Score:</strong> {{$form->data['score'] ?? '-' }}</p>
																</div>
															</section>
															<section class="p-2">
																<h4>5. Intended Study Plan in China</h4>
																<div class="p-2">
																	<p><strong>Intended Level of Study:</strong> {{$form->data['intended_level_of_study'] ?? '-' }}</p>
																	<p><strong>Preferred Field of Study:</strong> {{$form->data['preferred_field_of_study'] ?? '-' }}</p>
																	<p><strong>Preferred Intake:</strong> {{$form->data['preferred_intake'] ?? '-' }}</p>
																	<p><strong>Preferred University:</strong> {{$form->data['preferred_university'] ?? '-' }}</p>
																</div>
															</section>
															<section class="p-2">
																<h4>6. Guardian/Emargency Contact</h4>
																<div class="p-2">
																	<p><strong>Guardian Name:</strong> {{$form->data['guardian_name'] ?? '-' }}</p>
																	<p><strong>Guardian Relationship:</strong> {{$form->data['guardian_relationship'] ?? '-' }}</p>
																	<p><strong>Guardian Number:</strong> {{$form->data['guardian_number'] ?? '-' }}</p>
																	<p><strong>Guardian Address:</strong> {{$form->data['guardian_address'] ?? '-' }}</p>
																</div>
															</section>
															<section class="p-2">
																<h4>7. Medical Information (Basic)</h4>
																<div class="p-2">
																	<p><strong>Have Medical Condition:</strong> {{$form->data['have_medical_condition'] ?? '-' }}</p>
																	@if ($form->data['have_medical_condition'] === "Yes")
																		<p> {{$form->data['medical_condition_detail'] ?? '-' }}</p>
																	@endif
																</div>
															</section>
															<section class="p-2">
																<h4>8. Visa Information</h4>
																<div class="p-2">
																	<p><strong>Have Visa Condition:</strong> {{$form->data['have_visa_condition'] ?? '-' }}</p>
																	@if ($form->data['have_visa_condition'] === "Yes")
																		<p> {{$form->data['visa_condition_detail'] ?? '-' }}</p>
																	@endif
																	<p><strong>Have Visa Refusal Condition:</strong> {{$form->data['have_visa_refusal_condition'] ?? '-' }}</p>
																	@if ($form->data['have_visa_refusal_condition'] === "Yes")
																		<p> {{$form->data['visa_refusal_condition_detail'] ?? '-' }}</p>
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
																			@if(!empty($form->data['educations']))
																				@foreach($form->data['educations'] as $item)
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

															<div class="bg-transparent border-0 no-print">
																<div class="d-flex justify-content-end">
																	<a href="javascript:void(0);" onclick="window.print()" class="btn btn-sm btn-primary me-2">Print</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--begin::Sidebar-->
												<div class="m-0">
													<div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
														<h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">FORM DETAILS</h6>
														<div class="mb-6">
															<div class="fw-semibold text-gray-600 fs-7">Status:</div>
															<div class="fw-bold text-gray-800 fs-6">
																@if ($form->status == "pending")
																	<span class="badge badge-light-warning me-2">Pending</span>
																@elseif($form->status == "processing")
																	<span class="badge badge-light-primary me-2">Processing</span>
																@elseif($form->status == "approved")
																	<span class="badge badge-light-success me-2">Approved</span>
																@else
																	<span class="badge badge-light-danger">Cancelled</span>
																@endif
															</div>
														</div>
														<div class="mb-6">
															<div class="fw-semibold text-gray-600 fs-7">Number:</div>
															<div class="fw-bold text-gray-800 fs-6">{{$form->number}}</div>
														</div>
														{{-- <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">SERVICE OVERVIEW</h6> --}}
														<div class="mb-6">
															<div class="fw-semibold text-gray-600 fs-7">Service Name</div>
															<div class="fw-bold fs-6 text-gray-800">{{ucfirst($form->invoice->form?->type ?? '')}}</div>
														</div>
														<div class="mb-6">
															<div class="fw-semibold text-gray-600 fs-7">Counselor Name</div>
															<div class="fw-bold fs-6 text-gray-800">{{ucfirst($form->counselor->user->name ?? '')}}</div>
														</div>
													</div>
												</div>
												<!--end::Sidebar-->
											</div>
											<!--end::Layout-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::Invoice 2 main-->
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
						<div id="kt_app_footer" class="app-footer">
							<!--begin::Footer container-->
							<div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
								<!--begin::Copyright-->
								<div class="text-dark order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">2026&copy;</span>
									<a href="#" target="_blank" class="text-gray-800 text-hover-primary">Let's Go China</a>
								</div>
								<!--end::Copyright-->
								<!--begin::Menu-->
								<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
									<li class="menu-item">
										<a href="{{route('home')}}" target="_blank" class="menu-link px-2">Home</a>
									</li>
									<li class="menu-item">
										<a href="{{route('about')}}" target="_blank" class="menu-link px-2">About</a>
									</li>
									<li class="menu-item">
										<a href="{{route('contact')}}" target="_blank" class="menu-link px-2">Contact</a>
									</li>
								</ul>
								<!--end::Menu-->
							</div>
							<!--end::Footer container-->
						</div>
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->

		<script src="{{asset('assets/backend/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/backend/js/scripts.bundle.js')}}"></script>
	</body>
	<!--end::Body-->
</html>