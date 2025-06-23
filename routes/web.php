<?php

use Illuminate\Support\Facades\Route;

// Import controllernya
use App\Http\Controllers\BackendController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});


// Route basic
Route::get('about', function () {
    return 'Ini halaman about';
});

Route::get('profile', function () {
    return view('profile');
});


// Route Parameters
Route::get('produk/{namaProduk}', function ($p){
    return "Saya Membeli " . $p;
});

Route::get('kategori/{namaKategori}', function ($kategori) {
    return view('kategori', compact('kategori'));
    //return view('kategori', ['kat' => $kategori]);
});


// Route Optionanl Paramaters
Route::get('search/{keywoard?}', function($key = null) {
    return view('search', compact('key'));
});

// Latihan

Route::get('promo/{barang?}/{kode?}', function($barang = null, $kode = null){
    return view('promo', compact ('barang', 'kode'));
});


// Route Buku
Route::get('buku', [MyController::class, 'index']);
// Tambah Buku
Route::get('buku/create', [MyController::class, 'create']);
Route::post('buku', [MyController::class, 'store']);
// show
Route::get('buku/{id}', [MyController::class, 'show']);
// edit
Route::get('buku/{id}/edit', [MyController::class, 'edit']);
Route::put('buku/{id}', [MyController::class, 'update']);

//delete
Route::delete('buku/{id}', [MyController::class, 'destroy']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Admin/Backend
Route::group(['prefix'=>'admin', 'middleware'=>['auth', Admin::class]], function () {
    Route::get('/', [BackendController::class, 'index']);
    // crud
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);

});