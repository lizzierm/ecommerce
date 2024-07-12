<div>
    <form  wire:submit="store">
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-14">

                <label class="flex items-center px-4 py-2 rounded-lg bg-yellow-200 cursor-pointer text-gray-700 ">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar Imagen
                    <input type="file"  wire:model="image">
                </label>
            
            </div>
            <img class="aspect-[19/9] object-cover object-center w-full" 
            src="{{ $image ? $image->temporaryUrl() :  asset('img/no-image.png')}}" 
            alt="">
        </figure>

            <x-validation-errors class="mb-4"/>

        <div class="card">
            <div class="mb-2"> <!-- Reduje el espacio aquí -->
                <x-label class="mb-1">
                    Código
                </x-label>

                <x-input 
                wire:model="product.sku" 
                class="w-full"
                placeholder="Ingrese el código del producto"/>
            </div>

            <div class="mb-2">
                <x-label class="mb-1">
                    Producto
                </x-label>

                <x-input
                wire:model="product.name" 
                class="w-full"
                placeholder="Ingrese el nombre del producto"/>
            </div>

            <div class="mb-2">
                <x-label class="mb-1">
                Descripción
                </x-label>

                <x-textarea
                wire:model="product.description" 
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
                    wire:model.live="product.subcategory_id">
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
            
            <div class="mb-4"> <!-- Reduje el espacio aquí -->
                <x-label class="mb-1">
                    Precio
                </x-label>

                <x-input 
                type="number"
                step="0.01"
                wire:model="product.price" 
                class="w-full"
                placeholder="Ingrese el precio del producto"/>
            </div>
            <div class="flex justify-end">
                <x-button>
                    Crear producto
                </x-button>

                <a class="btn btn-green rounded-full ml-2" href="{{ route('admin.products.index') }}">
                    <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                </a>
            </div>
        </div>
    </form>
</div>