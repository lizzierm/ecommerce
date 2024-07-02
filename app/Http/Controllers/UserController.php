<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{



    public function __construct(){
        // $this->middleware('can:admin.users.index')->only('index');
        // $this->middleware('can:admin.users.create')->only('create','store');
        // $this->middleware('can:admin.users.edit')->only('edit','update');
        // $this->middleware('can:admin.users.destroy')->only('destroy');


    }
    public function index()
    {

        // $this->authorize('admin.users.index');
        $users = User::orderBy('id', 'asc')->paginate(10);
                
        return view('admin.users.index', [
            'users' => $users,
        ]);
        
    }
    

    public function create()
    {
        // $this->authorize('admin.users.create');
        return view('admin.users.create');
        
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            // Agrega más reglas de validación para otros campos si es necesario
        ], [
            'email.unique' => 'El correo electrónico ya está registrado.',
        ]);
    
        try {
            // Crea un nuevo usuario
            User::create($request->all());
    
            // Muestra el mensaje de éxito después de crear el usuario
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Usuario creado',
                'text' => 'El usuario ha sido creado correctamente.',
            ]);
        } catch (\Exception $e) {
            // Si ocurre una excepción (por ejemplo, violación de unicidad), redirecciona de vuelta al formulario con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al crear el usuario. Por favor, inténtalo de nuevo.']);
        }
    
        // Redirecciona a la vista de listado de usuarios
        return redirect()->route('admin.users.index');
    }
    

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
{
    // Validación de los datos
    $request->validate([
        'name' => 'required',
        'document_type' => 'required',
        'document_number' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
    ]);

    // Actualización de los roles del usuario
    $user->roles()->sync($request->roles);

    // Actualización de los datos del usuario
    $user->update([
        'name' => $request->name,
        'document_type' => $request->document_type,
        'document_number' => $request->document_number,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    // Mensaje flash de éxito
    session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Actualizado',
        'text' => 'Usuario actualizado correctamente.',
    ]);

    // Redirección a la lista de usuarios
    return redirect()->route('admin.users.index');
}

        // public function update(Request $request, User $user)
    // {
    //     $user->roles()->sync($request->roles);
    //     $request->validate([
    //         'name' => 'required',
    //     ]);

    //     $user->update($request->all());

    //     session()->flash('swal', [
    //         'icon' => 'success',
    //         'title' => 'Actualizado',
    //         'text' => 'Usuario actualizado correctamente.',
    //     ]);

    //     return redirect()->route('admin.users.index');
    // }

    public function destroy(User $user)
    {
    
        $user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Usuario eliminado correctamente.',
        ]);
        
        return redirect()->route('admin.users.index');
    }
  

}
