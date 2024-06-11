@php
$links = [
    //dashboard
    [
    'icon' => 'fa-solid fa-hands-holding-circle',
    'name' => 'Dashboard',
    'route' => route('admin.dashboard'),
    'active' => request()->routeIs('admin.dashboard'),
    ],
    [//usuarios
    'icon' => 'fa-solid fa-users',
    'name' => 'Usuarios',
    'route' => route('admin.users.index'), // Ajustar la ruta a 'admin.users.index'
    'active' => request()->routeIs('admin.users.*'), // Ajustar la verificación de ruta a 'admin.users.*'
    ],
    [
    'icon' => 'fa-solid fa-user-tie',
    'name' => 'Roles',
    'route' => route('admin.dashboard'),
    'active' => request()->routeIs('admin.dashboard'),
    ],
    [//Opciones
    'icon' => 'fa-solid fa-gear' ,
    'name' => 'Opciones',
    'route' => route('admin.options.index'),
    'active' => request()->routeIs('admin.options.*'),
    ],
    [//familia de productos
    'icon' => 'fa-solid fa-people-roof',
    'name' => 'Familias',
    'route' => route('admin.families.index'),
    'active' => request()->routeIs('admin.families.*'),
    ],
    [//Categorias
    'icon' => 'fa-solid fa-list' ,
    'name' => 'Categorias',
    'route' => route('admin.categories.index'),
    'active' => request()->routeIs('admin.categories.*'),
    ],
    [//Subcategorias
    'icon' => 'fa-solid fa-sitemap' ,
    'name' => 'Subcategorias',
    'route' => route('admin.subcategories.index'),
    'active' => request()->routeIs('admin.subcategories.*'),
    ],
    [//Products
    'icon' => 'fa-solid fa-gifts' ,
    'name' => 'Productos',
    'route' => route('admin.products.index'),
    'active' => request()->routeIs('admin.products.*'),
    ],
    [//Covers
    'icon' => 'fa-solid fa-images' ,
    'name' => 'Portadas',
    'route' => route('admin.covers.index'),
    'active' => request()->routeIs('admin.covers.*'),
    ]
];
@endphp
{{-- aqui esta el pedaso que falto del sidebar --}}
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-purple-400"
    :class="{
        'translate-x-0 ease-put': sidebarOpen, //ase que se abra el sidebar
        '-translate-x-full ease-in': !sidebarOpen,//ase que se sierre el sidebar
       }" aria-label="Sidebar">
{{-- //-----------formato del silderbar----------AZUL --}}
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-purple-400">
        <ul class="space-y-2 font-medium">

            @foreach ($links as $link)

                <li>
                    {{-- aqui editaremos el color de nuestra plantilla --}}
                    <a href="{{ $link['route'] }}"
                    class="flex items-center p-2 text-gray-800 rounded-lg dark:text-black hover:bg-gray-100 dark:hover:bg-gray-100 group {{ $link['active'] ? 'bg-green-100' : '' }}"

                        <span class="inline-flex w-6 h-6 justify-items-center items-center">
                        <i class="{{$link['icon']}}"></i>
                        </span>
                            <span class="ms-2">
                                {{$link['name']}}
                            </span>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</aside>