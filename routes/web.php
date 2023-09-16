<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
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


Route::middleware('auth')->group(function(){

    Route::post('/cart_add/{id}', [CartItemController::class, 'cartItemControll'])->name('cart.add');
    Route::get('/cart', [CartItemController::class, 'cartList'])->name('list.cart');
    Route::get('/cart_remove/{id}', [CartItemController::class, 'cartRemoveItem'])->name('cart.remove');

    Route::get('/checkout_show_address', [CheckoutController::class, 'showAdresses'])->name('checkout.show.address');
    Route::get('/checkout_confirm_address/{id}', [CheckoutController::class, 'confirmAddress'])->name('checkout.confirm.address');
    Route::get('/checkout_show_payment', [CheckoutController::class, 'showPayment'])->name('checkout.show.payment');
    Route::get('/checkout_confirm_payment/{id}', [CheckoutController::class, 'confirmPayment'])->name('checkout.confirm.payment');

    Route::get('/checkout_finish', [CheckoutController::class, 'finish'])->name('checkout.finish');

});

Route::get('login_form', [LoginController::class, 'form'])->name('login.form');
Route::post('login_validate', [LoginController::class, 'loginValidate'])->name('login.validate');
Route::get('login_logout', [LoginController::class, 'logout'])->name('login.logout');