<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Kontenta\AdminManagerImplementation\Http\Controllers')->group(function () {
    if(!Route::has('admin.index')) {
        Route::get('/', 'IndexController')->name('admin.index');
    }
});
