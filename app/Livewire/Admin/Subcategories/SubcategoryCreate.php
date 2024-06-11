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

    public function updatedSubcategoryFamilyId(){
       
        $this->subcategory['category_id']='';
    } //mantente a la escuha de alguna propiedad
    #[Computed()]
    public function categories(){
        return Category::where('family_id', $this->subcategory['family_id'])->get();
    }
    public function save(){
        // dd($this->subcategory);
        $this->validate([
            'subcategory.family_id' => 'required|exists:families,id',
            'subcategory.category_id' => 'required|exists:categories,id',
            'subcategory.name' => 'required',
        ],[],[
            'subcategory.family_id' => 'familia',
            'subcategory.category_id' =>'categoria',
            'subcategory.name' => 'nombre'

        ]);
        Subcategory::create($this->subcategory);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Subcategoria creada exitosamente',
        ]);
        return redirect()->route('admin.subcategories.index');
    }
    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }
}
