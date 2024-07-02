<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Roles',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Crear Rol',
    ]
]">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4 text-center" style="font-weight: bold;">Crear Nuevo Rol</h2>
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="h3 mb-4" style="font-weight: bold; text-gray-900">Nombre del Rol</label>
                    <input type="text" name="name" id="name" class="form-input mt-1 block w-full" placeholder="Ingrese el nombre del nuevo rol" required>

                    @error('name')
                        <small class="text-danger">
                            {{$message}}
                        </small>
                    @enderror
                </div>

                <h2 class="h3 mb-4" style="font-weight: bold;">Lista de Permisos</h2>
               
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($permissions as $permission)
                        <div>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-1">
                            <span>{{ $permission->description }}</span>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-pink ">Crear Rol</button>
            </form>
        </div>
    </div>
</x-admin-layout>
   {{-- <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store'])!!}
                
            <div class="form-group">
                    {!! Form::label('name', 'nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}
                    
                </div>

                <h2 class="h3">Lista de permisos</h2>
                    @foreach ($permissions as $permission )
                        <div>
                            <label>
                                {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                                {{$permission->description}}
                            </label>
                        </div>
                    @endforeach

                {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary'])!!}
            {!! Form::close() !!}
        </div>
   </div> --}}

