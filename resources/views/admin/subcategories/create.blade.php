{{-- //create subcategories --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategorias',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => 'Nuevo',
        // 'route' => route('admin.families.index'),
    ]
]">

    {{-- <form action="{{route('admin.subcategories.store')}}" method="POST">
        @csrf

        <div class="card">
            
            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">
                    Categorias
                </x-label>
                <x-select name="category_id" class="w-full">
                    @foreach ($categories as $category )
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
                <x-input class="w-full" placeholder="Ingrese el nombre de la nueva categoria" name="name"
                    value="{{old('name')}}" />
        
                <div class="flex justify-end mt-4">
                    <!-- Utilizamos flexbox y agregamos margen superior -->
                    <x-button class="bg-yellow-400">
                        <!-- Cambiamos el color del botón a amarillo -->
                        Guardar
                    </x-button>
                </div>  
            </div>

        </div>
    </form> --}}
    @livewire('admin.subcategories.subcategory-create')
</x-admin-layout>