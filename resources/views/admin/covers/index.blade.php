{{-- //CONTENIDO COVERS--}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
    ]
]">

    <x-slot name="action">
        <a href="{{route('admin.covers.create')}}" class="btn btn-yellow">
            Nuevo
        </a>
    </x-slot>

    <ul class="space-y-4" id="covers">
        @foreach ($covers as $cover )
            <li class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex cursor-move "
                data-id="{{$cover->id}}">

                <img src="{{$cover->image}}" alt="" class=" w-full lg:w-64 aspect-[3/1] object-cover object-center">

                <div class="p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center space-y-2 lg:space-y-0"> 
                    <div>
                        <h1 class="font-semibold">
                            {{$cover->title}}
                        </h1>

                        <p>
                            @if ($cover->is_active)

                            <span class="bg-green-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-300 dark:text-gray-600">
                                Activo
                            </span>
                                
                            @else
                                <span class="bg-red-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-400 dark:text-gray-600">
                                    Inactivo
                                </span>
                            @endif

                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold">
                            Fecha de inicio
                        </p>
                       
                        <p>
                            {{$cover->start_at->format('d/m/Y')}}
                        </p>
                    </div>

                    <div> 
                        <p class="text-sm font-bold">
                          Fecha de finalización
                        </p>
                    
                        <p>
                            {{$cover->end_at ? $cover->end_at ->format('d/m/Y'): '-'}}
                        </p>
                    </div>

                    <div>
                        <a class="btn btn-pink" href="{{route('admin.covers.edit', $cover)}}">
                            <i class="fa-solid fa-file-pen"></i>
                        </a>
                        
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- por encima pegamos el cdn  --}}
    
    @push('js')
    {{-- por encima pegamos el cdn  --}}
   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var sortable = new Sortable(document.getElementById('covers'), {
                    animation: 150,
                    store: {
                        set: function(sortable) {
                            var sorts = sortable.toArray();
                            axios.post("{{ route('api.sort.covers') }}", {
                                sorts: sorts
                            }).then(function(response) {
                                console.log(response.data);
                            }).catch(function(error) {
                                console.log(error);
                            });
                        }
                    }
                });

                sortable.option("onChoose", function(evt) {
                    evt.item.style.backgroundColor = '#cce4ff'; // Cambia el color de fondo al comenzar a arrastrar
                });

                sortable.option("onUnchoose", function(evt) {
                    evt.item.style.backgroundColor = ''; // Restaura el color de fondo al dejar de arrastrar
                });
            });
        </script>
    @endpush



</x-admin-layout>