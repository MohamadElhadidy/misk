<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

//authenticated users
Route::middleware(['auth'])->group(function () {
    Route::view('/profile', 'user.profile')->middleware('verified');
    Route::post('/logout', LogoutController::class);


    // Email verification
    Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
    Route::get('/email/verification-notification', [VerifyEmailController::class, 'sendVerificationEmail'])->middleware('throttle:6,1')->name('verification.send');
});


Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('orders', OrderController::class);

//admin
Route::view('/admin/dashboard', 'admin.dashboard');


//links
Route::view('/about', 'pages.about');
Route::view('/contact', 'pages.contact');
Route::view('/locations', 'pages.locations');

//guest users
Route::middleware('guest')->group(function () {
    //get routes
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register');

    //forget password
    Route::view('/forgot-password', 'auth.forgot-password');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink']);
    Route::view('/reset-password/{token}', 'auth.reset-password')->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

    //post routes
    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class);
});
