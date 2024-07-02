{{-- CONTENIDO Usuarios --}}
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
    @can('admin.users.create')
        <a class="btn btn-yellow rounded-full" href="{{ route('admin.users.create') }}">
            Nuevo
        </a>
    @endcan
</x-slot>

    @can('admin.users.index')
        @livewire('admin.users-index')
    @else
        <div class="alert alert-danger" style="background-color: #dc3545; color: #fff;">
            El usuario no tiene permitido ver este Módulo
        </div>
        @endcan
</x-admin-layout>
