# 🛒 Tienda de Negocios

## 📋 Descripción del Proyecto

**Tienda de Negocios** es una aplicación web desarrollada con Laravel que permite gestionar productos de una tienda. El sistema proporciona funcionalidades básicas para administrar el inventario de productos de manera eficiente.

## 🚀 Estado Actual del Proyecto

### ✅ Funcionalidades Implementadas
- [x] Configuración del sistema de rutas
- [x] Conexión a base de datos MySQL
- [x] Controlador de Productos
- [x] Modelo Producto
- [x] Migración de la tabla Productos

### 🔄 Próximos Pasos
- [ ] Implementación de CRUD completo
- [ ] Vistas para gestión de productos
- [ ] Validaciones de formularios
- [ ] Autenticación de usuarios
- [ ] Sistema de categorías

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

tienda-negocios/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── ProductoController.php
│   │   └── Routes/
│   │       └── web.php
│   └── Models/
│       └── Producto.php
├── database/
│   ├── migrations/
│   │   └── [timestamp]_create_productos_table.php
│   └── seeders/
├── resources/
│   └── views/
├── routes/
│   └── web.php
└── ...

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

👨‍💻 Desarrollador
Nombre del desarrollador - [Héctor Darío Sol]

