<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'OK',
        'app' => 'FourWander Backend',
        'time' => now()
    ]);
});
