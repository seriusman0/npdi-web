<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/layanan', [ServicesController::class, 'index'])->name('services');
Route::get('/hubungi-kami', [ContactController::class, 'index'])->name('contact');
Route::post('/hubungi-kami', [ContactController::class, 'store'])->middleware('throttle:5,10')->name('contact.store');

// Product Shop
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/checkout/{product}/{plan}', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/checkout/{product}/{plan}', [PaymentController::class, 'createInvoice'])->middleware('throttle:10,5')->name('checkout.submit');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::post('/payment/webhook/xendit', [PaymentController::class, 'webhook'])->name('payment.webhook');

// Back Office (Admin Panel)
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes (guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,15')->name('login.store');
    });

    // Protected routes
    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
