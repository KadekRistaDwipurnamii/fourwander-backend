<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'OK',
        'service' => 'FourWander Backend API',
        'version' => '1.0'
    ]);
});
