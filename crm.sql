-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para c0crm
CREATE DATABASE IF NOT EXISTS `c0crm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `c0crm`;

-- Volcando estructura para tabla c0crm.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_asig_proyecto
CREATE TABLE IF NOT EXISTS `tbl_asig_proyecto` (
  `id_asig_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `id_marca` int(11) DEFAULT NULL,
  `id_campania` int(11) DEFAULT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `f_inicio` date DEFAULT NULL,
  `vigencia` date DEFAULT NULL,
  `promo` varchar(255) DEFAULT NULL,
  `desc_promo` varchar(255) DEFAULT NULL,
  `restric` text DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id_asig_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=1388 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_categorias
CREATE TABLE IF NOT EXISTS `tbl_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `activo` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla c0crm.tbl_categorias: ~9 rows (aproximadamente)
INSERT INTO `tbl_categorias` (`id_categoria`, `nombre`, `activo`) VALUES
	(1, 'Automotriz', 0),
	(2, 'Comercio / Servicios', 0),
	(3, 'Educación / Idiomas', 0),
	(4, 'Entretenimiento', 0),
	(5, 'Escuela', 0),
	(6, 'Hotelería / Turismo', 0),
	(7, 'OnLine', 0),
	(8, 'Restaurante / Comida Rápida', 0),
	(9, 'Salud / Belleza', 0),
	(11, 'Electronics', 0);

-- Volcando estructura para tabla c0crm.tbl_cat_estatus
CREATE TABLE IF NOT EXISTS `tbl_cat_estatus` (
  `id_estatus` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `activo` int(1) DEFAULT 0,
  `colorhex` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla c0crm.tbl_cat_estatus: ~10 rows (aproximadamente)
INSERT INTO `tbl_cat_estatus` (`id_estatus`, `nombre`, `descripcion`, `color`, `activo`, `colorhex`) VALUES
	(1, 'aprobada', ' se aprobo en sistema', 'bg-cyan', 0, '#00BCD4'),
	(2, 'cancelada', 'no se aprobo  en el sistema', 'bg-red', 0, '#F44336'),
	(3, 'solicitada', ' se encuentra pendiente de revision ', 'bg-orange', 0, '#FF5722'),
	(4, 'publicada', 'esta publicada', 'bg-green', 0, '#4CAF50'),
	(5, 'contacto inicial ', 'ejecutivo realizo contacto', 'bg-purple', 0, '#9C27B0'),
	(6, 'propuesta', 'ejecutivo envío propuesta', 'bg-deep-purple', 0, '#673AB7'),
	(7, 'interesado', 'el cliente le  interesa ', 'bg-teal', 0, '#009688'),
	(8, 'afiliada', 'se afilio la marca', 'bg-pink', 0, '#E91E63'),
	(9, 'no le interesa', 'no le interesa a la marca', 'bg-black', 0, '#000000'),
	(10, 'vencida', 'la vigencia de la marca ya expiro', 'bg-grey', 0, '#9E9E9E');

-- Volcando estructura para tabla c0crm.tbl_clientes
CREATE TABLE IF NOT EXISTS `tbl_clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `key_clte` varchar(45) DEFAULT NULL,
  `img_logo` varchar(255) DEFAULT NULL,
  `img_banner` varchar(255) DEFAULT NULL,
  `activo` int(2) DEFAULT NULL,
  `publico` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_codigos_postales
CREATE TABLE IF NOT EXISTS `tbl_codigos_postales` (
  `id_codigo_postal` int(11) NOT NULL AUTO_INCREMENT,
  `cp` int(5) unsigned zerofill DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `del_mun` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_codigo_postal`)
) ENGINE=InnoDB AUTO_INCREMENT=144389 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_descarga_cupon
CREATE TABLE IF NOT EXISTS `tbl_descarga_cupon` (
  `id_descarga_cupon` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `fecha_descarga` datetime DEFAULT NULL,
  PRIMARY KEY (`id_descarga_cupon`)
) ENGINE=InnoDB AUTO_INCREMENT=99196 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_grupo
CREATE TABLE IF NOT EXISTS `tbl_grupo` (
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `nobre_grupo` varchar(255) DEFAULT NULL,
  `activo` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla c0crm.tbl_grupo: ~3 rows (aproximadamente)
INSERT INTO `tbl_grupo` (`id_grupo`, `nobre_grupo`, `activo`) VALUES
	(1, 'Redes', 0),
	(2, 'Bancos', 0),
	(3, 'Cashback', 0);

-- Volcando estructura para tabla c0crm.tbl_log_seg_marca
CREATE TABLE IF NOT EXISTS `tbl_log_seg_marca` (
  `id_log_seg_marca` int(11) NOT NULL AUTO_INCREMENT,
  `id_marca` int(11) DEFAULT NULL,
  `id_estatus` int(11) DEFAULT NULL,
  `comentarios` varchar(255) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log_seg_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=11829 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_marcas
CREATE TABLE IF NOT EXISTS `tbl_marcas` (
  `id_marcas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT 'logo_default.jpg',
  `id_usuario_marca` int(11) DEFAULT NULL,
  `id_cat_estatus` int(11) DEFAULT NULL,
  `activo` int(2) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `com_rechazo` varchar(255) DEFAULT NULL,
  `rs` varchar(255) DEFAULT NULL,
  `rfc` varchar(255) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `mail_contacto` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `vigencia` date DEFAULT NULL,
  `promo` varchar(255) DEFAULT NULL,
  `restric` text DEFAULT NULL,
  `cupon` varchar(255) DEFAULT 'cupon_default.jpg',
  `llam_cal` int(2) DEFAULT NULL,
  `vis_cal` int(2) DEFAULT NULL,
  `dias_pvencer` int(2) DEFAULT NULL,
  `id_proy2` int(11) DEFAULT NULL,
  `promo2` varchar(255) DEFAULT NULL,
  `contrato` varchar(255) DEFAULT 'contrato_default.pdf',
  `id_proceso_calidad` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT 'imagen_default.jpg',
  `contrato2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_marcas`)
) ENGINE=InnoDB AUTO_INCREMENT=931 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_modulo
CREATE TABLE IF NOT EXISTS `tbl_modulo` (
  `id_modulo` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `icono` varchar(255) DEFAULT NULL,
  `pagina` varchar(45) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `activo` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla c0crm.tbl_modulo: ~6 rows (aproximadamente)
INSERT INTO `tbl_modulo` (`id_modulo`, `nombre`, `icono`, `pagina`, `orden`, `activo`) VALUES
	(1, 'USUARIOS', 'group', 'usuario/usuarios', 1, 0),
	(2, 'MARCAS', 'view_module', 'marcas/marcass', 2, 0),
	(3, 'REPORTES', 'trending_up', NULL, 5, 0);

-- Volcando estructura para tabla c0crm.tbl_pantalla
CREATE TABLE IF NOT EXISTS `tbl_pantalla` (
  `idpantalla` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `ruta` varchar(45) DEFAULT NULL,
  `activo` int(2) DEFAULT NULL,
  `idmodulo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpantalla`),
  KEY `idarea_idx` (`idmodulo`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla c0crm.tbl_pantalla: ~19 rows (aproximadamente)
INSERT INTO `tbl_pantalla` (`idpantalla`, `nombre`, `ruta`, `activo`, `idmodulo`) VALUES
	(1, ' Admin Usuarios', '../usuarios/usuarios.php', 0, 1),
	(2, 'Admin Marcas ', '../marcas/admin_marcas.php', 0, 2),
	(3, 'Solicitar Marca', '../marcas/solicita_marca.php', 0, 2),
	(4, 'Seguimiento Marca', '../marcas/seguimiento_marca.php', 0, 2),
	(5, 'Aprobación Marca', '../marcas/aprobacion_marca.php', 0, 2),
	(6, 'Publicación  Marca', '../marcas/publicacion_marca.php', 0, 2),
	(7, 'Reporte General', '../reportes/reportes.php', 0, 3),
	(15, 'Admin Campaña', '../marcas/admin_campania.php', 0, 2),
	(16, 'Reporte Descargas', '../reportes/reporte_descargas.php', 0, 3),
	(19, 'Editar Mi Usuario', '../usuarios/edit_usuario.php', 0, 1);

-- Volcando estructura para tabla c0crm.tbl_proyectos
CREATE TABLE IF NOT EXISTS `tbl_proyectos` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` varchar(255) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_rel_marca_categoria
CREATE TABLE IF NOT EXISTS `tbl_rel_marca_categoria` (
  `id_rel_marca_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_marca` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rel_marca_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3878 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_rel_rol_modulo
CREATE TABLE IF NOT EXISTS `tbl_rel_rol_modulo` (
  `id_rel_rol_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rel_rol_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_rol
CREATE TABLE IF NOT EXISTS `tbl_rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla c0crm.tbl_rol: ~5 rows (aproximadamente)
INSERT INTO `tbl_rol` (`id_rol`, `rol`) VALUES
	(1, 'Ejecutivo'),
	(2, 'Supervisor'),
	(3, 'Calidad'),
	(4, 'Super Admin'),
	(5, 'Premium');

-- Volcando estructura para tabla c0crm.tbl_sucursales_marca
CREATE TABLE IF NOT EXISTS `tbl_sucursales_marca` (
  `id_sucursal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `num_ext` varchar(45) DEFAULT NULL,
  `num_int` varchar(45) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `latitud` varchar(45) DEFAULT NULL,
  `longitud` varchar(45) DEFAULT NULL,
  `cp` varchar(45) DEFAULT NULL,
  `id_cp` varchar(45) DEFAULT NULL,
  `activo` int(2) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_zona` int(11) DEFAULT NULL,
  `id_banco` int(11) DEFAULT NULL,
  `num_afiliacion` varchar(45) DEFAULT NULL,
  `id_estatus_calidad` int(11) DEFAULT NULL,
  `id_pais` int(11) DEFAULT 7,
  `id_rel_cipa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=69177 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_usuario
CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `idusuario` int(3) NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) NOT NULL DEFAULT 0,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `fecha_ultimo_acceso` datetime DEFAULT NULL,
  `activo` int(2) DEFAULT 1,
  `pass_default` int(2) DEFAULT 1,
  `token` varchar(64) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla c0crm.tbl_zonas
CREATE TABLE IF NOT EXISTS `tbl_zonas` (
  `id_zona` int(11) NOT NULL AUTO_INCREMENT,
  `zona` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_zona`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.