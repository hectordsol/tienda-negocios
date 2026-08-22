<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Electrónica',
            'slug' => 'electronica', 
            'descripcion' => 'Productos electrónicos como teléfonos, computadoras, televisores, etc.'
            ]);
        Categoria::create([
            'nombre' => 'Indumentaria',
            'slug' => 'indumentaria',
            'descripcion' => 'Ropa para hombres, mujeres y niños.'
            ]);
        Categoria::create([
            'nombre' => 'Libros',
            'slug' => 'libros',
            'descripcion' => 'Libros de diferentes géneros y autores.'
            ]);
        Categoria::create([
            'nombre' => 'Hogar',
            'slug' => 'hogar',
            'descripcion' => 'Productos para el hogar y la decoración.'
            ]);
        Categoria::create([
            'nombre' => 'Deportes',
            'slug' => 'deportes',
            'descripcion' => 'Equipamiento y ropa deportiva.'
            ]);
        Categoria::create([
            'nombre' => 'Juguetes',
            'slug' => 'juguetes',
            'descripcion' => 'Juguetes para niños de todas las edades.'
            ]);
        Categoria::create([
            'nombre' => 'Belleza',
            'slug' => 'belleza',
            'descripcion' => 'Productos de belleza y cuidado personal.'
            ]);
    }
}
