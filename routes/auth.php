<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Kontenta\KontourSupport\Http\Controllers\Auth')->group(function () {
    if (!Route::has('kontour.login')) {
        Route::get('login', 'LoginController@showLoginForm')->name('kontour.login');
        Route::post('login', 'LoginController@login');
    }
    if (!Route::has('kontour.logout')) {
        Route::post('logout', 'LoginController@logout')->name('kontour.logout');
    }
});
