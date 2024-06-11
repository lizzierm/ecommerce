{{-- //editar families --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],

    [
        'name' => 'Familias',
        'route' => route('admin.families.index'), // Asegúrate de que 'admin.families.index' esté entre comillas
    ],

    [
        'name' => $family->name,
        // 'route' => route('admin.families.index'),
    ]

]">

<div class="card">
    <form action="{{ route('admin.families.update', $family) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <x-label class="mb-2">
                Nombre  
            </x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre de la nueva categoría" name="name"
                value="{{ old('name', $family->name) }}" />

            <div class="flex justify-end mt-4">
                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>
               
                <x-button class="ml-2">Actualizar</x-button>
                
                <a class="btn btn-green rounded-full ml-2" href="{{ route('admin.families.index') }}">  
                    <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
               </a>
            </div>
        </div>
    </form>
</div>

<form action="{{ route('admin.families.destroy', $family) }}" method="POST" id="delete-form">
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
</x-admin-layout>
