<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/index', function(){
    return view('index');
});


Route::get('/list_catalog', [CategoryController::class, 'listCategoriesAndProducts'])->name('list.catalog');
Route::get('/category/{id}', [CategoryController::class, 'category'])->name('category');

Route::get('/product/{id}', [ProductController::class, 'product'])->name('product');

Route::get('/cart_add/{id}', [CartItemController::class, 'cartAdd'])->name('cart.add');
Route::get('/cart', [CartItemController::class, 'list'])->name('list.cart');

Route::get('/checkout_address', [CheckoutController::class, 'address'])->name('checkout.address');
Route::get('/checkout_payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/checkout_finish', [CheckoutController::class, 'finish'])->name('checkout.finish');