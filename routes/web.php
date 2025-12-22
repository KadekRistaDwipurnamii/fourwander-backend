<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'ok',
        'app' => 'FourWander Backend',
        'message' => 'API is running'
    ]);
});
