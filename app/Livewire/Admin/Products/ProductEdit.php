<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $product;
    public $productEdit;

    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;

    public function mount($product)
    {
        $this->productEdit = $product->only('sku', 'name', 'description', 'image_path','stock', 'price', 'subcategory_id');
        $this->families = Family::all();
        $this->category_id = $product->subcategory->category->id;
        $this->family_id = $product->subcategory->category->family_id;
    }

    public function updatedFamilyId($value)
    {
        // Reset subcategory_id when family_id changes
        $this->category_id = '';
        $this->productEdit['subcategory_id'] = '';
    }

    public function updatedCategoryId($value)
    {
        // Reset subcategory_id when category_id changes
        $this->productEdit['subcategory_id'] = '';
    }
    #[On('variant-generate')]
    public function updateProduct(){
        $this->product = $this->product->fresh();
    }

    #[Computed()]
    public function categories()
    {
        // Filter categories by selected family_id
        return Category::where('family_id', $this->family_id)->get();
    }

    #[Computed()]
    public function subcategories()
    {
        // Filter subcategories by selected category_id
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    public function store()
    {
        $this->validate([
            'image' => 'nullable|image|max:1024',
            'productEdit.sku' => 'required|unique:products,sku,' . $this->product->id,
            'productEdit.name' => 'required|max:255',
            'productEdit.description' => 'nullable',
            'productEdit.stock' => 'required|numeric|min:0',
            'productEdit.price' => 'required|numeric|min:0',
            'productEdit.subcategory_id' => 'required|exists:subcategories,id',
        ]);

        if ($this->image) {
            Storage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products');
        }

        $this->product->update($this->productEdit);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Producto actualizado exitosamente',
        ]);
    
        return redirect()->route('admin.products.edit', $this->product);

    }

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
