<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\ProfileController;
use App\Livewire\AdminDashboard;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\Products;
use App\Livewire\SingleProduct;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index')->name('show.index');
Route::get('/products/{category?}', Products::class)->name('products');
Route::get('/product/{id}', SingleProduct::class)->name('show.singleProduct');


Route::middleware('check.admin')->group(function(){
    Route::get("/admin/dashboard", AdminDashboard::class)->name('show.adminDashboard');
});

Route::middleware('check.customer')->group(function(){
    Route::get("/checkout",Checkout::class)->name('show.Checkout');
    Route::post("/confirmCheckout", [CheckoutController::class, 'checkout'])->name('Confirm.checkout');
    Route::get('/cart', Cart::class)->name('show.Cart');
    Route::view('/ordercomplete', 'payment-complete')->name('show.order.complete');
    Route::get('/customerprofile', [CustomerProfileController::class, 'show'])->name('show.customer.profile');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
