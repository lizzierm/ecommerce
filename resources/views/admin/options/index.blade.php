<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Opciones',
    ],
]">
    @can('admin.options.index')
        @livewire('admin.options.manage-options')
    @else
        <div class="alert alert-danger" style="background-color: #dc3545; color: #fff;">
            El usuario no tiene permitido ver este módulo opciones.
        </div>
    @endcan
</x-admin-layout>
