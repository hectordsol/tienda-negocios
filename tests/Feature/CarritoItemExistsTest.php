<?php

use App\Models\Carrito;
use App\Models\Carritoitem;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('prevents duplicate products in the same user cart', function () {
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

it('rejects deleting an item that is not in the authenticated user cart', function () {
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

it('deletes the active cart of the authenticated user', function () {
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
