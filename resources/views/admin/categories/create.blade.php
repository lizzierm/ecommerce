{{-- //create categories --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => 'Nuevo',
        // 'route' => route('admin.families.index'),
    ]
]">
    <form action="{{route('admin.categories.store')}}" method="POST">
        @csrf
    
        <div class="card">
            
            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">
                    Familia
                </x-label>
                <x-select name="family_id" class="w-full">
                    @foreach ($families as $family )
                        <option value="{{$family->id}}">
                            @selected(old('family_id') == $family->id)
                            {{$family->name}}
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
                        <i class="fa-solid fa-floppy-disk fa-lg"></i>
                    </x-button>
                    <a class="btn btn-green rounded-full ml-2" href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                    </a>
                </div>  
            </div>

        </div>
    </form>
</x-admin-layout>