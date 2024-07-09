<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $families = [
           
            'Moda Hombre' => [
                'Tendencias y colecciones' => [ 
                    'Lo mas nuevo',
                ],
                'Ropa de hombre por tipo' => [
                    'Abrigos',
                    'Camisas',                
                    'Jeans',
                    'Polos',
                    'Shorts',
                    'Trajes',
                ],
               
                'Ropa interior y pijamas' => [
                    'Boxers',
                    'Pijamas',
                ],
                'Calzado hombre' => [
                    'Casuales',
                    'Formales',
                ],
            ],
            'Moda Mujer' => [
                'Tendencias y colecciones' => [
                    'Lo mas nuevo',    
                ],
                'Ropa de mujer por tipo' => [
                    'Abrigos',
                    'Blusas',
                    'Camisas',
                    'Jeans',
                    'Polos',
                    'Shorts',
                    'Vestidos',
                ],
                
                'Ropa interior y pijamas' => [
                    'Pijamas',
                    'Ropa interior',
                ],
                'Calzado mujer' => [
                    'Botas',
                    'Casuales',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
            'Moda Infantil' => [
                'Tendencias y colecciones' => [
                    'Lo mas nuevo',
                ],
                'Ropa de niño por tipo' => [
                    'Abrigos',
                    'Camisas',
                    'Jeans',
                    'Polos',
                    'Shorts',
                ],
                
                'Ropa interior y pijamas' => [
                    'Boxers',
                    'Pijamas',
                ],
                'Calzado niño' => [
                    'Tenis',
                    'Zapatillas',
                ],
                'Ropa de niña por tipo' => [
                    'Abrigos',
                    'Blusas',
                    'Camisas',
                    'Jeans',
                    'Polos',
                    'Shorts',
                    'Vestidos',
                ],
                'Calzado niña' => [
                    'Botas',
                    'Casuales',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
           
        ];
        //la llave representa la familia
        foreach ($families as $family => $categories){
            $family = Family::create([
                'name' => $family
            ]);
        
            foreach ($categories as $category => $subcategories){
                $categoryModel = Category::create([
                    'name' => $category,
                    'family_id' => $family->id,
                ]);
        
                foreach ($subcategories as $subcategory){
                    Subcategory::create([
                        'name' => $subcategory,
                        'category_id' => $categoryModel->id,
                    ]);
                }
            }
        }
        
       
    }
}


