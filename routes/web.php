<?php

use Illuminate\Support\Facades\Route;

// Import controllernya
use App\Http\Controllers\BackendController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController as BackendOrdersController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DesignController; // Tambah ini

//import middleware
use App\Http\Middleware\Admin; // Fix: App\Http\Middleware\Admin (case sensitive?)

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ----------------- GUEST / FRONTEND -----------------
Route::get('/', [FrontendController::class, 'index']);
Route::get('/product', [FrontendController::class, 'product'])->name('product.index');
Route::get('/product/{product}', [FrontendController::class, 'singleProduct'])->name('product.show');
Route::get('/product/category/{slug}', [FrontendController::class, 'filterByCategory'])->name('product.filter');
Route::get('/search', [FrontendController::class, 'search'])->name('product.search');
Route::get('/about', [FrontendController::class, 'about']);

// ----------------- CART -----------------
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

// ----------------- ORDERS -----------------
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

// ----------------- REVIEW -----------------
Route::post('/product/{product}/review', [ReviewController::class, 'store'])
    ->middleware('auth')->name('review.store');

// ----------------- DESIGN CUSTOM PRODUCT -----------------
Route::middleware('auth')->group(function () {
    Route::get('/design/{product:slug}', [DesignController::class, 'create'])->name('designs.create');
    Route::post('/design/{product:slug}', [DesignController::class, 'store'])->name('designs.store'); // Fix: post ke /design/{slug}
    Route::get('/designs/{design}', [DesignController::class, 'show'])->name('designs.show');
});

// ----------------- AUTH -----------------
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ----------------- ADMIN / BACKEND -----------------
Route::group(['prefix'=>'admin', 'as' => 'backend.', 'middleware'=>['auth', Admin::class]], function () {
    Route::get('/', [BackendController::class, 'index']);
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/orders', BackendOrdersController::class);
    Route::put('/orders/{id}/status', [BackendOrdersController::class, 'updateStatus'])->name('orders.updateStatus');

    // Admin lihat semua desain custom
    Route::get('/designs', [DesignController::class, 'index'])->name('designs.index');
    Route::get('/designs/{design}', [DesignController::class, 'show'])->name('designs.show');
});

// HAPUS INI (DUPLIKAT):
// use App\Http\Controllers\DesignController;
// Route::get('/products/{product}/design', [DesignController::class, 'create'])->name('designs.create');
// Route::post('/products/{product}/design', [DesignController::class, 'store'])->name('designs.store');
// Route::get('/designs/{design}', [DesignController::class, 'show'])->name('designs.show');
