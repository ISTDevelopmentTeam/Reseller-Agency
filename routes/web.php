<?php

use App\Http\Controllers\CMS_AddController;
use App\Http\Controllers\CMS_FetchingController;
use App\Http\Controllers\CMS_UpdateController;
use App\Http\Controllers\CMS_UpdateDiscountLogController;
use App\Http\Controllers\CMSAddPageController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\CustomerFormSubmitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventDashboardController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\PidpController;
use App\Http\Controllers\RenewResellerController;
use App\Http\Controllers\ReportResellerController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\QRCustomerController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\SubscriptionPlan_CMS_Controller;
use App\Http\Controllers\CMSEditPageController;
use App\Http\Controllers\CMSViewPageController;
use App\Models\CustomerFillOutModel;
use App\Models\TokenModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('generate_client_access', [QRCustomerController::class, 'index'])->name('generate_client_access');
// NEW
Route::get('/event_dashboard', [EventDashboardController::class, 'event_dashboard'])->name('event_dashboard');

// MEMBERSHIP (reseller side)
Route::get('/new_membership/{membershipId?}/{planId?}', [MembershipController::class, 'index'])->name('new_membership.index');
Route::post('/new_membership', [MembershipController::class, 'store'])->name('new_membership.store');
// MEMBERSHIP (customer side)
Route::get('/membership/{membershipId?}/{planId?}/{token}', [MembershipController::class, 'fetch'])->name('membership.fetch');
Route::post('/membership/{token}', [MembershipController::class, 'storing'])->name('membership.storing');
Route::get('/thankyou_membership', [MembershipController::class, 'thank'])->name('thankyou_membership');


// PIDP (reseller side)
Route::get('/new_pidp/{membershipId?}/{planId?}', [PidpController::class, 'index'])->name('new_pidp.index');
Route::post('/new_pidp', [PidpController::class, 'store'])->name('new_pidp.store');
// PIDP (customer side)
Route::get('/pidp/{membershipId?}/{planId?}/{token}', [PidpController::class, 'fetch'])->name('pidp.fetch');
Route::post('/pidp/{token}', [PidpController::class, 'storing'])->name('pidp.storing');
Route::get('/thankyou', [PidpController::class, 'thank'])->name('thankyou');

// MOTORCYLE (reseller side)
Route::get('/new_motorcycle/{planId?}', [MotorcycleController::class, 'index'])->name('new_motorcycle.index');
Route::post('/new_motorcycle', [MotorcycleController::class, 'store'])->name('new_motorcycle.store');
// MOTORCYLE (customer side)
Route::get('/motorcycle/{planId?}/{token}', [MotorcycleController::class, 'fetch'])->name('motorcycle.fetch');
Route::post('/motorcycle/{token}', [MotorcycleController::class, 'storing'])->name('motorcycle.storing');
Route::get('/thankyou', [MotorcycleController::class, 'thank'])->name('thankyou');


// RENEW
Route::get('/renew_reseller', [RenewResellerController::class, 'index'])->name('renew_reseller');
Route::post('/search_member', [RenewResellerController::class, 'search_member'])->name('search_member');

Route::get('/renew_membership/{id}/{vehicle}', [RenewResellerController::class, 'membership'])->name('renew_membership');
Route::post('/renew_membership/{id}/{vehicle}', [RenewResellerController::class, 'membership_store'])->name('renew_membership.store');

Route::get('/renew_pidp/{id}/{vehicle}', [RenewResellerController::class, 'pidp'])->name('renew_pidp');
Route::post('/renew_pidp/{id}/{vehicle}', [RenewResellerController::class, 'pidp_store'])->name('renew_pidp.store');

Route::get('/renew_motorcycle/{id}/{vehicle}', [RenewResellerController::class, 'motorcycle'])->name('renew_motorcycle');
Route::post('/renew_motorcycle/{id}/{vehicle}', [RenewResellerController::class, 'motorcycle_store'])->name('renew_motorcycle.store');

// CUSTOMER
Route::get('/customer_qr', [QRCustomerController::class, 'index'])->name('customer_qr');
// Route for handling customer form with token
Route::get('/customer_fillout_form/{token}', [EventDashboardController::class, 'customer_event_dashboard'])
    ->name('customer_fillout_form');
// Route for the expired page
Route::get('/token-expired', function () {
    return view('webpage_expiration_page');
})->name('webpage_expiration_page');


Route::get('/subscription_plan_cms', [CMS_FetchingController::class, 'cms_fetch'])->name('subscription_plan_cms');
Route::get('/edit_cms', [CMS_FetchingController::class, 'Edit_Fetch'])->name('edit_cms_page');
Route::get('/view_cms', [CMS_FetchingController::class, 'View_Fetch'])->name('view_cms_page');
Route::get('/add_cms', [CMS_FetchingController::class, 'add_fetching'])->name('add_cms_page');

// REPORTS
Route::get('/report_reseller', [ReportResellerController::class, 'index'])->name('report_reseller');
Route::get('/audit_trail', [AuditTrailController::class, 'index'])->name('audit_trail');


// TRACKING
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
Route::post('/tracking/track', [TrackingController::class, 'track'])->name('tracking.track');


//URL Token Validation Routes

// Route for the temporary page
// Route::get('/customer_fillout_form/{token}', function ($token) {


//     // Check if the token exists and is not expired
//     $temporaryToken = TokenModel::where('token', $token)->first();

//     // If token doesn't exist or is expired
//     if (!$temporaryToken || $temporaryToken->expires_at < now()) 
//     {
//         return redirect()->route('webpage_expiration_page'); // Redirect to expired page
//     }
    
//     // If token is valid, display the temporary page
//     return view('reseller_form/event_dashboard', ['token' => $token]);
//     })->name('customer_fillout_form');



// Route for the expired page
Route::get('/token-expired', function () {
return view('webpage_expiration_page');
})->name('webpage_expiration_page');
// End of QR Configuration


// In routes/web.php
// Route::post('/submit', [CustomerFormSubmitController::class, 'store'])->name('insert-data');



//Comment
// Route::post('/cms/update/{id}/{member_id}', [CMS_UpdateController::class, 'update'])->name('cms.update');
// Route::post('/cms/view/{id}/{member_id}', action: [CMS_UpdateController::class, 'update'])->name('cms.view');
// Route::post('/cms/view_discountLogs/{id}', action: [CMS_UpdateDiscountLogController::class, 'update'])->name('cms.discountLog');
// Route::post('/cms/insert', [CMS_AddController::class, 'store'])->name('cms.add');
// Route::get('/cms/insert/membership_fetch', [CMSAddPageController::class, 'membership_plan_type'])->name('cms.fetch');


Route::get('/get-fetch/{membership_id}', [CMS_FetchingController::class, 'fetch_drop_down_data'])->name('cms.fetch.data');
Route::post('/update-subscription-plan', [CMSController::class, 'update'])->name('update_plan');
Route::post('/add-membership', [CMSController::class, 'add'])->name('add.membership');