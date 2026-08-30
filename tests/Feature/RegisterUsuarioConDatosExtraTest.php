<?php

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('registers a user with phone, address, city, postal code and country', function () {
    $payload = [
        'nombre' => 'María',
        'apellido' => 'López',
        'email' => 'maria@example.com',
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
        'telefono' => '1122334455',
        'direccion' => 'Calle Falsa 123',
        'ciudad' => 'Buenos Aires',
        'codigo_postal' => 'C1000',
        'pais' => 'Argentina',
    ];

    $response = $this->postJson('/api/v1/register', $payload);

    $response->assertOk();

    $usuario = Usuario::where('email', 'maria@example.com')->first();

    expect($usuario)->not->toBeNull()
        ->and($usuario->telefono)->toBe('1122334455')
        ->and($usuario->direccion)->toBe('Calle Falsa 123')
        ->and($usuario->ciudad)->toBe('Buenos Aires')
        ->and($usuario->codigo_postal)->toBe('C1000')
        ->and($usuario->pais)->toBe('Argentina');
});
