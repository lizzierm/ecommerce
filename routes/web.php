<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyController as ControllersFamilyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\WelcomeController;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Variant;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;


Route::get('/',[WelcomeController::class, 'index'])->name('welcome.index');

// Route::get('families/{$family}', [FamilyController::class, 'show'])->name('families.show');
Route::get('families/{family}', [FamilyController::class, 'show'])->name('families.show');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');
Route::get('products/{products}', [ProductController::class, 'show'])->name('products.show');
Route::get('Cart', [CartController::class, 'index'])->name('cart.index');
Route::get('shipping', [ShippingController::class, 'index'])->name('shipping.index');
Route::get('checkout', [CheckoutController::class, 'index'])-> name('checkout.index');
Route::post('checkout/paid', [CheckoutController::class, 'paid'])-> name('checkout.paid');


Route::get('gracias', function(){
    return view('gracias');
})->name('gracias');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('prueba', function(){
    
    Cart::instance('shopping');
    
    return Cart::content();
});
