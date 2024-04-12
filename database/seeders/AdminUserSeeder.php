<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear el usuario administrador
        $admin = User::create([
            'name' => 'Juan',
            'apellidos' => 'ceballos',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);

        // Asignar el rol administrador al usuario
        $admin->assignRole('administrador');

        // Obtener todos los permisos
        $permissions = Permission::pluck('id')->all();

        // Asignar todos los permisos al rol administrador
        $admin->syncPermissions($permissions);


       

    

        
    }
}