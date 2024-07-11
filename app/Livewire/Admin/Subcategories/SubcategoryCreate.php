<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryCreate extends Component
{

    public $families;
    
    public $subcategory = [
        'family_id' => '',
        'category_id' => '',
        'name' => '',
    ];
    // mount metodo para recargar 
    public function mount(){ 
        $this->families = Family::all();
    }

  
    public function updatedSubcategoryFamilyId()
{
    $this->subcategory['category_id'] = null; // Reiniciar category_id
    if (!empty($this->subcategory['family_id'])) {
        $this->subcategory['category_id'] = Category::where('family_id', $this->subcategory['family_id'])->value('id');
    }
}

  
    #[Computed]
    public function categories()
    {
        if (!empty($this->subcategory['family_id'])) {
            return Category::where('family_id', $this->subcategory['family_id'])->get();
        } else {
            return collect(); // Retorna una colección vacía si family_id no está configurado
        }
    }
    

    public function save()
    {
        $this->validate([
            'subcategory.family_id' => 'required|exists:families,id',
            'subcategory.category_id' => 'required|exists:categories,id',
            'subcategory.name' => 'required',
        ], [], [
            'subcategory.family_id' => 'familia',
            'subcategory.category_id' => 'categoria',
            'subcategory.name' => 'nombre'
        ]);

        Subcategory::create([
            'family_id' => $this->subcategory['family_id'],
            'category_id' => $this->subcategory['category_id'],
            'name' => $this->subcategory['name'],
        ]);

        session()->flash('message', '¡La subcategoría se ha creado correctamente!');

        return redirect()->route('admin.subcategories.index');
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }
}
