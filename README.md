# MiniEcommerce

Sistema de comercio electronico desarrollado con Laravel 11. Permite la gestion de productos, ventas y usuarios con control de acceso por roles, autenticacion de dos factores y despliegue en la nube.

## Tecnologias

- **Laravel 11** — Framework PHP
- **PHP 8.2** — Lenguaje backend
- **PostgreSQL** — Base de datos en produccion
- **SQLite** — Base de datos en pruebas automaticas
- **GitHub Actions** — Integracion continua (CI)
- **Render** — Despliegue en la nube (CD)
- **Docker** — Contenedor de despliegue

## Funcionalidades

- Autenticacion con verificacion de dos factores (2FA por correo)
- Control de acceso por roles: `administrador`, `gerente`, `empleado`, `cliente`
- CRUD completo de productos, categorias, ventas y usuarios
- Politicas de autorizacion (Policies) por rol
- Subida de imagenes para productos
- Generacion y descarga de tickets de venta
- Dashboards personalizados por rol
- Logging de eventos de autenticacion, productos y ventas

## Instalacion local

```bash
# 1. Clonar el repositorio
git clone https://github.com/GabrielPV10/MiniEcommerce.git
cd MiniEcommerce

# 2. Instalar dependencias
composer install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate

# 4. Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pruebas_db
DB_USERNAME=root
DB_PASSWORD=

# 5. Ejecutar migraciones y seeders
php artisan migrate
php artisan db:seed

# 6. Enlazar almacenamiento
php artisan storage:link

# 7. Iniciar servidor
php artisan serve
```

## Credenciales de prueba

| Rol | Correo | Contrasena |
|-----|--------|------------|
| Administrador | admin@tuxtla.tecnm.mx | 123456 |
| Gerente | usuario001@tuxtla.tecnm.mx | 123456 |
| Cliente | usuario006@tuxtla.tecnm.mx | 123456 |

## Ejecucion de pruebas

```bash
php artisan test
```

El proyecto incluye 24 pruebas automaticas organizadas en:

| Archivo | Pruebas | Descripcion |
|---------|---------|-------------|
| `AuthTest.php` | 7 | Login, registro, 2FA, logout |
| `DashboardTest.php` | 5 | Control de acceso por rol |
| `CategoriaTest.php` | 3 | Policies de categorias |
| `ProductoTest.php` | 4 | Policies de productos |
| `Unit/ExampleTest.php` | 2 | Logica de expiracion del codigo 2FA |
| `Feature/ExampleTest.php` | 1 | Respuesta de la pagina principal |

## Pipeline de Integracion Continua (CI)

El pipeline se ejecuta automaticamente en cada `push` o `pull request` hacia `main`.

**Pasos del pipeline** (`.github/workflows/laravel.yml`):
1. Clonar repositorio
2. Instalar PHP 8.2
3. Instalar dependencias Composer
4. Configurar entorno con SQLite
5. Ejecutar migraciones
6. Ejecutar seeders
7. Ejecutar las 24 pruebas automaticas

## Despliegue Continuo (CD)

Cada `push` a `main` desencadena automaticamente un nuevo despliegue en Render.

**Flujo completo:**
```
git push origin main
       ↓
GitHub Actions ejecuta las 24 pruebas
       ↓
Render detecta el push y construye la imagen Docker
       ↓
Se ejecutan migraciones automaticamente
       ↓
Aplicacion disponible en la URL publica
```

## URL publica

[https://miniecommerce-kyhl.onrender.com](https://miniecommerce-kyhl.onrender.com)

> El plan gratuito de Render puede tardar hasta 50 segundos en responder si el servidor estuvo inactivo.

## Variables de entorno requeridas

```
APP_NAME=
APP_ENV=
APP_KEY=
APP_DEBUG=
APP_URL=

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

SESSION_DRIVER=
CACHE_STORE=
QUEUE_CONNECTION=
MAIL_MAILER=
```

Las variables de produccion se configuran directamente en el panel de Render, nunca en el repositorio.

## Equipo

Proyecto desarrollado para la materia de Desarrollo Web — TECNM Campus Tuxtla.
