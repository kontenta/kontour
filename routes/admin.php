<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Erik\AdminManagerImplementation\Http\Controllers')->group(function () {
    Route::get('/', 'IndexController')->name('admin.index');
});
