<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(seederTablaPermisos::class);
        $this->call(UserSeeder::class);
        $this->call(InsumoSeeder::class);
        $this->call(ProductoSeeder::class);
    }
    //php artisan db:seed
}
