<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsuranceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::prefix('insurance')->middleware(['api'])->group(function () {
        Route::post('/save-quotation', [InsuranceController::class, 'saveQuotation'])->name('quotation.save');
        Route::get('/carMake', [InsuranceController::class, 'getcarMakeTest'])->name('getcarMakeTest');
        Route::post('/getCarModel', [InsuranceController::class, 'getCarModel'])->name('getCarModel');
        Route::post('/getBodyType', [InsuranceController::class, 'getBodyType'])->name('getBodyType');
        Route::post('/getYearModel', [InsuranceController::class, 'getYearModel'])->name('getYearModel');
        Route::post('/getSubModel', [InsuranceController::class, 'getSubModel'])->name('getSubModel');
    });
});