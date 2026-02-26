# Migraciones y Seeders - CRM Laravel

## Migraciones Creadas

Se han creado las siguientes migraciones para las tablas del CRM:

1. `tbl_categorias` - Categorías de marcas
2. `tbl_cat_estatus` - Catálogo de estatus
3. `tbl_grupo` - Grupos de usuarios
4. `tbl_rol` - Roles de usuarios
5. `tbl_usuario` - Usuarios del sistema
6. `tbl_proyectos` - Proyectos
7. `tbl_marcas` - Marcas
8. `tbl_clientes` - Clientes
9. `tbl_rel_marca_categoria` - Relación marca-categoría
10. `tbl_descarga_cupon` - Descargas de cupones
11. `tbl_asig_proyecto` - Asignación de proyectos
12. `tbl_log_seg_marca` - Log de seguimiento de marcas
13. `tbl_modulo` - Módulos del sistema
14. `tbl_pantalla` - Pantallas del sistema
15. `tbl_rel_rol_modulo` - Relación rol-módulo
16. `tbl_codigos_postales` - Códigos postales
17. `tbl_zonas` - Zonas
18. `tbl_sucursales_marca` - Sucursales de marcas

## Seeders Creados

Se han creado seeders con datos iniciales para:

- `CategoriasSeeder` - 10 categorías predefinidas
- `CatEstatusSeeder` - 10 estatus predefinidos
- `GrupoSeeder` - 3 grupos (Redes, Bancos, Cashback)
- `RolSeeder` - 5 roles (Ejecutivo, Supervisor, Calidad, Super Admin, Premium)
- `ModuloSeeder` - 3 módulos (USUARIOS, MARCAS, REPORTES)
- `PantallaSeeder` - 10 pantallas del sistema

## Comandos para Ejecutar

### 1. Ejecutar todas las migraciones
```bash
php artisan migrate
```

### 2. Ejecutar los seeders
```bash
php artisan db:seed
```

### 3. Ejecutar migraciones y seeders juntos
```bash
php artisan migrate --seed
```

### 4. Refrescar la base de datos (elimina todo y vuelve a crear)
```bash
php artisan migrate:fresh --seed
```

### 5. Ejecutar un seeder específico
```bash
php artisan db:seed --class=CategoriasSeeder
```

## Notas Importantes

- Las migraciones están ordenadas por dependencias
- Los seeders solo insertan datos de catálogos iniciales
- Las tablas de Laravel por defecto (users, cache, jobs, etc.) ya existen
- Asegúrate de configurar correctamente tu archivo `.env` con las credenciales de la base de datos antes de ejecutar las migraciones
