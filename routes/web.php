<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;

use Illuminate\Support\Facades\Route;




Route::prefix('admin')->middleware(['auth', 'admin', 'banned'])->group(function () {
    Route::get('/', DashboardController::class)->name('admin');

    Route::resource('/products', AdminProductController::class);
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/customers', CustomerController::class);

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/orders/{order:order_id}', [AdminOrderController::class, 'show'])->name('orders.show');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/settings/shipping', [SettingsController::class, 'shipping'])->name('settings.shipping');
    Route::get('/settings/seo_social_media', [SettingsController::class, 'seo_social_media'])->name('settings.seo_social_media');
    Route::get('/settings/appearance', [SettingsController::class, 'appearance'])->name('settings.appearance');
    Route::get('/settings/users', [SettingsController::class, 'users'])->name('settings.users');
    Route::get('/settings/security', [SettingsController::class, 'security'])->name('settings.security');

    Route::post('/settings/user/promote/{user}', [SettingsController::class, 'promote'])->name('user.promote');
    Route::post('/settings/user/ban/{user}', [SettingsController::class, 'ban'])->name('user.ban');
    Route::post('/settings/user/unban/{user}', [SettingsController::class, 'unban'])->name('user.unban');
    Route::post('/settings/user/downgrade/{user}', [SettingsController::class, 'downgrade'])->name('user.downgrade');

});





//authenticated users
Route::middleware(['auth', 'checkMaintenance', 'banned'])->group(function () {
    Route::view('/profile', 'user.profile')->middleware('verified');
    Route::post('/logout', LogoutController::class)->name('logout');

    // Email verification
    Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [VerifyEmailController::class, 'sendVerificationEmail'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', fn() => view('checkout.success'))->name('checkout.success');

    Route::get('/orders/{order:order_id}', [OrderController::class, 'show']);
});

Route::middleware(['checkMaintenance', 'banned'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::post('/wishlist', [WishlistController::class, 'store']);
    Route::delete('/wishlist', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');


    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);


    //links
    Route::view('/about', 'pages.about');
    Route::view('/contact', 'pages.contact');
    Route::view('/locations', 'pages.locations');

});

Route::view('/login', 'auth.login')->name('login')->middleware('guest');
Route::post('/login', LoginController::class)->middleware('guest');

//guest users
Route::middleware(['guest', 'checkMaintenance'])->group(function () {
    //get routes
    Route::view('/register', 'auth.register')->name('register');

    //forget password
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink']);
    Route::view('/reset-password/{token}', 'auth.reset-password')->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

    //post routes
    Route::post('/register', RegisterController::class);
});
