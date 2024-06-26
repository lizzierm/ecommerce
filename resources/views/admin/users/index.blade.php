{{-- //CONTENIDO Usuarios --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
    ]
]">

<x-slot name="action">
    <a class="btn btn-yellow rounded-full" href="{{ route('admin.users.create') }}">
        Nuevo
    </a>
</x-slot>

<div class="overflow-x-auto mt-6">
    <table class="min-w-full bg-white rounded-lg overflow-hidden">
        <!-- Encabezados de la tabla -->
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold uppercase tracking-wider">Apellido</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold uppercase tracking-wider">Tipo de Documento</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold uppercase tracking-wider">Número de Documento</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold uppercase tracking-wider">Correo Electrónico</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold uppercase tracking-wider">Teléfono</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <!-- Filas de la tabla -->
            @foreach ($users as $user)
            <tr>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">{{ $user->id }}</td>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">{{ $user->name }}</td>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">{{ $user->last_name }}</td>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">
                    @if ($user->document_type == 1)
                        CI
                    @elseif ($user->document_type == 2)
                        CE
                    @elseif ($user->document_type == 3)
                        PP
                    @elseif ($user->document_type == 4)
                        CIE
                    @else
                        Otro
                    @endif
                </td>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">{{ $user->document_number }}</td>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">{{ $user->email }}</td>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">{{ $user->phone }}</td>
                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium flex">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-pink rounded-full me-2">
                        <i class="fa-solid fa-file-pen"></i>
                    </a>
                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="confirmDelete(event, {{ $user->id }})">
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
</x-admin-layout>

