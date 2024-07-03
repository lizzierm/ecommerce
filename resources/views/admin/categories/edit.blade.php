{{-- //edit categoria --}}
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
        'name' => $category->name,
        // 'route' => route('admin.families.index'),
    ]
]">

    <form action="{{route('admin.categories.update', $category)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            
            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">
                    Familia
                </x-label>
                <x-select name="family_id" class="w-full">
                    @foreach ($families as $family )
                        <option value="{{$family->id}}"
                            @selected(old('family_id',$category->family_id) == $family->id)>
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
                    value="{{old('name', $category->name)}}" />
        
                <div class="flex justify-end mt-4">

                    {{-- <x-danger-button onclick="confirmDelete()">
                        Eliminar
                    </x-danger-button>
                   
                    <x-button class="bg-yellow-400 mb-2">          
                        Actualizar
                    </x-button>
                    <a class="btn btn-green rounded-full ml-2" href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                    </a> --}}

                    <x-button class="bg-yellow-400 mb-2 btn-lg rounded-full mr-2 d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-floppy-disk fa-lg"></i> <!-- Icono de actualización -->
                    </x-button>
                    
                    <x-danger-button onclick="confirmDelete()" class="btn-lg rounded-full mr-2 d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-trash-can"></i> <!-- Icono de papelera -->
                    </x-danger-button>
                    
                    <a class="btn btn-green rounded-full btn-lg d-flex justify-content-center align-items-center" href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right" style="margin-top: 7px;"></i>
                    </a>
               
                </div>  
            </div>

        </div>
    </form>
        @can('admin.categories.destroy')
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
            </form>
        @endcan
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
</x-admin-layout>