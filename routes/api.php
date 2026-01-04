<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminDashboardController;

// CONTACT
Route::post('/contact', [ContactController::class, 'store']);

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// PAKET
Route::get('/paket', [PaketController::class, 'index']);
Route::get('/paket/slug/{slug}', [PaketController::class, 'showBySlug']);
Route::get('/paket/{id}', [PaketController::class, 'show'])->whereNumber('id');

// BOOKING
Route::post('/booking', [BookingController::class,'store']);
Route::get('/bookings/{id}', [BookingController::class,'show']);
Route::post('/booking/{id}/payment', [BookingController::class,'pay']);
Route::get('/booking/{id}/invoice', [BookingController::class, 'invoice']);

// ADMIN
Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard']);
Route::get('/admin/bookings', [BookingController::class,'index']);

// TEST
Route::post('/test', function () {
    return response()->json(['ok' => true]);
});
