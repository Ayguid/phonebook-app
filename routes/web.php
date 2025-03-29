<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('throttle:60,1')->group(function () {
    // These routes will have a rate limit of 60 requests per minute
    Route::get('/', [ContactController::class, 'index'])->name('home');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});

