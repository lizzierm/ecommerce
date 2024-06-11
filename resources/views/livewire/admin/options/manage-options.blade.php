<div>
    <section class="rounded-lg bg-white shadow-lg">
     <header class="border-b border-gray-100 px-6 py-2">
         <div class="flex justify-between">
            <h1 class="text-lg font-bold text-blue-700 mb-4 border-b-2 border-gray-300 pb-2">
                Opciones
            </h1>
            
            <x-button wire:click="$set('newOption.openModal', true)" class="max-h-9 px-5 text-sm">
                Nuevo
            </x-button>
            
         </div>
     </header>
     <div class="p-6">

         <div class="space-y-4">

             @foreach ($options as $option)
                 <div class="p-6 rounded-lg border border-gray-200 relative"
                     wire:key="option-{{$option->id}}">
                    <div class="absolute -top-3 px-4 bg-white">
                       
                        <button class="mr-1" onclick="confirmDelete('{{ $option->id }}', 'option')">
                            <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                        </button>
                        
                        {{-- CON ESO SE VEN LOS TITULOS DE LAS OPCIONES --}}
                        <span class="font-bold text-lg">
                            {{ $option->name }}
                        </span>
                        
                    </div>

                    {{-- VALORES DE LA DESCRIPCION NUEVA OPCION--}}

                    <div class="flex flex-wrap mb-4">
                        @foreach ($option->features as $feature)
                            @switch($option->type)
                                @case(1)    
                                    {{-- texto   --}}
                                    <span class="bg-pink-100 text-black text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded dark:bg-gray-100 dark:text-black border border-green-500">
                                        {{ $feature->description }}
                                        <button class="ml-0.5" 
                                            onclick="confirmDelete({{ $feature->id }}, 'feature')">
                                            <i class="fa-solid fa-trash-can hover:text-red-500"></i>
                                        </button>
                                    </span>
                                    @break
                                @case(2)
                                    {{-- color --}}
                                    <div class="relative">
                                        <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4" style="background-color:{{ $feature->value }}"></span>
                                        <button class="absolute z-10 left-1 top-6 " 
                                            onclick="confirmDelete({{ $feature->id }}, 'feature')">
                                            <i class="fa-solid fa-trash-can hover:text-red-500 text-sm"></i>
                                        </button>
                                    </div>
                                    @break
                               
                                @default
                            @endswitch
                        @endforeach
                    </div>
                    
                   <div>
                        @livewire('admin.options.add-new-feature', ['option' => $option], key('add-new-feature-' . $option->id))
                   </div>

                 </div>
             @endforeach
         </div>
     </div>
    </section>

    <x-dialog-modal wire:model="newOption.openModal">

        <x-slot name="title">
            Crear nueva opción
        </x-slot>

        <x-slot name="content">
            {{-- validacion de error --}}
            <x-validation-errors class="mb-4"/>

            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>

                    <x-label class="mb-1">
                        Nombre
                    </x-label>

                    <x-input 
                        wire:model="newOption.name"
                        class="w-full"
                        placeholder="Ejemplo: Sexo" >
                    </x-input>

                </div>

                <div>
                    <x-label class="mb-1">
                        Tipo
                    </x-label>

                    <x-select 
                        wire:model.live="newOption.type"
                        class="w-full">

                        <option value="1">Texto</option>
                        <option value="2">Color</option>

                    </x-select>
                </div>

            </div>

            <div class="flex items-center mb-4"> 
                <hr class="flex-1">
                <span class="mx-4 font-bold text-sm">
                    Descripción del tipo de opción
                </span>
                <hr class="flex-1">
            </div>
            

            <div class="mb-4 space-y-3">
                @foreach ($newOption->features as $index => $feature )
                    <div class="p-6 rounded-lg border border-gray-200 relative"
                    wire:key="features-{{$index}}">

                        <div class="absolute -top-3 px-4 bg-white">
                            <button wire:click="removeFeature({{$index}})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                           
                            <div>
                                <x-label class="mb-1">
                                    Valor
                                </x-label>

                                @switch($newOption->type)
                                        @case(1)
                                            <x-input 
                                                wire:model="newOption.features.{{ $index }}.value"
                                                class="w-full"
                                                placeholder="Descripcion de valor" />
                                            @break
                                        @case(2)
                                            <div class="border border-gray-300 h-[42px] flex items-center justify-between px-3">
                                                {{ $newOption->features[$index]->value ?: 'Seleccione un color' }}
                                                <x-input 
                                                    type="color"
                                                    wire:model.live="newOption.features.{{ $index }}.value"/>
                                            </div>
                                            @break
                                        @default
                                @endswitch              
                            </div>

                            <div>
                                <x-label class="mb-1">
                                    Descripción
                                </x-label>
                                <x-input 
                                    wire:model="newOption.features.{{$index}}.description"
                                    class="w-full"
                                    placeholder="Ejemplo: femenino" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end">
                <button wire:click="addFeature" class="me-2">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button class="btn btn-green" wire:click="addOption">
                Agregar
            </button>
        </x-slot>
    </x-dialog-modal>
    @push('js')
        <script>
            function confirmDelete(id, type){
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
                        switch(type) {
                            case 'feature':
                                @this.call('deleteFeature', id);
                                break;
                            case 'option':
                                @this.call('deleteOption', id);
                                break;
                            default:
                                break;
                        }
                    }
                });
            }

        </script>
    @endpush
 </div>
 