<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\category;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::orderBy('id', 'desc')
        ->with('family')
        ->paginate(15);


        return view('admin.categories.index', compact(('categories')));
    }

    public function create()
    {
        $families = Family::all();
        return view('admin.categories.create', compact('families'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'family_id' => 'required|exists:families,id',
            'name' => 'required',
        ]);
        Category::create($request->all());

        session()->flash('swal',[
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Categoria creada exitosamente',
        ]);
        return redirect()->route('admin.categories.index');
    }
    public function show(category $category)
    {
        //
    }

    public function edit(category $category)
    {
        $families = Family::all();
       return view('admin.categories.edit', compact('category', 'families'));
    }

    public function update(Request $request, category $category)
    {
        $request->validate([
            'family_id' => 'required|exists:families,id',
            'name' => 'required',
        ]);
        $category->update($request->all());

        session()->flash('swal',[
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Categoria editada exitosamente',
        ]);
        return redirect()->route('admin.categories.edit', $category);

    }

    public function destroy(category $category)
    {
        if($category->subcategories->count()>0){
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se puede eliminar la categoria porque tiene subcategorias aociadas.',
            ]);
            return redirect()->route('admin.categories.edit', $category);
        }
        $category->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Categoria eliminada correctamete.',
        ]);
        return redirect()->route('admin.categories.index');

    }
}