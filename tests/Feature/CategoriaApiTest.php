<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_listar_categoria_solo_admin(): void
    {
        Categoria::factory()->count(3)->create();

        $this->getJson('/api/v1/categorias')
            ->assertUnauthorized();

        $admin = Usuario::factory()->create(['isadmin' => true]);

        $this->actingAs($admin, 'api')
            ->getJson('/api/v1/categorias')
            ->assertOk()
            ->assertJsonCount(3);
    }

    public function test_persona_admin_crea_categoria_ok(): void
    {
        $admin = Usuario::factory()->create(['isadmin' => true]);

        $datos = [
            'nombre' => 'Electronica',
            'slug' => 'electronica',
            'descripcion' => 'Productos electronicos',
        ];

        $this->actingAs($admin, 'api')
            ->postJson('/api/v1/categorias', $datos)
            ->assertCreated()
            ->assertJsonPath('nombre', 'Electronica')
            ->assertJsonPath('slug', 'electronica');

        $this->assertDatabaseHas('categorias', $datos);
    }

    public function test_persona_sin_token_admin_no_puede_crear_categoria(): void
    {
        $this->postJson('/api/v1/categorias', [
            'nombre' => 'Categoria no autorizada',
            'slug' => 'categoria-no-autorizada',
            'descripcion' => 'No debe crearse',
        ])->assertUnauthorized();

        $this->assertDatabaseMissing('categorias', [
            'slug' => 'categoria-no-autorizada',
        ]);
    }

    public function test_persona_con_token_admin_puede_modificar_categoria(): void
    {
        $admin = Usuario::factory()->create(['isadmin' => true]);
        $categoria = Categoria::factory()->create([
            'nombre' => 'Nombre original',
            'slug' => 'nombre-original',
        ]);

        $this->actingAs($admin, 'api')
            ->putJson('/api/v1/categorias/'.$categoria->id, [
                'nombre' => 'Nombre actualizado',
                'slug' => 'nombre-actualizado',
            ])
            ->assertOk()
            ->assertJsonPath('nombre', 'Nombre actualizado')
            ->assertJsonPath('slug', 'nombre-actualizado');

        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'nombre' => 'Nombre actualizado',
            'slug' => 'nombre-actualizado',
        ]);
    }

    public function test_persona_sin_token_admin_no_puede_modificar_categoria(): void
    {
        $categoria = Categoria::factory()->create([
            'nombre' => 'Nombre original',
        ]);

        $this->putJson('/api/v1/categorias/'.$categoria->id, [
            'nombre' => 'Nombre actualizado',
        ])->assertUnauthorized();

        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'nombre' => 'Nombre original',
        ]);
    }

    public function test_persona_con_token_admin_puede_borrar_categoria(): void
    {
        $admin = Usuario::factory()->create(['isadmin' => true]);
        $categoria = Categoria::factory()->create();

        $this->actingAs($admin, 'api')
            ->deleteJson('/api/v1/categorias/'.$categoria->id)
            ->assertNoContent();

        $this->assertDatabaseMissing('categorias', [
            'id' => $categoria->id,
        ]);
    }

    public function test_persona_sin_token_admin_no_puede_borrar_categoria(): void
    {
        $categoria = Categoria::factory()->create();

        $this->deleteJson('/api/v1/categorias/'.$categoria->id)
            ->assertUnauthorized();

        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
        ]);
    }
}
