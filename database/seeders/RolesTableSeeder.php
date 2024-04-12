<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;



//spatie

use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Crear el rol de administrador
         $permisos = [
            //tabla roles
            'dashboard',
            'roles',
            'usuarios',
            'clientes',
            'categoria de productos',
            'productos',
            'insumos',
            'pedidos',
            'ventas',
        ];

        
        foreach($permisos as $permiso){
            Permission::create(['name' => $permiso]);
        }

      
        $adminRole = Role::create(['name' => 'administrador']);

        $permissions = [
            'dashboard',
            'roles',
            'usuarios',
            'clientes',
            'categoria de productos',
            'productos',
            'insumos',
            'pedidos',
            'ventas',
        ];
        $adminRole->syncPermissions($permissions);
        
        // Otros roles y asignaciones de permisos si es necesario
        $clientRole = Role::create(['name' => 'cliente']);
    
         // Crear el rol de cliente
         
        //
    }
}
