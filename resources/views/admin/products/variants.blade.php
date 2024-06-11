{{-- //CONTENIDO    VARIANTS --}}
<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index'),
    ],
    [
        'name' => $product->name,
        'route' => route('admin.products.edit', $product),   
    ],
    [
        'name' => $variant->features->pluck('description')->implode(', '),     
    ]
]">
    {{-- <form action="{{ route('products.variantsUpdate', [$product, $variant]) }}" method="POST"> --}}
        <form action="{{ route('admin.products.variantsUpdate', [$product, $variant]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <x-validation-errors class="mb-4" />
        
            <div class="relative mb-6">
                <figure>
                    <img class="aspect-[1/1] w-full object-cover object-center" src="{{ $variant->image }}" alt="" id="imgPreview">
                </figure>
        
                <div class="absolute top-8 right-14">
                    <label class="flex items-center bg-yellow-200 px-4 py-2 rounded-lg cursor-pointer">
                        <i class="fas fa-camera mr-2"></i>
                        Actualizar imagen
                        <input type="file" class="hidden" accept="image/*" name="image" onchange="previewImage(event, '#imgPreview')">
                    </label>
                </div>
            </div>
        
            <div class="card">
                <div class="mb-4">
                    <x-label class="mb-1">
                        Codigo (SKU)
                    </x-label>
        
                    <x-input name="sku" value="{{ old('sku', $variant->sku) }}" placeholder="Ingrese el codigo (SKU)" class="w-full" />
                </div>
            </div>
        
            <div class="card">
                <div class="mb-4">
                    <x-label class="mb-1">
                        Stock
                    </x-label>
        
                    <x-input name="stock" value="{{ old('sku', $variant->stock) }}" placeholder="Ingrese el stock del producto" class="w-full" />
                </div>
        
             
                <div class="flex justify-end">
                        {{-- Actualizar --}}
                    <x-button>
                        <i class="fa-solid fa-floppy-disk"></i>
                    
                    </x-button>

                    <a class="btn btn-green rounded-full ml-2" href="{{ route('admin.products.edit', $product) }}">
                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                    </a>
                    
                </div>
            </div>
        </form>
        
        @push('js')
            <script>
                function previewImage(event, querySelector) {
                    const input = event.target;
                    const $imgPreview = document.querySelector(querySelector);
                    
                    if (!input.files.length) return;
                    
                    const file = input.files[0];
                    const objectURL = URL.createObjectURL(file);
                    
                    $imgPreview.src = objectURL;
                }
            </script>
        @endpush
        
</x-admin-layout>
