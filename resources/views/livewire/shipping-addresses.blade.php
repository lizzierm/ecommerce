<div>
    <section class="bg-white rounded-lg shadow overflow-hidden">
        <header class="bg-yellow-400 px-4 py-2 text-center">
            <h2 class="text-black text-lg ">
                <i class="fa-solid fa-file-pen"></i> Direcciones de envío guardadas
            </h2>
        </header>

        <div class="p-4">

            @if ($newAddress)

            <x-validation-errors class="mb-6" />

            <div class="grid grid-cols-4 gap-4">

                {{-- Tipo de direccion --}}
                <div class="col-span-1">
                    <x-select wire:model="createAddress.type">
                        <option value="">
                            Tipo de dirección
                        </option>
                        <option value="1">
                            Domicilio
                        </option>
                        <option value="2">
                            Oficina
                        </option>
                    </x-select>
                </div>

                {{-- Descripcion de la direccion --}}
                <div class="col-span-3">
                    <x-input wire:model="createAddress.description" class="w-full" type="text"
                        placeholder="Ingrese la dirección de destino">
                    </x-input>
                </div>

                {{-- Municipio --}}
                <div class="col-span-2">
                    <x-input wire:model="createAddress.district" class="w-full" type="text" placeholder="Municipio">
                    </x-input>
                </div>

                {{-- Referencia --}}
                <div class="col-span-2">
                    <x-input wire:model="createAddress.reference" class="w-full" type="text" placeholder="Referencia">
                    </x-input>
                </div>
            </div>

            <hr class="my-4">

            <div x-data="{
                receiver: @entangle('createAddress.receiver'),
                receiver_info: @entangle('createAddress.receiver_info'),
                }" x-init="
                    $watch('receiver', value => {
                        if(value == 1){
                            receiver_info.name = '{{ auth()->user() ? auth()->user()->name : '' }}';
                            receiver_info.last_name = '{{ auth()->user() ? auth()->user()->last_name : '' }}';
                            receiver_info.document_type = '{{ auth()->user() ? auth()->user()->document_type : '' }}';
                            receiver_info.document_number = '{{ auth()->user() ? auth()->user()->document_number : '' }}';
                            receiver_info.phone = '{{ auth()->user() ? auth()->user()->phone : '' }}';
                        } else {
                            receiver_info.name = '';
                            receiver_info.last_name = '';
                            receiver_info.document_number = '';
                            receiver_info.phone = '';
                        }
                    })
            ">

                <p class="font-semibold mb-2">
                    ¿Quién recibirá el pedido?
                </p>

                <div class="flex space-x-4 mb-4">

                    <label class="flex items-center">
                        <input x-model="receiver" type="radio" value="1" class="mr-1">
                        Mi persona (yo)
                    </label>

                    <label class="flex items-center">
                        <input x-model="receiver" type="radio" value="2" class="mr-1">
                        Otra persona
                    </label>

                </div>

                <div class="grid grid-cols-2 gap-2 ">
                    <div>
                        <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.name" class="w-full"
                            placeholder="Nombre" />
                    </div>

                    <div>
                        <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.last_name" class="w-full"
                            placeholder="Apellido" />
                    </div>

                    <div>
                        <div class="flex space-x-2">

                            <x-select x-model="receiver_info.document_type">
                                @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                <option value="{{$item->value}}">
                                    {{$item->name}}
                                </option>
                                @endforeach
                            </x-select>

                            <x-input x-model="receiver_info.document_number" class="w-full"
                                placeholder="Número de documento" />

                        </div>

                    </div>

                    <div>
                        <x-input x-model="receiver_info.phone" class="w-full" placeholder="Teléfono" />
                    </div>

                    <div>
                        <button class="btn btn-outline-gray w-full" wire:click="$set('newAddress', false)">
                            Cancelar <i class="fa-solid fa-xmark"></i>
                        </button>

                    </div>

                    <div>
                        <button wire:click="store" class="btn btn-outline-yellow w-full">
                            Guardar <i class="fa-solid fa-floppy-disk"></i>
                        </button>
                    </div>
                </div>

            </div>

            @else

            @if ($addresses->count())

                <ul class="grid grid-cols-3 gap-4"
                    @foreach ($addresses as $address)

                        <li class="{{$address->default ? 'bg-purple-200' : 'bg-white'}} rounded-lg shadow"
                            wire:key="addresses-{{$address->id}}">
                            <div class="p-4 flex items-center">

                                <div>
                                    <i class="fa-solid fa-house text-xl text-purple-600"></i>
                                </div>

                                <div class="flex-1 mx-4 text-xs">

                                    <p class="text-purple-900">
                                        <strong>{{$address->type == 1 ? 'Envio a domicilio :' : 'Envio a oficina :'}}</strong>
                                    </p>
                                    
                                    <p class=" font-semibold">
                                          {{$address->district}}
                                    </p>

                                    <p class=" font-semibold">
                                        {{$address->description}}
                                    </p>

                                    <p class="text-purple-900">
                                        <strong>Enviar a :</strong>
                                    </p>

                                    <p class=" font-semibold">
                                         {{$address->receiver_info['name']}}
                                      </p>

                                </div>

                                <div class="text-xs text-gray-800 flex flex-col">

                                    <button wire:click="setDefaultAddress({{$address->id}})">
                                        <i class="fa-solid fa-star"></i>
                                    </button>

                                    <button>
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <button wire:click="deleteAddress({{$address->id}})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            @else
            <p class="text-center text-purple-500">
                No se encontraron direcciones.
            </p>

            @endif

            <button class="btn-outline-gray w-full flex items-center justify-center mt-4"
                wire:click="$set('newAddress', true)">
                Agregar <i class="fa-solid fa-plus ml-2"></i>
            </button>
            @endif

        </div>
    </section>
</div>
