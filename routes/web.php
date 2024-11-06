<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewResellerController;
use App\Http\Controllers\RenewResellerController;
use App\Http\Controllers\ReportResellerController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\QRCustomerController;
use App\Models\TokenModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/new_reseller', [NewResellerController::class, 'index'])->name('new_reseller');
Route::get('/renew_reseller', [RenewResellerController::class, 'index'])->name('renew_reseller');
Route::get('/customer_qr', [QRCustomerController::class, 'index'])->name('customer_qr');

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