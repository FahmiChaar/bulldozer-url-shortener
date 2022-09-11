<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UrlController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard/urls');

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    'middleware' => ['auth', 'verified']
], function() {
    Route::get('/', DashboardController::class);
    Route::resource('urls', UrlController::class);
});

require __DIR__.'/auth.php';
