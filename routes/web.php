<?php

use App\Livewire\AdminDashboard;
use App\Livewire\Products;
use App\Livewire\SingleProduct;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('show.index');

// Route::get('/products/{category?}',function(){
//     return view('products');
// })->name('products');

// Route::get('/products/{category?}', function ($category = 'products') {
//     return view('products', compact('category'));
// })->name('products');

Route::get('/products/{category?}', Products::class)->name('products');

Route::get('/cart', function(){
    return view('livewire.cart');
});

Route::get('/product/{id}',SingleProduct::class)->name('show.singleProduct');
Route::get("/admin/dashboard", AdminDashboard::class)->name('show.adminDashboard');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
