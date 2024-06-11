<div>
    <form wire:submit="addFeature" class="flex space-x-4">

        <div class="flex-1">
            <x-label class="mb-1">
                Valor
            </x-label>

            @switch($option->type)
                    @case(1)
                        <x-input 
                            wire:model="newFeature.value"
                            class="w-full"
                            placeholder="Ingrese un valor" />
                        @break
                    @case(2)
                        <div class="border border-gray-300 h-[42px] flex items-center justify-between px-3">
                            {{ $newFeature['value'] ?: 'Seleccione un color' }}
                            <x-input 
                                type="color"
                                wire:model.live="newFeature.value"/>
                        </div>
                        @break
                    @default
            @endswitch
        </div>

        <div class="flex-1">
            <x-label class="mb-1">
                Descripción
            </x-label>

            <x-input 
                wire:model="newFeature.description"
                class="w-full"
                placeholder="Ejemplo: Talla pequeño, color azul,etc." />
        </div>
        <div class="pt-5">
                {{-- <x-button> //eso solo sirve para los butons de agregar para que sea mas facil de añadir el color 
                Agregar
                </x-button> --}}
                <button class="btn btn-green">
                    Agregar
                </button>
        </div>
    </form>
</div>
