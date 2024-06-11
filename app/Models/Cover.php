<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cover extends Model
{
    use HasFactory;

    protected $fillable =[
        'image_path',
        'title',
        'start_at',
        'end_at',
        'is_active',
    ];
    protected $casts =[
        'start_at'=>'datetime',
        'end_at'=>'datetime',
        'is_active'=>'boolean',
    ];
    public function getImageAttribute()
    {
        return Storage::url($this->image_path);
    }
    // protected function image():Attribute
    // {

    //         return Attribute::make(
    //             get:fn() => Storage::url($this->image_path),
    // );
    // }
}
