<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'category_id',
  ];

      //RELACION UNO A MUCHOS inversa
      public function category(){
        return $this-> belongsTo(Category::class);
            }

              //RELACION UNO A MUCHOS
    public function products(){ //llamamos a productos
        return $this-> hasMany(Product::class);//le pasamos el modelo poduct
            }
}
