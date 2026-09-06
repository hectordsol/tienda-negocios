<?php

use App\Models\Carrito;
use App\Models\Carritoitem;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('devuelve solo el carrito activo', function () {
    $usuario = Usuario::create([
        'nombre' => 'Sofía',
        'apellido' => 'Gómez',
        'email' => 'sofia@example.com',
        'password' => bcrypt('secret123'),
    ]);

    $carrito = Carrito::create([
        'usuario_id' => $usuario->id,
        'estado' => 'activo',
    ]);

    $this->actingAs($usuario, 'api')
        ->getJson('/api/v1/carrito')
        ->assertOk()
        ->assertJsonPath('resumen.cantidad_productos', 0)
        ->assertJsonPath('resumen.total', 0);

    $carrito->update(['estado' => 'finalizado']);

    $this->actingAs($usuario, 'api')
        ->getJson('/api/v1/carrito')
        ->assertNotFound();
});

it('crea un carrito activo nuevo si el usuario solo tiene carritos finalizados', function () {
    $usuario = Usuario::factory()->create();
    $carritoFinalizado = Carrito::create([
        'usuario_id' => $usuario->id,
        'estado' => 'finalizado',
    ]);
    $producto = Producto::factory()->create([
        'stock' => 10,
    ]);

    $this->actingAs($usuario, 'api')
        ->postJson('/api/v1/carrito', [
            'producto_id' => $producto->id,
            'cantidad' => 2,
        ])
        ->assertCreated();

    $carritoActivo = Carrito::query()
        ->where('usuario_id', $usuario->id)
        ->where('estado', 'activo')
        ->first();

    expect($carritoActivo)->not->toBeNull()
        ->and($carritoActivo->id)->not->toBe($carritoFinalizado->id)
        ->and($carritoFinalizado->fresh()->estado)->toBe('finalizado')
        ->and($carritoActivo->items()->where('producto_id', $producto->id)->value('cantidad'))->toBe(2);
});

it('evita productos duplicados en el mismo carrito de usuario', function () {
    $usuario = Usuario::create([
        'nombre' => 'Ana',
        'apellido' => 'García',
        'email' => 'ana@example.com',
        'password' => bcrypt('secret123'),
    ]);

    $carrito = Carrito::create([
        'usuario_id' => $usuario->id,
        'estado' => 'activo',
    ]);

    $producto = Producto::create([
        'nombre' => 'Notebook',
        'descripcion' => 'Laptop 14',
        'precio' => 1500.00,
        'stock' => 10,
    ]);

    Carritoitem::create([
        'carrito_id' => $carrito->id,
        'producto_id' => $producto->id,
        'cantidad' => 1,
        'precio_unitario' => 1500.00,
    ]);

    expect(fn () => Carritoitem::create([
        'carrito_id' => $carrito->id,
        'producto_id' => $producto->id,
        'cantidad' => 2,
        'precio_unitario' => 1500.00,
    ]))->toThrow(QueryException::class);
});

it('rechaza la eliminación de un artículo que no se encuentra en el carrito del usuario autenticado', function () {
    $usuario = Usuario::create([
        'nombre' => 'Luis',
        'apellido' => 'Pérez',
        'email' => 'luis@example.com',
        'password' => bcrypt('secret123'),
    ]);

    $otroUsuario = Usuario::create([
        'nombre' => 'Marta',
        'apellido' => 'López',
        'email' => 'marta@example.com',
        'password' => bcrypt('secret123'),
    ]);

    $carritoOtroUsuario = Carrito::create([
        'usuario_id' => $otroUsuario->id,
        'estado' => 'activo',
    ]);

    $producto = Producto::create([
        'nombre' => 'Teclado',
        'descripcion' => 'Mecánico',
        'precio' => 500.00,
        'stock' => 5,
    ]);

    $item = Carritoitem::create([
        'carrito_id' => $carritoOtroUsuario->id,
        'producto_id' => $producto->id,
        'cantidad' => 1,
        'precio_unitario' => 500.00,
    ]);

    $this->actingAs($usuario, 'api')
        ->deleteJson('/api/v1/carrito/items/'.$item->id)
        ->assertStatus(404);
});

it('elimina el carrito activo del usuario autenticado', function () {
    $usuario = Usuario::create([
        'nombre' => 'Carlos',
        'apellido' => 'Ruiz',
        'email' => 'carlos@example.com',
        'password' => bcrypt('secret123'),
    ]);

    Carrito::create([
        'usuario_id' => $usuario->id,
        'estado' => 'activo',
    ]);

    $this->actingAs($usuario, 'api')
        ->deleteJson('/api/v1/carrito')
        ->assertStatus(204);

    expect($usuario->fresh()->carrito()->exists())->toBeFalse();
});

it('procesa el carrito activo y devuelve el resumen del pedido', function () {
    $usuario = Usuario::create([
        'nombre' => 'Nora',
        'apellido' => 'Fernández',
        'email' => 'nora@example.com',
        'password' => bcrypt('secret123'),
    ]);

    $carrito = Carrito::create([
        'usuario_id' => $usuario->id,
        'estado' => 'activo',
    ]);

    $producto = Producto::create([
        'nombre' => 'Mouse',
        'descripcion' => 'Mouse gamer',
        'precio' => 4500.00,
        'stock' => 10,
    ]);

    Carritoitem::create([
        'carrito_id' => $carrito->id,
        'producto_id' => $producto->id,
        'cantidad' => 2,
        'precio_unitario' => 4500.00,
    ]);

    $response = $this->actingAs($usuario, 'api')
        ->postJson('/api/v1/carrito/checkout');

    $response->assertOk()
        ->assertJsonPath('resumen.subtotal', 9000)
        ->assertJsonPath('resumen.impuestos', 1890)
        ->assertJsonPath('resumen.envio', 5000)
        ->assertJsonPath('resumen.total', 15890);

    $producto->refresh();

    expect($producto->stock)->toBe(8)
        ->and($carrito->fresh()->estado)->toBe('finalizado');
});
