<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//PRODUCTOS
Route::controller(ProductController::class)->group(function(){
    Route::get('/product/index','index')->name('product.index');
});

//ventas
Route::controller(SellController::class)->group(function(){
    Route::get('/sell/index','index')->name('sell.index');
});

//Clientes
Route::controller(CustomerController::class)->group(function(){
    Route::get('/customer/index','index')->name('customer.index');
});

//Caja
Route::controller(WalletController::class)->group(function(){
    Route::get('/wallet/index','index')->name('wallet.index');
});





require __DIR__.'/auth.php';
