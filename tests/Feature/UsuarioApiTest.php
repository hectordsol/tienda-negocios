<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsuarioApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_listar_usuarios_solo_admin(): void
    {
        Usuario::factory()->count(5)->create();

        $this->getJson('/api/v1/usuarios')
            ->assertUnauthorized();

        $admin = Usuario::factory()->create(['isadmin' => true]);

        $this->actingAs($admin, 'api')
            ->getJson('/api/v1/usuarios')
            ->assertOk()
            ->assertJsonCount(6);
    }

    public function test_persona_admin_crea_usuario_ok(): void
    {
        $admin = Usuario::factory()->create();
        $admin->isadmin = true;
        $admin->save();

        $datos = [
            'nombre' => 'Maria',
            'apellido' => 'Lopez',
            'email' => 'maria@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'telefono' => '1122334455',
            'direccion' => 'Calle Falsa 123',
            'ciudad' => 'Buenos Aires',
            'codigo_postal' => 'C1000',
            'pais' => 'Argentina',
        ];

        $this->actingAs($admin, 'api')
            ->postJson('/api/v1/usuarios', $datos)
            ->assertCreated()
            ->assertJsonPath('nombre', 'Maria')
            ->assertJsonPath('apellido', 'Lopez')
            ->assertJsonPath('email', 'maria@example.com');

        $this->assertDatabaseHas('usuarios', [
            'nombre' => 'Maria',
            'apellido' => 'Lopez',
            'email' => 'maria@example.com',
            'telefono' => '1122334455',
            'direccion' => 'Calle Falsa 123',
            'ciudad' => 'Buenos Aires',
            'codigo_postal' => 'C1000',
            'pais' => 'Argentina',
        ]);
    }

    public function test_persona_sin_token_admin_no_puede_crear_usuario(): void
    {
        $this->postJson('/api/v1/usuarios', [
            'nombre' => 'Usuario',
            'apellido' => 'No autorizado',
            'email' => 'no-autorizado@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])->assertUnauthorized();

        $this->assertDatabaseMissing('usuarios', [
            'email' => 'no-autorizado@example.com',
        ]);
    }

    public function test_persona_con_token_admin_puede_modificar_usuario(): void
    {
        $admin = Usuario::factory()->create();
        $admin->isadmin = true;
        $admin->save();

        $usuario = Usuario::factory()->create([
            'nombre' => 'Nombre original',
        ]);

        $this->actingAs($admin, 'api')
            ->putJson('/api/v1/usuarios/'.$usuario->id, [
                'nombre' => 'Nombre actualizado',
                'ciudad' => 'Cordoba',
            ])
            ->assertOk()
            ->assertJsonPath('nombre', 'Nombre actualizado')
            ->assertJsonPath('ciudad', 'Cordoba');

        $this->assertDatabaseHas('usuarios', [
            'id' => $usuario->id,
            'nombre' => 'Nombre actualizado',
            'ciudad' => 'Cordoba',
        ]);
    }

    public function test_persona_sin_token_admin_no_puede_modificar_usuario(): void
    {
        $usuario = Usuario::factory()->create([
            'nombre' => 'Nombre original',
        ]);

        $this->putJson('/api/v1/usuarios/'.$usuario->id, [
            'nombre' => 'Nombre actualizado',
        ])->assertUnauthorized();

        $this->assertDatabaseHas('usuarios', [
            'id' => $usuario->id,
            'nombre' => 'Nombre original',
        ]);
    }

    public function test_persona_con_token_admin_puede_borrar_usuario(): void
    {
        $admin = Usuario::factory()->create();
        $admin->isadmin = true;
        $admin->save();

        $usuario = Usuario::factory()->create();

        $this->actingAs($admin, 'api')
            ->deleteJson('/api/v1/usuarios/'.$usuario->id)
            ->assertNoContent();

        $this->assertDatabaseMissing('usuarios', [
            'id' => $usuario->id,
        ]);
    }

    public function test_persona_sin_token_admin_no_puede_borrar_usuario(): void
    {
        $usuario = Usuario::factory()->create();

        $this->deleteJson('/api/v1/usuarios/'.$usuario->id)
            ->assertUnauthorized();

        $this->assertDatabaseHas('usuarios', [
            'id' => $usuario->id,
        ]);
    }
}
