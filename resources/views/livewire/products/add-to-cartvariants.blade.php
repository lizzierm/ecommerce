<x-container>
    <div class="card">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1">

                {{-- <figure class="">
                    <img src="{{$this->variant->image}}" class="aspect-[16/9] w-full object-cover object-center">
                </figure> --}}

                @if($this->variant && $this->variant->image)
                    <img src="{{$this->variant->image}}" class="aspect-[16/9] w-full object-cover object-center">
                @endif

            </div>
            <div class="col-span-1">
                <h1 class="text-xl text-black mb-2 font-semibold">
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


                <div class="flex flex-wrap">

                    @foreach ($product->options as $option)
                    <div class="mr-4 mb-4">
                        <p class="font-semibold mb-2">
                            {{ $option->name }}
                        </p>

                        <ul class="flex items-center space-x-4">
                            @foreach ($option->pivot->features as $feature )
                                <li>

                                    @switch($option->type)
                                        @case(1)
                                        {{-- boton de talla --}}
                                            <button class="w-20 h-8 font-semibold uppercase text-sm rounded-lg {{$selectedFeatures [$option->id] == $feature['id'] ? 'bg-yellow-200 text-black' : 'border border-gray-200 text-gray-700'}} "
                                                wire:click="$set('selectedFeatures.{{$option->id}}', {{$feature['id']}})">

                                                {{$feature['value']}}
                                                
                                            </button>
                                            @break

                                        @case(2)
                                        {{-- boton de color --}}
                                            {{-- <div class="p-0.5 border-2 rounded-lg items-center -mt-1.5 {{$selectedFeatures [$option->id] == $feature['id']? 'border-yellow-300 ': 'border-transparent'}}">
                                                <button class="w-20 h-8 rounded-lg border border-gray-200"
                                                    style="background-color: {{$feature['value']}}"
                                                    wire:click="$set('selectedFeatures.{{$option->id}}', {{$feature['id']}})">
                                                </button>
                                            </div> --}}

                                            <div class="relative">
                                                <button 
                                                    class="w-6 h-6 rounded-full border border-gray-200 focus:outline-none"
                                                    style="background-color: {{$feature['value']}}"
                                                    wire:click="$set('selectedFeatures.{{$option->id}}', {{$feature['id']}})">
                                                </button>
                                                <div class="absolute top-0 left-0 w-6 h-6 rounded-full border border-yellow-600 opacity-0 transition duration-300 {{$selectedFeatures[$option->id] == $feature['id'] ? 'opacity-100' : ''}}" style="pointer-events: none;"></div>
                                            </div>
                                            
                                            
                                            
                                            
                                            @break
                                    
                                        @default
                                            
                                    @endswitch

                                   
                                </li>
                            @endforeach
                        </ul>
                        {{-- @dump($selectedFeatures) --}}
                    </div>
                @endforeach
                
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
