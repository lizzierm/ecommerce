<x-container>
    <div class="card">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <figure class="">
                    <img src="{{$product->image}}" class="aspect-[16/9] w-full object-cover object-center">
                </figure>

            </div>
            <div class="col-span-1">
                <h1 class="text-xl text-black mb-2">
                    {{$product->name}}
                </h1>

                <div class="text-sm mb-2">
                    {{$product->description}}
                </div>

                <div class="flex item-center space-x-2 mb-4">
                    <ul class="flex space-x-1 text-sm">
                        <li>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                        </li>
                    </ul>
                    <p class="text-sm text-gray-700">
                        4.7 (87)
                    </p>
                </div>
                <p class="font-semibold text-2sm text-gray-700 mb-4">
                   Precio: {{$product->price}}$
                </p>
                <div class="flex items-center space-x-6 mb-6"
                    x-data="{
                        qty:@entangle('qty'),
                    }">
                    <button class="btn btn-green"
                    x-on:click="qty = qty - 1"
                    x-bind:disabled="qty == 1">
                        -
                    </button>
                    <span x-text="qty" class="inline-block w-2 text-center"></span>
                    <button class="btn btn-green"
                        x-on:click="qty = qty + 1">
                        +
                    </button>
                </div>
                <button class="btn btn-yellow w-full mb-6"
                    wire:click="add_to_cart"
                    wire:loading.attr="disabled">
                    <i class="fa-solid fa-cart-shopping"></i>  Agregar al carrito
                </button>
                <div class="text-gray-700 flex items-center space-x-4">
                    <i class="fa-solid fa-truck-fast text-2xl"> </i>
                    <p>Despacho a domicilio</p>
                </div>
            </div>
        </div>
    </div>
</x-container>
