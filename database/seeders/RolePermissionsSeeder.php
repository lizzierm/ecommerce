<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Vendedor']);
        

        Permission::create(['name' => 'admin.dashboard',
                    'description' =>'Ver panel administrador'])->syncRoles([$role1, $role2]);
        //PERMISOS PARA USUARIOS
        Permission::create(['name' => 'admin.users.index',
                    'description' =>'ver usuarios'])->syncRoles([$role1, ]);
        Permission::create(['name' => 'admin.users.create',
                    'description' =>'crear usuarios'])->syncRoles([$role1, ]);
        Permission::create(['name' => 'admin.users.edit',
                    'description' =>'editar usuarios'])->syncRoles([$role1, ]);
        Permission::create(['name' => 'admin.users.destroy',
                    'description' =>'eliminar usuarios'])->syncRoles([$role1, ]);
        //PERMISOS PARA ROLES
        Permission::create(['name' => 'admin.roles.index',
                    'description' =>'ver roles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.roles.create',
                    'description' =>'crear roles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.roles.edit',
                    'description' =>'editar roles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.roles.destroy',
                    'description' =>'eliminar roles'])->syncRoles([$role1, $role2]);
         //PERMISOS PARA OPCIONES
        Permission::create(['name' => 'admin.options.index',
                    'description' =>'ver opciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.options.create',
                    'description' =>'crear opciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.options.edit',
                    'description' =>'editar opciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.options.destroy',
                    'description' =>'eliminar opciones'])->syncRoles([$role1, $role2]);
        //PERMISOS PARA FAMILIAS
        Permission::create(['name' => 'admin.families.index',
                    'description' =>'ver familias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.families.create',
                    'description' =>'crear familias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.families.edit',
                    'description' =>'editar familias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.families.destroy',
                    'description' =>'eliminar familias'])->syncRoles([$role1, $role2]);
        //PERMISOS PARA CATEGORIAS
        Permission::create(['name' => 'admin.categories.index',
                    'description' =>'ver categorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.create',
                    'description' =>'crear categorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.edit',
                    'description' =>'editar categorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.destroy',
                    'description' =>'eliminar categorias'])->syncRoles([$role1, $role2]);
        //PERMISOS PARA SUBCATEGORIAS
        Permission::create(['name' => 'admin.subcategories.index',
                    'description' =>'ver subcategorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.subcategories.create',
                    'description' =>'crear subcategorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.subcategories.edit',
                    'description' =>'editar subcategorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.subcategories.destroy',
                    'description' =>'eliminar subcategorias'])->syncRoles([$role1, $role2]);
        //PERMISOS PARA PRODUCTOS
        Permission::create(['name' => 'admin.products.index',
                    'description' =>'ver productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.products.create',
                    'description' =>'crear productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.products.edit',
                     'description' =>'editar productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.products.destroy',
                    'description' =>'eliminar productos'])->syncRoles([$role1, $role2]);
        //PERMISOS PARA PORTADAS
        Permission::create(['name' => 'admin.covers.index',
                    'description' =>'ver portada'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.covers.create',
                    'description' =>'crear portada'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.covers.edit',
                    'description' =>'editar portada'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.covers.destroy',
                    'description' =>'eliminar portada'])->syncRoles([$role1, $role2]);
        //PERMISOS PARA ENVIOS
        Permission::create(['name' => 'admin.orders.index',
                    'description' =>'ver ordenes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.orders.ticket',
                    'description' =>'ver tickets'])->syncRoles([$role1, $role2]);
            
    }
    
}
