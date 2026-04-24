<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about'); // We will need to create this later
})->name('about');

Route::get('/partner', function () {
    return view('partner'); // We will need to create this later
})->name('partner');

Route::get('/contact', function () {
    return view('contact'); // We will need to create this later
})->name('contact');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');

Route::get('/product/{id?}', function () {
    return view('product-detail');
})->name('product.detail');

Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart-count', [App\Http\Controllers\CartController::class, 'getCartCount'])->name('cart.count');
Route::get('/cart-content', [App\Http\Controllers\CartController::class, 'getCartContent'])->name('cart.content');
Route::post('/cart-update', [App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart-remove', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/checkout/place-order', [App\Http\Controllers\OrderController::class, 'store'])->name('checkout.place_order');
Route::get('/thank-you/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('checkout.success');

Route::post('/partner-submit', [App\Http\Controllers\PartnerController::class, 'store'])->name('partner.store');
Route::post('/contact-submit', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');

    // Contact Routes
    Route::get('/contacts', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('admin.contacts.index')->middleware('auth');
    Route::get('/contacts/list', [App\Http\Controllers\Admin\ContactController::class, 'list'])->name('admin.contacts.list')->middleware('auth');

    // Partner Routes
    Route::get('/partners', [App\Http\Controllers\Admin\PartnerController::class, 'index'])->name('admin.partners.index')->middleware('auth');
    Route::get('/partners/list', [App\Http\Controllers\Admin\PartnerController::class, 'list'])->name('admin.partners.list')->middleware('auth');

    // Order Routes
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index')->middleware('auth');
    Route::get('/orders/list', [App\Http\Controllers\Admin\OrderController::class, 'list'])->name('admin.orders.list')->middleware('auth');
    Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show')->middleware('auth');
    Route::delete('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.orders.destroy')->middleware('auth');
    Route::post('/orders/{id}/update-payment', [App\Http\Controllers\Admin\OrderController::class, 'updatePaymentStatus'])->name('admin.orders.update_payment')->middleware('auth');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
