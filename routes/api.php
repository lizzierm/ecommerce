<?php

use App\Http\Controllers\Api\SortController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/sort/covers', [SortController::class, 'covers'])->name('api.sort.covers');