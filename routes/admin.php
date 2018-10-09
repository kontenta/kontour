<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Kontenta\Kontour\Http\Controllers')->group(function () {
    if(!Route::has('kontour.index')) {
        Route::get('/', 'IndexController')->name('kontour.index');
    }
});
