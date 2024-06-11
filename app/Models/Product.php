<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'sku',
      'name',
      'description',
      'image_path',
      'price',
      'stock',
      'subcategory_id',
  ];
  public function scopeVerifyFamily($query, $family_id){
    $query->when($family_id, function($query,$family_id){
      $query->whereHas('subcategory.category', function($query) use ($family_id){
          $query->where('family_id', $family_id);
      });
    });
  }

  public function scopeVerifyCategory($query, $category_id){
    $query->when($category_id, function($query, $category_id){
      $query->whereHas('subcategory', function($query) use ($category_id){
          $query->where('category_id', $category_id);
      });
    });
  }

  public function scopeVerifySubcategory($query, $subcategory_id){
      $query->when($subcategory_id, function($query, $subcategory_id){
        $query->where('subcategory_id', $subcategory_id);
    });
  }
  public function scopeCustomOrder($query, $orderBy){
    $query-> when($orderBy==1, function($query){
      $query->orderBy('created_at', 'desc');
    }) 

    ->when($orderBy==2, function($query){
      $query->orderBy('price', 'desc');
    }) 

    ->when($orderBy==3, function($query){
      $query->orderBy('price', 'asc');
    });
  }

  public function scopeSelectFeatures($query, $selected_features){
    $query->when($selected_features, function($query, $selected_features){
      $query->whereHas('variants.features', function($query) use ($selected_features){
          $query->whereIn('features.id', $selected_features);

      });
  });
  }
 
      public function getImageAttribute(): string
      {
          return Storage::url($this->image_path);
      }


    //RELACION UNO A MUCHOS INVERSA
      public function subcategory(){
        return $this-> belongsTo(Subcategory::class);
            }

            //RELACION UNO A MUCHOS 
      public function variants(){
        return $this-> hasMany(Variant::class);
            }

            //RELACION muchos a muchos->
      public function Options(){
        return $this-> belongsToMany(Option::class)
                ->using(OptionProduct::class)
                ->withPivot('features')
                ->withTimestamps();
            }//solo existe dos campos belonstomany

}

