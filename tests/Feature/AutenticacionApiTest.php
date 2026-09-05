<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutenticacionApiTest extends TestCase
{
    use RefreshDatabase;

    public function testear_registro_una_persona(): void
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
        $usuario = [
            'email' => 'ana@tienda.test',
            'password' => 'password',
        ];
        $response = $this->postJson('/api/v1/login', $usuario);

        $response->assertUnauthorized();
    }

    public function test_persona_autenticada_vea_perfil(): void
    {
        $user = Usuario::factory()->create();
        $token = auth('api')->login($user);
        $this->withToken($token)
            ->getJson('api/v1/profile')
            ->assertOk()
            ->assertJson('id')->$user->id
            ->assertJson('email')->$user->email
            ->assertJsonMissingPath('password')->$user->password;
    }

    public function test_rechazo_perfil_sin_token(): void
    {
        $this->getJson('api/v1/profile')->assertUnauthorized();
    }
}
