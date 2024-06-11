<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(){
        return view('cart.index');
    }

}
