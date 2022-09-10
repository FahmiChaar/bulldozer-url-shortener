<?php

use App\Http\Controllers\Dashboard\UrlController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    'middleware' => ['auth', 'verified']
], function() {
    Route::get('/', [UrlController::class, 'index'])->name('urls.index');
    Route::get('/{id}', [UrlController::class, 'show'])->name('urls.show');
});

require __DIR__.'/auth.php';
