# 🛒 Tienda de Negocios

## 📋 Descripción del Proyecto

**Tienda de Negocios** es una aplicación web desarrollada con Laravel que permite gestionar productos de una tienda. El sistema proporciona funcionalidades básicas para administrar el inventario de productos.

## 🚀 Estado Actual del Proyecto

### Funcionalidades Implementadas
- ✅ Configuración del sistema de rutas
- ✅ Conexión a base de datos MySQL
- ✅ Controlador de Productos
- ✅ Modelo Producto, Usuario, Categoría, Carrito
- ✅ Migración de la tablas Usuario, Producto, Categoría, Carrito.
- ✅ Definir Relaciones en los modelos
- ✅ Crear controlador de Usuarios, Categoría, Carrito
- ✅ Implementación de CRUD completo Producto, Categoría, Usuario, Carrito
- ✅ Vistas para gestión de productos con rutas (routes/api.php)
- ✅ Comparación de arquitecturas MVC
- ✅ Validaciones de formularios
- ✅ Validar datos
- ✅ Analizar y documentar el flujo de información de Laravel.


### 🔄 Próximos Pasos
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

## ⚙️ Instalación y ejecución del proyecto


### 1. Clonar el repositorio
```bash
git clone https://github.com/hectordsol/tienda-negocios.git
cd tienda-negocios
```

### 2. Instalar dependencias

```bash
composer install
```
No requiere parámetros obligatorios para este caso.

¿Qué hace?
Lee el archivo composer.json y descarga las dependencias necesarias del proyecto. Entre ellas se encuentra el framework Laravel. Las dependencias se instalan normalmente en el directorio vendor/.

Resultado:
Se genera o actualiza el directorio:

vendor/

y queda disponible el autoloader de Composer para que Laravel pueda cargar sus clases.


### 3. Configuración de base de datos para probar

Antes de ejecutar las migraciones es necesario configurar las variables de conexión en .env:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tienda_negocios
DB_USERNAME=root
DB_PASSWORD=
```

Crear base de datos "tienda-negocios" en MySQL

### 4. Ejecutar las migraciones

```bash
php artisan migrate 
```

Si el proyecto dispone de seeders:

```bash
php artisan migrate --seed
```
Esto ejecuta las migraciones pendientes y, posteriormente, los seeders definidos por el proyecto.
Los seeders se encuentran normalmente en:

database/seeders/

Resultado:
Además de crear la estructura de la base de datos, se pueden insertar datos iniciales necesarios para comenzar a utilizar la aplicación.


### 5. Iniciar el servidor de desarrollo

```bash
php artisan serve
```
No requiere parámetros para el funcionamiento básico.

¿Qué hace?
Inicia el servidor de desarrollo de Laravel para poder acceder a la aplicación desde el navegador.

Resultado:
La aplicación queda disponible normalmente en:

http://127.0.0.1:8000


## 🌐 Documentación de Rutas (API)
La API de Tienda de Negocios está definida en el archivo routes/api.php y sigue el estándar RESTful. Todas las rutas devuelven respuestas en formato JSON.

Convenciones Generales
Base URL: http://localhost:8000/api

Formato de Respuesta: JSON.

Códigos de Estado: Se utilizan los estándares HTTP (200 OK, 201 Creado, 404 No Encontrado, 422 Error de Validación, etc.).

Autenticación: (Pendiente de implementar. Por ahora, las rutas son públicas).

### 📦 Recursos
1. Categorías
Endpoints para la gestión del catálogo de categorías.

Método	Endpoint	Controlador	Método	Descripción
GET	/api/categorias	CategoriaController	index()	Lista todas las categorías.
POST	/api/categorias	CategoriaController	store()	Crea una nueva categoría.
GET	/api/categorias/{id}	CategoriaController	show()	Muestra los detalles de una categoría específica.
PUT/PATCH	/api/categorias/{id}	CategoriaController	update()	Actualiza una categoría existente.
DELETE	/api/categorias/{id}	CategoriaController	destroy()	Elimina una categoría.


## Comparación de proyecto PHP con Laravel

### 🔄 Comparación de arquitecturas MVC

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


## 🔄 Flujo de una petición en Laravel

Laravel utiliza una arquitectura basada en **MVC (Modelo–Vista–Controlador)**. El flujo básico de información puede resumirse de la siguiente manera:

```text
Petición HTTP
     │
     ▼
routes/web.php
     │
     ▼
Controlador
     │
     ▼
Modelo ──────► Base de datos
     │
     ▼
Vista Blade
     │
     ▼
Respuesta HTTP
     │
     ▼
Navegador / Cliente
```

### 1. Petición HTTP

El cliente (navegador, Postman, aplicación frontend, etc.) realiza una petición HTTP, por ejemplo:

```text
GET /productos
```

Laravel recibe la petición a través de su punto de entrada y comienza a determinar qué acción debe ejecutar.

### 2. Ruta

El sistema de rutas busca una coincidencia en `routes/web.php` o `routes/api.php`.

Por ejemplo:

```php
Route::get('/productos', [ProductoController::class, 'index']);
```

La ruta indica que una petición `GET /productos` debe ser atendida por el método `index()` de `ProductoController`.

### 3. Controlador

El controlador recibe la petición y coordina la lógica necesaria.

```php
public function index()
{
    $productos = Producto::all();

    return view('productos.index', compact('productos'));
}
```

El controlador actúa como intermediario entre la petición, los modelos y la respuesta.

### 4. Modelo

El modelo representa los datos de la aplicación y permite interactuar con la base de datos mediante **Eloquent ORM**.

```php
$productos = Producto::all();
```

En este caso, `Producto` consulta los registros correspondientes en la base de datos y devuelve la información al controlador.

### 5. Vista

El controlador puede enviar los datos obtenidos a una vista **Blade**:

```php
return view('productos.index', compact('productos'));
```

Laravel busca entonces:

```text
resources/views/productos/index.blade.php
```

La vista utiliza los datos recibidos para generar el contenido HTML.

### 6. Respuesta HTTP

Finalmente, Laravel genera una respuesta HTTP y la devuelve al cliente.

```text
Cliente
   │
   │ GET /productos
   ▼
Ruta
   │
   ▼
ProductoController@index
   │
   ▼
Producto (Eloquent)
   │
   ▼
Base de datos
   │
   ▼
ProductoController
   │
   ▼
Blade
   │
   ▼
HTML
   │
   ▼
Respuesta HTTP
```

### 🎯 Resumen

En términos simples:

**Ruta → Controlador → Modelo → Base de datos → Controlador → Vista → Respuesta**

La **ruta** determina qué controlador debe atender la petición; el **controlador** coordina la operación; el **modelo** permite acceder a los datos; y la **vista** presenta esos datos al usuario. Finalmente, Laravel devuelve el resultado como una respuesta HTTP.

> En una API REST que devuelve JSON, normalmente no interviene una vista Blade. El flujo sería, de forma simplificada: **Ruta → Controlador → Modelo → JSON → Cliente**.


## 📡 API REST

La aplicación dispone de una API REST para gestionar **categorías, productos, usuarios y carritos**.

Los endpoints se encuentran definidos en `routes/api.php` y utilizan los métodos HTTP:

- `GET` → consultar información
- `POST` → crear registros
- `PUT` → actualizar registros
- `DELETE` → eliminar registros

La respuesta de la API se devuelve en formato **JSON**.

### URL base

Durante el desarrollo local:

```text
http://127.0.0.1:8000/api
```

Por ejemplo:

```text
GET http://127.0.0.1:8000/api/categorias
```

---

# 🏷️ Categorías

Las categorías permiten clasificar los productos de la tienda.

### Obtener todas las categorías

```http
GET /api/categorias
```

**Parámetros:** ninguno.

**Controlador:** `CategoriaController@index`

**Respuesta exitosa:**

```json
[
    {
        "id": 1,
        "nombre": "Electrónica",
        "slug": "electronica",
        "descripcion": "Productos electrónicos"
    }
]
```

El método obtiene todas las categorías mediante `Categoria::all()` y devuelve el resultado como JSON.

### Obtener una categoría

```http
GET /api/categorias/{id}
```

**Parámetros de URL:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador de la categoría |

Ejemplo:

```http
GET /api/categorias/1
```

**Respuesta exitosa:** `200 OK`

```json
{
    "id": 1,
    "nombre": "Electrónica",
    "slug": "electronica",
    "descripcion": "Productos electrónicos"
}
```

Si la categoría no existe:

```json
{
    "message": "Categoría no encontrada"
}
```

Código HTTP: `404 Not Found`.

### Crear una categoría

```http
POST /api/categorias
```

**Body JSON:**

```json
{
    "nombre": "Electrónica",
    "slug": "electronica",
    "descripcion": "Productos electrónicos"
}
```

**Parámetros:**

| Campo | Tipo | Obligatorio | Descripción |
|---|---|---|---|
| `nombre` | string | Sí | Nombre de la categoría |
| `slug` | string | Sí | Identificador utilizado en la URL |
| `descripcion` | string | No | Descripción de la categoría |

El `slug` debe ser único dentro de la tabla `categorias`.

**Respuesta exitosa:** `201 Created`

```json
{
    "id": 1,
    "nombre": "Electrónica",
    "slug": "electronica",
    "descripcion": "Productos electrónicos"
}
```

### Actualizar una categoría

```http
PUT /api/categorias/{id}
```

**Parámetro de URL:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador de la categoría |

**Body JSON:**

```json
{
    "nombre": "Electrónica y tecnología",
    "slug": "electronica-tecnologia",
    "descripcion": "Productos electrónicos y tecnológicos"
}
```

Los campos `nombre` y `slug` son obligatorios en la validación actual; `descripcion` es opcional.

**Respuesta exitosa:** `200 OK`

Devuelve la categoría actualizada en formato JSON.

Si no existe:

```json
{
    "message": "Categoría no encontrada"
}
```

Código HTTP: `404 Not Found`.

### Eliminar una categoría

```http
DELETE /api/categorias/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador de la categoría |

**Respuesta exitosa:** `200 OK`

```json
{
    "message": "Categoría eliminada"
}
```

Si no existe:

```json
{
    "message": "Categoría no encontrada"
}
```

Código HTTP: `404 Not Found`.

---

# 📦 Productos

Los productos representan los artículos disponibles en la tienda.

### Obtener todos los productos

```http
GET /api/productos
```

**Parámetros:** ninguno.

**Controlador:** `ProductoController@index`

**Respuesta:** `200 OK`

Devuelve un array JSON con todos los productos.

### Obtener un producto

```http
GET /api/productos/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del producto |

Ejemplo:

```http
GET /api/productos/1
```

Si existe, devuelve el producto:

```json
{
    "id": 1,
    "nombre": "Notebook",
    "descripcion": "Notebook para uso general",
    "precio": 850000,
    "stock": 10,
    "categoria_id": 1
}
```

Si no existe:

```json
{
    "message": "Producto no encontrado"
}
```

Código HTTP: `404 Not Found`.

### Crear un producto

```http
POST /api/productos
```

**Body JSON:**

```json
{
    "nombre": "Notebook",
    "descripcion": "Notebook para uso general",
    "precio": 850000,
    "stock": 10,
    "categoria_id": 1
}
```

**Parámetros:**

| Campo | Tipo | Obligatorio | Restricciones |
|---|---|---|---|
| `nombre` | string | Sí | Máximo 255 caracteres |
| `descripcion` | string | No | Texto |
| `precio` | numeric | Sí | Mayor o igual a 0 |
| `stock` | integer | Sí | Mayor o igual a 0 |
| `categoria_id` | integer | Sí | Debe existir en `categorias` |

Estas reglas están implementadas mediante `StoreProductoRequest`.

**Respuesta exitosa:** `201 Created`

Devuelve el producto creado en formato JSON.

### Actualizar un producto

```http
PUT /api/productos/{producto}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `producto` | integer | Identificador del producto |

Ejemplo:

```http
PUT /api/productos/1
```

**Body JSON:**

```json
{
    "precio": 900000,
    "stock": 8
}
```

En la actualización, los campos pueden enviarse de forma parcial mediante `sometimes`. Los campos disponibles son `nombre`, `descripcion`, `precio`, `stock` y `categoria_id`.

**Respuesta exitosa:** `200 OK`

Devuelve el producto actualizado.

### Eliminar un producto

```http
DELETE /api/productos/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del producto |

**Respuesta exitosa:**

```json
{
    "message": "Producto eliminado"
}
```

Si no existe:

```json
{
    "message": "Producto no encontrado"
}
```

Código HTTP: `404 Not Found`.

---

# 👤 Usuarios

Los usuarios representan las personas registradas en la aplicación.

### Obtener todos los usuarios

```http
GET /api/usuarios
```

**Parámetros:** ninguno.

**Respuesta:** `200 OK`

Devuelve el listado de usuarios en formato JSON.

### Obtener un usuario

```http
GET /api/usuarios/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del usuario |

Ejemplo:

```http
GET /api/usuarios/1
```

Si no existe:

```json
{
    "message": "Usuario no encontrado"
}
```

Código HTTP: `404 Not Found`.

### Crear un usuario

```http
POST /api/usuarios
```

**Body JSON:**

```json
{
    "nombre": "Juan",
    "apellido": "Pérez",
    "email": "juan@example.com",
    "password": "12345678"
}
```

**Parámetros:**

| Campo | Tipo | Obligatorio | Restricciones |
|---|---|---|---|
| `nombre` | string | Sí | Máximo 255 caracteres |
| `apellido` | string | Sí | Máximo 255 caracteres |
| `email` | string | Sí | Email válido y único |
| `password` | string | Sí | Mínimo 8 caracteres |

Estas reglas están implementadas en `UsuarioController`.

**Respuesta exitosa:** `201 Created`

Devuelve el usuario creado en formato JSON.

### Actualizar un usuario

```http
PUT /api/usuarios/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del usuario |

**Body JSON:**

```json
{
    "nombre": "Juan",
    "apellido": "Pérez",
    "email": "juan.perez@example.com",
    "password": "nueva-clave"
}
```

Los campos son validados de la misma forma que en la creación.

**Respuesta exitosa:** `200 OK`

Devuelve el usuario actualizado.

### Eliminar un usuario

```http
DELETE /api/usuarios/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del usuario |

**Respuesta exitosa:**

```json
{
    "message": "Usuario eliminado"
}
```

Si no existe:

```json
{
    "message": "Usuario no encontrado"
}
```

Código HTTP: `404 Not Found`.

---

# 🛒 Carrito

El carrito relaciona un usuario con un producto y registra la cantidad solicitada.

### Obtener todos los carritos

```http
GET /api/carrito
```

**Parámetros:** ninguno.

**Respuesta:** `200 OK`

Devuelve todos los registros del carrito.

### Obtener un carrito

```http
GET /api/carrito/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del carrito |

Ejemplo:

```http
GET /api/carrito/1
```

Si no existe:

```json
{
    "message": "Carrito no encontrado"
}
```

Código HTTP: `404 Not Found`.

### Crear un registro de carrito

```http
POST /api/carrito
```

**Body JSON:**

```json
{
    "usuario_id": 1,
    "producto_id": 3,
    "cantidad": 2
}
```

**Parámetros:**

| Campo | Tipo | Obligatorio | Restricciones |
|---|---|---|---|
| `usuario_id` | integer | Sí | Debe existir en `usuarios` |
| `producto_id` | integer | Sí | Debe existir en `productos` |
| `cantidad` | integer | Sí | Mínimo 1 |

Estas reglas están implementadas en `CarritoController`.

**Respuesta exitosa:** `201 Created`

Devuelve el registro creado en formato JSON.

### Actualizar un carrito

```http
PUT /api/carrito/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del registro |

**Body JSON:**

```json
{
    "usuario_id": 1,
    "producto_id": 3,
    "cantidad": 5
}
```

Los tres campos son obligatorios y se validan antes de realizar la actualización.

**Respuesta exitosa:** `200 OK`

Devuelve el registro actualizado.

### Eliminar un carrito

```http
DELETE /api/carrito/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del registro |

**Respuesta exitosa:**

```json
{
    "message": "Carrito eliminado"
}
```

Si no existe:

```json
{
    "message": "Carrito no encontrado"
}
```

Código HTTP: `404 Not Found`.

---

# 📋 Resumen de endpoints

| Recurso | Método | Endpoint | Operación |
|---|---|---|---|
| Categorías | GET | `/api/categorias` | Listar |
| Categorías | GET | `/api/categorias/{id}` | Obtener |
| Categorías | POST | `/api/categorias` | Crear |
| Categorías | PUT | `/api/categorias/{id}` | Actualizar |
| Categorías | DELETE | `/api/categorias/{id}` | Eliminar |
| Productos | GET | `/api/productos` | Listar |
| Productos | GET | `/api/productos/{id}` | Obtener |
| Productos | POST | `/api/productos` | Crear |
| Productos | PUT | `/api/productos/{producto}` | Actualizar |
| Productos | DELETE | `/api/productos/{id}` | Eliminar |
| Usuarios | GET | `/api/usuarios` | Listar |
| Usuarios | GET | `/api/usuarios/{id}` | Obtener |
| Usuarios | POST | `/api/usuarios` | Crear |
| Usuarios | PUT | `/api/usuarios/{id}` | Actualizar |
| Usuarios | DELETE | `/api/usuarios/{id}` | Eliminar |
| Carrito | GET | `/api/carrito` | Listar |
| Carrito | GET | `/api/carrito/{id}` | Obtener |
| Carrito | POST | `/api/carrito` | Crear |
| Carrito | PUT | `/api/carrito/{id}` | Actualizar |
| Carrito | DELETE | `/api/carrito/{id}` | Eliminar |

Las rutas anteriores corresponden a las definidas actualmente en `routes/api.php` del proyecto.

## 🧪 Ejemplo de prueba

Por ejemplo, para consultar las categorías desde un cliente como Postman:

```http
GET http://127.0.0.1:8000/api/categorias
Accept: application/json
```

Para crear una categoría:

```http
POST http://127.0.0.1:8000/api/categorias
Content-Type: application/json
Accept: application/json
```

Body:

```json
{
    "nombre": "Electrónica",
    "slug": "electronica",
    "descripcion": "Productos electrónicos"
}
```

La API procesa la petición mediante la ruta correspondiente, ejecuta el método del controlador y devuelve una respuesta JSON.

## ⚠️ Validaciones y errores

Los endpoints que reciben datos realizan validaciones antes de modificar la base de datos.

Si los datos enviados no cumplen las reglas de validación, Laravel devuelve una respuesta de error de validación. Por ejemplo, un producto requiere `nombre`, `precio`, `stock` y una `categoria_id` existente.

Los recursos que no son encontrados devuelven:

```json
{
    "message": "Recurso no encontrado"
}
```

con código HTTP `404 Not Found`, utilizando mensajes específicos para cada entidad.

### Códigos HTTP utilizados

| Código | Significado |
|---|---|
| `200 OK` | Operación realizada correctamente |
| `201 Created` | Registro creado correctamente |
| `404 Not Found` | Recurso solicitado inexistente |
| `422 Unprocessable Entity` | Datos enviados que no superan la validación |


## 👨‍💻 Desarrollador
Nombre del desarrollador - [Héctor Darío Sol]
