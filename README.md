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
- ✅ Implementar registro, login, logout
- ✅ Proteger rutas
- ✅ Middleware globales y locales
- ✅ Almacenar contraseñas seguras



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
│   ├── DTO/
│   │   ├── CarritoDTO.php
│   │   ├── CarritoitemDTO.php
│   │   └── ProductoDTO.php
│   ├── Exceptions/
│   │   └── ApiException.php
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Api
│   │       │   └──V1
│   │       │       ├── AuthController.php
│   │       │       ├── CarritoController.php
│   │       │       ├── CategoriaController.php
│   │       │       ├── ProductoController.php
│   │       │       └── UsuarioController.php
│   │       ├── Controller.php
│   │       ├── Middleware
│   │       │   └── IsAdmin.php
│   │       ├── Requests/
│   │       │   ├── StoreCarritoRequest.php
│   │       │   ├── StoreCategoriaRequest.php
│   │       │   ├── StoreProductoRequest.php
│   │       │   ├── StoreUsuarioRequest.php
│   │       │   ├── UpdateCategoriaRequest.php
│   │       │   ├── UpdateProductoRequest.php
│   │       │   └── UpdateUsuarioRequest.php
│   │       └── Resources/
│   │           ├──CarritoitemResource.php
│   │           ├──CarritoResource.php
│   │           ├──ProductoResource.php
│   │           └──ResumenCarritoResource.php
│   ├── Models/
│   │   ├── Carrito.php
│   │   ├── Carritoitem.php
│   │   ├── Categoria.php
│   │   ├── Producto.php
│   │   └── Usuario.php
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   └── Services/
│       ├── CarritoitemService.php
│       ├── CarritoService.php
│       ├── ProductoService.php
│       └── ResumenCarritoService.php
├── bootstrap/
│   ├── cache/
│   └── app.php <-exceptions with middleware
├── database/
│   ├── migrations/
│   │   ├── [timestamp]_create_usuarios_table.php
│   │   ├── [timestamp]_create_productos_table.php
│   │   ├── [timestamp]_create_categorias_table.php
│   │   ├── [timestamp]_create_productos_table.php
│   │   ├── [timestamp]_add_categoria_id_productos_table
│   │   ├── [timestamp]_create_carritos_table.php
│   │   ├── [timestamp]_create_carritositems_table.php
│   │   └── [timestamp]_allow_multiple_carts_per_user
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
├── tests/
│   ├── Feature
│   │    ├── AutenticacionApiTest.php
│   │    ├── CarritoCheckoutApiTest.php
│   │    ├── CarritoItemExistsTest.php
│   │    ├── CategoriaApiTest.php
│   │    ├── ProductoApiTest.php
│   │    └── UsuarioApiTest.php
│   └── Unit
│        ├── ExampleTest.php
│        └── ResumenCarritoTest.php
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

http://127.0.0.1:8000 o http://localhost:8000


## 🌐 Documentación de Rutas (API)
La API de Tienda de Negocios está definida en el archivo routes/api.php y sigue el estándar RESTful. Todas las rutas devuelven respuestas en formato JSON.

Convenciones Generales:

Base URL: http://localhost:8000/api/v1
Formato de Respuesta: JSON.

Códigos de Estado: Se utilizan los estándares HTTP (200 OK, 201 Creado, 204 eliminado OK, 404 No Encontrado, 422 Error de Validación, etc.).

Autenticación: Implementado con JWT.

## 📡 API REST

La aplicación dispone de una API REST para gestionar **categorías, productos, usuarios, login, carrito y checKout de carrito**.

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
GET http://127.0.0.1:8000/api/v1/productos
```
Esta ruta no está protegida por lo que cualquier ususario pueda ver una lista de productos ordenado por id, o para ser manipulada y filtrada:
```json
[
    {
        "id": 1,
        "nombre": "Producto1",
        "descripcion": "Descripción del producto de ejemplo1",
        "precio": 19.99,
        "disponible": true,
        "actualizado": "28-08-2026 04:08:04",
        "categoria_id": 1
    },
    {
        "id": 2,
        "nombre": "Producto2",
        "descripcion": "Descripción del producto de ejemplo2",
        "precio": 19.99,
        "disponible": true,
        "actualizado": "28-08-2026 04:08:04",
        "categoria_id": 1
    },
    ...

    {
        "id": 15,
        "nombre": "Producto de ejemplo18",
        "descripcion": "Descripción del producto de ejemplo18",
        "precio": 12,
        "disponible": true,
        "actualizado": "28-08-2026 19:01:48",
        "categoria_id": 7
    }
]
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)

**Endpoint:** `GET /api/v1/productos/{id}`

**Parámetros de ruta:**

| Parámetro | Tipo   | Descripción                    | Obligatorio |
|-----------|--------|--------------------------------|-------------|
| `id`      | Entero | ID único del producto a consultar | Sí          |

```text
GET /api/v1/productos/1

```
Esta consulta del producto id 1 devuelve:
```json
    {
        "id": 1,
        "nombre": "Producto1",
        "descripcion": "Descripción del producto de ejemplo1",
        "precio": 19.99,
        "disponible": true,
        "actualizado": "28-08-2026 04:08:04",
        "categoria_id": 1
    }
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)

# 🔐 Autenticación con JWT (JSON Web Tokens)

La API utiliza JWT (JSON Web Tokens) para manejar la autenticación de usuarios de manera segura y sin estado. A diferencia de las sesiones tradicionales, el servidor no guarda el estado de la sesión del usuario; toda la información necesaria está contenida en el propio token.

## 📦 Dependencia Principal
El proyecto utiliza el paquete 'php-open-source-saver/jwt-auth' para la implementación de JWT en Laravel.

"php-open-source-saver/jwt-auth": "^2.9"

```bash
composer require php-open-source-saver/jwt-auth
```

## 📋 Estructura del Token JWT
Un token JWT está compuesto por tres partes codificadas en Base64, separadas por puntos (.):

```text
[HEADER].[PAYLOAD].[SIGNATURE]
```

### 1. HEADER (Encabezado)
Contiene el tipo de token y el algoritmo de firma utilizado.

```json
{
  "alg": "HS256",
  "typ": "JWT"
}
```

### 2. PAYLOAD (Cuerpo)
Contiene los claims (declaraciones) sobre el usuario y metadatos del token. En nuestro proyecto, el payload incluye:


| Claim | Descripción | Ejemplo |
|---|---|---|
| `sub` (Subject) | Identificador del usuario (su ID) | 1 |
| `iat` (Issued At) | Momento en que se emitió el token (timestamp) | 1692892800 |
| `exp` (Expiration | Time) Momento en que el token expira (timestamp) | 1692896400 |
| `nbf` (Not Before) | Momento a partir del cual el token es válido | 1692892800 |
| `jti` (JWT ID) | Identificador único del token | f8d5e6a... |
| `user_data` (Opcional) | Datos básicos del usuario (para evitar consultas) | { "email": "juan@example.com" } |

Ejemplo de Payload decodificado:

```json
{
  "sub": 1,
  "iat": 1692892800,
  "exp": 1692896400,
  "nbf": 1692892800,
  "jti": "f8d5e6a9-8b5c-4a3d-9e2f-1a2b3c4d5e6f",
  "user_data": {
    "id": 1,
    "email": "juan@example.com",
    "nombre": "Juan Pérez"
  }
}
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)

### 3. SIGNATURE (Firma)
La firma se genera combinando el header y el payload codificados con una clave secreta (JWT_SECRET en el archivo .env). Asegura que el token no haya sido alterado.

```text
HMACSHA256(
  base64UrlEncode(header) + "." + base64UrlEncode(payload),
  secret
)
```

## 🔄 Ciclo de Vida del Token
El ciclo de vida de un token JWT en la aplicación sigue los siguientes pasos:
```mermaid
sequenceDiagram
    participant U as Usuario
    participant C as Cliente (Frontend)
    participant A as API (Laravel)
    
    U->>C: Ingresa credenciales
    C->>A: POST /api/v1/login
    A->>A: Valida credenciales
    A->>A: Genera JWT
    A-->>C: Devuelve token (access_token)
    C->>C: Almacena token (localStorage/Session)
    
    loop Cada solicitud protegida
        C->>A: POST /api/v1/productos (Header: Authorization: Bearer <token>)
        A->>A: Valida firma y expiración
        A->>A: Identifica usuario
        A-->>C: Devuelve datos
    end
    
    U->>C: Cierra sesión
    C->>A: POST /api/v1/logout
    A->>A: Invalida token (opcional)
    A-->>C: Confirmación
```


## 1. Regristo de usuario (register)
Para que un usuario se registre debe solicitar a la ruta `/api/v1/register` con una petición POST, enviando los datos del usuario en formato JSON por Body:

```http
POST /api/v1/register
```

**Body JSON:**
```json
{
    "nombre" : "Analia",
    "apellido" : "Gonzalez",
    "email" : "analia@example.com",
    "password" : "password",
    "password_confirmation" : "password",
    "telefono" : "232332333",
    "domicilio" : "el domicilio usuario falso",
    "ciudad" : "Catriel",
    "codigo_postal" : "8203"
} 
```

Respuesta:

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3YxL3JlZ2lzdGVyIiwiaWF0IjoxNzg4NzQwNTYxLCJleHAiOjE3ODg3NDQxNjEsIm5iZiI6MTc4ODc0MDU2MSwianRpIjoiMEdHY1FlSDNpQ2RYYUh5TiIsInN1YiI6IjE2IiwicHJ2IjoiNTg3MDg2M2Q0YTYyZDc5MTQ0M2ZhZjkzNmZjMzY4MDMxZDExMGM0ZiJ9._9E2RAdlWvxvEyX8M1RkCxHktxJxFJvBIoQQtubj5MI",
    "token_type": "bearer",
    "expires_in": 3600,
    "usuario": {
        "nombre": "Analia",
        "apellido": "Gonzalez",
        "email": "analia@example.com",
        "telefono": "232332333",
        "ciudad": "Catriel",
        "codigo_postal": "8203",
        "updated_at": "2026-09-07T00:22:41.000000Z",
        "created_at": "2026-09-07T00:22:41.000000Z",
        "id": 16
    }
}
```
**Respuesta exitosa:** ![201 Created](https://img.shields.io/badge/201-Created-green)


## 2. Emisión (Firma y Verificación Inicial)

Endpoint: `POST /api/v1/login`
Content-Type: application/json

```json
{
    "email" : "analia@example.com",
    "password" : "password"
} 
```

Proceso:

- El usuario envía sus credenciales (email y password) al endpoint de login.

- El controlador valida las credenciales contra la base de datos.

- Si son correctas, se genera un nuevo JWT usando la clave secreta del servidor.

- El token se devuelve al cliente en la respuesta.


```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3YxL2xvZ2luIiwiaWF0IjoxNzg4NzQwNzYwLCJleHAiOjE3ODg3NDQzNjAsIm5iZiI6MTc4ODc0MDc2MCwianRpIjoiRk55dnl1TWt1SEpGQWVoViIsInN1YiI6IjE2IiwicHJ2IjoiNTg3MDg2M2Q0YTYyZDc5MTQ0M2ZhZjkzNmZjMzY4MDMxZDExMGM0ZiJ9.6otWPlLicZMy2ib0WV627-AWoY9KJmNL0jH5NZS99W8",
    "token_type": "bearer",
    "expires_in": 3600,
    "usuario": {
        "id": 16,
        "nombre": "Analia",
        "apellido": "Gonzalez",
        "email": "analia@example.com",
        "email_verified_at": null,
        "isadmin": false,
        "created_at": "2026-09-07T00:22:41.000000Z",
        "updated_at": "2026-09-07T00:22:41.000000Z",
        "telefono": "232332333",
        "direccion": null,
        "ciudad": "Catriel",
        "codigo_postal": "8203",
        "pais": "Argentina"
    }
}
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)


Ejemplo de Respuesta con credenciales erroneas:

```json
{
    "message": "no autenticado",
    "status": 401,
    "errors": {}
}
```
**Respuesta no exitosa:** ![401 Unauthorized](https://img.shields.io/badge/401-Unauthorized-red)

## 3. Almacenamiento en Cliente
El cliente (frontend) debe almacenar el token de forma segura. Las opciones comunes son:

- Almacenamiento en memoria: Para aplicaciones SPA.

- localStorage/sessionStorage: Fácil de implementar pero vulnerable a XSS.

- Cookies con flag HttpOnly: Más seguras contra XSS.

- Recomendación: Para APIs, usar el header Authorization con el token.

## 4. Verificación en Solicitudes Protegidas
Para acceder a rutas protegidas, el cliente debe incluir el token en el header de autorización.
Si un usuario intenta accedar a la ruta del profile, debería poder recibir su información.
Ejemplo de solicitud
```http
GET /api/v1/profile
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```

Proceso de Verificación en el Servidor (Middleware):

- El middleware jwt.auth intercepta la solicitud.

- Extrae el token del header Authorization.

- Verifica la firma del token usando JWT_SECRET.

- Comprueba que el token no haya expirado (revisa el claim exp).

- Si es válido, decodifica el payload y asocia el usuario a la solicitud.

- Si falla, devuelve un error 401 Unauthorized.

Si la respuesta es exitosa:
```json
{
    "id": 16,
    "nombre": "Analia",
    "apellido": "Gonzalez",
    "email": "analia@example.com",
    "email_verified_at": null,
    "isadmin": false,
    "created_at": "2026-09-07T00:22:41.000000Z",
    "updated_at": "2026-09-07T00:22:41.000000Z",
    "telefono": "232332333",
    "direccion": null,
    "ciudad": "Catriel",
    "codigo_postal": "8203",
    "pais": "Argentina"
}
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)

Si el usuario no está inició sesión debería devolver:

```json
{
    "message": "no autenticado",
    "status": 401,
    "errors": {}
}
```
**Respuesta no exitosa:** ![401 Unauthorized](https://img.shields.io/badge/401-Unauthorized-red)


## 5.Actualizar un usuario
Un usuario que inicia sesión puede solicitar actualizar información del perfil con una solicitud PUT, enviando por Body los datos a actualizar:
```http
PUT /api/v1/profile
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```

**Body JSON:**

```json
{
    "nombre": "Analia Nuevo",
    "apellido": "Gonzalez Modificado",
    "telefono": "2954929292",
    "direccion": "Calle Falsa 124",
    "ciudad": "Casa de Piedra",
    "codigo_postal": "C8201",
}

```
**Parámetros:**

| Campo | Tipo | Obligatorio | Descripción |
|---|---|---|---|
| `nombre` | string | No | Nombre del usuario opcional |
| `apellido` | string | No | Apellido del usuario opcional |
| `email` | string | Identifica el usuario como único|
| `telefono` | string | No | telefono opcional |
| `direccion` | string | No | direccion opcional |
| `ciudad` | string | No | ciudad opcional |
| `codigo_postal` | string | No | código postal opcional |
| `pais` | string | No | Por defecto es argentina |
| `isadmin` | string | No | Por defecto es false si no se envía el campo |


```json
{
    "id": 16,
    "nombre": "Analia Nuevo",
    "apellido": "Gonzalez Modificado",
    "email": "analia@example.com",
    "email_verified_at": null,
    "isadmin": false,
    "created_at": "2026-09-07T00:22:41.000000Z",
    "updated_at": "2026-09-07T00:23:22.000000Z",
    "telefono": "2954929292",
    "direccion": "Calle Falsa 124",
    "ciudad": "Casa de Piedra",
    "codigo_postal": "C8201",
    "pais": "Argentina"
}
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)

## 4. Expiración
Los tokens tienen un tiempo de vida limitado para reducir el riesgo de robo. La expiración se controla con el claim exp.

- Tiempo de expiración predeterminado: 1 hora (3600 segundos).

- Configurable en: config/jwt.php (ttl).

- Comportamiento al expirar: El cliente recibe un error 401 Unauthorized y debe solicitar un nuevo token (refrescar o volver a autenticar).


## 5. Invalidación (Logout)
El cierre de sesión puede manejar la invalidación del token de dos maneras:

- Invalidación en servidor: Se añade el token a una "lista negra" (blacklist) hasta que expire.

- Invalidación en cliente: El cliente simplemente elimina el token de su almacenamiento local.

- Endpoint: POST /api/v1/logout

Proceso:

- El cliente envía la solicitud con el token actual.

- El servidor invalida el token añadiéndolo a la blacklist (opcional).

- El cliente debe eliminar el token localmente.

Ejemplo:

```http
POST /api/v1/logout
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```
Respuesta:

```json
{
    "message": "Sesión cerrada exitosamente"
}
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)


# 🛡️ Seguridad y Buenas Prácticas

## Configuración de Clave Secreta. 

La clave JWT_SECRET en el archivo .env es fundamental para la firma de tokens. Debe ser única y mantenerse en secreto.

```env
JWT_SECRET=tu_clave_secreta_unica_y_larga
```
Generación:

```bash
php artisan jwt:secret
```

## Algoritmo de Firma
Por defecto, se utiliza HS256 (firma simétrica con clave secreta). Para entornos productivos, se recomienda usar algoritmos asimétricos como RS256.

## Claims Personalizados
Se pueden agregar claims adicionales al payload, como datos básicos del usuario, para evitar consultas adicionales a la base de datos en cada solicitud.

# 📚 Endpoints de Autenticación (Propuestos)

| Método | Endpoint | Descripción | Protección
|---|---|---|---|
| POST | /api/v1/login | Iniciar sesión y obtener token | Público |
| POST | /api/v1/register | Registrar nuevo usuario | Público |
| POST | /api/v1/logout | Cerrar sesión (invalidar token) | Privado (Bearer) |
| GET | /api/v1/profile | Obtener datos del usuario autenticado | Privado (Bearer) |
| PUT | /api/v1/profile | Actualizar datos del usuario autenticado | Privado (Bearer) |

---

# 🏷️ Categorías (CRUD disponible solo para administrador)

Las categorías permiten clasificar los productos de la tienda. Las rutas que manejan la información de las categorías de los productos están protegidas para que solo pueda manejarla si es usuario administrador. Cualquier acción en:

**Ruta categorías** `/api/v1/categorias`


**Cualquier acción en estas rutas si es un usuario y no es administrador devuelve:**

```json
{
    "error": "Sin permiso para esta acción"
}
```
**Respuesta no exitosa:** ![403 Forbidden](https://img.shields.io/badge/403-Forbidden-red)

**y si no hay usuario logueado devuelve:**
```json
{
    "message": "no autenticado",
    "status": 401,
    "errors": {}
}
```
**Respuesta no exitosa:** ![401 Unauthorized](https://img.shields.io/badge/401-Unauthorized-red)

### Obtener todas las categorías

```http
GET /api/v1/categorias
```
**Respuesta exitosa si es administrador Categorías envía:**

```json
[
    {
        "id": 1,
        "nombre": "Electrónica",
        "slug": "electronica",
        "descripcion": "Productos electrónicos como teléfonos, computadoras, televisores, etc.",
        "created_at": "2026-08-28T04:08:04.000000Z",
        "updated_at": "2026-08-28T04:08:04.000000Z"
    },
    {
        "id": 2,
        "nombre": "Indumentaria",
        "slug": "indumentaria",
        "descripcion": "Ropa para hombres, mujeres y niños.",
        "created_at": "2026-08-28T04:08:04.000000Z",
        "updated_at": "2026-08-28T04:08:04.000000Z"
    },
...
    {
        "id": 7,
        "nombre": "Belleza",
        "slug": "belleza",
        "descripcion": "Productos de belleza y cuidado personal.",
        "created_at": "2026-08-28T04:08:04.000000Z",
        "updated_at": "2026-08-28T04:08:04.000000Z"
    }
]
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)

El método obtiene todas las categorías mediante `Categoria::all()` y devuelve el resultado como JSON.

### Obtener una categoría

```http
GET /api/v1/categorias/{id}
```

**Parámetros de URL:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador de la categoría |

Ejemplo:

```http
GET /api/v1/categorias/1
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
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)


Si la categoría no existe:
```http
GET /api/v1/categorias/122
```

```json
{
    "message": "Recurso no encontrado",
    "status": 404,
    "errors": {
        "error": "No query results for model [App\\Models\\Categoria] 122"
    }
}
```
**Respuesta no exitosa:**  ![404 Not Found](https://img.shields.io/badge/404-Not_Found-red)

### Crear una categoría

```http
POST /api/v1/categorias
```

**Body JSON:**

```json
{
    "nombre" : "Supermercado",
    "slug" : "supermercado",
    "descripcion":"Artículos de almacen"
}
```

```json
{
    "nombre": "Supermercado",
    "slug": "supermercado",
    "descripcion": "Artículos de almacen",
    "updated_at": "2026-09-06T21:21:52.000000Z",
    "created_at": "2026-09-06T21:21:52.000000Z",
    "id": 8
}
```
**Respuesta exitosa:** ![201 Created](https://img.shields.io/badge/201-Created-green)


**Parámetros:**

| Campo | Tipo | Obligatorio | Descripción |
|---|---|---|---|
| `nombre` | string | Sí | Nombre de la categoría |
| `slug` | string | Sí | Identificador utilizado en la URL |
| `descripcion` | string | No | Descripción de la categoría |

El `slug` debe ser único dentro de la tabla `categorias`.

**Respuesta exitosa:**

```json
{
    "id": 1,
    "nombre": "Electrónica",
    "slug": "electronica",
    "descripcion": "Productos electrónicos"
}
```
Código HTTP: `201 Created`

### Actualizar una categoría

```http
PUT {{url_base}}/categorias/{categoria}
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

**Respuesta no exitosa:**  ![404 Not Found](https://img.shields.io/badge/404-Not_Found-red)

### Eliminar una categoría

```http
DELETE {{url_base}}/categorias/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador de la categoría |


```json
{
    "message": "Categoría eliminada"
}
```
**Respuesta exitosa:** ![204 No Content](https://img.shields.io/badge/204-No_Content-green)


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

**Respuesta no exitosa:** ![404 Not Found](https://img.shields.io/badge/404-Not_Found-red)

---


# 🏷️ Usuarios (CRUD disponible solo para administrador)
Las rutas que manejan la información de los usuarios de la tienda están protegidos para que solo pueda manejarla si es usuario administrador. Cualquier acción en:

**Ruta usuarios** `/api/v1/usuarios`

**Cualquier acción en esta ruta si es un usuario y no es administrador devuelve:**

```json
{
    "error": "Sin permiso para esta acción"
}
```
**Respuesta no exitosa:** ![403 Forbidden](https://img.shields.io/badge/403-Forbidden-red)

**y si no hay usuario logueado devuelve:**
```json
{
    "message": "no autenticado",
    "status": 401,
    "errors": {}
}
```
**Respuesta no exitosa:** ![401 Unauthorized](https://img.shields.io/badge/401-Unauthorized-red)


### Obtener todos los usuarios

```http
GET /api/v1/usuarios
```
**Respuesta exitosa si es administrador Categorías envía:**

```json
[
    {
        "id": 1,
        "nombre": "Usuario1",
        "apellido": "Apellido de ejemplo1",
        "email": "usuario1@example.com",
        "email_verified_at": null,
        "isadmin": true,
        "created_at": "2026-08-28T04:08:05.000000Z",
        "updated_at": "2026-08-28T04:08:05.000000Z",
        "telefono": null,
        "direccion": null,
        "ciudad": null,
        "codigo_postal": null,
        "pais": "Argentina"
    },
    {
        "id": 2,
        "nombre": "Usuario2",
        "apellido": "Apellido de ejemplo2",
        "email": "usuario2@example.com",
        "email_verified_at": null,
        "isadmin": false,
        "created_at": "2026-08-28T04:08:05.000000Z",
        "updated_at": "2026-08-28T04:08:05.000000Z",
        "telefono": null,
        "direccion": null,
        "ciudad": null,
        "codigo_postal": null,
        "pais": "Argentina"
    },
    ...
   {
        "id": 14,
        "nombre": "Maria",
        "apellido": "Lopez",
        "email": "maria@example.com",
        "email_verified_at": null,
        "isadmin": false,
        "created_at": "2026-09-06T00:01:52.000000Z",
        "updated_at": "2026-09-06T00:01:52.000000Z",
        "telefono": "2954929292",
        "direccion": "Calle Falsa 123",
        "ciudad": "Buenos Aires",
        "codigo_postal": "C1000",
        "pais": "Argentina"
    }
]
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)

El método obtiene todas las categorías mediante `Usuario::all()` y devuelve el resultado como JSON.

### Obtener una categoría o usuario

```http
GET /api/v1/usuarios/{id}
```

**Parámetros de URL:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador de la categoría |

Ejemplo:

```http
GET /api/v1/usuarios/1
```
Si el usuario existe:

```json
{
    "id": 1,
    "nombre": "Usuario1",
    "apellido": "Apellido de ejemplo1",
    "email": "usuario1@example.com",
    "email_verified_at": null,
    "isadmin": true,
    "created_at": "2026-08-28T04:08:05.000000Z",
    "updated_at": "2026-08-28T04:08:05.000000Z",
    "telefono": null,
    "direccion": null,
    "ciudad": null,
    "codigo_postal": null,
    "pais": "Argentina"
}
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)


Si el usuario no existe:
```http
GET /api/v1/usuarios/111
```

```json
{
    "message": "Recurso no encontrado",
    "status": 404,
    "errors": {
        "error": "No query results for model [App\\Models\\Usuario] 111"
    }
}
```
**Respuesta no exitosa:**  ![404 Not Found](https://img.shields.io/badge/404-Not_Found-red)

### Crear un usuario

```http
POST /api/v1/usuarios
```

**Body JSON:**

```json
{
    "nombre": "Pedro",
    "email": "pedro@example.com",
    "password" : "secret123",
    "password_confirmation" : "secret123",
    "apellido": "Martinez",
    "telefono": "2954929292",
    "direccion": "Calle Falsa 124",
    "ciudad": "Puelen",
    "codigo_postal": "C8201",
    "pais": "Argentina"
}
```

**Parámetros:**

| Campo | Tipo | Obligatorio | Descripción |
|---|---|---|---|
| `nombre` | string | Sí | Nombre del usuario |
| `apellido` | string | Sí | Apallido del usuario |
| `email` | string | Sí | Identificador del usuario como único |
| `password` | string | No | password necesita confirmación |
| `telefono` | string | No | telefono opcional |
| `direccion` | string | No | direccion opcional |
| `ciudad` | string | No | ciudad opcional |
| `codigo_postal` | string | No | código postal opcional |
| `pais` | string | No | Por defecto es argentina |
| `isadmin` | string | No | Por defecto es false si no se envía el campo |


El `email` debe ser único dentro de la tabla `usuarios`.

**Respuesta exitosa:**

```json
{
    "nombre": "Pedro",
    "apellido": "Martinez",
    "email": "pedro@example.com",
    "telefono": "2954929292",
    "direccion": "Calle Falsa 124",
    "ciudad": "Puelen",
    "codigo_postal": "C8201",
    "pais": "Argentina",
    "updated_at": "2026-09-06T22:45:14.000000Z",
    "created_at": "2026-09-06T22:45:14.000000Z",
    "id": 15
}
```
**Respuesta exitosa:** ![201 Created](https://img.shields.io/badge/201-Created-green)

### Actualizar un usuario

```http
PUT /api/v1/usuarios/1
```

**Parámetro de URL:**


**Body JSON:**

```json
{
    "nombre": "Pedro Modificado",
    "apellido": "Martinez Modificado",
    "email": "pedromodificado@example.com",
    "telefono": "2954-929292",
    "direccion": "Calle Falsa 125",
    "ciudad": "25 de Mayo",
    "codigo_postal": "C8202",
}

```
**Parámetros:**

| Campo | Tipo | Obligatorio | Descripción |
|---|---|---|---|
| `nombre` | string | No | Nombre del usuario opcional |
| `apellido` | string | No | Apellido del usuario opcional |
| `email` | string | Identifica el usuario como único|
| `telefono` | string | No | telefono opcional |
| `direccion` | string | No | direccion opcional |
| `ciudad` | string | No | ciudad opcional |
| `codigo_postal` | string | No | código postal opcional |
| `pais` | string | No | Por defecto es argentina |
| `isadmin` | string | No | Por defecto es false si no se envía el campo |


Si no existe:

```json
{
    "message": "Recurso no encontrado",
    "status": 404,
    "errors": {
        "error": "No query results for model [App\\Models\\Usuario] 122"
    }
}
```
**Respuesta no exitosa:**  ![404 Not Found](https://img.shields.io/badge/404-Not_Found-red)

Si existe:

```json
{
    "id": 15,
    "nombre": "Pedro Modificado",
    "apellido": "Martinez Modificado",
    "email": "pedromodificado@example.com",
    "email_verified_at": null,
    "isadmin": false,
    "created_at": "2026-09-06T22:45:14.000000Z",
    "updated_at": "2026-09-06T23:10:45.000000Z",
    "telefono": "2954-929292",
    "direccion": "Calle Falsa 125",
    "ciudad": "25 de Mayo",
    "codigo_postal": "C8202",
    "pais": "Argentina"
}
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)

### Eliminar un usuario

```http
DELETE /api/v1/usuarios/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador de la usuario |


**Respuesta exitosa:** ![204 No Content](https://img.shields.io/badge/204-No_Content-green)

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

**Respuesta no exitosa:** ![404 Not Found](https://img.shields.io/badge/404-Not_Found-red)

---

# 📦 Productos

Los productos poseen 3 rutas protegidas para ser accedidas por un administrador.

### Crear un producto

```http
POST {{url_base}}/productos
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
PUT /api/v1/productos/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del producto |

Ejemplo:

```http
PUT /api/v1/productos/1
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
DELETE /api/v1/productos/{id}
```

**Parámetro:**

| Parámetro | Tipo | Descripción |
|---|---|---|
| `id` | integer | Identificador del producto |

```http
DELETE /api/v1/productos/1
```

**Respuesta exitosa:** ![204 No Content](https://img.shields.io/badge/204-No_Content-green)


Si no existe:
```http
DELETE /api/v1/productos/111
```

```json
{
    "message": "Recurso no encontrado",
    "status": 404,
    "errors": {
        "error": "No query results for model [App\\Models\\Producto] 111"
    }
}
```

**Respuesta no exitosa:** ![404 Not Found](https://img.shields.io/badge/404-Not_Found-red)

---

# 🛒 Carrito de Compras

El carrito de compras permite a los usuarios seleccionar y gestionar productos antes de realizar una compra. La API permite consultar, agregar, actualizar y eliminar items del carrito.

## Estructura de Datos

El carrito se compone de items, donde cada item representa un producto con una cantidad específica. Un usuario tiene un único carrito activo representado por la colección de sus items y para acceder debe estar logueado.


### Obtener carrito de usuario


```http
GET /api/v1/carrito/
```

Si no hay usuario logueado:

```json
{
    "message": "no autenticado",
    "status": 401,
    "errors": {}
}
```
**Respuesta no exitosa:** ![401 Unauthorized](https://img.shields.io/badge/401-Unauthorized-red)


Si hay usuario logueado y no tiene carrito:

```json
{
    "error": "El usuario no tiene un carrito activo."
}
```
**Respuesta no exitosa:** ![404 Not Found](https://img.shields.io/badge/404-Not_found-red)


Si tiene carrito:
```json
{
    "items": [
        {
            "id": 16,
            "producto_id": 5,
            "producto_nombre": "Producto5",
            "cantidad": 2,
            "precio_unitario": "29.99",
            "subtotal": 59.98
        },
        {
            "id": 17,
            "producto_id": 6,
            "producto_nombre": "Producto6",
            "cantidad": 2,
            "precio_unitario": "9.99",
            "subtotal": 19.98
        }
    ],
    "resumen": {
        "cantidad_productos": 2,
        "cantidad_unidades": 4,
        "subtotal": 79.96,
        "impuestos": 16.79,
        "envio": 5000,
        "total": 5096.75
    }
}
```
**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green).

Muestra listado de productos, con la cantidad de cada uno, y un resumen con el total de items, y precio total.

### Checkout de carrito de usuario 🛒 
```http
GET /api/v1/carrito/checkout
```
Si no hay usuario logueado:

```json
{
    "message": "no autenticado",
    "status": 401,
    "errors": {}
}
```
**Respuesta no exitosa:** ![401 Unauthorized](https://img.shields.io/badge/401-Unauthorized-red)

```json
{
    "error": "El carrito está vacío."
}
```
**Respuesta no exitosa:** ![422 Unprocessable content](https://img.shields.io/badge/422-Unprocessable_content-red)


```json
{
    "message": "Checkout realizado con éxito.",
    "resumen": {
        "subtotal": 79.96,
        "impuestos": 16.79,
        "envio": 5000,
        "total": 5096.75
    }
}
```

**Respuesta exitosa:** ![200 OK](https://img.shields.io/badge/200-OK-green)

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


## 🧪 Ejecución de Pruebas (Test Suite)
El proyecto incluye un conjunto de pruebas automatizadas para verificar el correcto funcionamiento de la API y la lógica de negocio. Estas pruebas se dividen en dos categorías principales:

Pruebas de Integración (Feature): Validan los endpoints de la API y las interacciones entre componentes.

Pruebas Unitarias (Unit): Verifican el comportamiento de clases y métodos específicos de forma aislada.

Estructura de las Pruebas

Los archivos de prueba se encuentran en el directorio tests/ y siguen la siguiente estructura:

```text
├── Feature/                          # Pruebas de integración (API)
│   ├── AutenticacionApiTest.php      # Pruebas de registro, login, logout y perfil
│   ├── CarritoCheckoutApiTest.php    # Pruebas del proceso de checkout del carrito
│   ├── CarritoItemExistsTest.php     # Pruebas para verificar items en el carrito
│   ├── CategoriaApiTest.php          # Pruebas del CRUD de categorías (solo admin)
│   ├── ProductoApiTest.php           # Pruebas del CRUD de productos
│   └── UsuarioApiTest.php            # Pruebas del CRUD de usuarios (solo admin)
└── Unit/                             # Pruebas unitarias
    ├── ExampleTest.php               # Prueba de ejemplo de Laravel
    └── ResumenCarritoTest.php        # Pruebas de la lógica de resumen del carrito
```

Requisitos Previos
Asegurar que el entorno cumpla con los siguientes requisitos antes de ejecutar las pruebas:

Base de Datos de Pruebas: Se recomienda crear una base de datos separada para las pruebas (por ejemplo, tienda_negocios_test) para no afectar tu entorno de desarrollo. El archivo phpunit.xml está configurado para usar variables de entorno específicas.

Archivo de Entorno .env.testing: Crear un archivo .env.testing en la raíz del proyecto. En él, configurar las variables de conexión a la base de datos de pruebas y la clave de JWT.

Puedes generar una clave secreta para pruebas con el comando:
```bash
 php artisan jwt:secret --env=testing.
```
### Comandos para Ejecutar las Pruebas

Utiliza el comando `php artisan test` de Laravel para ejecutar los tests (Feature y Unit)::

```bash
php artisan test
```

Ejecutar solo las pruebas de características (Feature):

```bash
php artisan test --testsuite=Feature
```

Ejecutar solo las pruebas unitarias (Unit):

```bash
php artisan test --testsuite=Unit
```

Ejecutar un archivo de prueba específico:

```bash
php artisan test tests/Feature/AutenticacionApiTest
```
### Listado de test disponibles

```text
Tests\Feature\AutenticacionApiTest
   registro_una_persona
   intento_registrar_usuario_registrado
   intento_registra_sin_campos_obligatorios
   inicio_sesion_usuario_registrado
   intento_iniciar_sesion_sin_registrar
   persona_autenticada_vea_perfil
   persona_autenticada_actualiza_perfil
   persona_sin_autenticar_no_puede_modificar_perfil
   rechazo_perfil_sin_token

Tests\Feature\CarritoCheckoutApiTest
   calcula_un_carrito_con_envio
   ofrece_envio_gratis_justo_desde_el_monto_limite
   cobra_gastos_envio_cuando_no_alcanza_el_envio_gratis_limite_inferior
   cobrar_gastos_envio_cuando_no_alcanza_el_envio_gratis_limite_superior
   suma_varias_lineas_antes_de_calcular_impuestos
   un_carrito_vacio_no_debe_genera_cargos


Tests\Feature\CarritoItemExistsTest
   it_devuelve_solo_el_carrito_activo
   it_crea_un_carrito_activo_nuevo_si_el_usuario_solo_tiene_carritos_finalizados
   it_evita_productos_duplicados_en_el_mismo_carrito_de_usuario
   it_rechaza_la_eliminacion_de_un_articulo_que_no_se_encuentra_en_el_carrito_del_usuario_autenticado
   it_elimina_el_carrito_activo_del_usuario_autenticado
   it_procesa_el_carrito_activo_y_devuelve_el_resumen_del_pedido

Tests\Feature\CategoriaApiTest
   listar_categoria_solo_admin
   persona_admin_crea_categoria_ok
   persona_sin_token_admin_no_puede_crear_categoria
   persona_con_token_admin_puede_modificar_categoria
   persona_sin_token_admin_no_puede_modificar_categoria
   persona_con_token_admin_puede_borrar_categoria
   persona_sin_token_admin_no_puede_borrar_categoria

Tests\Feature\ProductoApiTest
   listar_productos_cualquier_usuario_sin_loguear
   persona_admin_crea_producto_ok
   persona_sin_token_admin_no_puede_crear_producto
   persona_con_token_admin_puede_modificar_producto
   persona_sin_token_admin_no_puede_modificar_producto
   persona_con_token_admin_puede_borrar_producto
   persona_sin_token_admin_no_puede_borrar_producto

Tests\Feature\UsuarioApiTest
   listar_usuarios_solo_admin
   persona_admin_crea_usuario_ok
   persona_sin_token_admin_no_puede_crear_usuario
   persona_con_token_admin_puede_modificar_usuario
   persona_sin_token_admin_no_puede_modificar_usuario
   persona_con_token_admin_puede_borrar_usuario
   persona_sin_token_admin_no_puede_borrar_usuario

Tests/Unit/ResumenCarritoTest.php
   calcula_un_carrito_con_envio
   ofrece_envio_gratis_justo_desde_el_monto_limite
   cobra_gastos_envio_cuando_no_alcanza_el_envio_gratis_limite_inferior
   cobrar_gastos_envio_cuando_no_alcanza_el_envio_gratis_limite_superior
   suma_varias_lineas_antes_de_calcular_impuestos
   un_carrito_vacio_no_debe_genera_cargos
  ```
De este listado se puede seleccionar filtrando el nombre para testear un método específico. Por ej.:

```bash
php artisan test --filter=registro_una_persona
```


## 👨‍💻 Desarrollador
Nombre del desarrollador - [Héctor Darío Sol]
