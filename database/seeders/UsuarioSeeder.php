<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Aquí puedes agregar la lógica para crear usuarios de ejemplo
        // Por ejemplo, puedes usar el modelo User para crear usuarios
        Usuario::create([
            'nombre' => 'Usuario de ejemplo1',
            'apellido' => 'Apellido de ejemplo1',
            'email' => 'usuario1@example.com',
            'password' => bcrypt('password'), 
        ]);
        Usuario::create([
            'nombre' => 'Usuario de ejemplo2',
            'apellido' => 'Apellido de ejemplo2',
            'email' => 'usuario2@example.com',
            'password' => bcrypt('password'), 
        ]);
        Usuario::create([
            'nombre' => 'Usuario de ejemplo3',
            'apellido' => 'Apellido de ejemplo3',
            'email' => 'usuario3@example.com',
            'password' => bcrypt('password'), 
        ]);
    }
}
