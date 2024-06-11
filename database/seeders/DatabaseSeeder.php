<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products'); //elimina el directorio
        Storage::makeDirectory('products'); //crea el directorio
            // crear usuario
            \App\Models\User::factory()->create([
               'name' => 'Lizzie',
               'last_name' => 'Rojas',
               'document_type' => '1',
               'document_number' => '7961579',
               'email' => 'admin@gmail.com',
               'phone' => '69283498',
               'password' => bcrypt ('12345678')
            ]) ;
        //para ejecutar un seeder -> php artisan db:seed
        //refrescar - borrar y volver a ejecutar -> php artisan migrate:fresh --seed
            $this->call([
                FamilySeeder::class,
                
                OptionSeeder::class,
            ]);
            // ejecutamos un seeder
            Product::factory(1)->create();
    }
}
