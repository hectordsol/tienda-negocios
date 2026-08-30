<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

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
            'nombre' => 'Usuario1',
            'apellido' => 'Apellido de ejemplo1',
            'email' => 'usuario1@example.com',
            'password' => bcrypt('password'),
            'isadmin' => true,
        ]);
        Usuario::create([
            'nombre' => 'Usuario2',
            'apellido' => 'Apellido de ejemplo2',
            'email' => 'usuario2@example.com',
            'password' => bcrypt('password'),
        ]);
        Usuario::create([
            'nombre' => 'Usuario3',
            'apellido' => 'Apellido de ejemplo3',
            'email' => 'usuario3@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
