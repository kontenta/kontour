<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Kontenta\KontourImplementation\Http\Controllers\Auth')->group(function () {
    if (!Route::has('admin.password.request')) {
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset');
    }
});
