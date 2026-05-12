<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;




Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', function () {
//     return redirect()->route('dashboard');
// });


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('products', ProductController::class);

Route::get('/admin/orders', [OrderController::class, 'index'])
    ->name('orders.index');
});

require __DIR__.'/auth.php';

Route::get('/checkout/{id}', [CheckoutController::class, 'showCheckout'])->name('checkout.page');
Route::post('/stripe-payment', [CheckoutController::class, 'checkout'])->name('checkout');

Route::get('/success', [CheckoutController::class, 'success'])->name('success');
Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('cancel');
