<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddToCartvariants extends Component
{
    public $product;
    public $qty = 1;
    public $selectedFeatures = [
        // '1' => '1',
        // '2' => '3',
    ];
    public function mount(){
        foreach($this->product->options as $option){
            $features = collect($option->pivot->features);

            $this->selectedFeatures[$option->id] = $features->first()['id'];

        }
    }
    #[Computed]
    public function variant(){
        return $this->product->variants->filter( function($variant){
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);
        })->first();
    }

    public function add_to_cart(){
    // Verificar si el producto tiene stock disponible
    if ($this->variant && $this->variant->stock > 0) {
        // Agregar el producto al carrito
        Cart::instance('shopping');

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->variant->image,
                'sku' => $this->variant->sku,
                'features' => Feature::whereIn('id', $this->selectedFeatures)
                        -> pluck('description', 'id')
                        ->toArray()
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
            'text' => 'El producto se ha añadido al carrito de compras'
        ]);
    } else {
        // Mostrar notificación de falta de stock
        $this->dispatch('swal', [
            'icon' => 'error',
            'title' => '¡Lo sentimos!',
            'text' => 'El producto está agotado o no tiene stock disponible y no se puede agregar al carrito'
        ]);
    }
}

    public function render()
    {
        return view('livewire.products.add-to-cartvariants');
    }
}
