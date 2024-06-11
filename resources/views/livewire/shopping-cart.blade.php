<div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
    <div class="lg:col-span-5">
        <div class="flex justify-between mb-2">
            <h1 class="text-lg">
                <strong>Carrito de compras ({{ Cart::count() }} productos)</strong>
            </h1>

            <button class="font-semibold text-gray-700 hover:text-blue-600 underline hover:no-underline"
                wire:click="destroy()">
                Limpiar Carrito
            </button>
        </div>

        <div class="card">
            <ul class="space-y-4">
                @forelse (Cart::content() as $item)
                    <li class="lg:flex">
                        <img class="w-full lg:w-36 h-36 aspect-[1/1] object-cover object-center mr-2"
                            src="{{$item->options->image}}">

                        <div class="w-80">
                            <p class="text-sm">
                                <a href="{{ route('products.show', $item->id) }}" 
                                   class="text-black font-bold transition-colors duration-300 hover:text-blue-600">
                                    {{$item->name}}
                                </a>
                            </p>
                            
                            <button
                                class="bg-red-100 hover:bg-red-200 text-red-800 text-xs font-semibold rounded px-2.5 py-0.5"
                                wire:click="remove('{{$item->rowId}}')">
                                <i class="fa-solid fa-xmark"></i>
                                Eliminar
                            </button>
                        </div>

                        <p>
                            Bs. {{$item->price}}
                        </p>

                        <div class="ml-auto space-x-3">
                            <button class="btn btn-green"
                                wire:click="decrease('{{$item->rowId}}')" >
                                -
                            </button>

                            <span class="inline-block w-2 text-center">
                                {{$item->qty}}
                            </span>

                            <button class="btn btn-green"
                                wire:click="increase('{{$item->rowId}}')" >
                                +
                            </button>
                        </div>
                    </li>
                @empty
                    <p class="text-center">
                        No hay productos en el carrito
                    </p>    
                @endforelse
            </ul>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="">
            <strong>Detalles:</strong>
        </div>
        
        <div class="card">
            @if (Cart::count() == 0)
                <p class="text-center text-red-500">No puedes continuar con la compra porque tu carrito está vacío.</p>
                <a href="/" class="btn btn-purple block w-full text-center mt-4">
                    Volver al inicio
                </a>
            @else
                <div class="flex justify-between font-semibold mb-2">
                    <p>
                        Total:
                    </p>
                    <p>
                        Bs. {{ Cart::subtotal() }}
                    </p>
                </div>

                @auth
                    <a href="{{ route('shipping.index') }}" class="btn btn-purple block w-full text-center">
                        Continuar compra
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-purple block w-full text-center">
                        Continuar compra
                    </a>
                @endauth
            @endif
        </div>
    </div>
</div>



