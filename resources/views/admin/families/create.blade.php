{{-- //create families --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Familias',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => 'Nuevo',
        // 'route' => route('admin.families.index'),
    ]
]">
    <div class="card">

        <form action="{{route('admin.families.store')}}" method="POST">
            @csrf
            <x-validation-errors class="mb-4" />
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la nueva familia" name="name"
                    value="{{old('name')}}" />

                <div class="flex justify-end mt-4">
                    <!-- Utilizamos flexbox y agregamos margen superior -->
                    <x-button class="bg-yellow-400">
                        <!-- Cambiamos el color del botón a amarillo -->
                        Guardar
                    </x-button>
                   
                    <a class="btn btn-green rounded-full ml-2" href="{{ route('admin.families.index') }}">  
                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                   </a>
                </div>

            </div>
        </form>
    </div>

</x-admin-layout>