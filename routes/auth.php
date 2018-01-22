<?php
use Illuminate\Support\Facades\Route;

Route::middleware('web')->namespace('Erik\AdminManagerImplementation\Http\Controllers\Auth')->group(function() {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    //TODO: implement password reset
    Route::get('password/reset', function() {})->name('admin.password.request');
});
