{{-- //CONTENIDO Products --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Ordenes y Envios',
    ]
]">

@livewire('admin.orders.order-table')

</x-admin-layout>