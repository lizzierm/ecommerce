<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
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
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            // Agrega aquí las validaciones para los demás campos si es necesario
        ]);

        $user->update($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Actualizado',
            'text' => 'Usuario actualizado correctamente.',
        ]);

        return redirect()->route('admin.users.index');
    }

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
