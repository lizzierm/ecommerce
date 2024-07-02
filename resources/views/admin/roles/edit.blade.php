<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Roles',
        'route' => route('admin.roles.index'),
    ],
    [
        'name' => 'Editar Rol',
    ]
]">
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')

                <h2 class="text-2xl font-semibold mb-4 text-center">Editar Rol</h2>

                <div class="form-group mb-4">
                    <label for="name" class="block text-gray-900 text-xl font-semibold mb-2">Nombre del Rol</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el nombre del rol" value="{{ old('name', $role->name) }}">
                </div>
                

                <h2 class="h3 mb-4" style="font-weight: bold;">Lista de Permisos</h2>
                <div class="grid grid-cols-4 gap-2">
                    @foreach ($permissions as $permission)
                    <div>
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-1" {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                            {{ $permission->description }}
                        </label>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-pink mt-4">Actualizar Rol</button>
            </form>
        </div>
    </div>
</x-admin-layout>
