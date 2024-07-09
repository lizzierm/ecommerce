<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Spatie\Permission\Models\Role;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Elimina y crea el directorio 'products'
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        // Crear rol 'Administrador'
        
        //  PRIMERO EJECUTAMOS SIN ROL, DESPUES DE EJECUTAR Y CREAR EL ROL, SEGUIMOS A EJECUATR
        // Crear usuario
       

        // Llamar a otros seeders
        $this->call([

            FamilySeeder::class,
            OptionSeeder::class,
            RolePermissionsSeeder::class,
            UserSeeder::class,
        ]);

        // Crear productos
        // Product::factory(1)->create();
        
    }
}
