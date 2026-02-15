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

Route::get('signup', App\Livewire\Auth\SignupComponent::class)->name('signup');

Route::middleware('guest')->group(function () {
    Route::get('login', App\Livewire\Auth\LoginComponent::class)->name('login');
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
});



// Start Frontend
Route::get('about-us', \App\Livewire\Frontend\Home::class)->name('front.about');
Route::get('contact-us', \App\Livewire\Frontend\Home::class)->name('front.contact');
Route::get('/unsubscribe/{email}', function ($email) {
    \App\Models\Subscriber::where('email', $email)->update(['is_active' => false]);
    return 'You have been unsubscribed.';
});

Route::get('term-condition', \App\Livewire\Frontend\Home::class)->name('front.termcondition');
Route::get('privacy-policy', \App\Livewire\Frontend\Home::class)->name('front.privacypolicy');
// End Frontend

Route::get('/', \App\Livewire\Frontend\Home::class)->name('home');
Route::get('dashboard', \App\Livewire\Frontend\Home::class)->name('dashboard');
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

    Route::get('admin/appointments', App\Livewire\Backend\Admin\Appointment::class)->name('admin.appointments');
    Route::get('admin/contacts', App\Livewire\Backend\Admin\Contact::class)->name('admin.contacts');
    Route::get('admin/subscribers', App\Livewire\Backend\Admin\Subscriber::class)->name('admin.subscribers');
    Route::get('admin/clients', App\Livewire\Backend\Admin\Client::class)->name('admin.clients');
    Route::get('admin/employees', App\Livewire\Backend\Admin\Employee::class)->name('admin.employees');
    Route::get('admin/activities', App\Livewire\Backend\Admin\Activity::class)->name('admin.activities');

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
