<?php

namespace App\Livewire\Products;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $qty = 1;
    // desde ahi mandamos el 1
    
   public function add_to_cart(){
    // Verificar si el producto tiene stock disponible
    if ($this->product->stock > 0) {
        // Calcular la cantidad que se puede agregar al carrito
        $quantityToAdd = min($this->qty, $this->product->stock);

        // Agregar el producto al carrito
        Cart::instance('shopping');

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $quantityToAdd,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->product->image,
                'sku' => $this->product->sku,
                'features' => [],
            ]
        ]);

        // Almacenar el carrito si el usuario está autenticado
        if(auth()->check()){
            Cart::store(auth()->id()); 
        }

        // Emitir evento de actualización del carrito
        $this->dispatch('cartUpdated', Cart::count());

        // Mostrar notificación de éxito
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Se ha añadido ' . $quantityToAdd . ' unidades del producto al carrito de compras'
        ]);
    } else {
        // Mostrar notificación de falta de stock
        $this->dispatch('swal', [
            'icon' => 'error',
            'title' => '¡Lo sentimos!',
            'text' => 'El producto está agotado y no se puede agregar al carrito'
        ]);
    }
}

    
    // public function add_to_cart(){
       
    //     Cart::instance('shopping');

    //     Cart::add([
    //         'id' => $this->product->id,
    //         'name' => $this->product->name,
    //         'qty' => $this->qty,
    //         'price' => $this->product->price,
    //         'options' =>[
    //             'image' => $this->product->image,
    //             'sku' => $this->product->sku,
    //             'features' => [],

    //         ]
    //     ]);

    //     if(auth()->check()){
    //         Cart::store(auth()->id()); 
    //     }

    //     $this->dispatch('cartUpdated', Cart::count());

    //     $this->dispatch('swal', [
    //         'icon' => 'success',
    //         'title' => '¡Bien hecho!',
    //         'text' => 'El producto se ha añadido al carrito de compras'
    //     ]);

       
    // }
    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
