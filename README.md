# 🛒 Tienda de Negocios

## 📋 Descripción del Proyecto

**Tienda de Negocios** es una aplicación web desarrollada con Laravel que permite gestionar productos de una tienda. El sistema proporciona funcionalidades básicas para administrar el inventario de productos.

## 🚀 Estado Actual del Proyecto

### Funcionalidades Implementadas
- [✅] Configuración del sistema de rutas
- [✅] Conexión a base de datos MySQL
- [✅] Controlador de Productos
- [✅] Modelo Producto, Usuario, Categoría, Carrito
- [✅] Migración de la tablas Usuario, Producto, Categoría, Carrito.
- [✅] Definir Relaciones en los modelos
- [✅] Crear controlador de Usuarios, Categoría, Carrito
- [✅] Implementación de CRUD completo Producto, Categoría, Usuario, Carrito
- [✅] Vistas para gestión de productos con rutas (routes/api.php)
- [✅] Analizar y documentar flujo de información Laravel


### 🔄 Próximos Pasos
- [ ] Validaciones de formularios
- [ ] Validar datos
- [ ] Incluir regla personalizada

## 🛠️ Tecnologías Utilizadas

- **Framework:** Laravel (versión 10.x)
- **Base de Datos:** MySQL
- **Servidor Local:** XAMPP
- **Lenguajes:** PHP, HTML, CSS, JavaScript

## 📦 Requisitos del Sistema

- PHP >= 8.3
- Composer
- MySQL
- XAMPP o similar
- Node.js y npm (opcional para assets)

## 📂 Estructura del Proyecto

```text
tienda-negocios/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── CarritoController.php
│   │       ├── CategoriaController.php
│   │       ├── ProductoController.php
│   │       └── ProductoController.php
│   └── Models/
│       ├── Carrito.php
│       ├── Categoria.php
│       ├── Producto.php
│       └── Usuario.php
├── database/
│   ├── migrations/
│   │   ├── [timestamp]_create_usuarios_table.php
│   │   ├── [timestamp]_create_productos_table.php
│   │   ├── [timestamp]_create_categorias_table.php
│   │   └── [timestamp]_create_carritos_table.php
│   └── seeders/
│       ├── CategoriaSeeder.php
│       ├── DatabaseSeeder.php
│       ├── ProductoSeeder.php
│       └── UsuarioSeeder.php
├── resources/
│   └── views/
├── routes/
│   ├── api.php
│   └── web.php
└── ...
```
## 🔧 Configuración del Entorno

### 1. Clonar el repositorio
```bash
git clone https://github.com/hectordsol/tienda-negocios.git
cd tienda-negocios

### 2. Configuración de base de datos para probar
.env para probar

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tienda_negocios
DB_USERNAME=root
DB_PASSWORD=

## 👨‍💻 Desarrollador
Nombre del desarrollador - [Héctor Darío Sol]

## Comparación de proyecto PHP con Laravel

## 🔄 Comparación de arquitecturas MVC

Los proyectos [`tienda-ecommerce`](https://github.com/hectordsol/tienda-ecommerce) y [`tienda-negocios`](https://github.com/hectordsol/tienda-negocios) implementan el patrón **MVC (Modelo–Vista–Controlador)**, pero con diferentes niveles de abstracción.

### 🧩 PHP puro — MVC propio

El proyecto `tienda-ecommerce` implementa una arquitectura MVC utilizando PHP y Composer, pero sin depender de un framework completo. La estructura principal es:

```text
tienda-ecommerce/
├── app/
│   ├── Controllers/
│   │   └── ProductoController.php
│   ├── Models/
│   │   ├── Producto.php
│   │   └── ProductoModel.php
│   └── Views/
│       └── productos.php
├── public/
├── composer.json
└── ...
```

En este enfoque, el desarrollador define y controla directamente la organización de **controladores, modelos, vistas, rutas y flujo de ejecución**. Esto permite comprender con mayor claridad cómo funciona internamente el patrón MVC y cómo se relacionan sus componentes.

**Ventajas:**

* Mayor control sobre la arquitectura.
* Estructura sencilla y fácil de comprender.
* Menor cantidad de abstracciones.
* Adecuado para aprender los fundamentos de MVC y de una API REST.

**Desventajas:**

* Muchas funcionalidades deben desarrollarse manualmente.
* El mantenimiento y la escalabilidad requieren más trabajo.
* La seguridad, validaciones, routing y otras tareas comunes no están centralizadas en un framework.

### 🚀 Laravel — Framework

El proyecto `tienda-negocios` utiliza Laravel instalado mediante Composer. La estructura incorpora convenciones y componentes propios del framework:

```text
tienda-negocios/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── CategoriaController.php
│   │       ├── ProductoController.php
│   │       ├── UsuarioController.php
│   │       └── CarritoController.php
│   └── Models/
│       ├── Categoria.php
│       ├── Producto.php
│       ├── Usuario.php
│       └── Carrito.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
├── routes/
│   ├── api.php
│   └── web.php
├── public/
├── config/
├── bootstrap/
├── storage/
├── tests/
├── artisan
├── composer.json
└── ...
```

Laravel mantiene la separación MVC, pero agrega una infraestructura completa alrededor de ella. Composer administra las dependencias y el autoload PSR-4, mientras que Laravel proporciona herramientas para routing, ORM, migraciones, validación, middleware, autenticación, manejo de sesiones y otras tareas habituales.

**Ventajas:**

* Estructura estandarizada y escalable.
* Routing y middleware integrados.
* Eloquent ORM para trabajar con la base de datos.
* Migraciones y seeders para administrar la estructura y datos iniciales.
* Validación, autenticación y protección CSRF integradas.
* Artisan permite automatizar numerosas tareas.
* Mayor facilidad para desarrollar y mantener aplicaciones complejas.

**Desventajas:**

* Mayor cantidad de archivos y conceptos que aprender.
* Mayor abstracción respecto de PHP puro.
* El desarrollador debe conocer las convenciones y herramientas propias de Laravel.

### 📊 Comparación conceptual

| Aspecto              | PHP MVC propio                      | Laravel                                       |
| -------------------- | ----------------------------------- | --------------------------------------------- |
| Patrón               | MVC implementado manualmente        | MVC dentro del framework                      |
| Controladores        | `app/Controllers`                   | `app/Http/Controllers`                        |
| Modelos              | `app/Models`                        | `app/Models`                                  |
| Vistas               | `app/Views`                         | `resources/views`                             |
| Rutas                | Implementadas por el proyecto       | `routes/web.php` / `routes/api.php`           |
| Base de datos        | Lógica implementada por el proyecto | Eloquent + migrations + seeders               |
| Dependencias         | Composer                            | Composer + Laravel                            |
| Automatización       | Limitada                            | Artisan                                       |
| Abstracción          | Baja                                | Alta                                          |
| Curva de aprendizaje | Menor inicialmente                  | Mayor                                         |
| Escalabilidad        | Depende de la implementación        | Favorecida por las convenciones del framework |

### 🎯 Conclusión

Ambos proyectos aplican el mismo principio fundamental: **separar la lógica de datos, la lógica de negocio y la presentación**. La principal diferencia está en quién proporciona la infraestructura.

En `tienda-ecommerce`, gran parte de esa infraestructura es desarrollada explícitamente por el programador. En `tienda-negocios`, Laravel proporciona una estructura y numerosas herramientas que permiten concentrarse principalmente en la lógica de la aplicación.

Por lo tanto, el primer proyecto resulta especialmente útil para comprender **cómo funciona MVC y una API REST desde sus fundamentos**, mientras que Laravel resulta más apropiado cuando se busca **productividad, organización, seguridad y escalabilidad en una aplicación de mayor tamaño**.
