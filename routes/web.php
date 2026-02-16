<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');

Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [App\Http\Controllers\PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [App\Http\Controllers\PageController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [App\Http\Controllers\PageController::class, 'disclaimer'])->name('disclaimer');
Route::get('/testimonials', [App\Http\Controllers\PageController::class, 'testimonials'])->name('testimonials');
Route::get('/faqs', [App\Http\Controllers\PageController::class, 'faqs'])->name('faqs');

Route::get('/properties', [App\Http\Controllers\PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [App\Http\Controllers\PropertyController::class, 'show'])->name('properties.show');

Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Booking Routes
Route::post('/booking', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{id}/payment', [App\Http\Controllers\BookingController::class, 'payment'])->name('booking.payment');
Route::post('/booking/{id}/payment', [App\Http\Controllers\BookingController::class, 'processPayment'])->name('booking.payment.process');

// Auth Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'index'])->name('wallet.index');
    Route::post('/wallet/withdraw', [App\Http\Controllers\WalletController::class, 'withdraw'])->name('wallet.withdraw');

    Route::get('/community', [App\Http\Controllers\ReferralController::class, 'index'])->name('community.index');

    Route::get('/checkout/{propertySlug}', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
    Route::get('/checkout/{propertySlug}/bank-transfer', [App\Http\Controllers\CheckoutController::class, 'bankTransfer'])->name('checkout.bank-transfer');
    Route::post('/checkout/{propertySlug}/bank-transfer', [App\Http\Controllers\CheckoutController::class, 'processBankTransfer'])->name('checkout.bank-transfer.process');
    Route::get('/checkout/verify/{transactionId}', [App\Http\Controllers\CheckoutController::class, 'verify'])->name('checkout.verify');
    Route::get('/checkout/success/{transactionId}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failed/{transactionId}', [App\Http\Controllers\CheckoutController::class, 'failed'])->name('checkout.failed');
    Route::post('/checkout/{propertySlug}/installment', [App\Http\Controllers\CheckoutController::class, 'createInstallmentPlan'])->name('checkout.installment.create');

    Route::resource('installments', App\Http\Controllers\InstallmentController::class)->only(['index', 'show']);
    Route::get('installments/{installment}/pay', [App\Http\Controllers\InstallmentController::class, 'pay'])->name('installments.pay');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Auth
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
        Route::resource('properties', App\Http\Controllers\Admin\PropertyController::class);
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('transactions', App\Http\Controllers\Admin\TransactionController::class);
        Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
        Route::resource('leads', App\Http\Controllers\Admin\LeadController::class);
        Route::resource('bank-accounts', App\Http\Controllers\Admin\BankAccountController::class)->except(['create', 'edit', 'show']);
        Route::resource('admin-installments', App\Http\Controllers\Admin\InstallmentController::class)->names([
            'index' => 'installments.index',
            'show' => 'installments.show',
        ]);

        Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class)->except(['show']);
        Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class)->except(['show']);

        Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
