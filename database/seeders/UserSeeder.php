<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creación de usuarios con asignación de roles
        $user = User::create([
            'name' => 'Lizzie',
            'last_name' => 'Rojas',
            'document_type' => '1',
            'document_number' => '7961579',
            'email' => 'rojaslizzie14@gmail.com',
            'phone' => '69283498',
            'password' => bcrypt('12345678')
        ])->assignRole('Administrador');

        $user = User::create([
            'name' => 'Daniela',
            'last_name' => 'Rojas', // Ejemplo: John Doe
            'document_type' => '1',
            'document_number' => '1234567',
            'email' => 'daniela@example.com',
            'phone' => '987654321',
            'password' => bcrypt('12345678')
        ]);

        $user = User::create([
            'name' => 'Elias',
            'last_name' => 'Soruco',
            'document_type' => '2',
            'document_number' => '9876543',
            'email' => 'admin@example.com',
            'phone' => '123456789',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678')
        ]);

        $user = User::create([
            'name' => 'Robert',
            'last_name' => 'Johnson',
            'document_type' => '3',
            'document_number' => '456890',
            'email' => 'robert@example.com',
            'phone' => '987654321',
            'profile_photo_path' => 'profiles/robert.jpg',
            'password' => bcrypt('password123')
        ]);

        $user = User::create([
            'name' => 'Emma',
            'last_name' => 'Davis',
            'document_type' => '1',
            'document_number' => '45689100', // Ejemplo: usuario sin número de documento
            'email' => 'emma@example.com',
            'phone' => '987654321',
            'password' => bcrypt('password123')
        ]);

        $user = User::create([
            'name' => 'Michael',
            'last_name' => 'Brown',
            'document_type' => '4',
            'document_number' => '12323',
            'email' => 'michael@example.com',
            'phone' => '987654321',
            'password' => bcrypt('password123')
        ]);
        $user = User::create([
            'name' => 'Mijael',
            'last_name' => 'Brown',
            'document_type' => '4',
            'document_number' => '12123',
            'email' => 'mijael@example.com',
            'phone' => '987654321',
            'password' => bcrypt('password123')
        ]);
        $user = User::create([
            'name' => 'Alexis',
            'last_name' => 'Soliz',
            'document_type' => '4',
            'document_number' => '121143',
            'email' => 'alex@example.com',
            'phone' => '987654321',
            'password' => bcrypt('password123')
        ]);

        $user = User::create([
            'name' => 'Liliana',
            'last_name' => 'Garcia',
            'document_type' => '1',
            'document_number' => '10893',
            'email' => 'alexYliliana@example.com',
            'phone' => '987654321',
            'password' => bcrypt('password123')
        ]);
        $user = User::create([
            'name' => 'Edit',
            'last_name' => 'Garcia',
            'document_type' => '1',
            'document_number' => '10113',
            'email' => 'Leydy@example.com',
            'phone' => '987654321',
            'password' => bcrypt('password123')
            
        ]);

    }
}

