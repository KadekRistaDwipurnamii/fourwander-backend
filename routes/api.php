<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\BooknowController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminDashboardController;


Route::post('/contact', [ContactController::class, 'store']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/booknow', [BooknowController::class, 'index']);

Route::get('/paket', [PaketController::class,'index']);
Route::get('/paket/slug/{slug}', [PaketController::class, 'showBySlug']);
Route::get('/paket/{id}', [PaketController::class, 'show'])
    ->whereNumber('id');

Route::post('/booking', [BookingController::class,'store']);
Route::get('/bookings/{id}', [BookingController::class,'show']);
Route::post('/booking/{id}/payment', [BookingController::class,'pay']);
Route::get('/booking/{id}/invoice', [BookingController::class, 'invoice']);

// admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard']);
Route::get('/admin/bookings', [BookingController::class,'index']); // protect with middleware in prod

Route::post('/test', function () {
    return response()->json([
        'ok' => true
    ]);
});
