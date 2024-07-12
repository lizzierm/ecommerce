<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;
    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'subcategory_id' => '',
    ];

    public function mount()
    {
        $this->families = Family::all();
    }

    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->product['subcategory_id'] = '';
    }

    public function updatedCategoryId($value)
    {
        $this->product['subcategory_id'] = '';
    }

    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }

    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    public function store()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.description' => 'nullable',
            'product.price' => 'required|numeric|min:0',
            'product.subcategory_id' => 'required|exists:subcategories,id',
        ]);

        if ($this->image) {
            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('products', $imageName, 'public');
            $this->product['image_path'] = 'products/' . $imageName;
        }

        $product = Product::create($this->product);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Producto creado exitosamente',
        ]);

        return redirect()->route('admin.products.edit', $product);
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
