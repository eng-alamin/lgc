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
															@if ($invoice->payment_status != 'paid')
																<a href="#" class="btn btn-sm btn-success">Pay Now</a>
															@endif
														</div>
														<div class="m-0">
															<div class="fw-bold fs-3 text-gray-800 mb-8">Invoice #{{$invoice->number}}</div>
															<div class="row g-5 mb-11">
                                                                @php
                                                                    $issueDate = \Carbon\Carbon::parse($invoice->date);
                                                                    $dueDate = \Carbon\Carbon::parse($invoice->date)->addDays(7);
                                                                    $daysLeft = now()->diffInDays($dueDate, false);
                                                                @endphp
																<div class="col-sm-6">
																	<div class="fw-semibold fs-7 text-gray-600 mb-1">Issue Date:</div>
																	<div class="fw-bold fs-6 text-gray-800">{{ $issueDate->format('d M Y') }}</div>
																</div>
																<div class="col-sm-6">
																	<div class="fw-semibold fs-7 text-gray-600 mb-1">Due Date:</div>
																	<div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
																		<span class="pe-2">{{ $dueDate->format('d M Y') }}</span>
                                                                        @if ($invoice->payment_status == "paid")
                                                                            <span class="fs-7 text-success d-flex align-items-center">
                                                                                <span class="bullet bullet-dot bg-success me-2"></span>
                                                                                Paid
                                                                            </span>
                                                                        @else
                                                                            <span class="fs-7 text-danger d-flex align-items-center">
                                                                                <span class="bullet bullet-dot bg-danger me-2"></span>
                                                                                @if($daysLeft >= 0)
                                                                                    Due in {{ (int) $daysLeft }} days
                                                                                @else
                                                                                    Overdue {{ (int) abs($daysLeft) }} days
                                                                                @endif
                                                                            </span>
                                                                        @endif
																	</div>
																</div>
															</div>
															<div class="row g-5 mb-12">
																<div class="col-sm-6">
																	<div class="fw-semibold fs-7 text-gray-600 mb-1">Issue For:</div>
																	<div class="fw-bold fs-6 text-gray-800">{{$invoice->form?->client?->user?->name ?? 'Name:____'}}</div>
																	<div class="fw-semibold fs-7 text-gray-600">{{$invoice->form?->data['current_address'] ?? ''}}</div>
																</div>
																<!--end::Col-->
																<!--end::Col-->
																<div class="col-sm-6">
																	<!--end::Label-->
																	<div class="fw-semibold fs-7 text-gray-600 mb-1">Issued By:</div>
																	<!--end::Label-->
																	<!--end::Text-->
																	<div class="fw-bold fs-6 text-gray-800">Let's Go China</div>
																	<!--end::Text-->
																	<!--end::Description-->
																	<div class="fw-semibold fs-7 text-gray-600">Moonlit Regency, House 02, Road 03,
																	<br />Nikunja 2, Dhaka 1229, Bangladesh</div>
																	<!--end::Description-->
																</div>
																<!--end::Col-->
															</div>
															<!--end::Row-->
															<!--begin::Content-->
															<div class="flex-grow-1">
																<!--begin::Table-->
																<div class="table-responsive border-bottom mb-9">
																	<table class="table mb-3">
																		<thead>
																			<tr class="border-bottom fs-6 fw-bold text-muted">
																				<th class="min-w-175px pb-2">Description</th>
																				{{-- <th class="min-w-70px text-end pb-2">Hours</th> --}}
																				{{-- <th class="min-w-80px text-end pb-2">Rate</th> --}}
																				<th class="min-w-100px text-end pb-2">Amount</th>
																			</tr>
																		</thead>
																		<tbody>
                                                                            @foreach ($invoice->items as $item)
																			<tr class="fw-bold text-gray-700 fs-5 text-end">
																				<td class="d-flex align-items-center pt-6">
																				<i class="fa fa-genderless text-danger fs-2 me-2"></i>{{$item['name']}}</td>
																				{{-- <td class="pt-6">80</td> --}}
																				{{-- <td class="pt-6">$40.00</td> --}}
																				<td class="pt-6 text-dark fw-bolder">৳ {{$item['total']}}</td>
																			</tr>
                                                                            @endforeach
																		</tbody>
																	</table>
																</div>
																<!--end::Table-->
																<!--begin::Container-->
																<div class="d-flex justify-content-end">
																	<!--begin::Section-->
																	<div class="mw-300px">
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

																		<div class="d-flex flex-stack mb-3">
																			<div class="fw-semibold pe-10 text-gray-600 fs-7">Subtotal:</div>
																			<div class="text-end fw-bold fs-6 text-gray-800">৳ {{$total}}</div>
																		</div>
																		<div class="d-flex flex-stack mb-3">
																			<div class="fw-semibold pe-10 text-gray-600 fs-7">Advance:</div>
																			<div class="text-end fw-bold fs-6 text-gray-800">- ৳ {{$paid}}</div>
																		</div>
																		<div class="d-flex flex-stack mb-3">
																			<div class="fw-semibold pe-10 text-gray-600 fs-7">Total</div>
																			<div class="text-end fw-bold fs-6 text-gray-800">৳ {{$invoice->total_amount}}</div>
																		</div>
                                                                        @if ($status == 'due')
                                                                            <div class="d-flex flex-stack mb-3">
                                                                                <div class="fw-semibold pe-10 text-danger fs-7">Due</div>
                                                                                <div class="text-end fw-bold fs-6 text-danger">+৳ {{$invoice->due_amount}}</div>
                                                                            </div>
                                                                        @elseif($status == 'partial')
                                                                            <div class="d-flex flex-stack mb-3">
                                                                                <div class="fw-semibold pe-10 text-danger fs-7">Due</div>
                                                                                <div class="text-end fw-bold fs-6 text-danger">+৳ {{$invoice->due_amount}}</div>
                                                                            </div>
                                                                         @endif
																		{{-- <div class="d-flex flex-stack mb-3">
																			<div class="fw-semibold pe-10 text-gray-600 fs-7">VAT 0%</div>
																			<div class="text-end fw-bold fs-6 text-gray-800">0.00</div>
																		</div>
																		<div class="d-flex flex-stack mb-3">
																			<div class="fw-semibold pe-10 text-gray-600 fs-7">Subtotal + VAT</div>
																			<div class="text-end fw-bold fs-6 text-gray-800">$ 20,600.00</div>
																		</div> --}}
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--begin::Sidebar-->
												<div class="m-0">
													<div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
														<div class="mb-8">
                                                            @if ($invoice->invoice_status == "pending")
                                                                <span class="badge badge-light-warning me-2">Pending</span>
                                                            @elseif($invoice->invoice_status == "processing")
                                                                <span class="badge badge-light-primary me-2">Processing</span>
                                                            @elseif($invoice->invoice_status == "approved")
                                                                <span class="badge badge-light-success me-2">Approved</span>
                                                            @else
                                                                <span class="badge badge-light-danger">Cancelled</span>
                                                            @endif
														</div>
														<h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">PAYMENT DETAILS</h6>
														<div class="mb-6">
															<div class="fw-semibold text-gray-600 fs-7">Account:</div>
															<div class="fw-bold text-gray-800 fs-6">###################
															<br />########</div>
														</div>
														<div class="mb-15">
															<div class="fw-semibold text-gray-600 fs-7">Payment Term:</div>
															<div class="fw-bold fs-6 text-gray-800 d-flex align-items-center">7 days
                                                                @if ($invoice->payment_status == "paid")
                                                                    <span class="fs-7 text-success d-flex align-items-center">
                                                                        <span class="bullet bullet-dot bg-success mx-2"></span>
                                                                        Paid
                                                                    </span>
                                                                @else
                                                                    <span class="fs-7 text-danger d-flex align-items-center">
                                                                        <span class="bullet bullet-dot bg-danger mx-2"></span>
                                                                        @if($daysLeft >= 0)
                                                                            Due in {{ (int) $daysLeft }} days
                                                                        @else
                                                                            Overdue {{ (int) abs($daysLeft) }} days
                                                                        @endif
                                                                    </span>
                                                                @endif
                                                            </div>
														</div>
														<h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">SERVICE OVERVIEW</h6>
														<div class="mb-6">
															<div class="fw-semibold text-gray-600 fs-7">Service Name</div>
															<div class="fw-bold fs-6 text-gray-800">{{ucfirst($invoice->form?->type ?? '')}}
															<a href="{{route('form.view', $invoice->form->id)}}" target="_blank" class="link-primary ps-1">View</a></div>
														</div>
														<div class="mb-6">
															<div class="fw-semibold text-gray-600 fs-7">Generated By:</div>
															<div class="fw-bold text-gray-800 fs-6">Mohiuddin Mahim <br> <span class="fs-7">CFO - Let's Go China</span></div>
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