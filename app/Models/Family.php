<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    //RELACION DE UNO A MUCHOS -> relacion entre famili y category
    //una familia puede tener muchas categorias, una categoria pertenece a una familia
    public function categories(){
        return $this->hasMany(Category::class); //modelo a relacionar
    }
}
