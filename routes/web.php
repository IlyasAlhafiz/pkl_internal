<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EcommerceController;

Route::get('/', [EcommerceController::class, 'index'])->name('welcome');

// Routing dasar
Route::get('/sample', function () {
    return 'percobaan';
});

Route::get('/sample2', function () {
    return view('sample2');
});

// Routing controller & view dasar
Route::get('/sample3', [LatihanController::class, 'index']);

// Routing controller & view dengan parameter
Route::get('/sample4', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
Route::delete('/siswa/destroy/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/testing', function(){
    return view('layouts.admin');
});

Route::get('/latihanjs', function(){
    return view('latihan-js');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', isAdmin::class]], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
});

Route::group(['middleware' => ['auth']],function(){
    Route::post('/order', [EcommerceController::class, 'createOrder'])->name('order.create');
    Route::post('/checkout', [EcommerceController::class, 'checkOut'])->name('order.checkout');
    Route::get('/my-orders', [EcommerceController::class, 'myOrders'])->name('orders.myOrders');
    Route::get('/my-orders/{id}', [EcommerceController::class, 'orderDetail'])->name('orders.detail');
    Route::post('/order/update-quantity', [EcommerceController::class, 'updateQuantity'])->name('order.update-quantity');
    Route::post('/order/remove-item', [EcommerceController::class, 'removeItem'])->name('order.remove-item');
});