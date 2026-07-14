<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/layanan', [ServicesController::class, 'index'])->name('services');
Route::get('/hubungi-kami', [ContactController::class, 'index'])->name('contact');
Route::post('/hubungi-kami', [ContactController::class, 'store'])->name('contact.store');
