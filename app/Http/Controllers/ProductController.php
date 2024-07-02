<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
   public function show($id)
{
    // Cargar el producto con sus relaciones de subcategoría y categoría
    $product = Product::with('subcategory.category.family')->findOrFail($id);
    
    // Devolver la vista con el producto cargado
    return view('products.show', compact('product'));
}

}
