<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutenticacionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_registro_una_persona(): void
    {
        // Prepara los datos. Arrange
        $usuario = [
            'nombre' => 'Ana Ropa',
            'apellido' => 'Sol',
            'email' => 'anaropa@tienda.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Realiza la solicitud. Act
        $response = $this->postJson('/api/v1/register', $usuario);

        // Verifica respuesta correcta. Assert
        $response->assertStatus(201)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
                'usuario' => ['id', 'nombre', 'email'],
            ])
            ->assertJsonPath('usuario.email', 'anaropa@tienda.test')
            ->assertJsonMissingPath('usuario.password');
    }

    public function test_intento_registrar_usuario_registrado(): void
    {
        Usuario::factory()->create(['email' => 'anaropa@tienda.test']);
        $response = $this->postJson('/api/v1/register', [
            'nombre' => 'Ana Ropa',
            'apellido' => 'Sol',
            'email' => 'anaropa@tienda.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertUnprocessable()
            ->assertJsonValidationErrors('email');
    }

    public function test_intento_registra_sin_campos_obligatorios(): void
    {
        $casos = [
            'sin nombre' => [
                'payload' => [
                    'apellido' => 'Sol',
                    'email' => 'anaropa@tienda.test',
                    'password' => 'password123',
                    'password_confirmation' => 'password123',
                ],
                'errores' => ['nombre'],
            ],
            'sin apellido' => [
                'payload' => [
                    'nombre' => 'Ana Ropa',
                    'email' => 'anaropa@tienda.test',
                    'password' => 'password123',
                    'password_confirmation' => 'password123',
                ],
                'errores' => ['apellido'],
            ],
            'sin email' => [
                'payload' => [
                    'nombre' => 'Ana Ropa',
                    'apellido' => 'Sol',
                    'password' => 'password123',
                    'password_confirmation' => 'password123',
                ],
                'errores' => ['email'],
            ],
            'sin password' => [
                'payload' => [
                    'nombre' => 'Ana Ropa',
                    'apellido' => 'Sol',
                    'email' => 'anaropa@tienda.test',
                    'password_confirmation' => 'password123',
                ],
                'errores' => ['password'],
            ],
            'password sin confirmacion' => [
                'payload' => [
                    'nombre' => 'Ana Ropa',
                    'apellido' => 'Sol',
                    'email' => 'anaropa@tienda.test',
                    'password' => 'password123',
                ],
                'errores' => ['password'],
            ],
        ];

        foreach ($casos as $descripcion => $caso) {
            $response = $this->postJson('/api/v1/register', $caso['payload']);

            $response->assertUnprocessable()
                ->assertJsonValidationErrors($caso['errores']);
        }
    }

    public function test_inicio_sesion_usuario_registrado(): void
    {   // Crear usuario registrado, Arrange.
        Usuario::factory()->create([
            'nombre' => 'Ana Ropa',
            'apellido' => 'Sol',
            'email' => 'anaropa@tienda.test',
            'password' => bcrypt('password'),
        ]);
        // Realiza inicio de sesión, Act.
        $response = $this->postJson('/api/v1/login', [
            'email' => 'anaropa@tienda.test',
            'password' => 'password',
        ]);
        // Verificar respuesta correcta. Assert.
        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
                'usuario' => ['id', 'nombre', 'email'],
            ])
            ->assertJsonPath('token_type', 'bearer')
            ->assertJsonPath('usuario.email', 'anaropa@tienda.test')
            ->assertJsonMissingPath('usuario.password');
    }

    public function test_intento_iniciar_sesion_sin_registrar(): void
    {
        // Preparo inicio de sesion, Arrange.
        $usuario = [
            'email' => 'ana@tienda.test',
            'password' => 'password',
        ];
        // Intenta inicio de sesión, Act.
        $response = $this->postJson('/api/v1/login', $usuario);

        // Verificar respuesta incorrecta. Assert.
        $response->assertUnauthorized();
    }

    public function test_persona_autenticada_vea_perfil(): void
    {
        $usuario = Usuario::factory()->create();

        $token = auth('api')->login($usuario);

        $this->withToken($token)
            ->getJson('/api/v1/profile')
            ->assertOk()
            ->assertJsonPath('id', $usuario->id)
            ->assertJsonPath('email', $usuario->email)
            ->assertJsonMissingPath('password');

    }

    public function test_persona_autenticada_actualiza_perfil(): void
    {
        $usuario = Usuario::factory()->create();

        $token = auth('api')->login($usuario);

        $response = $this->withToken($token)
            ->putJson('/api/v1/profile', [
                'nombre' => 'Ana Actualizada',
                'apellido' => 'Ropa Nueva',
            ]);

        $response->assertOk()
            ->assertJsonPath('message', 'Usuario actualizado correctamente.')
            ->assertJsonPath('usuario.id', $usuario->id)
            ->assertJsonPath('usuario.nombre', 'Ana Actualizada')
            ->assertJsonPath('usuario.apellido', 'Ropa Nueva')
            ->assertJsonMissingPath('usuario.password');

        $this->assertDatabaseHas('usuarios', [
            'id' => $usuario->id,
            'nombre' => 'Ana Actualizada',
            'apellido' => 'Ropa Nueva',
        ]);
    }

    public function test_persona_sin_autenticar_no_puede_modificar_perfil(): void
    {
        $this->putJson('/api/v1/profile', [
            'nombre' => 'Ana Actualizada',
        ])->assertUnauthorized();
    }

    public function test_rechazo_perfil_sin_token(): void
    {
        $this->getJson('api/v1/profile')->assertUnauthorized();
    }
}
