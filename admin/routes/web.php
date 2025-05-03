<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('app'); // a Blade view with <div id="app">
})->where('any', '.*');


require __DIR__.'/auth.php';
require __DIR__.'/api.php';
