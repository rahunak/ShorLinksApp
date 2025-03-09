<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [ShortLinkController::class, 'index']);

Route::resource('short_links', ShortLinkController::class);
Route::get('/{shortLinks}', [ShortLinkController::class, 'redirect'])->name('short_links.redirect');
