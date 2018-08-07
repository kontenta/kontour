<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Kontenta\KontourSupport\Http\Controllers\Auth')->group(function () {
    if (!Route::has('kontour.password.request')) {
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('kontour.password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('kontour.password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('kontour.password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset');
    }
});
