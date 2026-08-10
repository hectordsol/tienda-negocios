# 🛒 Tienda de Negocios

## 📋 Descripción del Proyecto

**Tienda de Negocios** es una aplicación web desarrollada con Laravel que permite gestionar productos de una tienda. El sistema proporciona funcionalidades básicas para administrar el inventario de productos.

## 🚀 Estado Actual del Proyecto

### ✅ Funcionalidades Implementadas
- [x] Configuración del sistema de rutas
- [x] Conexión a base de datos MySQL
- [x] Controlador de Productos
- [x] Modelo Producto, Usuario, Categoría, Carrito
- [x] Migración de la tablas Usuario, Producto, Categoría, Carrito.
- [x] Definir Relaciones en los modelos
- [x] Crear controlador de Usuarios, Categoría, Carrito
- [x] Implementación de CRUD completo Producto, Categoría, Usuario, Carrito


### 🔄 Próximos Pasos
- [ ] Vistas para gestión de productos con rutas (routes/web.php)
- [ ] Validaciones de formularios
- [ ] Validar datos
- [ ] Incluir regla personalizada
- [ ] Analizar y documentar flujo de información Laravel

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
│   │   ├── Controllers/
│   │   │   └── ProductoController.php
│   │   └── Routes/
│   │         ├── api.php
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

