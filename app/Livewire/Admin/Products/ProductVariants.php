<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use App\Models\Variant;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductVariants extends Component
{   
    public $product;
    public $openModal = false; //true para que este siempre abierto
    public $options;
    public $variant = [
        'option_id' =>'',
        'features' => [
            [
                'id'=>'',
                'value'=>'',
                'description'=>'',
            ],
        ]
    ];
    
    public function mount(){
        
        $this->options = Option::all();
    }
    public function updatedVariantOptionId($value){
        
        $this->variant['features']= [
            [
                'id' => '',
                'value' => '',
                'description' => ''
            ],
        ];
    }

    #[Computed()]
    public function features(){
        return Feature::where('option_id', $this->variant['option_id'])->get();
    }
    public function addFeature(){
        $this->variant['features'][]=[
                'id'=>'',
                'value'=>'',
                'description'=>'',
        ];
    }
    public function feature_change($index){
        // dd($index);
        $feature = Feature::find($this->variant['features'][$index]['id']);

        if($feature){
            $this->variant['features'][$index]['value'] =$feature->value;
            $this->variant['features'][$index]['description'] =$feature->description;

        }
    }
    public function removeFeature($index){
        // dd($index);
        unset($this->variant['features'][$index]);
        $this->variant['features']= array_values($this->variant['features']);
    }
    public function deleteFeature($option_id, $feature_id)
    {
        $this->product->options()->updateExistingPivot($option_id,[
            'features'=> array_filter($this->product->options->find($option_id)->pivot->features, function($feature) use ($feature_id){
                return $feature['id'] != $feature_id;
            })
        ]);
        // refrescac al aliminar para que se vea lo eliminado
        $this->product = $this->product->fresh();
        $this->generarVariantes();

    } 
    public function deleteOption($option_id){

        $this->product->options()->detach($option_id);
        $this->product = $this->product->fresh();
        $this->generarVariantes();
    }
    public function save(){
      
       $this->validate([
            // 'variant.option_id.*' => 'required',
            // 'variant.features.*.id' => 'required',
            'variant.features.*.value' => 'required',
            // 'variant.features.*.description' => 'required',

        ], [], [
            'variant.features.*.value' => 'valor',
  
        ]);

        $this->product->options()->attach($this->variant['option_id'], [
            'features' => $this->variant['features']
        ]);
        $this->product = $this->product->fresh();
        $this->generarVariantes();
        $this->reset(['variant', 'openModal']);
    }

    public function generarVariantes(){
        $features = $this->product->options->pluck('pivot.features');
        $combinaciones = $this-> generarCombinaciones($features);
        
        $this->product->variants()->delete();

        foreach ($combinaciones as $combinacion){

            $variant = Variant::create([
                'product_id'=> $this->product->id,             
            ]);

            $variant->features()->attach($combinacion);
        
        }
        $this->dispatch('variant-generate');
    }
    
    function generarCombinaciones($arrays, $indice = 0, $combinacion = [])
    {
        if ($indice == count($arrays)) {
            return [$combinacion];
        }
    
        $resultado = [];
    
        foreach ($arrays[$indice] as $item) {
            $combinacionesTemporal = $combinacion;
            $combinacionesTemporal[] = $item ['id'];
            $resultado = array_merge($resultado, $this-> generarCombinaciones($arrays, $indice + 1, $combinacionesTemporal));
        }
    
        return $resultado;
    }
    
    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}
