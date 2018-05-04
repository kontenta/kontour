<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Erik\AdminManagerImplementation\Http\Controllers\Auth')->group(function () {
    if (!Route::has('admin.login')) {
        Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'LoginController@login');
    }
    if (!Route::has('admin.logout')) {
        Route::post('logout', 'LoginController@logout')->name('admin.logout');
    }
});
