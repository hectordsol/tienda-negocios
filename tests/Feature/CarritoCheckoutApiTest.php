<?php

namespace Tests\Feature;

use App\Models\Carrito;
use App\Models\Carritoitem;
use App\Models\Producto;
use App\Models\Usuario;
use App\Services\ResumenCarritoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarritoCheckoutApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_calcula_un_carrito_con_envio(): void
    {
        $usuario = Usuario::factory()->create();
        $carrito = Carrito::create([
            'usuario_id' => $usuario->id,
            'estado' => 'activo',
        ]);
        $producto = Producto::factory()->create([
            'precio' => 1000,
            'stock' => 10,
        ]);

        Carritoitem::create([
            'carrito_id' => $carrito->id,
            'producto_id' => $producto->id,
            'cantidad' => 2,
            'precio_unitario' => 1000,
        ]);

        $resumen = app(ResumenCarritoService::class)->calcular(
            $carrito->fresh()->items()->with('producto')->get(),
        );

        $this->assertSame(2000.0, $resumen['subtotal']);
        $this->assertSame(420.0, $resumen['impuestos']);
        $this->assertSame(5000.0, $resumen['envio']);
        $this->assertSame(7420.0, $resumen['total']);
    }

    public function test_ofrece_envio_gratis_justo_desde_el_monto_limite(): void
    {
        $carrito = $this->crearCarritoConProducto(100000);

        $resumen = app(ResumenCarritoService::class)->calcular(
            $carrito->items()->with('producto')->get(),
        );

        $this->assertSame(100000.0, $resumen['subtotal']);
        $this->assertSame(21000.0, $resumen['impuestos']);
        $this->assertSame(0.0, $resumen['envio']);
        $this->assertSame(121000.0, $resumen['total']);
    }

    public function test_cobra_gastos_envio_cuando_no_alcanza_el_envio_gratis_limite_inferior(): void
    {
        $carrito = $this->crearCarritoConProducto(99999.99);

        $resumen = app(ResumenCarritoService::class)->calcular(
            $carrito->items()->with('producto')->get(),
        );

        $this->assertSame(99999.99, $resumen['subtotal']);
        $this->assertSame(21000.0, $resumen['impuestos']);
        $this->assertSame(5000.0, $resumen['envio']);
    }

    public function test_cobrar_gastos_envio_cuando_no_alcanza_el_envio_gratis_limite_superior(): void
    {
        $carrito = $this->crearCarritoConProducto(0.01);

        $resumen = app(ResumenCarritoService::class)->calcular(
            $carrito->items()->with('producto')->get(),
        );

        $this->assertSame(0.01, $resumen['subtotal']);
        $this->assertSame(0.0, $resumen['impuestos']);
        $this->assertSame(5000.0, $resumen['envio']);
    }

    public function test_suma_varias_lineas_antes_de_calcular_impuestos(): void
    {
        $usuario = Usuario::factory()->create();
        $carrito = Carrito::create([
            'usuario_id' => $usuario->id,
            'estado' => 'activo',
        ]);
        $primerProducto = Producto::factory()->create(['precio' => 2000]);
        $segundoProducto = Producto::factory()->create(['precio' => 3000]);

        Carritoitem::create([
            'carrito_id' => $carrito->id,
            'producto_id' => $primerProducto->id,
            'cantidad' => 2,
            'precio_unitario' => 2000,
        ]);
        Carritoitem::create([
            'carrito_id' => $carrito->id,
            'producto_id' => $segundoProducto->id,
            'cantidad' => 1,
            'precio_unitario' => 3000,
        ]);

        $resumen = app(ResumenCarritoService::class)->calcular(
            $carrito->fresh()->items()->with('producto')->get(),
        );

        $this->assertSame(7000.0, $resumen['subtotal']);
        $this->assertSame(1470.0, $resumen['impuestos']);
        $this->assertSame(5000.0, $resumen['envio']);
        $this->assertSame(13470.0, $resumen['total']);
    }

    public function test_un_carrito_vacio_no_debe_genera_cargos(): void
    {
        $usuario = Usuario::factory()->create();
        $carrito = Carrito::create([
            'usuario_id' => $usuario->id,
            'estado' => 'activo',
        ]);

        $resumen = app(ResumenCarritoService::class)->calcular(
            $carrito->items()->with('producto')->get(),
        );

        $this->assertSame(0.0, $resumen['subtotal']);
        $this->assertSame(0.0, $resumen['impuestos']);
        $this->assertSame(0.0, $resumen['envio']);
        $this->assertSame(0.0, $resumen['total']);
    }

    private function crearCarritoConProducto(float $precio): Carrito
    {
        $usuario = Usuario::factory()->create();
        $carrito = Carrito::create([
            'usuario_id' => $usuario->id,
            'estado' => 'activo',
        ]);
        $producto = Producto::factory()->create([
            'precio' => $precio,
            'stock' => 10,
        ]);

        Carritoitem::create([
            'carrito_id' => $carrito->id,
            'producto_id' => $producto->id,
            'cantidad' => 1,
            'precio_unitario' => $precio,
        ]);

        return $carrito->fresh();
    }
}
