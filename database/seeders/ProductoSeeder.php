<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Producto1',
            'descripcion' => 'Descripción del producto de ejemplo1',
            'precio' => 19.99,
            'stock' => 40,
            'categoria_id' => 1, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto2',
            'descripcion' => 'Descripción del producto de ejemplo2',
            'precio' => 19.99,
            'stock' => 50,
            'categoria_id' => 1, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto3',
            'descripcion' => 'Descripción del producto de ejemplo3',
            'precio' => 9.99,
            'stock' => 20,
            'categoria_id' => 2, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto4',
            'descripcion' => 'Descripción del producto de ejemplo4',
            'precio' => 88.99,
            'stock' => 16,
            'categoria_id' => 2, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto5',
            'descripcion' => 'Descripción del producto de ejemplo5',
            'precio' => 29.99,
            'stock' => 50,
            'categoria_id' => 3, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto6',
            'descripcion' => 'Descripción del producto de ejemplo6',
            'precio' => 9.99,
            'stock' => 200,
            'categoria_id' => 4, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto6',
            'descripcion' => 'Descripción del producto de ejemplo6',
            'precio' => 19.99,
            'stock' => 40,
            'categoria_id' => 4, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto7',
            'descripcion' => 'Descripción del producto de ejemplo7',
            'precio' => 19.99,
            'stock' => 40,
            'categoria_id' => 5, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto8',
            'descripcion' => 'Descripción del producto de ejemplo8',
            'precio' => 19.99,
            'stock' => 50,
            'categoria_id' => 5, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto9',
            'descripcion' => 'Descripción del producto de ejemplo9',
            'precio' => 9.99,
            'stock' => 20,
            'categoria_id' => 6, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto10',
            'descripcion' => 'Descripción del producto de ejemplo10',
            'precio' => 88.99,
            'stock' => 16,
            'categoria_id' => 6, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto11',
            'descripcion' => 'Descripción del producto de ejemplo11',
            'precio' => 22.99,
            'stock' => 50,
            'categoria_id' => 7, // Asegúrate de que esta categoría exista
        ]);
        Producto::create([
            'nombre' => 'Producto12',
            'descripcion' => 'Descripción del producto de ejemplo12',
            'precio' => 30.99,
            'stock' => 20,
            'categoria_id' => 7, // Asegúrate de que esta categoría exista
        ]);
    }
}
