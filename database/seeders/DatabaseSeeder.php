<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategoriaSeeder;
use Database\Seeders\ProductoSeeder;
use Database\Seeders\UsuarioSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuario::factory(10)->create();

        // Usuario::factory()->create([
        //     'nombre' => 'Test User',
        //     'apellido' => 'Test Lastname',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('password'),
        // ]);
        $this->call([
            CategoriaSeeder::class,
            ProductoSeeder::class,
            UsuarioSeeder::class,
        ]);
    
    }
}
