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
                    'Colección de verano',
                    'Lo mas nuevo',
                ],
                'Ropa de hombre por tipo' => [
                    'Abrigos',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Trajes',
                    'Zapatos',
                ],
                'Accesorios' => [
                    'Billeteras',
                    'Cinturones',
                    'Corbatas',
                    'Gorros',
                    'Gafas',
                    'Guantes',
                    'Mochilas',
                    'Otros',
                    'Relojes',
                    'Sombreros',
                ],
                'Ropa interior y pijamas' => [
                    'Boxers',
                    'Pijamas',
                    'Ropa interior',
                ],
                'Calzado hombre' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
            'Moda Mujer' => [
                'Tendencias y colecciones' => [
                    'Colección de verano',
                    'Lo mas nuevo',
                    'Comodidad',
                    'Colección otoño invierno',
                ],
                'Ropa de mujer por tipo' => [
                    'Abrigos',
                    'Blusas',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Vestidos',
                    'Zapatos',
                ],
                'Accesorios' => [
                    'Billeteras',
                    'Cinturones',
                    'Gorros',
                    'Gafas',
                    'Guantes',
                    'Mochilas',
                    'Otros',
                    'Relojes',
                    'Sombreros',
                ],
                'Ropa interior y pijamas' => [
                    'Pijamas',
                    'Ropa interior',
                ],
                'Calzado mujer' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
            'Moda Infantil' => [
                'Tendencias y colecciones' => [
                    'Colección de verano',
                    'Lo mas nuevo',
                    'Colección otoño invierno',
                ],
                'Ropa de niño por tipo' => [
                    'Abrigos',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Zapatos',
                ],
                'Accesorios' => [
                    'Billeteras',
                    'Cinturones',
                    'Gorros',
                    'Gafas',
                    'Guantes',
                    'Mochilas',
                    'Otros',
                    'Relojes',
                    'Sombreros',
                ],
                'Ropa interior y pijamas' => [
                    'Boxers',
                    'Pijamas',
                    'Ropa interior',
                ],
                'Calzado niño' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
                'Ropa de niña por tipo' => [
                    'Abrigos',
                    'Blusas',
                    'Camisas',
                    'Camisetas',
                    'Jeans',
                    'Pantalones',
                    'Polos',
                    'Ropa interior',
                    'Shorts',
                    'Vestidos',
                    'Zapatos',
                ],
                'Calzado niña' => [
                    'Botas',
                    'Casuales',
                    'Formales',
                    'Otros',
                    'Sandalias',
                    'Zapatillas',
                ],
            ],
            // 'Belleza' => [
            //     'Cuidado capilar' => [
            //         'Acondicionadores',
            //         'Cepillos',
            //         'Cremas para peinar',
            //         'Otros',
            //         'Shampoo',
            //         'Tintes',
            //     ],
            //     'Cuidado corporal' => [
            //         'Cremas corporales',
            //         'Cremas de manos',
            //         'Cremas de pies',
            //         'Cuidado de uñas',
            //         'Desodorantes',
            //         'Exfoliantes',
            //         'Otros',
            //     ],
            //     'Dermocosmética' => [
            //         'Cremas antiarrugas',
            //         'Cremas antimanchas',
            //         'Cremas hidratantes',
            //         'Cremas nutritivas',
            //         'Cremas reafirmantes',
            //         'Cremas reductoras',
            //         'Otros',
            //     ],
            //     'Electro belleza' => [
            //         'Cepillos alisadores',
            //         'Cepillos faciales',
            //         'Cortadoras de cabello',
            //         'Depiladoras',
            //         'Otros',
            //         'Planchas',
            //         'Rizadores',
            //         'Secadoras',
            //     ],
            //     'Maquillaje' => [
            //         'Bases',
            //         'Brochas',
            //         'Correctores',
            //         'Delineadores',
            //         'Labiales',
            //         'Otros',
            //         'Polvos',
            //         'Sombras',
            //     ],
            //     'Masaje y spa' => [
            //         'Aceites',
            //         'Cremas',
            //         'Otros',
            //     ],
            //     'Perfumes' => [
            //         'Femeninos',
            //         'Masculinos',
            //         'Otros',
            //     ],
            //     'Tratamientos faciales' => [
            //         'Cremas antiarrugas',
            //         'Cremas antimanchas',
            //         'Cremas hidratantes',
            //         'Cremas nutritivas',
            //         'Cremas reafirmantes',
            //         'Cremas reductoras',
            //         'Otros',
            //     ],
            //     'pack regalo' => [
            //         'Cuidado capilar',
            //         'Cuidado corporal',
            //         'Dermocosmética',
            //         'Electro belleza',
            //         'Maquillaje',
            //         'Masaje y spa',
            //         'Perfumes',
            //         'Tratamientos faciales',
            //     ],
            // ],
        
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


