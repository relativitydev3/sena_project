<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

               // Crea un usuario administrador


          // Crear el usuario administrador
          $admin = User::create([
            'name' => 'caja',
            'apellidos' => 'caja',
            'email' => 'caja@gmail.com',
            'password' => bcrypt('caja')
        ]);

        // Asignar el rol cliente al usuario
        $admin->assignRole('cliente');

        // Obtener todos los permisos
        $permissions = Permission::pluck('id')->all();

        // Asignar todos los permisos al rol administrador
        $admin->syncPermissions($permissions);



    }
}
