<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

class RoleController extends Controller
{
    public function index()
    {
       
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::all();
       
        return view('admin.roles.create', compact('permissions'));
        
    }
  

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);
         // Creación del rol
        $role = Role::create($request->all());
        // Asignación de permisos
        $role->permissions()->sync($request->permissions);
        // Redireccionar con mensaje de éxito
        return redirect()->route('admin.roles.index', $role)->with('inf', 'Rol creado exitosamente.');
    }
        
    public function show(Role $role){
        return view('admin.roles.show', compact('role'));

    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));

    }

    public function update(Request $request, Role $role) //actualziar rol
    {
       $request->validate([
        'name' => 'required'
       ]);
       $role->update($request->all());
       $role->permissions()->sync($request->permissions);
       return redirect()->route('admin.roles.index', $role)->with('info', 'El rol se actualizo correctamente');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')
                        ->with('success', 'Role deleted successfully.');
    }


}
