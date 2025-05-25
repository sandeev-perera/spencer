<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\AdminDashboard;
use App\Livewire\Cart;
use App\Livewire\Products;
use App\Livewire\SingleProduct;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('show.index');

Route::get('/products/{category?}', Products::class)->name('products');

Route::get('/cart', Cart::class)->name('show.Cart');

Route::get('/product/{id}', SingleProduct::class)->name('show.singleProduct');
Route::get("/admin/dashboard", AdminDashboard::class)->name('show.adminDashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
