<?php

use Illuminate\Support\Facades\Route;

// Import controllernya
use App\Http\Controllers\BackendController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
//import middleware
use App\Http\Middleware\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route guest member
Route::get('/', [FrontendController::class, 'index']);
Route::get('/product', [FrontendController::class, 'product']) -> name('product.index');
Route::get('/product/{product}', [FrontendController::class, 'singleProduct']) -> name('product.shows');
Route::get('/product/category/{slug}', [FrontendController::class, 'filterByCategory']) -> name('product.filter');
Route::get('/search', [FrontendController::class, 'search']) -> name('product.search');

Route::get('/about', [FrontendController::class, 'about']);

// cart
Route::get('/cart', [CartController::class, 'index']) -> name('cart.index');
Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart']) -> name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'updateCart']) -> name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove']) -> name('cart.remove');

// orders
Route::get('/checkout', [CartController::class, 'checkout']) -> name('cart.checkout');
Route::get('/orders', [OrderController::class, 'index']) -> name('order.index');
Route::get('/orders/{id}', [OrderController::class, 'show']) -> name('order.show');

// review

// Route::get('/', function () {
//     return view('layouts.frontend');
// });


// // Route basic
// Route::get('about', function () {
//     return 'Ini halaman about';
// });

// Route::get('profile', function () {
//     return view('profile');
// });


// // Route Parameters
// Route::get('produk/{namaProduk}', function ($p){
//     return "Saya Membeli " . $p;
// });

// Route::get('kategori/{namaKategori}', function ($kategori) {
//     return view('kategori', compact('kategori'));
//     //return view('kategori', ['kat' => $kategori]);
// });


// // Route Optionanl Paramaters
// Route::get('search/{keywoard?}', function($key = null) {
//     return view('search', compact('key'));
// });

// // Latihan

// Route::get('promo/{barang?}/{kode?}', function($barang = null, $kode = null){
//     return view('promo', compact ('barang', 'kode'));
// });


// // Route Buku
// Route::get('buku', [MyController::class, 'index']);
// // Tambah Buku
// Route::get('buku/create', [MyController::class, 'create']);
// Route::post('buku', [MyController::class, 'store']);
// // show
// Route::get('buku/{id}', [MyController::class, 'show']);
// // edit
// Route::get('buku/{id}/edit', [MyController::class, 'edit']);
// Route::put('buku/{id}', [MyController::class, 'update']);

// //delete
// Route::delete('buku/{id}', [MyController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Admin/Backend
Route::group(['prefix'=>'admin', 'as' => 'backend.', 'middleware'=>['auth', Admin::class]], function () {
    Route::get('/', [BackendController::class, 'index']);
    // crud
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/orders', OrdersController::class);

});