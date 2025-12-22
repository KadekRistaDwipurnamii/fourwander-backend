<?php

use Illuminate\Support\Facades\Route;

Route::middleware([])->get('/', function () {
    echo 'FOURWANDER BACKEND OK';
    exit;
});
