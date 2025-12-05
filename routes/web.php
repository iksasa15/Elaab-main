<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', HomeController::class)->name('home');

// Login routes
Route::get('/login', LoginController::class)->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Signup routes
Route::get('/signup', SignupController::class)->name('signup');
Route::post('/signup', [SignupController::class, 'register'])->name('signup.register');

// Category routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// Game routes
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');

// Contact routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// هذا المسار للتعامل مع إرسال نموذج الاتصال
Route::post('/contact', function () {
    // هنا يمكنك معالجة البيانات المرسلة من النموذج
    return redirect()->back()->with('success', 'Your message has been sent successfully!');
})->name('contact.submit');