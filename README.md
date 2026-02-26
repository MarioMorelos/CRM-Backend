# CRM Laravel - Sistema de Gestión de Relaciones con Clientes

## Descripción del Proyecto

Sistema CRM (Customer Relationship Management) desarrollado en Laravel para la gestión integral de clientes, marcas, campañas y proyectos. El sistema permite administrar relaciones comerciales, seguimiento de leads y gestión de contratos.

## Características Principales

- Gestión de usuarios y autenticación
- Administración de marcas y clientes
- Sistema de campañas y proyectos
- Gestión de categorías
- Control de estatus
- Asignación de proyectos
- Carga de documentos (contratos, imágenes)
- API RESTful completa

## Requisitos del Sistema

- PHP >= 8.0
- Composer
- MySQL/MariaDB >= 10.4
- Laravel >= 9.x
- Apache/Nginx
- Node.js y NPM (para assets)

## Instalación

1. Clonar el repositorio:
```bash
git clone [URL_DEL_REPOSITORIO]
cd crm_laravel
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Copiar el archivo de configuración:
```bash
cp .env.example .env
```

4. Configurar la base de datos en el archivo `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=c0crm
DB_USERNAME=root
DB_PASSWORD=
```

5. Generar la clave de la aplicación:
```bash
php artisan key:generate
```

6. Importar la base de datos:
```bash
mysql -u root -p c0crm < crm.sql
```

7. Ejecutar migraciones (si aplica):
```bash
php artisan migrate
```

8. Iniciar el servidor de desarrollo:
```bash
php artisan serve
```

## Estructura de la Base de Datos

### Tablas Principales

- **tbl_clientes**: Información de clientes
- **tbl_marcas**: Gestión de marcas
- **tbl_categorias**: Categorías de clasificación
- **tbl_cat_estatus**: Catálogo de estatus
- **tbl_asig_proyecto**: Asignación de proyectos a marcas
- **personal_access_tokens**: Tokens de autenticación API

## Documentación de la API

### Base URL
```
http://localhost/crm_laravel/
```

### Autenticación

La API utiliza tokens Bearer para autenticación. Incluir el token en el header:
```
Authorization: Bearer {token}
```

### Endpoints Disponibles

#### 1. Autenticación

##### Registro de Usuario
```http
POST /register
Content-Type: application/json
Authorization: Bearer {token}

{
    "id_grupo": 1,
    "nombre": "Usuario",
    "apellidos": "Test",
    "email": "test@test.com",
    "id_rol": 1
}
```

##### Login
```http
POST /login
Content-Type: application/json

{
    "email": "mario@test.com.mx",
    "password": "Mm12345678."
}
```

**Respuesta exitosa:**
```json
{
    "token": "12|GgIlKmAw68RYIiAqFliyqiQ6gOnFBLvOduNdDZ4Tef8c9a60",
    "user": {
        "id": 1,
        "nombre": "mario",
        "email": "mario@test.com.mx"
    }
}
```

##### Editar Usuario
```http
PUT /edit_user/{id}
Content-Type: application/json
Authorization: Bearer {token}

{
    "nombre": "Artur",
    "apellidos": "Mendoza",
    "password": "12345678A.",
    "password_confirmation": "12345678A."
}
```

##### Recuperar Contraseña
```http
POST /olvide_password
Content-Type: application/json

{
    "email": "mario@test.com.mx"
}
```

##### Establecer Nueva Contraseña
```http
POST /nueva_password
Content-Type: application/json

{
    "token": "3e4g6kqi1cupsozdtklhi0jvtn47oban4rcdf8m8",
    "password": "12345678.",
    "password_confirmation": "12345678."
}
```

#### 2. Gestión de Marcas

##### Obtener Todas las Marcas
```http
GET /marcas
Authorization: Bearer {token}
```

**Respuesta:**
```json
{
    "data": [
        {
            "id_marca": 1,
            "nombre": "Marca Ejemplo",
            "rs": "Razón Social",
            "tel": "5512345678",
            "contacto": "Nombre Contacto",
            "mail_contacto": "contacto@marca.com",
            "url": "https://marca.com",
            "id_estatus": 1,
            "estatus": {
                "nombre": "aprobada",
                "color": "#00BCD4"
            }
        }
    ]
}
```

##### Obtener Información de una Marca
```http
GET /marcas/{id}
Authorization: Bearer {token}
```

##### Crear Nueva Marca
```http
POST /marcas
Content-Type: application/json
Authorization: Bearer {token}

{
    "nombre": "Marca 1"
}
```

##### Activar/Desactivar Marca
```http
PUT /marcas/active/{id}
Authorization: Bearer {token}
```

##### Aprobar/Rechazar Marca
```http
PATCH /marcas/{id}
Content-Type: application/json
Authorization: Bearer {token}

{
    "accion": 1,
    "com_rechazo": ""
}
```

**Parámetros:**
- `accion`: 1 para aprobar, 0 para rechazar
- `com_rechazo`: Comentario de rechazo (opcional)

##### Editar Marca
```http
PUT /marcas/{id}
Content-Type: application/json
Authorization: Bearer {token}

{
    "rs": "Razón Social",
    "tel": "5512345678",
    "contacto": "Nombre Contacto",
    "mail_contacto": "contacto@marca.com",
    "url": "https://marca.com",
    "categoria": [1, 6, 9],
    "llam_cal": 0,
    "vis_cal": 0,
    "estatus": 8,
    "contrato_base64": "data:application/pdf;base64,...",
    "imagen_base64": "data:image/jpeg;base64,..."
}
```

**Campos:**
- `rs`: Razón social
- `tel`: Teléfono
- `contacto`: Nombre del contacto
- `mail_contacto`: Email del contacto
- `url`: Sitio web
- `categoria`: Array de IDs de categorías
- `llam_cal`: Llamadas calificadas
- `vis_cal`: Visitas calificadas
- `estatus`: ID del estatus
- `contrato_base64`: Contrato en base64
- `imagen_base64`: Imagen en base64

## Catálogos

### Categorías Disponibles

| ID | Nombre |
|----|--------|
| 1 | Automotriz |
| 2 | Comercio / Servicios |
| 3 | Educación / Idiomas |
| 4 | Entretenimiento |
| 5 | Escuela |
| 6 | Hotelería / Turismo |
| 7 | OnLine |
| 8 | Restaurante / Comida Rápida |
| 9 | Salud / Belleza |
| 11 | Electronics |

### Estatus Disponibles

| ID | Nombre | Color | Descripción |
|----|--------|-------|-------------|
| 1 | aprobada | #00BCD4 | Se aprobó en sistema |
| 2 | cancelada | #F44336 | No se aprobó en el sistema |
| 3 | solicitada | #FF5722 | Se encuentra pendiente de revisión |
| 4 | publicada | #4CAF50 | Está publicada |
| 5 | contacto inicial | #9C27B0 | Ejecutivo realizó contacto |
| 6 | propuesta | #673AB7 | Ejecutivo envió propuesta |
| 7 | interesado | #009688 | El cliente le interesa |
| 8 | afiliada | #E91E63 | Se afilió la marca |
| 9 | no le interesa | #000000 | No le interesa a la marca |
| 10 | vencida | #9E9E9E | La vigencia de la marca ya expiró |

## Códigos de Respuesta HTTP

- `200 OK`: Solicitud exitosa
- `201 Created`: Recurso creado exitosamente
- `400 Bad Request`: Error en los datos enviados
- `401 Unauthorized`: No autenticado o token inválido
- `403 Forbidden`: No tiene permisos
- `404 Not Found`: Recurso no encontrado
- `422 Unprocessable Entity`: Error de validación
- `500 Internal Server Error`: Error del servidor

## Manejo de Errores

Las respuestas de error siguen el siguiente formato:

```json
{
    "error": true,
    "message": "Descripción del error",
    "errors": {
        "campo": ["Mensaje de error específico"]
    }
}
```

## Seguridad

- Todas las contraseñas se almacenan hasheadas
- Autenticación mediante Laravel Sanctum
- Validación de datos en todas las peticiones
- Protección CSRF en formularios web
- Tokens de acceso con expiración

## Archivos y Documentos

El sistema permite la carga de:
- Contratos (PDF) en formato base64
- Imágenes (JPEG, PNG) en formato base64
- Logos de marcas
- Banners

## Testing

Para ejecutar las pruebas:

```bash
php artisan test
```

## Deployment

### Producción

1. Configurar variables de entorno en `.env`:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com
```

2. Optimizar la aplicación:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

3. Configurar permisos:
```bash
chmod -R 755 storage bootstrap/cache
```

## Soporte y Contacto

Para soporte técnico o consultas sobre el sistema, contactar al equipo de desarrollo.

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

---

**Nota**: Este README está basado en la colección de Postman "API CRM PREVIEW" y la estructura de la base de datos del proyecto.
