<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Producto de ejemplo1',
            'descripcion' => 'Descripción del producto de ejemplo1',
            'precio' => 19.99,
            'stock' => 40,
            'categoria_id' => 1, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo2',
            'descripcion' => 'Descripción del producto de ejemplo2',
            'precio' => 19.99,
            'stock' => 50,
            'categoria_id' => 1, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo3',
            'descripcion' => 'Descripción del producto de ejemplo3',
            'precio' => 9.99,
            'stock' => 20,
            'categoria_id' => 2, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo4',
            'descripcion' => 'Descripción del producto de ejemplo4',
            'precio' => 88.99,
            'stock' => 16,
            'categoria_id' => 2, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo5',
            'descripcion' => 'Descripción del producto de ejemplo5',
            'precio' => 29.99,
            'stock' => 50,
            'categoria_id' => 3, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo6',
            'descripcion' => 'Descripción del producto de ejemplo6',
            'precio' => 9.99,
            'stock' => 200,
            'categoria_id' => 4, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo6',
            'descripcion' => 'Descripción del producto de ejemplo6',
            'precio' => 19.99,
            'stock' => 40,
            'categoria_id' => 4, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo7',
            'descripcion' => 'Descripción del producto de ejemplo7',
            'precio' => 19.99,
            'stock' => 40,
            'categoria_id' => 5, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo8',
            'descripcion' => 'Descripción del producto de ejemplo8',
            'precio' => 19.99,
            'stock' => 50,
            'categoria_id' => 5, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo9',
            'descripcion' => 'Descripción del producto de ejemplo9',
            'precio' => 9.99,
            'stock' => 20,
            'categoria_id' => 6, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo10',
            'descripcion' => 'Descripción del producto de ejemplo10',
            'precio' => 88.99,
            'stock' => 16,
            'categoria_id' => 6, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo11',
            'descripcion' => 'Descripción del producto de ejemplo11',
            'precio' => 22.99,
            'stock' => 50,
            'categoria_id' => 7, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto de ejemplo12',
            'descripcion' => 'Descripción del producto de ejemplo12',
            'precio' => 30.99,
            'stock' => 20,
            'categoria_id' => 7, // Asegúrate de que esta categoría exista
        ]);
    }
}
