<?php
//abrimos php y decimos que queremos utilizar el paquete route

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\OptionController as AdminOptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Adminn\OptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');


Route::get('/options', [AdminOptionController::class, 'index'])->name('options.index');

Route::resource('users', UserController::class);
Route::resource('families', FamilyController::class);
Route::resource('categories',CategoryController::class);
Route::resource('subcategories',SubcategoryController::class);
Route::resource('products',ProductController::class);
Route::get('products/{product}/variants/{variant}',[ProductController::class, 'variants'])
        ->name('products.variants')
        ->scopeBindings();

Route::put('products/{product}/variants/{variant}',[ProductController::class, 'variantsUpdate'])
        ->name('products.variantsUpdate')
        ->scopeBindings();

Route::resource('covers',CoverController::class);
    