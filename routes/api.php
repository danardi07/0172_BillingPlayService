<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\superadmin\CabangController;
use App\Http\Controllers\superadmin\PerangkatController;
use App\Http\Controllers\superadmin\UserController;
use App\Http\Controllers\kasir\KasirBillingController;
use App\Http\Controllers\admin\AdminBillingController;
use App\Http\Controllers\admin\AdminPerangkatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\DashboardController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register-kasir', [AuthController::class, 'registerKasir']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/check-token', [AuthController::class, 'checkToken']);
    Route::post('/logout', [AuthController::class, 'logout']);





Route::middleware('role:superadmin')->prefix('superadmin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('profile', [ProfileController::class, 'me']);
    Route::put('profile/update', [ProfileController::class, 'update']);


    Route::get('cabangs', [CabangController::class, 'index']);
    Route::post('cabangs', [CabangController::class, 'store']);


    Route::get('perangkat/cabang/{cabangId}', [PerangkatController::class, 'getByCabang']);
    Route::post('perangkat', [PerangkatController::class, 'store']);
    Route::delete('perangkat/{id}', [PerangkatController::class, 'destroy']);


    Route::get('cabangs/{cabangId}/users', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
    });


Route::middleware('role:admin')->prefix('admin')->group(function () {

        Route::get('profile', [ProfileController::class, 'me']);
        Route::put('profile/update', [ProfileController::class, 'update']);


        Route::get('perangkat/cabang/{cabangId}', [AdminPerangkatController::class, 'getByCabang']);
        Route::post('perangkat', [AdminPerangkatController::class, 'store']);
        Route::post('perangkat/{id}/update', [AdminPerangkatController::class, 'update']);
        Route::delete('perangkat/{id}/delete', [AdminPerangkatController::class, 'destroy']);


        Route::get('billing', [AdminBillingController::class, 'index']);
        Route::get('billing/cabang/{cabangId}', [AdminBillingController::class, 'billingByCabang']);
    });


Route::middleware('role:kasir')->prefix('kasir')->group(function () {

        Route::get('profile', [ProfileController::class, 'me']);
        Route::put('profile/update', [ProfileController::class, 'update']);

        Route::get('perangkat', [AdminPerangkatController::class, 'index']);

        Route::get('billing', [KasirBillingController::class, 'index']);
        Route::post('billing', [KasirBillingController::class, 'store']);
        Route::put('billing/{id}/status', [KasirBillingController::class, 'updateStatus']);


        Route::post('billing/{billingId}/foto', [KasirBillingController::class, 'uploadFotoQris']);


        Route::get('billing/export', [KasirBillingController::class, 'exportPDF']);
    });
});
