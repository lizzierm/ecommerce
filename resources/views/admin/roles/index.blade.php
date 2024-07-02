{{-- Roles para el personal --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Roles',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
    ]
]">

<x-slot name="action">
    <a class="btn btn-yellow rounded-full" href="{{ route('admin.roles.create') }}">
        Nuevo
    </a>
</x-slot>

<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4 text-center">Lista de Roles</h2>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="text-center">
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-xs font-semibold text-white uppercase tracking-wider text-center">ID</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-xs font-semibold text-white uppercase tracking-wider text-center">Rol</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-xs font-semibold text-white uppercase tracking-wider text-center">Acciones</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($roles as $role)
                <tr class="text-center">
                    <td class="py-2 px-4 border-b">{{ $role->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $role->name }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium flex justify-center">
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-pink rounded-full me-2">
                            <i class="fa-solid fa-file-pen"></i>
                        </a>

                        {{-- <a href="{{ route('admin.roles.destroy', $role) }}"  method="POST" class="btn btn-green rounded-full me-2">
                            @csrf
                            @method('DELETE')
                            <i class="fa-solid fa-trash"></i>
                        </a> --}}
                        <form id="delete-form-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role) }}" method="POST" onsubmit="confirmDelete(event, {{ $role->id }})">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-red rounded-full">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(event, id) {
        event.preventDefault();
        if (confirm('¿Estás seguro de que deseas eliminar este rol?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
</x-admin-layout>