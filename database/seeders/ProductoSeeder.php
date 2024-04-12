<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Insumo;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = [
            [
                'imagen' => 'img/IMGWelcome/JugoKiwi.png',
                'nombre' => 'Jugo de Durazno',
                'precio' => 7000,
                'descripcion' => 'Verdes',
                'activo' => true,
                'categorias_id' => 1,
            ],
            [
                'imagen' => 'img/IMGWelcome/JugoManzana.png',
                'nombre' => 'Jugo de Manzana',
                'precio' => 8000,
                'descripcion' => 'Frutas',
                'activo' => true,
                'categorias_id' => 2,
            ],
            // [
            //     'imagen' => 'img/IMGWelcome/CategoriaFrutas.png',
            //     'nombre' => 'Guayaba con mango',
            //     'precio' => 9000,
            //     'descripcion' => 'Personalizado',
            //     'activo' => true,
            //     'categorias_id' => 3,
            // ],
            [
                'imagen' => 'img/IMGWelcome/JugoMaracuya.png',
                'nombre' => 'Jugo de Maracuya',
                'precio' => 8000,
                'descripcion' => 'Frutas',
                'activo' => true,
                'categorias_id' => 1,
            ],
            [
                'imagen' => 'img/IMGWelcome/JugoPapaya.png',
                'nombre' => 'Jugo de papaya',
                'precio' => 9000,
                'descripcion' => 'Frutas',
                'activo' => true,
                'categorias_id' => 2,
            ],
            [
                'imagen' => 'img/IMGWelcome/JugoPera.png',
                'nombre' => 'Jugo de Pera',
                'precio' => 8000,
                'descripcion' => 'Verdes',
                'activo' => true,
                'categorias_id' => 2,
            ],
        ];

        // Arreglo de nombres de insumos por producto
        $insumosPorProducto = [
            'Jugo de Durazno' => ['Durazno'],
            'Jugo de Manzana' => ['Manzana'],
            // 'Guayaba con mango' => ['Maracuya', 'Fresa'],
            'Jugo de Maracuya' => ['Maracuya'],
            'Jugo de papaya' => ['Papaya'],
            'Jugo de Pera' => ['Pera'],
        ];
        
        foreach ($productos as $productoData) {
            $insumoNombres = $insumosPorProducto[$productoData['nombre']];
            $productoDataWithoutInsumos = $productoData; // Hacemos una copia para eliminar el campo 'insumos'
            unset($productoDataWithoutInsumos['insumos']);

            $producto = Producto::create($productoDataWithoutInsumos);

            // Buscar los insumos por nombre y adjuntarlos al producto
            foreach ($insumoNombres as $nombre) {
                $insumo = Insumo::where('nombre', $nombre)->first();
                if ($insumo) {
                    $producto->insumos()->attach($insumo);
                }
            }
        }
    }
}
