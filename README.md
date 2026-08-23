# 🛒 Tienda de Negocios

## 📋 Descripción del Proyecto

**Tienda de Negocios** es una aplicación backend desarrollada con Laravel que permite gestionar productos de una tienda. El sistema proporciona funcionalidades básicas para administrar el inventario de productos, categorías de productos, usuarios, carritos de usuario.

## 🚀 Estado Actual del Proyecto

### Funcionalidades Implementadas
- ✅ Configuración del sistema de rutas
- ✅ Conexión a base de datos MySQL
- ✅ Modelo Producto, Usuario, Categoría, Carrito, Carritoitem
- ✅ Migración de la tablas Usuario, Producto, Categoría, Carrito y Carritoitem.
- ✅ Definir Relaciones en los modelos
- ✅ Crear Resource controlador de Usuarios, Categoría, Carrito, Producto
- ✅ Implementación de CRUD completo Producto, Categoría, Usuario, Carrito
- ✅ Vistas para gestión de productos con rutas (routes/api.php)
- ✅ Validar datos con Requests
- ✅ Busquedas personalizadas
- ✅ Diseñar en Productos DTO (Data Transfer Object)


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
│   │       ├──Api
│   │       │   └──V1
│   │       │       ├── CarritoController.php
│   │       │       ├── CategoriaController.php
│   │       │       ├── ProductoController.php
│   │       │       └── UsuarioController.php
│   │       ├──Controller.php
│   │       ├── Requests/
│   │       │   ├── StoreCarritoRequest.php
│   │       │   ├── StoreCategoriaRequest.php
│   │       │   ├── StoreProductoRequest.php
│   │       │   ├── StoreUsuarioRequest.php
│   │       │   ├── UpdateCategoriaRequest.php
│   │       │   ├── UpdateProductoRequest.php
│   │       │   └── UpdateUsuarioRequest.php
│   │       └── Resources/
│   │           └──ProductoResource.php
│   ├── Models/
│   │   ├── Carrito.php
│   │   ├── Carritoitem.php
│   │   ├── Categoria.php
│   │   ├── Producto.php
│   │   └── Usuario.php
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   └── Services/
│       └── ProductoService.php
├── database/
│   ├── migrations/
│   │   ├── [timestamp]_create_usuarios_table.php
│   │   ├── [timestamp]_create_productos_table.php
│   │   ├── [timestamp]_create_categorias_table.php
│   │   ├── [timestamp]_create_productos_table.php
│   │   ├── [timestamp]_add_categoria_id_productos_table
│   │   ├── [timestamp]_create_carritos_table.php
│   │   └── [timestamp]_create_carritositems_table.php
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

Sembrar semillas con los seeders:

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
Base URL: http://localhost:8000/api/v1

Formato de Respuesta: JSON.

Códigos de Estado: Se utilizan los estándares HTTP (200 OK, 201 Creado, 204 eliminado OK, 404 No Encontrado, 422 Error de Validación, etc.).

Autenticación: (Pendiente de implementar. Por ahora, las rutas son públicas).

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
http://127.0.0.1:8000/api/v1
```

Por ejemplo:

```text
GET http://127.0.0.1:8000/api/v1/categorias
```

---

# 🏷️ Categorías

Las categorías permiten clasificar los productos de la tienda.

### Obtener todas las categorías

```http
GET http://127.0.0.1:8000/api/v1/categorias
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
GET http://127.0.0.1:8000/api/v1/categorias/{id}
```

**Parámetros de URL:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador de la categoría |

Ejemplo:

```http
GET http://127.0.0.1:8000/api/v1/categorias/1
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
    "message": "Recurso no encontrado",
    "status": 404,
    "errors": {
        "error": "No query results for model [App\\Models\\Categoria] 122"
    }
}
```

Código HTTP: `404 Not Found`.

### Crear una categoría

```http
POST http://127.0.0.1:8000/api/v1/categorias
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
PUT http://127.0.0.1:8000/api/v1/categorias/{id}
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
    "message": "Recurso no encontrado",
    "status": 404,
    "errors": {
        "error": "No query results for model [App\\Models\\Categoria] 122"
    }
}
```

Código HTTP: `404 Not Found`.

### Eliminar una categoría

```http
DELETE http://127.0.0.1:8000/api/v1/categorias/{id}
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
    "message": "Recurso no encontrado",
    "status": 404,
    "errors": {
        "error": "No query results for model [App\\Models\\Categoria] 122"
    }
}
```

Código HTTP: `404 Not Found`.

---

# 📦 Productos

Los productos representan los artículos disponibles en la tienda.

### Obtener todos los productos

```http
GET http://127.0.0.1:8000/api/v1/productos
```

**Parámetros:** ninguno.

**Controlador:** `ProductoController@index`

**Respuesta:** `200 OK`

Devuelve un array JSON con todos los productos.

### Obtener un producto

```http
GET http://127.0.0.1:8000/api/v1/productos/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del producto |

Ejemplo:

```http
GET http://127.0.0.1:8000/api/v1/productos/1
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
POST http://127.0.0.1:8000/api/v1/productos
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
PUT http://127.0.0.1:8000/api/v1/productos/{producto}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `producto` | integer | Identificador del producto |

Ejemplo:

```http
PUT http://127.0.0.1:8000/api/v1/productos/1
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
DELETE http://127.0.0.1:8000/api/v1/productos/{id}
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
GET http://127.0.0.1:8000/api/v1/usuarios
```

**Parámetros:** ninguno.

**Respuesta:** `200 OK`

Devuelve el listado de usuarios en formato JSON.

### Obtener un usuario

```http
GET http://127.0.0.1:8000/api/v1/usuarios/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del usuario |

Ejemplo:

```http
GET http://127.0.0.1:8000/api/v1/usuarios/1
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
POST http://127.0.0.1:8000/api/v1/usuarios
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
PUT http://127.0.0.1:8000/api/v1/usuarios/{id}
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
DELETE http://127.0.0.1:8000/api/v1/usuarios/{id}
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
GET http://127.0.0.1:8000/api/v1/carritos
```

**Parámetros:** ninguno.

**Respuesta:** `200 OK`

Devuelve todos los registros del carrito.

### Obtener un carrito

```http
GET http://127.0.0.1:8000/api/v1/carritos/{usuario_id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del carrito |

Ejemplo:

```http
GET /api/carritos/1
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
POST http://127.0.0.1:8000/api/v1/carritos/
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
PUT http://127.0.0.1:8000/api/v1/carritos/{id}
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
DELETE http://127.0.0.1:8000/api/v1/carritos/{usuario_id}/productos/{producto_id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del registro |

**Respuesta exitosa:**

```json
{
    "message": "Producto de Carrito eliminado"
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
| Categorías | GET | `/api/v1/categorias` | Listar |
| Categorías | GET | `/api/v1/categorias/{id}` | Obtener |
| Categorías | POST | `/api/v1/categorias` | Crear |
| Categorías | PUT | `/api/v1/categorias/{id}` | Actualizar |
| Categorías | DELETE | `/api/v1/categorias/{id}` | Eliminar |
| Productos | GET | `/api/v1/productos` | Listar |
| Productos | GET | `/api/v1/productos/{id}` | Obtener |
| Productos | POST | `/api/v1/productos` | Crear |
| Productos | PUT | `/api/v1/productos/{producto}` | Actualizar |
| Productos | DELETE | `/api/v1/productos/{id}` | Eliminar |
| Usuarios | GET | `/api/v1/usuarios` | Listar |
| Usuarios | GET | `/api/v1/usuarios/{id}` | Obtener |
| Usuarios | POST | `/api/v1/usuarios` | Crear |
| Usuarios | PUT | `/api/v1/usuarios/{id}` | Actualizar |
| Usuarios | DELETE | `/api/v1/usuarios/{id}` | Eliminar |
| Carrito | GET | `/api/v1/carritos` | Listar |
| Carrito | GET | `/api/v1/carritos/{usuario_id}` | Obtener |
| Carrito | POST | `/api/v1/carritos` | Crear |
| Carrito | PUT | `/api/v1/carritos/{usuario_id}/productos/{producto_id}` | Actualizar un producto|
| Carrito | PUT | `/api/v1/carritos/{usuario_id}` | Actualizar |
| Carrito | DELETE | `/api/v1/carritos/{usuario_id}/productos/{producto_id}` | Eliminar un producto|
| Carrito | DELETE | `/api/v1/carritos/{id}` | Eliminar |

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
| `204 Deleted` | Registro borrado correctamente |
| `404 Not Found` | Recurso solicitado inexistente |
| `422 Unprocessable Entity` | Datos enviados que no superan la validación |


## 👨‍💻 Desarrollador
Nombre del desarrollador - [Héctor Darío Sol]
