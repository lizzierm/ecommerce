{{-- //CONTENIDO Products --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
    ]
]">

    <x-slot name="action">
        @can('admin.products.create')
            <a class="btn btn-yellow rounded-full" href="{{ route('admin.products.create') }}">
                Nuevo
            </a>
        @endcan
    </x-slot>

    @cannot('admin.products.index')
        <div class="alert alert-danger mt-4" style="background-color: #dc3545; color: #fff;">
            El usuario no tiene permitido ver este módulo de productos.
        </div>
    @else
        @if ($products->count())
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                CODIGO
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                PRODUCTO
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                PRECIO
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $product->id }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm text-gray-500">
                                    {{ $product->sku }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm text-gray-500">
                                    {{ $product->name }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm text-gray-500">
                                    {{ $product->price }}
                                </td>
                                <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">
                                    @can('admin.products.edit')
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-pink rounded-full">
                                            <i class="fa-solid fa-file-pen"></i>
                                        </a>
                                    @endcan
                                    
                                    @can('admin.products.destroy')
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-red rounded-full" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
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
                {{ $products->links() }}
            </div>
        @else
            <div class="flex items-center p-4 text-sm text-black rounded-lg bg-purple-500 dark:bg-pink-100 dark:text-black" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Info alert!</span> No cuenta con productos registrados.
                </div>
            </div>
        @endif
    @endcannot

</x-admin-layout>
