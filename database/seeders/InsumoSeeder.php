<?php

namespace Database\Seeders;

use App\Models\Insumo;
use Illuminate\Database\Seeder;

class InsumoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insumos = [
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Pera',
                'activo' => true,
                'cantidad_disponible' => 100,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 3000,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Papaya',
                'activo' => true,
                'cantidad_disponible' => 100,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 4000,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Manzana',
                'activo' => true,
                'cantidad_disponible' => 100,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 3500,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Maracuya',
                'activo' => true,
                'cantidad_disponible' => 100,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 4000,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Durazno',
                'activo' => true,
                'cantidad_disponible' => 100,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 3500,
            ],
        ];

        foreach ($insumos as $insumoData) {
            Insumo::create($insumoData);
        }
    }
}