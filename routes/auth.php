<?php
use Illuminate\Support\Facades\Route;

Route::middleware('web')->namespace('Erik\AdminManagerImplementation\Http\Controllers\Auth')->group(function() {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');
    //TODO: implement password reset
    Route::get('password/reset', function() {})->name('admin.password.request');
});
