<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_listar_productos_cualquier_usuario_sin_loguear(): void
    {
        Producto::factory()->count(10)->create();
        $response = $this->getJson('/api/v1/productos');

        $response->assertOk()
            ->assertJsonCount(10);
    }

    public function test_persona_admin_crea_producto_ok(): void
    {
        $admin = Usuario::factory()->create();
        $admin->isadmin = true;
        $admin->save();

        $categoria = Categoria::factory()->create();

        $datos = [
            'nombre' => 'Notebook Pro',
            'descripcion' => 'Notebook para trabajo',
            'precio' => 1500.50,
            'stock' => 8,
            'categoria_id' => $categoria->id,
        ];

        $this->actingAs($admin, 'api')
            ->postJson('/api/v1/productos', $datos)
            ->assertCreated()
            ->assertJsonPath('nombre', 'Notebook Pro')
            ->assertJsonPath('categoria_id', $categoria->id);

        $this->assertDatabaseHas('productos', [
            'nombre' => 'Notebook Pro',
            'categoria_id' => $categoria->id,
        ]);
    }

    public function test_persona_sin_token_admin_no_puede_crear_producto(): void
    {
        $categoria = Categoria::factory()->create();

        $this->postJson('/api/v1/productos', [
            'nombre' => 'Producto sin autorización',
            'descripcion' => 'No debe crearse',
            'precio' => 100,
            'stock' => 1,
            'categoria_id' => $categoria->id,
        ])->assertUnauthorized();

        $this->assertDatabaseMissing('productos', [
            'nombre' => 'Producto sin autorización',
        ]);
    }

    public function test_persona_con_token_admin_puede_modificar_producto(): void
    {
        $admin = Usuario::factory()->create(['isadmin' => true]);
        $producto = Producto::factory()->create([
            'nombre' => 'Producto original',
        ]);

        $this->actingAs($admin, 'api')
            ->putJson('/api/v1/productos/'.$producto->id, [
                'nombre' => 'Producto actualizado',
                'precio' => 250,
            ])
            ->assertOk()
            ->assertJsonPath('nombre', 'Producto actualizado')
            ->assertJsonPath('precio', 250);

        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'nombre' => 'Producto actualizado',
            'precio' => 250,
        ]);
    }

    public function test_persona_sin_token_admin_no_puede_modificar_producto(): void
    {
        $producto = Producto::factory()->create([
            'nombre' => 'Producto original',
        ]);

        $this->putJson('/api/v1/productos/'.$producto->id, [
            'nombre' => 'Producto actualizado',
        ])->assertUnauthorized();

        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'nombre' => 'Producto original',
        ]);
    }

    public function test_persona_con_token_admin_puede_borrar_producto(): void
    {
        $admin = Usuario::factory()->create(['isadmin' => true]);
        $producto = Producto::factory()->create();

        $this->actingAs($admin, 'api')
            ->deleteJson('/api/v1/productos/'.$producto->id)
            ->assertNoContent();

        $this->assertDatabaseMissing('productos', [
            'id' => $producto->id,
        ]);
    }

    public function test_persona_sin_token_admin_no_puede_borrar_producto(): void
    {
        $usuario = Usuario::factory()->create(['isadmin' => false]);
        $producto = Producto::factory()->create();

        $this->actingAs($usuario, 'api')
            ->deleteJson('/api/v1/productos/'.$producto->id)
            ->assertForbidden();

        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
        ]);
    }
}
