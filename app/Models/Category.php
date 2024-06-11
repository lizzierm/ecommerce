<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'family_id',
    ];

    //RELACION DE UNO A MUCHOS inversa
    public function family(){
        return $this->belongsTo(Family::class);
    }

    //RELACION UNO A MUCHOS
    public function subcategories(){
        return $this-> hasMany(Subcategory::class);
    }
}
