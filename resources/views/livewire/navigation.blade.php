<div x-data="{
    open:false,
}">
    {{-- encabezado --}}
    <header class="bg-purple-400">
        <x-container class="px-4 py-4">
            <div class="flex space-x-8 items-center justify-between">
                {{-- abre el deslizador --}}
                <button class="text-2xl" x-on:click="open = true">
                    {{-- icono de deslizador --}}
                    <i class="fas fa-bars text-white"></i>
                </button>
                <h1 class="text-white">
                    <a href="/" class="inline-flex flex-col items-end">
                        <span class="text-xl md:text-3xl leading-4 md:leading-6 font-semibold">
                            Bella_Butique
                        </span>
                        <span>
                            Tienda Online
                        </span>
                    </a>
                </h1>
                {{-- Buscador --}}
                <div class="flex-1 hidden md:block">

                    <x-input oninput="search(this.value)" class="w-full " placeholder="Buscar.... " />
                </div>

                <div class="flex items-center space-x-4 md:space-x-8 ">

                    {{-- <x-dropdown contentClasses="py-1 bg-white !important dark:bg-gray-700">

                        <x-slot name="trigger">
                            <button class="text-xl md:text-3xl">
                                icono de usuario
                                <i class="fas fa-user text-white"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2">

                                <div class="flex justify-center">
                                    <a href="{{route('login')}}" class="btn btn-purple">
                                        Iniciar Sección
                                    </a>
                                </div>

                                <p class="text-sm text-center  mt-2">
                                    ¿No tienes cuenta? <a href="{{route('register')}}"
                                        class="text-purple-600 hover:underline">Registrate</a>
                                </p>
                            </div>
                        </x-slot>

                    </x-dropdown> --}}

                    <x-dropdown contentClasses="py-1 bg-white !important dark:bg-gray-700">

                        <x-slot name="trigger">

                            @auth
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <button class="text-xl md:text-3xl">
                                {{-- icono de usuario --}}
                                <i class="fas fa-user text-white"></i>
                            </button>
                            @endauth

                        </x-slot>

                        <x-slot name="content">
                            @guest
                            <div class="px-4 py-2">
                                <div class="flex justify-center">
                                    <a href="{{ route('login') }}" class="btn btn-purple">
                                        Iniciar Sesión
                                    </a>
                                </div>

                                <p class="text-sm text-center mt-2">
                                    ¿No tienes cuenta? <a href="{{ route('register') }}"
                                        class="text-purple-600 hover:underline">Regístrate</a>
                                </p>
                            </div>
                            @else
                            <x-dropdown-link href="{{route('profile.show')}}">
                                Mi perfil
                            </x-dropdown-link>


                            <div class="border-t border-gray-200">
                            </div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                            @endguest

                        </x-slot>
                    </x-dropdown>

                    <a href="{{route('cart.index')}}" class="relative">
                        {{-- icono de carrito --}}
                        <i class="fas fa-shopping-cart text-white text-xl md:text-3xl"></i>

                        <span 
                            id="cart-count"
                            class="absolute -top-2 -end-4 inline-flex items-center justify-center w-6 h-6 bg-red-500 rounded-full text-xs font-bold text-white ">
                            {{Cart::instance('shopping')->count() }}
                        </span>
                    </a>
                </div>
            </div>
            {{-- Vista movil buscar --}}
            <div class="mt-4 md:hidden">
                <x-input oninput="search(this.value)" class="w-full " placeholder="Buscar.... " />
            </div>
        </x-container>
    </header>

    {{-- la parte negra de nuestra vista --}}
    <div x-show="open" x-on:click="open=false" style="display: none"
        class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10"> </div>

    {{-- menu --}}
    <div x-show="open" style="display: none" class="fixed top-0 left-0 z-20 ">
        <div class="flex">
            <div class=" w-screen sm:w-80 h-screen bg-white ">
                <div class="bg-purple-400 px-4 py-3 text-white font-semibol">

                    <div class="flex justify-between items-center">
                        <span class="text-lg">
                            Bella_Butique_
                        </span>
                        <button x-on:click="open=false">
                            {{-- buton de cerrar --}}
                            <i class="fa-regular fa-circle-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="h-[calc(100vh - 52px)] overflow-auto">
                    <ul>
                        @foreach ($families as $family)
                        <li wire:mouseover="$set('family_id', {{$family->id}})">
                            <a href="{{route('families.show', $family)}}"
                                class=" flex items-center justify-between px-4 py-4 text-gray-700 hover:bg-purple-200">
                                {{$family->name}}
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class=" w-80 xl:w-[57rem] pt-[52px] hidden md:block">
                <div class="bg-white h-[calc(100vh-52px)] overflow-auto px-6 py-8">

                    <div class="mb-8 flex items-center">
                        <p class="border-b-[3px] border-lime-400 uppercase text-xl font-semibold pb-1">
                            {{$this->familyName}}
                        </p>
                        <a href="{{route('families.show', $family_id)}}" class="btn btn-purple ml-auto">
                            Ver todo
                        </a>
                    </div>


                    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        @foreach ($this->categories as $category)
                        <li>
                            <a href="{{route('categories.show', $category)}}" class="text-purple-600 font-semibold text-lg">
                                {{$category->name}}
                            </a>

                            <ul class="mt-4 space-y-2">
                                @foreach ($category->subcategories as $subcategory)
                                <li>
                                    <a href="{{route('subcategories.show', $subcategory)}}" class="text-sm text-gray-700 hover:text-purple-600 ">
                                        {{$subcategory->name}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>

                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

    @push('js')

        <script>

            Livewire.on('cartUpdated', (count) => {
                document.getElementById('cart-count').innerText = count;
            });

            // se comunicara con el otro componente
            function search(value){
                    Livewire.dispatch('search', {
                        search: value
                    })
                }
            // function search(value){
            //   alert(value);
            // }
        </script>
    @endpush

</div>