{{-- CONTENIDO Subcategorias --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategorias',
    ]
]">

<x-slot name="action">
    @can('admin.subcategories.create')
        <a class="btn btn-yellow rounded-full" href="{{ route('admin.subcategories.create') }}">
            Nuevo
        </a>
    @endcan
</x-slot>

@can('admin.subcategories.index')
    @if ($subcategories->count())
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Nombre (subcategorias)
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Categoria
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Familia
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $subcategory->id }}
                            </td>
                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm text-gray-500">
                                {{ $subcategory->name }}
                            </td>
                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm text-gray-500">
                                {{ $subcategory->category->name }}
                            </td>
                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm text-gray-500">
                                {{ $subcategory->category->family->name }}
                            </td>
                            <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">
                                @can('admin.subcategories.edit')
                                    <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="btn btn-pink rounded-full mr-2">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </a>
                                @endcan
                                @can('admin.subcategories.destroy')
                                    <form id="delete-form-{{ $subcategory->id }}" action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" onsubmit="confirmDelete(event, {{ $subcategory->id }})" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red rounded-full">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $subcategories->links() }}
        </div>
    @else
        <div class="flex items-center p-4 text-sm text-black rounded-lg bg-purple-500 dark:bg-pink-100 dark:text-black" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Info alert!</span> No cuenta con registros de subcategorias registradas
            </div>
        </div>
    @endif
@else
    <div class="alert alert-danger" style="background-color: #dc3545; color: #fff;">
        El usuario no tiene permitido ver este Módulo
    </div>
@endcan
</x-admin-layout>

<script>
function confirmDelete(event, subcategoryId) {
    event.preventDefault();
    if (confirm('¿Estás seguro de que deseas eliminar esta subcategoría?')) {
        document.getElementById('delete-form-' + subcategoryId).submit();
    }
}
</script>
