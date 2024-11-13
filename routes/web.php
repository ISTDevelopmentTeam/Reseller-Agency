<?php

use App\Http\Controllers\CMS_AddController;
use App\Http\Controllers\CMS_FetchingController;
use App\Http\Controllers\CMS_UpdateController;
use App\Http\Controllers\CMS_UpdateDiscountLogController;
use App\Http\Controllers\CMSAddPageController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\CustomerFormSubmitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewResellerController;
use App\Http\Controllers\RenewResellerController;
use App\Http\Controllers\ReportResellerController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\QRCustomerController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// NEW
Route::get('/new_reseller', [NewResellerController::class, 'index'])->name('new_reseller');
// RENEW
Route::get('/renew_reseller', [RenewResellerController::class, 'index'])->name('renew_reseller');
Route::post('/search_member', [RenewResellerController::class, 'search_member'])->name('search_member');

Route::get('/customer_qr', [QRCustomerController::class, 'index'])->name('customer_qr');
Route::get('/subscription_plan_cms', [CMS_FetchingController::class, 'cms_fetch'])->name('subscription_plan_cms');
Route::get('/edit_cms', [CMS_FetchingController::class, 'Edit_Fetch'])->name('edit_cms_page');
Route::get('/view_cms', [CMS_FetchingController::class, 'View_Fetch'])->name('view_cms_page');
Route::get('/add_cms', [CMS_FetchingController::class, 'add_fetching'])->name('add_cms_page');

// REPORTS
Route::get('/report_reseller', [ReportResellerController::class, 'index'])->name('report_reseller');
Route::get('/audit_trail', [AuditTrailController::class, 'index'])->name('audit_trail');




//URL Token Validation Routes

// Route for the temporary page
Route::get('/customer_fillout_form/{token}', function ($token) {


    // Check if the token exists and is not expired
    $temporaryToken = TokenModel::where('token', $token)->first();

    // If token doesn't exist or is expired
    if (!$temporaryToken || $temporaryToken->expires_at < now()) 
    {
        return redirect()->route('webpage_expiration_page'); // Redirect to expired page
    }
    
    // If token is valid, display the temporary page
    return view('customer_fillout_form', ['token' => $token]);
    })->name('customer_fillout_form');



// Route for the expired page
Route::get('/token-expired', function () {
return view('webpage_expiration_page');
})->name('webpage_expiration_page');
// End of QR Configuration


// In routes/web.php
Route::post('/submit', [CustomerFormSubmitController::class, 'store'])->name('insert-data');


Route::post('/cms/update/{id}/{member_id}', [CMS_UpdateController::class, 'update'])->name('cms.update');
Route::post('/cms/view/{id}/{member_id}', action: [CMS_UpdateController::class, 'update'])->name('cms.view');
Route::post('/cms/view_discountLogs/{id}', action: [CMS_UpdateDiscountLogController::class, 'update'])->name('cms.discountLog');
Route::post('/cms/insert', [CMS_AddController::class, 'store'])->name('cms.add');
Route::get('/cms/insert/membership_fetch', [CMSAddPageController::class, 'membership_plan_type'])->name('cms.fetch');
Route::post('/update-subscription-plan', [CMSController::class, 'update'])->name('update_plan');
Route::post('/add-membership', [CMSController::class, 'add'])->name('add.membership');
Route::get('/get-fetch/{membership_id}', [CMS_FetchingController::class, 'fetch_drop_down_data'])->name('cms.fetch.data');
