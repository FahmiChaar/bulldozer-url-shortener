<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UrlController;
use App\Http\Controllers\Dashboard\VisitTrackingController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard/urls');

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    'middleware' => ['auth', 'verified']
], function() {
    Route::get('/home', DashboardController::class)->name('home');
    Route::resource('urls', UrlController::class);
});

require __DIR__.'/auth.php';

Route::get('/{token}', VisitTrackingController::class);