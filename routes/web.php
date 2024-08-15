<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Graficos\VistaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function(){
    Route::controller(VistaController::class)->group(function(){
        Route::get('/dashboard','index')->name('dashboard');
    });
});
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
});

//Tickets
Route::controller(TicketController::class)->group(function(){
    Route::get('/ticket/index','index')->name('ticket.index')->middleware(['auth', 'verified']);
    Route::post('/ticket/store','store')->name('ticket.store')->middleware(['auth', 'verified']);
    Route::get('/ticket/showtickets','showtickets')->name('ticket.showtickets')->middleware(['auth','verified']);
    Route::get('/ticket/show/{ticket}','show')->name('ticket.show')->middleware(['auth','verified']);
    Route::put('/ticket/payment/{ticket}','payment')->name('ticket.payment')->middleware('auth','verified');
    Route::post('/ticket/annular/{ticket}','annular')->name('ticket.annular')->middleware('auth','verified');
});


//Caja
Route::controller(WalletController::class)->group(function(){
    Route::get('/wallet/index','index')->name('wallet.index')->middleware(['auth', 'verified']);
    Route::post('/wallet/deposit','deposit')->name('wallet.deposit')->middleware(['auth', 'verified']);
    Route::post('/wallet/withdraw','withdraw')->name('wallet.withdraw')->middleware(['auth', 'verified']);
});

//Configuraciones
Route::middleware('auth')->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('user/index','index')->name('user.index');
        Route::delete('user/destroy/{user}','destroy')->name('user.destroy');
    });
});







require __DIR__.'/auth.php';
