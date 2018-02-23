<?php
use Illuminate\Support\Facades\Route;

Route::middleware('web')->namespace('Erik\AdminManagerImplementation\Http\Controllers\Auth')->group(function() {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', function() { return false; })->name('admin.password.email');
    Route::get('password/reset/{token}', function() { return false; })->name('admin.password.reset');
    Route::post('password/reset', function() { return false; });
});
