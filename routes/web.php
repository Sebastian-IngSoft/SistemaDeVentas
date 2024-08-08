<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
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
    Route::get('/product/index','index')->name('product.index')->middleware(['auth', 'verified']);
    Route::post('/product/store','store')->name('product.store')->middleware(['auth', 'verified']);
    Route::put('/product/update/{product}','update')->name('product.update')->middleware(['auth', 'verified']);
    Route::put('/product/visibility/{product}','visibility')->name('product.visibility')->middleware(['auth', 'verified']);
});

//Clientes
Route::controller(CustomerController::class)->group(function(){
    Route::get('/customer/index','index')->name('customer.index')->middleware(['auth', 'verified']);
    Route::post('/costumer/store','store')->name('customer.store')->middleware(['auth', 'verified']);
    Route::put('/costumer/update/{customer}','update')->name('customer.update')->middleware(['auth', 'verified']);
})->middleware(['auth', 'verified']);

//ventas
Route::controller(SaleController::class)->group(function(){
    Route::get('/sale/index','index')->name('sale.index')->middleware(['auth', 'verified']);
})->middleware(['auth', 'verified']);


//Caja
Route::controller(WalletController::class)->group(function(){
    Route::get('/wallet/index','index')->name('wallet.index');
})->middleware(['auth', 'verified']);





require __DIR__.'/auth.php';
