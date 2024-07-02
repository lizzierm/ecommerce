{{-- //SE VE EL CONTENIDO DE NUESTRO SITIO WEB -> DENTRO DE LAS LINEAS --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
      //   'route' => route('admin.dashboard'),
    ],
   //  [
   //      'name' => 'Prueba',
       
   //  ]
]">

   <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

      <div class="bg-write rounded-lg shadow-lg p-6">
         <div class="flex items-center">
            <img class="h-12 w-12 object-cover" src="{{ Auth::user()->profile_photo_url }}" 
            alt="{{ Auth::user()->name }}" />

            <div class="ml-4 flex-1">
               <h2 class="text-lg font-semibold">
                  Bienvenido, {{ auth()->user()->name }}
               </h2>
               <frorm action="{{ route('logout') }}" mothod="POST">
                  @csrf
                  <button
                     class="text-sm font-bold text-black hover:text-blue-700 rounded-full border border-green-600 hover:border-green-700 px-4 py-1">
                     Cerrar Sesión 
                  </button>


               </frorm>
            </div>
         </div>
      </div>
      <div class="bg-write rounded-lg shadow-lg p-6 flex items-center justify-center ">
         <h2 class="text-xl font-semibold">
            Bella_Butique 
         </h2>
      </div>
   </div>
</x-admin-layout>