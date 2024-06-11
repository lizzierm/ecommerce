<div>
    <form wire:submit="save">
        <div class="card">

            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">
                    Familias
                </x-label>
                <x-select class="w-full" wire:model.live="subcategoryEdit.family_id">

                    <option>
                        Seleccione una familia
                    </option>

                    @foreach ($families as $family)
                    <option value="{{$family->id}}">
                        {{$family->name}}
                    </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Categorias
                </x-label>
                <x-select name="category_id" class="w-full" wire:model.live="subcategoryEdit.category_id">
                    <option value="" disabled>
                        Seleccione una categoria 
                    </option>
                    @foreach ($this->categories as $category )
                    <option value="{{$category->id}}">
                        @selected(old('category_id') == $category->id)
                        {{$category->name}}
                    </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre de la Categoria
                </x-label>
                <x-input class="w-full" 
                placeholder="Ingrese el nombre de la nueva categoria" 
                wire:model="subcategoryEdit.name"/>

                <div class="flex justify-end mt-4">
                    <x-danger-button onclick="confirmDelete()">
                        Eliminar
                    </x-danger-button>

                    <!-- Utilizamos flexbox y agregamos margen superior -->
                    <x-button class="bg-yellow-400">
                        <!-- Cambiamos el color del botón a amarillo -->
                       Actualizar
                    </x-button>

                    <a class="btn btn-green rounded-full ml-2" href="{{ route('admin.subcategories.index') }}">
                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </form>
    {{-- prueba para ver si esta bien  --}}
    {{-- @dump($subcategory) --}}

    <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" id="delete-form">
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