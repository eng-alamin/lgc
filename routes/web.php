<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/auth/redirect/{provider}', [App\Http\Controllers\SocialiteController::class, 'redirect']);

Route::get('account-deactivated', function () { return view('livewire/auth/account-deactivated'); });
Route::get('account-approved', function () {
    if( auth()->user()['account-approved'] == 0){
        return view('livewire/auth/account-approved');
    }else{
        return redirect()->intended(\App\Providers\RouteServiceProvider::HOME);
    }
})->name('account-approved');
Route::get('error/error-401', function () { return view('error/error-401'); });
Route::get('error/error-500', function () { return view('error/error-500'); });

use App\Http\Controllers\SocialAuthController;
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

Route::middleware('guest')->group(function () {
    Route::get('signup', App\Livewire\Auth\SignupComponent::class)->name('signup');
    Route::get('login', App\Livewire\Auth\LoginComponent::class)->name('login');
    Route::get('signin', App\Livewire\Auth\LoginComponent::class)->name('signin');
    Route::get('forget-password', App\Livewire\Auth\ForgotPasswordComponent::class)->name('forget.password');
    Route::post('forget-password', [App\Livewire\Auth\ForgotPasswordComponent::class, 'store'])->name('forget.password');
    Route::get('reset-password/{id}', App\Livewire\Auth\ResetPasswordComponent ::class)->name('reset.password');
    Route::post('reset-password', [App\Livewire\Auth\ResetPasswordComponent::class, 'store'])->name('reset.password');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', App\Livewire\Auth\EmailVerificationPromptComponent::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', App\Livewire\Auth\VerifyEmailComponent::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [App\Livewire\Auth\EmailVerificationNotificationComponent::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('email-verification-resend', App\Livewire\Auth\EmailVerificationResendComponent::class)->name('email.verification.resend');
    Route::get('email-verification-verify/{token}', App\Livewire\Auth\EmailVerificationVerifyComponent::class)->name('email.verification.verify');

    Route::get('logout', [App\Livewire\Auth\LoginComponent::class, 'logout'])->name('logout');
    
    Route::get('personalinfo', \App\Livewire\Frontend\Client\PersonalInformationComponent::class)->name('personalinfo');
    Route::get('academicinfo', \App\Livewire\Frontend\Client\AcademicInformationComponent::class)->name('academicinfo');
    Route::get('documentmanager', \App\Livewire\Frontend\Client\DocumentManagerComponent::class)->name('documentmanager');
    Route::get('progress', \App\Livewire\Frontend\Client\ProgressComponent::class)->name('progress');
    
    Route::get('form', \App\Livewire\Frontend\Client\FormComponent::class)->name('form');
    Route::get('form/view/{id}', function($id){
        $form = \App\Models\Form::with('client')->findOrFail($id);;
        return view('livewire.frontend.client.form-view-component', compact('form'));
    })->name('form.view');

    Route::get('invoices', \App\Livewire\Frontend\Client\InvoiceComponent::class)->name('invoices');
    Route::get('invoices/view/{id}', function($id){
        $invoice = \App\Models\Invoice::with('form.client')->findOrFail($id);
        return view('livewire.frontend.client.invoice-view-component', compact('invoice'));
    })->name('invoices.view');

    Route::get('notices', \App\Livewire\Frontend\Client\NoticeComponent::class)->name('notices');
    Route::get('notices/view/{id}', \App\Livewire\Frontend\Client\NoticeViewComponent::class)->name('notices.view');

    //Remove
    Route::get('application/view/{id}', App\Livewire\Frontend\Client\ApplicationViewComponent::class)->name('application.view');
    
});

// Start Frontend
Route::get('agent', App\Livewire\Auth\AgentComponent::class)->name('agent');
Route::get('/', \App\Livewire\Frontend\Home::class)->name('home');
Route::get('workprocess', \App\Livewire\Frontend\Workprocess::class)->name('workprocess');
Route::get('essentials', \App\Livewire\Frontend\Essential::class)->name('essential');
Route::get('essential/detail/{id}', \App\Livewire\Frontend\EssentialDetail::class)->name('essential.detail');
Route::get('visa', \App\Livewire\Frontend\Visa::class)->name('visa');
Route::get('visa/detail/{id}', \App\Livewire\Frontend\VisaDetail::class)->name('visa.detail');
Route::get('contact', \App\Livewire\Frontend\Contact::class)->name('contact');
Route::get('blogs', \App\Livewire\Frontend\Blog::class)->name('blogs');
Route::get('blog/detail/{id}', \App\Livewire\Frontend\BlogDetail::class)->name('blog.detail');
Route::get('casestudies', \App\Livewire\Frontend\Casestudy::class)->name('casestudies');
Route::get('casestudies/detail/{id}', \App\Livewire\Frontend\CasestudyDetail::class)->name('casestudies.detail');
Route::get('about', \App\Livewire\Frontend\About::class)->name('about');
Route::get('appointment', \App\Livewire\Frontend\Appointment::class)->name('appointment');
Route::get('teams', \App\Livewire\Frontend\Team::class)->name('teams');
Route::get('universities', \App\Livewire\Frontend\University::class)->name('universities');
Route::get('courses', \App\Livewire\Frontend\Course::class)->name('courses');
Route::get('search', \App\Livewire\Frontend\Search::class)->name('search');

Route::get('about-us', \App\Livewire\Frontend\Home::class)->name('front.about');
Route::get('contact-us', \App\Livewire\Frontend\Home::class)->name('front.contact');
Route::get('/unsubscribe/{email}', function ($email) {
    \App\Models\Subscriber::where('email', $email)->update(['is_active' => false]);
    return 'You have been unsubscribed.';
});

Route::get('term-condition', \App\Livewire\Frontend\Home::class)->name('front.termcondition');
Route::get('privacy-policy', \App\Livewire\Frontend\Home::class)->name('front.privacypolicy');
// End Frontend

Route::get('attendance', \App\Livewire\Frontend\AttendanceComponent::class)->name('attendance');

// Admin
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('admin/dashboard', \App\Livewire\Backend\Admin\Dashboard::class)->name('admin.dashboard');

    // Page CRUD
    Route::get('admin/crud/sliders', \App\Livewire\Backend\Admin\Crud\Slider::class)->name('admin.crud.slider');
    Route::get('admin/crud/features', \App\Livewire\Backend\Admin\Crud\Feature::class)->name('admin.crud.feature');
    Route::get('admin/crud/essentials', \App\Livewire\Backend\Admin\Crud\Essential::class)->name('admin.crud.essential');
    Route::get('admin/crud/provinces', \App\Livewire\Backend\Admin\Crud\Province::class)->name('admin.crud.province');
    Route::get('admin/crud/chooses', \App\Livewire\Backend\Admin\Crud\Choose::class)->name('admin.crud.choose');
    Route::get('admin/crud/faqs', \App\Livewire\Backend\Admin\Crud\Faq::class)->name('admin.crud.faq');
    Route::get('admin/crud/testimonials', \App\Livewire\Backend\Admin\Crud\Testimonial::class)->name('admin.crud.testimonial');
    Route::get('admin/crud/logos', \App\Livewire\Backend\Admin\Crud\Logo::class)->name('admin.crud.logo');
    Route::get('admin/crud/blogs', \App\Livewire\Backend\Admin\Crud\Blog::class)->name('admin.crud.blog');
    Route::get('admin/crud/workprocess', \App\Livewire\Backend\Admin\Crud\Workprocess::class)->name('admin.crud.workprocess');
    Route::get('admin/crud/visa', \App\Livewire\Backend\Admin\Crud\Visa::class)->name('admin.crud.visa');
    Route::get('admin/crud/casestudies', \App\Livewire\Backend\Admin\Crud\Casestudy::class)->name('admin.crud.casestudies');
    Route::get('admin/crud/teams', \App\Livewire\Backend\Admin\Crud\Team::class)->name('admin.crud.teams');
    Route::get('admin/crud/universities', \App\Livewire\Backend\Admin\Crud\University::class)->name('admin.crud.universities');
    Route::get('admin/crud/courses', \App\Livewire\Backend\Admin\Crud\Course::class)->name('admin.crud.courses');

    Route::get('admin/section/feature', \App\Livewire\Backend\Admin\Section\Feature::class)->name('admin.section.feature');
    Route::patch('admin/section/feature/update/{id}', [App\Livewire\Backend\Admin\Section\Feature::class, 'sectionUpdate'])->name('admin.section.feature.update');
    Route::get('admin/section/essential', \App\Livewire\Backend\Admin\Section\Essential::class)->name('admin.section.essential');
    Route::patch('admin/section/essential/update/{id}', [App\Livewire\Backend\Admin\Section\Essential::class, 'sectionUpdate'])->name('admin.section.essential.update');
    Route::get('admin/section/about', \App\Livewire\Backend\Admin\Section\About::class)->name('admin.section.about');
    Route::patch('admin/section/about/update/{id}', [App\Livewire\Backend\Admin\Section\about::class, 'sectionUpdate'])->name('admin.section.about.update');
    Route::get('admin/section/choose', \App\Livewire\Backend\Admin\Section\Choose::class)->name('admin.section.choose');
    Route::patch('admin/section/choose/update/{id}', [App\Livewire\Backend\Admin\Section\Choose::class, 'sectionUpdate'])->name('admin.section.choose.update');
    Route::get('admin/section/funfact', \App\Livewire\Backend\Admin\Section\Funfact::class)->name('admin.section.funfact');
    Route::patch('admin/section/funfact/update/{id}', [App\Livewire\Backend\Admin\Section\Funfact::class, 'sectionUpdate'])->name('admin.section.funfact.update');
    Route::get('admin/section/faq', \App\Livewire\Backend\Admin\Section\Faq::class)->name('admin.section.faq');
    Route::patch('admin/section/faq/update/{id}', [App\Livewire\Backend\Admin\Section\Faq::class, 'sectionUpdate'])->name('admin.section.faq.update');
    Route::get('admin/section/process', \App\Livewire\Backend\Admin\Section\Process::class)->name('admin.section.process');
    Route::patch('admin/section/process/update/{id}', [App\Livewire\Backend\Admin\Section\Process::class, 'sectionUpdate'])->name('admin.section.process.update');
    Route::get('admin/section/visa', \App\Livewire\Backend\Admin\Section\Visa::class)->name('admin.section.visa');
    Route::patch('admin/section/visa/update/{id}', [App\Livewire\Backend\Admin\Section\Visa::class, 'sectionUpdate'])->name('admin.section.visa.update');
    Route::get('admin/section/testimonial', \App\Livewire\Backend\Admin\Section\Testimonial::class)->name('admin.section.testimonial');
    Route::patch('admin/section/testimonial/update/{id}', [App\Livewire\Backend\Admin\Section\Testimonial::class, 'sectionUpdate'])->name('admin.section.testimonial.update');
    Route::get('admin/section/team', \App\Livewire\Backend\Admin\Section\Team::class)->name('admin.section.team');
    Route::patch('admin/section/team/update/{id}', [App\Livewire\Backend\Admin\Section\Team::class, 'sectionUpdate'])->name('admin.section.team.update');
    Route::get('admin/section/casestudies', \App\Livewire\Backend\Admin\Section\Casestudy::class)->name('admin.section.casestudies');
    Route::patch('admin/section/casestudies/update/{id}', [App\Livewire\Backend\Admin\Section\Casestudy::class, 'sectionUpdate'])->name('admin.section.casestudies.update');
    Route::get('admin/section/blog', \App\Livewire\Backend\Admin\Section\Blog::class)->name('admin.section.blog');
    Route::patch('admin/section/blog/update/{id}', [App\Livewire\Backend\Admin\Section\Blog::class, 'sectionUpdate'])->name('admin.section.blog.update');
    Route::get('admin/section/intro', \App\Livewire\Backend\Admin\Section\Intro::class)->name('admin.section.intro');
    Route::patch('admin/section/intro/update/{id}', [App\Livewire\Backend\Admin\Section\Intro::class, 'sectionUpdate'])->name('admin.section.intro.update');
    Route::get('admin/section/contact', \App\Livewire\Backend\Admin\Section\Contact::class)->name('admin.section.contact');
    Route::patch('admin/section/contact/update/{id}', [App\Livewire\Backend\Admin\Section\Contact::class, 'sectionUpdate'])->name('admin.section.contact.update');
    Route::get('admin/section/subscriber', \App\Livewire\Backend\Admin\Section\Subscriber::class)->name('admin.section.subscriber');
    Route::patch('admin/section/subscriber/update/{id}', [App\Livewire\Backend\Admin\Section\Subscriber::class, 'sectionUpdate'])->name('admin.section.subscriber.update');
    Route::get('admin/section/university', \App\Livewire\Backend\Admin\Section\University::class)->name('admin.section.university');
    Route::patch('admin/section/university/update/{id}', [App\Livewire\Backend\Admin\Section\university::class, 'sectionUpdate'])->name('admin.section.university.update');
    Route::get('admin/section/course', \App\Livewire\Backend\Admin\Section\Course::class)->name('admin.section.course');
    Route::patch('admin/section/course/update/{id}', [App\Livewire\Backend\Admin\Section\Course::class, 'sectionUpdate'])->name('admin.section.course.update');
    Route::get('admin/section/footer', \App\Livewire\Backend\Admin\Section\Footer::class)->name('admin.section.footer');
    Route::patch('admin/section/footer/update/{id}', [App\Livewire\Backend\Admin\Section\Footer::class, 'sectionUpdate'])->name('admin.section.footer.update');

    Route::get('admin/banners', App\Livewire\Backend\Admin\Banner::class)->name('admin.banners');

    Route::get('admin/application/list', App\Livewire\Backend\Admin\Application\ListComponent::class)->name('admin.application.list');
    Route::get('admin/application/add', App\Livewire\Backend\Admin\Application\AddComponent::class)->name('admin.application.add');
    Route::get('admin/application/edit/{id}', App\Livewire\Backend\Admin\Application\EditComponent::class)->name('admin.application.edit');
    Route::get('admin/application/view/{id}', App\Livewire\Backend\Admin\Application\ViewComponent::class)->name('admin.application.view');
   
    Route::get('admin/invoices', App\Livewire\Backend\Admin\InvoiceComponent::class)->name('admin.invoices');
    Route::get('admin/invoices/print/{id}', function($id){
        $invoice = \App\Models\Invoice::with('form.client')->findOrFail($id);
        return view('livewire.backend.admin.invoice-print-component', compact('invoice'));
    })->name('admin.invoices.print');
    Route::get('admin/counselors', App\Livewire\Backend\Admin\CounselorComponent::class)->name('admin.counselors');
    Route::get('admin/agents', App\Livewire\Backend\Admin\AgentComponent::class)->name('admin.agents');
    Route::get('admin/client/list', App\Livewire\Backend\Admin\Client\ListComponent::class)->name('admin.client.list');
    Route::get('admin/client/overview/{id}', App\Livewire\Backend\Admin\Client\OverviewComponent::class)->name('admin.client.overview');
    
    Route::get('admin/documents', App\Livewire\Backend\Admin\DocumentComponent::class)->name('admin.documents');
    Route::get('admin/stages', App\Livewire\Backend\Admin\StageComponent::class)->name('admin.stages');
    Route::get('admin/services', App\Livewire\Backend\Admin\ServiceComponent::class)->name('admin.services');
    Route::get('admin/notices', App\Livewire\Backend\Admin\NoticeComponent::class)->name('admin.notices');

    Route::get('admin/followups', \App\Livewire\Backend\Admin\FollowUpComponent::class)->name('admin.followups');

    Route::get('admin/appointments', App\Livewire\Backend\Admin\AppointmentComponent::class)->name('admin.appointments');
    Route::get('admin/calendars', App\Livewire\Backend\Admin\CalendarComponent::class)->name('admin.calendars');
    Route::get('admin/contacts', App\Livewire\Backend\Admin\Contact::class)->name('admin.contacts');
    Route::get('admin/subscribers', App\Livewire\Backend\Admin\Subscriber::class)->name('admin.subscribers');

    Route::get('admin/activities', App\Livewire\Backend\Admin\Activity::class)->name('admin.activities');
    Route::get('admin/commissions', App\Livewire\Backend\Admin\CommissionComponent::class)->name('admin.commissions');
    Route::get('admin/commission/rules', App\Livewire\Backend\Admin\CommissionRuleComponent::class)->name('admin.commission.rules');

    Route::get('admin/hr/employees', App\Livewire\Backend\Admin\Hr\Employee\IndexComponent::class)->name('admin.hr.employees');
    Route::get('admin/hr/attendances', App\Livewire\Backend\Admin\Hr\AttendanceComponent::class)->name('admin.hr.attendances');
    Route::get('admin/hr/payrolls', App\Livewire\Backend\Admin\Hr\PayrollComponent::class)->name('admin.hr.payrolls');
    Route::get('admin/hr/leaves', App\Livewire\Backend\Admin\Hr\LeaveComponent::class)->name('admin.hr.leaves');
    Route::get('admin/hr/leavetypes', App\Livewire\Backend\Admin\Hr\LeaveTypeComponent::class)->name('admin.hr.leavetypes');
    Route::get('admin/hr/departments', App\Livewire\Backend\Admin\Hr\DepartmentComponent::class)->name('admin.hr.departments');
    
    Route::get('admin/users', App\Livewire\Backend\Admin\User\ListComponent::class)->name('admin.users');
    Route::get('admin/user/overview/{id}', App\Livewire\Backend\Admin\User\Overview::class)->name('admin.user.overview');
    Route::get('admin/user/setting/{id}', App\Livewire\Backend\Admin\User\Setting::class)->name('admin.user.setting');
    Route::patch('admin/user/setting/update/{id}', [App\Livewire\Backend\Admin\User\Setting::class, 'updateSetting'])->name('admin.user.setting.update');
    Route::put('admin/user/setting/password/update/{id}', [App\Livewire\Backend\Admin\User\Setting::class, 'updatePassword'])->name('admin.user.setting.password.update');
    Route::post('admin/user/setting/deactivate/{id}', [App\Livewire\Backend\Admin\User\Setting::class, 'deactivate'])->name('admin.user.setting.deactivate');
    Route::get('admin/user/activity/{id}', App\Livewire\Backend\Admin\User\Activity::class)->name('admin.user.activity');
    Route::get('admin/user/agent-forms/{id}', App\Livewire\Backend\Admin\User\AgentFormList::class)->name('admin.user.agent.forms');
    Route::get('admin/user/agent-commissions/{id}', App\Livewire\Backend\Admin\User\AgentCommissionList::class)->name('admin.user.agent.commissions');
    Route::get('admin/user/counselor-forms/{id}', App\Livewire\Backend\Admin\User\CounselorFormList::class)->name('admin.user.counselor.forms');
    Route::get('admin/user/employee-attendances/{id}', App\Livewire\Backend\Admin\User\EmployeeAttendanceList::class)->name('admin.user.employee.attendances');
    Route::get('admin/user/employee-leaves/{id}', App\Livewire\Backend\Admin\User\EmployeeLeaveList::class)->name('admin.user.employee.leaves');
    Route::get('admin/user/employee-payrolls/{id}', App\Livewire\Backend\Admin\User\EmployeePayrollList::class)->name('admin.user.employee.payrolls');

    // Setting
    Route::get('admin/setting/app', App\Livewire\Backend\Admin\Setting\App::class)->name('admin.setting.app');
    Route::post('admin/setting/app', [App\Livewire\Backend\Admin\Setting\App::class, 'update'])->name('admin.setting.app.update');
    Route::get('admin/setting/auth', App\Livewire\Backend\Admin\Setting\Auth::class)->name('admin.setting.auth');
    Route::post('admin/setting/auth', [App\Livewire\Backend\Admin\Setting\Auth::class, 'update'])->name('admin.setting.auth.update');
    Route::get('admin/setting/email', App\Livewire\Backend\Admin\Setting\Email::class)->name('admin.setting.email');
    Route::post('admin/setting/email', [App\Livewire\Backend\Admin\Setting\Email::class, 'update'])->name('admin.setting.email.update');
    Route::get('admin/setting/protection', App\Livewire\Backend\Admin\Setting\Protection::class)->name('admin.setting.protection');
    Route::post('admin/setting/protection', [App\Livewire\Backend\Admin\Setting\Protection::class, 'update'])->name('admin.setting.protection.update');
    Route::get('admin/setting/meta', App\Livewire\Backend\Admin\Setting\Meta::class)->name('admin.setting.meta');
    Route::post('admin/setting/meta', [App\Livewire\Backend\Admin\Setting\Meta::class, 'update'])->name('admin.setting.meta.update');
    Route::get('admin/setting/other', App\Livewire\Backend\Admin\Setting\Other::class)->name('admin.setting.other');
    Route::post('admin/setting/other', [App\Livewire\Backend\Admin\Setting\Other::class, 'update'])->name('admin.setting.other.update');

    Route::get('admin/account/overview', App\Livewire\Backend\Admin\Account\Overview::class)->name('admin.account.overview');
    Route::get('admin/account/setting', App\Livewire\Backend\Admin\Account\Setting::class)->name('admin.account.setting');
    Route::patch('admin/account/setting/update/{id}', [App\Livewire\Backend\Admin\Account\Setting::class, 'updateSetting'])->name('admin.account.setting.update');
    Route::put('admin/account/setting/email/update', [App\Livewire\Backend\Admin\Account\Setting::class, 'updateEmail'])->name('admin.account.setting.email.update');
    Route::put('admin/account/setting/password/update', [App\Livewire\Backend\Admin\Account\Setting::class, 'updatePassword'])->name('admin.account.setting.password.update');
    Route::post('admin/account/setting/deactivate', [App\Livewire\Backend\Admin\Account\Setting::class, 'deactivate'])->name('admin.account.setting.deactivate');
    Route::get('admin/account/activity', App\Livewire\Backend\Admin\Account\Activity::class)->name('admin.account.activity');

});

//CEO
Route::get('ceo/dashboard', \App\Livewire\Backend\CEO\DashboardComponent::class)->name('ceo.dashboard');

// Writer
Route::group(['middleware' => ['auth', 'writer']], function () {
    Route::get('writer/crud/sliders', \App\Livewire\Backend\Writer\Crud\Slider::class)->name('writer.crud.slider');
    Route::get('writer/crud/features', \App\Livewire\Backend\Writer\Crud\Feature::class)->name('writer.crud.feature');
    Route::get('writer/crud/essentials', \App\Livewire\Backend\Writer\Crud\Essential::class)->name('writer.crud.essential');
    Route::get('writer/crud/provinces', \App\Livewire\Backend\Writer\Crud\Province::class)->name('writer.crud.province');
    Route::get('writer/crud/chooses', \App\Livewire\Backend\Writer\Crud\Choose::class)->name('writer.crud.choose');
    Route::get('writer/crud/faqs', \App\Livewire\Backend\Writer\Crud\Faq::class)->name('writer.crud.faq');
    Route::get('writer/crud/testimonials', \App\Livewire\Backend\Writer\Crud\Testimonial::class)->name('writer.crud.testimonial');
    Route::get('writer/crud/logos', \App\Livewire\Backend\Writer\Crud\Logo::class)->name('writer.crud.logo');
    Route::get('writer/crud/blogs', \App\Livewire\Backend\Writer\Crud\Blog::class)->name('writer.crud.blog');
    Route::get('writer/crud/workprocess', \App\Livewire\Backend\Writer\Crud\Workprocess::class)->name('writer.crud.workprocess');
    Route::get('writer/crud/visa', \App\Livewire\Backend\Writer\Crud\Visa::class)->name('writer.crud.visa');
    Route::get('writer/crud/casestudies', \App\Livewire\Backend\Writer\Crud\Casestudy::class)->name('writer.crud.casestudies');
    Route::get('writer/crud/teams', \App\Livewire\Backend\Writer\Crud\Team::class)->name('writer.crud.teams');
    Route::get('writer/crud/universities', \App\Livewire\Backend\Writer\Crud\University::class)->name('writer.crud.universities');
    Route::get('writer/crud/courses', \App\Livewire\Backend\Writer\Crud\Course::class)->name('writer.crud.courses');

    Route::get('writer/section/feature', \App\Livewire\Backend\Writer\Section\Feature::class)->name('writer.section.feature');
    Route::patch('writer/section/feature/update/{id}', [App\Livewire\Backend\Writer\Section\Feature::class, 'sectionUpdate'])->name('writer.section.feature.update');
    Route::get('writer/section/essential', \App\Livewire\Backend\Writer\Section\Essential::class)->name('writer.section.essential');
    Route::patch('writer/section/essential/update/{id}', [App\Livewire\Backend\Writer\Section\Essential::class, 'sectionUpdate'])->name('writer.section.essential.update');
    Route::get('writer/section/about', \App\Livewire\Backend\Writer\Section\About::class)->name('writer.section.about');
    Route::patch('writer/section/about/update/{id}', [App\Livewire\Backend\Writer\Section\about::class, 'sectionUpdate'])->name('writer.section.about.update');
    Route::get('writer/section/choose', \App\Livewire\Backend\Writer\Section\Choose::class)->name('writer.section.choose');
    Route::patch('writer/section/choose/update/{id}', [App\Livewire\Backend\Writer\Section\Choose::class, 'sectionUpdate'])->name('writer.section.choose.update');
    Route::get('writer/section/funfact', \App\Livewire\Backend\Writer\Section\Funfact::class)->name('writer.section.funfact');
    Route::patch('writer/section/funfact/update/{id}', [App\Livewire\Backend\Writer\Section\Funfact::class, 'sectionUpdate'])->name('writer.section.funfact.update');
    Route::get('writer/section/faq', \App\Livewire\Backend\Writer\Section\Faq::class)->name('writer.section.faq');
    Route::patch('writer/section/faq/update/{id}', [App\Livewire\Backend\Writer\Section\Faq::class, 'sectionUpdate'])->name('writer.section.faq.update');
    Route::get('writer/section/process', \App\Livewire\Backend\Writer\Section\Process::class)->name('writer.section.process');
    Route::patch('writer/section/process/update/{id}', [App\Livewire\Backend\Writer\Section\Process::class, 'sectionUpdate'])->name('writer.section.process.update');
    Route::get('writer/section/visa', \App\Livewire\Backend\Writer\Section\Visa::class)->name('writer.section.visa');
    Route::patch('writer/section/visa/update/{id}', [App\Livewire\Backend\Writer\Section\Visa::class, 'sectionUpdate'])->name('writer.section.visa.update');
    Route::get('writer/section/testimonial', \App\Livewire\Backend\Writer\Section\Testimonial::class)->name('writer.section.testimonial');
    Route::patch('writer/section/testimonial/update/{id}', [App\Livewire\Backend\Writer\Section\Testimonial::class, 'sectionUpdate'])->name('writer.section.testimonial.update');
    Route::get('writer/section/team', \App\Livewire\Backend\Writer\Section\Team::class)->name('writer.section.team');
    Route::patch('writer/section/team/update/{id}', [App\Livewire\Backend\Writer\Section\Team::class, 'sectionUpdate'])->name('writer.section.team.update');
    Route::get('writer/section/casestudies', \App\Livewire\Backend\Writer\Section\Casestudy::class)->name('writer.section.casestudies');
    Route::patch('writer/section/casestudies/update/{id}', [App\Livewire\Backend\Writer\Section\Casestudy::class, 'sectionUpdate'])->name('writer.section.casestudies.update');
    Route::get('writer/section/blog', \App\Livewire\Backend\Writer\Section\Blog::class)->name('writer.section.blog');
    Route::patch('writer/section/blog/update/{id}', [App\Livewire\Backend\Writer\Section\Blog::class, 'sectionUpdate'])->name('writer.section.blog.update');
    Route::get('writer/section/intro', \App\Livewire\Backend\Writer\Section\Intro::class)->name('writer.section.intro');
    Route::patch('writer/section/intro/update/{id}', [App\Livewire\Backend\Writer\Section\Intro::class, 'sectionUpdate'])->name('writer.section.intro.update');
    Route::get('writer/section/contact', \App\Livewire\Backend\Writer\Section\Contact::class)->name('writer.section.contact');
    Route::patch('writer/section/contact/update/{id}', [App\Livewire\Backend\Writer\Section\Contact::class, 'sectionUpdate'])->name('writer.section.contact.update');
    Route::get('writer/section/subscriber', \App\Livewire\Backend\Writer\Section\Subscriber::class)->name('writer.section.subscriber');
    Route::patch('writer/section/subscriber/update/{id}', [App\Livewire\Backend\Writer\Section\Subscriber::class, 'sectionUpdate'])->name('writer.section.subscriber.update');
    Route::get('writer/section/university', \App\Livewire\Backend\Writer\Section\University::class)->name('writer.section.university');
    Route::patch('writer/section/university/update/{id}', [App\Livewire\Backend\Writer\Section\university::class, 'sectionUpdate'])->name('writer.section.university.update');
    Route::get('writer/section/course', \App\Livewire\Backend\Writer\Section\Course::class)->name('writer.section.course');
    Route::patch('writer/section/course/update/{id}', [App\Livewire\Backend\Writer\Section\Course::class, 'sectionUpdate'])->name('writer.section.course.update');
    Route::get('writer/section/footer', \App\Livewire\Backend\Writer\Section\Footer::class)->name('writer.section.footer');
    Route::patch('writer/section/footer/update/{id}', [App\Livewire\Backend\Writer\Section\Footer::class, 'sectionUpdate'])->name('writer.section.footer.update');

    Route::get('writer/banners', App\Livewire\Backend\Writer\Banner::class)->name('writer.banners');

    Route::get('writer/account/overview', App\Livewire\Backend\Writer\Account\Overview::class)->name('writer.account.overview');
    Route::get('writer/account/setting', App\Livewire\Backend\Writer\Account\Setting::class)->name('writer.account.setting');
    Route::patch('writer/account/setting/update/{id}', [App\Livewire\Backend\Writer\Account\Setting::class, 'updateSetting'])->name('writer.account.setting.update');
    Route::put('writer/account/setting/email/update', [App\Livewire\Backend\Writer\Account\Setting::class, 'updateEmail'])->name('writer.account.setting.email.update');
    Route::put('writer/account/setting/password/update', [App\Livewire\Backend\Writer\Account\Setting::class, 'updatePassword'])->name('writer.account.setting.password.update');
    Route::post('writer/account/setting/deactivate', [App\Livewire\Backend\Writer\Account\Setting::class, 'deactivate'])->name('writer.account.setting.deactivate');
    Route::get('writer/account/activity', App\Livewire\Backend\Writer\Account\Activity::class)->name('writer.account.activity');
});

//Employee
Route::group(['middleware' => ['auth', 'employee']], function () {
    Route::get('employee/dashboard', App\Livewire\Backend\Employee\DashboardComponent::class)->name('employee.dashboard');
    Route::get('employee/attendances', App\Livewire\Backend\Employee\AttendanceComponent::class)->name('employee.attendances');
    Route::get('employee/payrolls', App\Livewire\Backend\Employee\PayrollComponent::class)->name('employee.payrolls');
    Route::get('employee/leaves', App\Livewire\Backend\Employee\LeaveComponent::class)->name('employee.leaves');
    
    Route::get('employee/account/overview', App\Livewire\Backend\Employee\Account\Overview::class)->name('employee.account.overview');
    Route::get('employee/account/setting', App\Livewire\Backend\Employee\Account\Setting::class)->name('employee.account.setting');
    Route::patch('employee/account/setting/update/{id}', [App\Livewire\Backend\Employee\Account\Setting::class, 'updateSetting'])->name('employee.account.setting.update');
    Route::put('employee/account/setting/email/update', [App\Livewire\Backend\Employee\Account\Setting::class, 'updateEmail'])->name('employee.account.setting.email.update');
    Route::put('employee/account/setting/password/update', [App\Livewire\Backend\Employee\Account\Setting::class, 'updatePassword'])->name('employee.account.setting.password.update');
    Route::post('employee/account/setting/deactivate', [App\Livewire\Backend\Employee\Account\Setting::class, 'deactivate'])->name('employee.account.setting.deactivate');
    Route::get('employee/account/activity', App\Livewire\Backend\Employee\Account\Activity::class)->name('employee.account.activity');
});

//Receptionist
Route::group(['middleware' => ['auth', 'receptionist']], function () {
    Route::get('receptionist/dashboard', \App\Livewire\Backend\Receptionist\DashboardComponent::class)->name('receptionist.dashboard');

    Route::get('receptionist/client/list', App\Livewire\Backend\Receptionist\Client\ListComponent::class)->name('receptionist.client.list');
    Route::get('receptionist/client/overview/{id}', App\Livewire\Backend\Receptionist\Client\OverviewComponent::class)->name('receptionist.client.overview');

    Route::get('receptionist/agents', \App\Livewire\Backend\Receptionist\AgentComponent::class)->name('receptionist.agents');
    Route::get('receptionist/application/list', App\Livewire\Backend\Receptionist\Application\ListComponent::class)->name('receptionist.application.list');
    Route::get('receptionist/application/add', App\Livewire\Backend\Receptionist\Application\AddComponent::class)->name('receptionist.application.add');
    Route::get('receptionist/application/edit/{id}', App\Livewire\Backend\Receptionist\Application\EditComponent::class)->name('receptionist.application.edit');
    Route::get('receptionist/application/view/{id}', App\Livewire\Backend\Receptionist\Application\ViewComponent::class)->name('receptionist.application.view');
    Route::get('receptionist/application/print/{id}', function($id){
        $application = \App\Models\Form::with('invoice.client')->findOrFail($id);
        return view('livewire.backend.receptionist.application.print-component', compact('application'));
    })->name('receptionist.application.print');
    Route::get('receptionist/appointments', \App\Livewire\Backend\Receptionist\AppointmentComponent::class)->name('receptionist.appointments');
    Route::get('receptionist/calendars', \App\Livewire\Backend\Receptionist\CalendarComponent::class)->name('receptionist.calendars');
    Route::get('receptionist/contacts', \App\Livewire\Backend\Receptionist\ContactComponent::class)->name('receptionist.contacts');
    Route::get('receptionist/calllogs', \App\Livewire\Backend\Receptionist\CallLogComponent::class)->name('receptionist.calllogs');
    Route::get('receptionist/followups', \App\Livewire\Backend\Receptionist\FollowUpComponent::class)->name('receptionist.followups');
    Route::get('receptionist/documents', \App\Livewire\Backend\Receptionist\DocumentComponent::class)->name('receptionist.documents');
    Route::get('receptionist/invoices', \App\Livewire\Backend\Receptionist\InvoiceComponent::class)->name('receptionist.invoices');
    Route::get('receptionist/invoices/print/{id}', function($id){
        $invoice = \App\Models\Invoice::with('form.client')->findOrFail($id);
        return view('livewire.backend.receptionist.invoice-print-component', compact('invoice'));
    })->name('receptionist.invoices.print');
    Route::get('receptionist/account/overview', App\Livewire\Backend\Receptionist\Account\Overview::class)->name('receptionist.account.overview');
    Route::get('receptionist/account/setting', App\Livewire\Backend\Receptionist\Account\Setting::class)->name('receptionist.account.setting');
    Route::patch('receptionist/account/setting/update/{id}', [App\Livewire\Backend\Receptionist\Account\Setting::class, 'updateSetting'])->name('receptionist.account.setting.update');
    Route::put('receptionist/account/setting/email/update', [App\Livewire\Backend\Receptionist\Account\Setting::class, 'updateEmail'])->name('receptionist.account.setting.email.update');
    Route::put('receptionist/account/setting/password/update', [App\Livewire\Backend\Receptionist\Account\Setting::class, 'updatePassword'])->name('receptionist.account.setting.password.update');
    Route::post('receptionist/account/setting/deactivate', [App\Livewire\Backend\Receptionist\Account\Setting::class, 'deactivate'])->name('receptionist.account.setting.deactivate');
    Route::get('receptionist/account/activity', App\Livewire\Backend\Receptionist\Account\Activity::class)->name('receptionist.account.activity');
});

//Agent
Route::group(['middleware' => ['auth', 'agent']], function () {
    Route::get('agent/dashboard', \App\Livewire\Backend\Agent\DashboardComponent::class)->name('agent.dashboard');
    Route::get('agent/commissions', \App\Livewire\Backend\Agent\CommissionComponent::class)->name('agent.commissions');
    Route::get('agent/clients', \App\Livewire\Backend\Agent\ClientComponent::class)->name('agent.clients');
    Route::get('agent/client/overview/{id}', App\Livewire\Backend\Agent\Client\OverviewComponent::class)->name('agent.client.overview');
    Route::get('agent/application/list', App\Livewire\Backend\Agent\Application\ListComponent::class)->name('agent.application.list');
    Route::get('agent/application/add', App\Livewire\Backend\Agent\Application\AddComponent::class)->name('agent.application.add');
    Route::get('agent/application/edit/{id}', App\Livewire\Backend\Agent\Application\EditComponent::class)->name('agent.application.edit');
    Route::get('agent/application/view/{id}', App\Livewire\Backend\Agent\Application\ViewComponent::class)->name('agent.application.view');
    Route::get('agent/application/print/{id}', function($id){
        $application = \App\Models\Form::with('invoice.client')->findOrFail($id);
        return view('livewire.backend.agent.application.print-component', compact('application'));
    })->name('agent.application.print');
        
    Route::get('agent/invoices', \App\Livewire\Backend\Agent\InvoiceComponent::class)->name('agent.invoices');
    Route::get('agent/invoices/print/{id}', function($id){
        $invoice = \App\Models\Invoice::with('form.client')->findOrFail($id);
        return view('livewire.backend.agent.invoice-print-component', compact('invoice'));
    })->name('agent.invoices.print');
    Route::get('agent/followups', \App\Livewire\Backend\Agent\FollowUpComponent::class)->name('agent.followups');
    Route::get('agent/documents', \App\Livewire\Backend\Agent\DocumentComponent::class)->name('agent.documents');

    Route::get('agent/account/overview', App\Livewire\Backend\Agent\Account\Overview::class)->name('agent.account.overview');
    Route::get('agent/account/setting', App\Livewire\Backend\Agent\Account\Setting::class)->name('agent.account.setting');
    Route::patch('agent/account/setting/update/{id}', [App\Livewire\Backend\Agent\Account\Setting::class, 'updateSetting'])->name('agent.account.setting.update');
    Route::put('agent/account/setting/email/update', [App\Livewire\Backend\Agent\Account\Setting::class, 'updateEmail'])->name('agent.account.setting.email.update');
    Route::put('agent/account/setting/password/update', [App\Livewire\Backend\Agent\Account\Setting::class, 'updatePassword'])->name('agent.account.setting.password.update');
    Route::post('agent/account/setting/deactivate', [App\Livewire\Backend\Agent\Account\Setting::class, 'deactivate'])->name('agent.account.setting.deactivate');
    Route::get('agent/account/activity', App\Livewire\Backend\Agent\Account\Activity::class)->name('agent.account.activity');
});





Route::get('try', function () {
    auth()->user()->sendEmailVerificationNotification();
    return redirect()->back()->with('success','Thanks for the fast site!');
})->name('try');

Route::get('clear', function () {
    Artisan::call('optimize:clear');
    return redirect()->back()->with('success','Thanks for the fast site!');
})->name('clear');
Route::get('backup', function () {
    // Artisan::call('backup:clean');
    Artisan::call('backup:run');
    return redirect()->back()->with('success','Thanks for the backup!');
})->name('backup');
Route::get('link', function () {
    Artisan::call('storage:link');
    return redirect()->back()->with('success','Thanks for the link storage!');
});
// Route::get('permissionrefresh', function () {
//     Artisan::call('migrate:refresh --path=/database/migrations/2024_01_15_210628_create_permission_tables.php');
// });
// Route::get('permissionreseed', function () {
//     Artisan::call('db:seed --class=PermissionSeeder');
// });
// Route::get('fresh', function () {
//     Artisan::call('migrate:fresh --seed');
// });
Route::get('migrate', function () {
    Artisan::call('migrate');
});
