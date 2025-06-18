<?php

use Illuminate\Support\Facades\Route;

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