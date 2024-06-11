<div>
    <form  wire:submit="store">
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-14">

                <label class="flex items-center px-4 py-2 rounded-lg bg-yellow-200 cursor-pointer text-gray-700 ">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar Imagen
                    <input type="file" class="hidden" accept="image/*" wire:model="image">
                </label>
            
            </div>
            <img class="aspect-[19/9] object-cover object-center w-full" 
            src="{{ $image ? $image->temporaryUrl() :  Storage::url($productEdit['image_path']) }}" 
            alt="">
        </figure>

            <x-validation-errors class="mb-4"/>

        <div class="card">
            <div class="mb-2"> <!-- Reduje el espacio aquí -->
                <x-label class="mb-1">
                    Código
                </x-label>

                <x-input 
                wire:model="productEdit.sku" 
                class="w-full"
                placeholder="Ingrese el código del producto"/>
            </div>

            <div class="mb-2">
                <x-label class="mb-1">
                    Producto
                </x-label>

                <x-input
                wire:model="productEdit.name" 
                class="w-full"
                placeholder="Ingrese el nombre del producto"/>
            </div>

            <div class="mb-2">
                <x-label class="mb-1">
                Descripción
                </x-label>

                <x-textarea
                wire:model="productEdit.description" 
                class="w-full"
                placeholder="Ingrese la descripción del producto">  
                </x-textarea>
            </div>

            <div class="mb-2">
                <x-label class="mb-1">
                    Familias
                </x-label>

                <x-select 
                    class="w-full" 
                    wire:model.live="family_id">
                    <option value="" disabled>
                        Seleccione una familia
                    </option>
                    @foreach ($families as $family)
                        <option value="{{$family->id}}">
                            {{$family->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-2">
                <x-label class="mb-1">
                    Categorías
                </x-label>

                <x-select class="w-full" 
                wire:model.live="category_id">
                    <option value="" disabled>
                        Seleccione una Categoria
                    </option>
                    @foreach ($this->categories as $category)

                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-2">
                <x-label class="mb-1">
                    Subcategorías
                </x-label>

                <x-select class="w-full" 
                    wire:model.live="productEdit.subcategory_id">
                    <option value="" disabled>
                        Seleccione una Subcategoria
                    </option>
                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{$subcategory->id}}">
                            {{$subcategory->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>
            
            @empty($product->variants->count() > 0)
            
                <div class="mb-4"> <!-- Reduje el espacio aquí -->
                    <x-label class="mb-1">
                        Stock
                    </x-label>

                    <x-input 
                    type="number"
                    wire:model="productEdit.stock" 
                    class="w-full"
                    placeholder="Ingrese el stock del producto"/>
                </div>
            @endempty

            <div class="mb-4"> <!-- Reduje el espacio aquí -->
                <x-label class="mb-1">
                    Precio
                </x-label>

                <x-input 
                type="number"
                step="0.01"
                wire:model="productEdit.price" 
                class="w-full"
                placeholder="Ingrese el precio del producto"/>
            </div>
           <div class="flex justify-end mt-4">
                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>
                
                <x-button class="ml-2">Actualizar</x-button>
                {{-- buton de retroceder --}}
                <a class="btn btn-green rounded-full ml-2" href="{{ route('admin.products.index') }}">
                    <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                </a>
            </div>

        </div>
    </form>

    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
    <script>
        function confirmDelete() {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, eliminar!",
                cancelButtonText:"Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
@endpush

</div>