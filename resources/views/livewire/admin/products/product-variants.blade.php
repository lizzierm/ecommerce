<div>
    <section class="rounded-lg bg-white shadow-lg">
        <header class="border-b border-gray-100 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-bold text-blue-700 mb-4 border-b-2 border-gray-300 pb-2">
                    Opciones
                </h1>
                <div>
                    <button wire:click="$set('openModal', true)" class="py-1 px-4 h-8 btn btn-pink">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>

        </header>
        <div class="p-6">

            @if ($product->options->count())

            <div class="space-y-6">

                @foreach ($product->options as $option)
                <div wire:key="product-option-{{$option->id}}" class="p-6 rounded-lg border border-gray-300 relative">
                    <div class="absolute -top-3 px-4 bg-white ml-2">
                        {{-- + buton de mas opciones + --}}
                        <button onclick="confirmDeleteOption({{$option->id}})">
                            <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                        </button>
                        <span class="ml-2">
                            {{$option->name}}
                        </span>
                    </div>

                    {{-- VALORES DE NUESTRO MODEL --}}

                    <div class="flex flex-wrap">

                        @foreach ($option->pivot-> features as $feature)
                        <div wire:key="option-{{$option->id}}-feature-{{$feature['id']}}">
                            @switch($option->type)
                            @case(1)
                            {{-- texto --}}
                            <span
                                class="bg-pink-100 text-black text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded dark:bg-gray-100 dark:text-black border border-green-500">
                                {{ $feature ['description'] }}

                                {{-- buton eliminar --}}
                                <button class="ml-0.5"
                                    onclick="confirmDeleteFeature({{$option->id}},{{ $feature['id'] }})">
                                    <i class="fa-solid fa-trash-can hover:text-red-500"></i>
                                </button>
                            </span>
                            @break
                            @case(2)
                            {{-- color --}}
                            <div class="relative">
                                <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4"
                                    style="background-color:{{ $feature['value'] }}"></span>

                                <button class="absolute z-10 left-1 top-6 "
                                    onclick="confirmDeleteFeature({{$option->id}},{{ $feature['id'] }})">
                                    <i class="fa-solid fa-trash-can hover:text-red-500 text-sm"></i>
                                </button>
                            </div>
                            @break

                            @default
                            @endswitch
                        </div>
                        @endforeach
                    </div>

                </div>
                @endforeach

            </div>

            @else

            <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-purple-50 dark:bg-purple-200 dark:text-purple-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">
                        Info alert!
                    </span> No hay opciones para este producto.
                </div>
            </div>

            @endif
        </div>
    </section>

    @if ($product->variants->count())
        
        <section class="rounded-lg bg-white shadow-lg mt-12 ">
            <header class="border-b border-gray-100 px-6 py-2">
                <div class="flex justify-between">
                    <h1 class="text-lg font-bold text-blue-700 mb-4 border-b-2 border-gray-300 pb-2">
                        Variantes
                    </h1>
                    
                </div>

            </header>
            <div class="p-6">
                <ul class=" divide-y -my-4">
                    @foreach ($product->variants as $item )
                        <li class="py-4 flex items-center">
                            <img src=" {{$item->image}}" class="w-12 h-12 object-cover object-center" >
                        <p class="divide-x">
                            @foreach ($item->features as $feature)
                                <span class="px-3">
                                    {{$feature->description}}
                                </span>
                            @endforeach
                        </p>
                        {{-- buton de editar --}}
                        {{-- <a href="" class="ml-auto"  class="btn btn-pink rounded-full">
                            Editar
                        </a> --}}
                    
                        <a href="{{route('admin.products.variants', [$product, $item])}}" class="ml-auto btn btn-pink rounded-full">
                            <i class="fa-solid fa-file-pen"></i>
                        </a>
                        
                        </li>
                    @endforeach
                </ul>

            </div>

        </section>
    @endif
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Agregar nueva opción
        </x-slot>
        <x-slot name="content">

            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-1">
                    Opción
                </x-label>

                <x-select class="w-full" wire:model.live="variant.option_id">
                    <option value="" disabled>
                        Seleccione una opción
                    </option>
                    @foreach ($options as $option)
                    <option value="{{ $option->id }}">
                        {{ $option->name }}
                    </option>
                    @endforeach
                </x-select>
            </div>

            <div class="flex items-center mb-6">
                {{-- Línea izquierda --}}
                <hr class="flex-1">

                {{-- Texto centrado --}}
                <span class="text-lg font-bold mx-4">Valores</span>

                {{-- Línea derecha --}}
                <hr class="flex-1">
            </div>

            <ul class="mb-4 space-y-4">
                @foreach ($variant['features'] as $index=> $feature)

                <li wire:key="variant-feature-{{ $index }}" class="relative border border-gray-300 rounded-lg p-6">
                    <!-- Contenido de cada elemento de la lista -->
                    <div class="absolute -top-3 bg-white px-4">
                        <button {{-- buton de eliminar --}} wire:click="removeFeature({{ $index }})">
                            <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                        </button>
                    </div>



                    <div>
                        <x-label class="mb-1">
                            Valores
                        </x-label>


                        <x-select class="w-full" wire:model="variant.features.{{$index}}.id"
                            wire:change="feature_change({{$index}})">
                            <option value="">
                                Selecciona un valor
                            </option>
                            @foreach ($this->features as $feature )
                            <option value="{{$feature->id}}">
                                {{$feature->description}}
                            </option>
                            @endforeach
                        </x-select>
                    </div>
                </li>
                @endforeach
            </ul>

            <div class="flex justify-end">
                <button class="btn btn-green" wire:click="addFeature">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button class="btn btn-pink " wire:click="save">
                Guardar
            </button>
            <x-danger-button wire:click="$set('openModal', false)" class="ml-2">
                Cancelar
            </x-danger-button>

        </x-slot>
    </x-dialog-modal>
    @push('js')
    <script>
        function confirmDeleteFeature(option_id, feature_id){
                            Swal.fire({
                                title: "¿Estás seguro?",
                                text: "¡No podrás revertir esto!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "¡Sí! Bórralo",
                                cancelButtonText: "Cancelar",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                
                                    @this.call('deleteFeature', option_id, feature_id);
                                }
                            });
                        }

                      function confirmDeleteOption(option_id){
                        Swal.fire({
                                title: "¿Estás seguro?",
                                text: "¡No podrás revertir esto!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "¡Sí! Bórralo",
                                cancelButtonText: "Cancelar",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                
                                    @this.call('deleteOption', option_id);
                                }
                            });
                      }
    </script>
    @endpush

</div>