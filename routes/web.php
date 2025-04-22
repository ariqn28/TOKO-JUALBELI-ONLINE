<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MessageController;

// ✅ Halaman utama menampilkan kategori (tanpa login)
Route::get('/', [CategoryController::class, 'home'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// ✅ Produk publik
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/show/{id}', [ProductController::class, 'showUserProduct'])->name('products.showUser');

// ✅ Marketplace publik (alias dua route)
Route::get('/marketplace', [ProductController::class, 'allProducts'])->name('products.marketplace');
Route::get('/products/all', [ProductController::class, 'allProducts'])->name('products.all');

// ✅ Autentikasi (login, register)
require __DIR__.'/auth.php';

// ✅ Dashboard utama untuk user login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Grup route untuk user login
Route::middleware('auth')->group(function () {

    // 🔒 Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🔒 Kategori (CRUD)
    Route::get('/dashboard/categories', [CategoryController::class, 'dashboardIndex'])->name('categories.dashboard.index');
    Route::get('/dashboard/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/dashboard/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/dashboard/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/dashboard/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/dashboard/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // 🔒 Produk (CRUD)
    Route::get('/dashboard/products', [ProductController::class, 'myProducts'])->name('products.my');
    Route::get('/dashboard/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/dashboard/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/dashboard/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/dashboard/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/dashboard/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/dashboard/products/view/{product}', [ProductController::class, 'showUserProduct'])->name('products.showUser');

    // 🔒 Chat antar pengguna (message)
    Route::get('/messages', [MessageController::class, 'listUsers'])->name('messages.users');
    Route::get('/messages/{receiver_id}', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{receiver_id}', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{user}', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');

});
