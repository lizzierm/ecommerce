{{-- //CONTENIDO FAMILIAS --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
    ]
]">

<x-slot name="action">
  <a class="btn btn-yellow rounded-full" href="{{ route('admin.families.create') }}">
    Nuevo
  </a>
</x-slot>

@if ($families->count())

<div class="overflow-x-auto mt-4">
  <table class="min-w-full bg-white rounded-lg overflow-hidden">
    <thead class="bg-blue-500 text-white">
      <tr>
        <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
          ID
        </th>
        <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
          Name
        </th>
        <th class="px-6 py-3 border-b border-gray-200 bg-purple-400 text-left text-xs font-semibold text-white uppercase tracking-wider">
          Acciones
        </th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
      @foreach ($families as $family)
      <tr>
        <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium text-gray-900">
          {{ $family->id }}
        </td>
        <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm text-gray-500">
          {{ $family->name }}
        </td>
        <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap text-sm font-medium">
          <a href="{{ route('admin.families.edit', $family) }}" class="btn btn-pink rounded-full">
            <i class="fa-solid fa-file-pen"></i>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="mt-4">
  {{ $families->links() }}
</div>
@else
<div class="flex items-center p-4 text-sm text-black rounded-lg bg-purple-500 dark:bg-pink-100 dark:text-black" role="alert">
  <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
  </svg>
  <span class="sr-only">Info</span>
  <div>
    <span class="font-medium">Info alert!</span> No cuenta con registros de familias registradas
  </div>
</div>
@endif
</x-admin-layout>
