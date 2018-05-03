<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Erik\AdminManagerImplementation\Http\Controllers\Auth')->group(function () {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');
});
