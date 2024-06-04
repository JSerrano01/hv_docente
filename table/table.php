<?php
include('../database.php');

connection()->query("CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `numero_documento` varchar(15) NOT NULL,
    `password` varchar(32) NOT NULL,
    `role` varchar(1) DEFAULT '1',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE (`numero_documento`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

connection()->query("INSERT IGNORE INTO `usuarios` (`id`,`numero_documento`,`password`,`role`) VALUES (1,'150324',MD5('1234'),'0')");

connection()->query("CREATE TABLE IF NOT EXISTS `perfiles` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `usuario_id` varchar(11) NOT NULL ,
    `primer_nombre` varchar(50) NOT NULL,
    `segundo_nombre` varchar(50) NOT NULL,
    `primer_apellido` varchar(50) NOT NULL,
    `segundo_apellido` varchar(50) NOT NULL,
    `correo` varchar(50) NOT NULL,
    `nacimiento` date NOT NULL,
    `documento_id` varchar(1) NOT NULL,
    `fecha_documento` date NOT NULL,
    `celular` varchar(10) NOT NULL,
    `fijo` varchar(10) NOT NULL,
    `direccion` varchar(100) NOT NULL,
    `cantidad_convive` varchar(100) NOT NULL,
    `pariente_id` varchar(100) NOT NULL,
    `ciudad_id` varchar(11) NOT NULL,
    `departamento_id` varchar(11) NOT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE (`usuario_id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

connection()->query("CREATE TABLE IF NOT EXISTS `estudios` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `usuario_id` varchar(11) NOT NULL,
    `tipo` varchar(1) NOT NULL,
    `fecha_inicio` date NOT NULL,
    `fecha_final` date NOT NULL,
    `fecha_graduacion` date NOT NULL,
    `titulo` varchar(50) NOT NULL,
    `file` varchar(100) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

connection()->query("CREATE TABLE IF NOT EXISTS `maestra_documento` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL UNIQUE,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

connection()->query("INSERT IGNORE INTO `maestra_documento` (`name`) VALUES
    ('Cedula de Cuidadania'),
    ('Cedula de Extranjeria')");

connection()->query("CREATE TABLE IF NOT EXISTS `maestra_pariente` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL UNIQUE,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

connection()->query("INSERT IGNORE INTO `maestra_pariente` (`name`) VALUES
    ('Cónyuge o compañero'),
    ('Papá'),
    ('Mamá'),
    ('Hijos'),
    ('Otros')");

connection()->query("CREATE TABLE IF NOT EXISTS `maestra_titulo` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL UNIQUE,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

connection()->query("INSERT IGNORE INTO `maestra_titulo` (`name`) VALUES
    ('Pregrado'),
    ('Maestria'),
    ('Doctorado'),
    ('Otros relacionados con Docencia')");

connection()->query("CREATE TABLE IF NOT EXISTS `experiencia` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `usuario_id` varchar(11) NOT NULL,
    `entidad` varchar(100) NOT NULL,
    `fecha_inicio` date NOT NULL,
    `fecha_final` date NOT NULL,
    `funcion` text NOT NULL,
    `file` varchar(100) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

connection()->query("CREATE TABLE IF NOT EXISTS `materias` (

    `usuario_id` varchar(11) NOT NULL,
    `materia_id` varchar(11) NOT NULL,
    `call` varchar(11) NOT NULL DEFAULT '0',
    `favorite` varchar(11) NOT NULL DEFAULT '0',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`usuario_id`,`materia_id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

connection()->query("CREATE TABLE IF NOT EXISTS `documentos` (
    `usuario_id` varchar(11) NOT NULL,
    `tipo_id` varchar(2) NOT NULL,
    `file` varchar(100) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`usuario_id`,`tipo_id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

connection()->query("CREATE TABLE IF NOT EXISTS `convocatoria` (

    `usuario_id` varchar(11) NOT NULL,
    `materia_id` varchar(11) NOT NULL,
    `enable` varchar(1) DEFAULT '1',   
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`usuario_id`,`materia_id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

?>




