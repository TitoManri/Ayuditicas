-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-08-2024 a las 01:47:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ayuditicas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueados`
--

CREATE TABLE `bloqueados` (
  `cedula_bloqueador` int(11) NOT NULL,
  `cedula_bloqueado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campanias`
--

CREATE TABLE `campanias` (
  `id_campania` int(11) NOT NULL,
  `cedula_creador_camp` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `voluntarios_requeridos` int(11) NOT NULL,
  `fecha_hora_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_hora_culminacion` datetime NOT NULL,
  `terminada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `campanias`
--

INSERT INTO `campanias` (`id_campania`, `cedula_creador_camp`, `nombre`, `descripcion`, `voluntarios_requeridos`, `fecha_hora_creacion`, `fecha_hora_culminacion`, `terminada`) VALUES
(1, 119410503, 'Educación a infantiles', 'En Cartago', 8, '2024-08-21 15:48:13', '2024-08-25 00:00:00', 1),
(2, 305590892, 'Limpiando Ríos', 'Grupo de personas dedicadas a limpiar los ríos de Costa Rica', 8, '2024-08-21 16:21:03', '2024-08-31 00:00:00', 0),
(3, 119410503, 'Verde Esperanza 2024', 'Únete a nuestra misión de reforestar las áreas más afectadas por la deforestación en nuestra región. Queremos plantar 10,000 árboles para restaurar la biodiversidad y combatir el cambio climático. Tu participación es clave para lograrlo. ¡Haz parte del cambio hoy!', 9, '2024-08-21 16:22:28', '2024-09-20 00:00:00', 0),
(4, 119440864, 'Por playas mas lindas', 'En esta campaña vamos a viajar por todo el pais, en limpieza de las playas para que se vea todo bien bonito', 50, '2024-08-21 16:23:47', '2025-12-29 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_publicacion` int(11) DEFAULT NULL,
  `id_publicacion_blog` int(11) DEFAULT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `num_like` int(11) NOT NULL,
  `contenido` varchar(512) NOT NULL,
  `fecha_hora_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `cedula`, `id_publicacion`, `id_publicacion_blog`, `id_padre`, `num_like`, `contenido`, `fecha_hora_creacion`) VALUES
(1, 119410503, 9, NULL, NULL, 0, 'hola\n', '2024-08-21 23:27:55'),
(2, 119320433, 9, NULL, NULL, 0, 'Muy bien!', '2024-08-21 23:28:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado_solicitud` int(11) NOT NULL,
  `cedula_jefe_camp` int(11) NOT NULL,
  `id_reporte` int(11) DEFAULT NULL,
  `id_solicitud_campania` int(11) DEFAULT NULL,
  `id_denuncia` int(11) DEFAULT NULL,
  `id_solicitud_jefe` int(11) DEFAULT NULL,
  `tipo_estado` varchar(50) NOT NULL,
  `progreso` varchar(50) NOT NULL,
  `is_resuelto` tinyint(1) NOT NULL,
  `aceptada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id_etiqueta` int(11) NOT NULL,
  `tipo_etiqueta` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`id_etiqueta`, `tipo_etiqueta`, `nombre`) VALUES
(55, 'publicacion', 'Deforestación'),
(56, 'publicacion', 'Contaminación_del_Agua'),
(57, 'publicacion', 'Contaminación_del_Aire'),
(58, 'publicacion', 'Caza_Ilegal'),
(59, 'publicacion', 'Pesca_Ilegal'),
(60, 'publicacion', 'Residuos_Tóxicos'),
(61, 'publicacion', 'Construcción_Ilegal'),
(62, 'publicacion', 'Tráfico_de_Fauna'),
(63, 'publicacion', 'Contaminación_del_Suelo'),
(64, 'publicacion', 'Ruido_Ambiental'),
(65, 'publicacion', 'Destrucción_de_Ecosistemas'),
(66, 'publicacion', 'Reforestación'),
(67, 'publicacion', 'Limpieza_de_Playas'),
(68, 'publicacion', 'Conservación_de_Fauna'),
(69, 'publicacion', 'Educación_Ambiental'),
(70, 'publicacion', 'Reciclaje'),
(71, 'publicacion', 'Energía_Renovable'),
(72, 'publicacion', 'Huertos_Urbanos'),
(73, 'publicacion', 'Protección_de_Especies'),
(74, 'publicacion', 'Voluntariado_Ambiental'),
(75, 'publicacion', 'Reducción_de_Residuos'),
(76, 'publicacion', 'Conservación_de_Agua'),
(77, 'publicacion', 'Sostenibilidad'),
(78, 'publicacion', 'Economía_Circular'),
(79, 'publicacion', 'Transporte_Verde'),
(80, 'publicacion', 'Cambio_Climático'),
(81, 'publicacion', 'Comunidad_Ecológica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_roles`
--

CREATE TABLE `grupo_roles` (
  `id_grupo` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `cedula` int(11) NOT NULL,
  `id_like` int(11) NOT NULL,
  `id_publicacion` int(11) DEFAULT NULL,
  `id_comentario` int(11) DEFAULT NULL,
  `id_publicacion_blog` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `cedula_remitente` int(11) NOT NULL,
  `cedula_destinatario` int(11) NOT NULL,
  `cuerpo_mensaje` varchar(1024) DEFAULT NULL,
  `img` varchar(512) DEFAULT NULL,
  `leido` tinyint(1) NOT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `cedula_remitente`, `cedula_destinatario`, `cuerpo_mensaje`, `img`, `leido`, `fecha_hora_envio`) VALUES
(231, 119410503, 119320433, 'hola', NULL, 1, '2024-08-21 21:58:57'),
(232, 119320433, 119440864, 'hola', NULL, 1, '2024-08-21 22:08:07'),
(233, 119440864, 119320433, 'hpla', NULL, 1, '2024-08-21 22:08:58'),
(234, 119320433, 119410503, NULL, './assets/img/66c6674f686455.65521004.jpeg', 1, '2024-08-21 22:16:47'),
(235, 119320433, 119410503, 'que te parece los cambios', NULL, 1, '2024-08-21 22:17:04'),
(236, 119410503, 119320433, 'hola esto es un prueba', NULL, 1, '2024-08-21 22:17:26'),
(237, 119410503, 119320433, NULL, './assets/img/66c6679fe78682.24937365.jpeg', 1, '2024-08-21 22:18:07'),
(238, 119410503, 119320433, 'Podrias crearme una campaña donde ocupo el nombre de la campaña, una descripcion, cantidad de personas y fecha de finalizacion', NULL, 1, '2024-08-21 22:25:34'),
(239, 305590892, 119410503, 'Hola Jorge, tienes noticias de la campaña?', NULL, 0, '2024-08-21 22:34:08'),
(240, 305590892, 119410503, NULL, './assets/img/66c66b897b6bf4.89072900.jpg', 0, '2024-08-21 22:34:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_grupo`
--

CREATE TABLE `mensajes_grupo` (
  `id_mensaje_grupo` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `contenido` varchar(1024) DEFAULT NULL,
  `img` varchar(512) DEFAULT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `leido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id_publicacion` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_campania` int(11) DEFAULT NULL,
  `titulo` varchar(256) DEFAULT NULL,
  `img` varchar(512) DEFAULT NULL,
  `num_like` int(11) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `inscripcion` tinyint(1) NOT NULL,
  `fecha_hora_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id_publicacion`, `cedula`, `id_campania`, `titulo`, `img`, `num_like`, `descripcion`, `inscripcion`, `fecha_hora_creacion`) VALUES
(6, 119320433, 1, 'Una publicacion', NULL, 0, 'ponele cualquier cosa pero tampoco tan literal.', 1, '2024-08-21 21:56:27'),
(7, 305590892, 2, 'Primer río limpiado', '7.jpg', 0, 'Foto tomada durante la primera reunión para limpiar ríos', 1, '2024-08-21 22:25:48'),
(8, 119440864, 4, 'Vamos a Jaco', '8.jpg', 0, 'Hoy vamos para jaco para lograr empezar con este movimiento de limpiar playas', 1, '2024-08-21 22:28:08'),
(9, 305590892, NULL, 'Avance en la limpieza de ríos', '9.jpg', 0, 'Río #1 limpio', 0, '2024-08-21 23:26:20'),
(10, 119440864, NULL, 'Recordemos que toda huella cuenta', NULL, 0, 'Recordemos que no porque no recojas 10 bolsas de basura no significa que no podas ayudar al pais, con una basurita ayudas', 0, '2024-08-21 23:28:12'),
(11, 119440864, NULL, 'Recordemos que toda huella cuenta', '11.jpg', 0, 'Recordemos que no porque no recojas 10 bolsas de basura no significa que no podas ayudar al pais, con una basurita ayudas', 0, '2024-08-21 23:28:52'),
(12, 119440864, NULL, 'Limpiando Playas', '12.jpg', 0, 'Hoy fuimos a la playa salsa brava, a limpiar y logramos reunir a muchos voluntarios', 0, '2024-08-21 23:34:54'),
(15, 305590892, NULL, 'Unite a la conversación', '15.jpeg', 0, 'Contactanos por la mensajería', 0, '2024-08-21 23:42:41'),
(16, 305590892, NULL, 'Formemos conciencia respecto al medio ambiente', NULL, 0, 'Seguí la campaña para limpiar las playas', 0, '2024-08-21 23:43:45'),
(17, 119410503, NULL, '0% Deforestacion', NULL, 0, 'Muchas gracias por ayudar al ambiente', 0, '2024-08-21 23:46:16'),
(18, 118430764, NULL, 'Dejemos de apollar', '18.jpg', 0, 'Dejemos de maltratar a los animales para que no sean utilizados en su contra', 0, '2024-08-21 23:46:37'),
(19, 118430764, NULL, 'Dejemos de apollar', '19.jpg', 0, 'Dejemos de maltratar a los animales para que no sean utilizados en su contra', 0, '2024-08-21 23:46:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones_blog`
--

CREATE TABLE `publicaciones_blog` (
  `id_publicacion_blog` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `contenido` varchar(1024) NOT NULL,
  `img` varchar(512) DEFAULT NULL,
  `num_like` int(11) NOT NULL,
  `fecha_hora_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones_etiquetas`
--

CREATE TABLE `publicaciones_etiquetas` (
  `id_etiqueta` int(11) NOT NULL,
  `id_publicacion` int(11) DEFAULT NULL,
  `id_publicacion_blog` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones_etiquetas`
--

INSERT INTO `publicaciones_etiquetas` (`id_etiqueta`, `id_publicacion`, `id_publicacion_blog`) VALUES
(55, 17, NULL),
(58, 18, NULL),
(58, 19, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_reporte` int(11) NOT NULL,
  `id_publicacion` int(11) DEFAULT NULL,
  `tipo_reporte` varchar(50) NOT NULL,
  `cuerpo_mensaje` varchar(50) NOT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_hora_cierre` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `tipo_rol` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `tipo_rol`, `nombre`, `descripcion`) VALUES
(1, 'Usuario', 'Usuario', 'Rol básico de usuario'),
(2, 'Jefe de Campaña', 'Jefe de Campaña', 'Rol de jefe de campaña'),
(3, 'Administrador', 'Administrador', 'Rol de administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `cedula_seguidor` int(11) NOT NULL,
  `cedula_seguido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_campanias`
--

CREATE TABLE `solicitudes_campanias` (
  `id_solicitud_campania` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `id_publicacion` int(11) DEFAULT NULL,
  `id_campania` int(11) NOT NULL,
  `contacto` varchar(32) NOT NULL,
  `razon_interes` varchar(128) NOT NULL,
  `habilidades` varchar(150) NOT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `aceptada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_campanias`
--

INSERT INTO `solicitudes_campanias` (`id_solicitud_campania`, `cedula`, `id_publicacion`, `id_campania`, `contacto`, `razon_interes`, `habilidades`, `fecha_hora_envio`, `aceptada`) VALUES
(4, 119320433, NULL, 1, 'Telefono', 'cualquier estupidez', 'y mandalo', '2024-08-21 21:54:20', 1),
(5, 119320433, NULL, 2, '', 'hola', 'hola', '2024-08-21 22:28:34', 1),
(6, 119440864, NULL, 2, '', 'Para un mejor pais', '', '2024-08-21 22:44:40', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_usuario_jefe`
--

CREATE TABLE `solicitudes_usuario_jefe` (
  `id_solicitud_u` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `mensaje` varchar(512) NOT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_hora_cierre` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `confirmacion` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_denuncias`
--

CREATE TABLE `solicitud_denuncias` (
  `id_denuncia` int(11) NOT NULL,
  `tipo_denuncia` varchar(50) DEFAULT NULL,
  `detalle` varchar(1024) DEFAULT NULL,
  `img` varchar(512) DEFAULT NULL,
  `latitud` varchar(512) DEFAULT NULL,
  `longitud` varchar(512) DEFAULT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_hora_confirmacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `confirmacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_denuncias`
--

INSERT INTO `solicitud_denuncias` (`id_denuncia`, `tipo_denuncia`, `detalle`, `img`, `latitud`, `longitud`, `fecha_hora_envio`, `fecha_hora_confirmacion`, `confirmacion`) VALUES
(22, 'Basura en las calles', 'Hay basura en san josé', './assets/img/66c66cb9a929b4.98427011.jpg', '9.9330574', '-84.0557369', '2024-08-22 06:39:53', '2024-08-21 22:41:50', 'Aceptada'),
(23, 'Deforestación', 'deff', './assets/img/66c6704a4505f0.04931312.jpg', '9.9330574', '-84.0557369', '2024-08-22 06:55:06', '0000-00-00 00:00:00', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `num_seguidores` int(11) NOT NULL,
  `img` varchar(1024) DEFAULT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `nombre`, `primer_apellido`, `segundo_apellido`, `genero`, `fecha_nacimiento`, `nombre_usuario`, `telefono`, `correo`, `contrasena`, `num_seguidores`, `img`, `fecha_creacion`) VALUES
(118430764, 'Paula', 'Herrera', 'Prado', 'Femenino', '2005-03-07', 'paulix', 88745169, 'pualix.Herrera@gmial.com', '$2y$10$uD4rZBvmBiUz0mtiDNXgKe3qrrhsBXXIGh/MMmnqdXm/wNyLhm//S', 0, NULL, '2024-08-21'),
(119320433, 'Manrique', 'Carazo', 'Nieto', 'Masculino', '2005-04-02', 'TitoManri', 62261713, 'manri.carazo@gmail.com', '$2y$10$NAWF9xw.gPpD3GMyMkfX9.GiP.oJT6VPITNGrn3LXnFltIzLV2Boy', 0, NULL, '2024-08-21'),
(119410503, 'Jorge', 'Abarca', 'Coto', 'Masculino', '2005-07-28', 'yorsh', 83445437, 'jabarcacoto05@gmail.com', '$2y$10$ktr6jx4Mni7Q7OEIXEkj7OZmacEMm/tV3lJ2BICNPvEazBZla.zlK', 0, NULL, '2024-08-21'),
(119440864, 'Ana Maria', 'Castro', 'Aguero', 'Femenino', '2005-08-29', 'ana._.png', 87313999, 'anam.castro@gmail.com', '$2y$10$Yjyokqp5tBkgVbGXmx9L4eRnzNbfEnvrrErTwte0bhpqES4J6zI.y', 0, NULL, '2024-08-21'),
(305490995, 'Ricardo', 'Ocampo', 'Lara', 'Femenino', '2004-01-02', 'ricocla15', 86074850, 'ricocla15@gmail.com', '$2y$10$LU5Y4B61EfogEFlSRrDujOCsoRfz.ZWEeoSGrZeWBxqsq.zMtRCie', 0, NULL, '2024-08-21'),
(305590892, 'Miranda', 'Tenorio', 'Baldi', 'Femenino', '2005-07-14', 'mtenorio', 89263220, 'maripaztb@gmail.com', '$2y$10$nrORO3YyjNwpJdpKtRIPn.qI8JiM0g3giksgfEhOLjI7ZdkMeDbLW', 0, '../views/assets/img_app/usuarios/66c66a8f73c51.jpg', '2024-08-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_grupo`
--

CREATE TABLE `usuarios_grupo` (
  `cedula` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_roles`
--

CREATE TABLE `usuario_roles` (
  `cedula` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_roles`
--

INSERT INTO `usuario_roles` (`cedula`, `id_rol`) VALUES
(118430764, 1),
(119320433, 1),
(119410503, 1),
(119440864, 1),
(305490995, 3),
(305590892, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voluntarios_campanias`
--

CREATE TABLE `voluntarios_campanias` (
  `id_campania` int(11) NOT NULL,
  `id_solicitud_campania` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `voluntarios_campanias`
--

INSERT INTO `voluntarios_campanias` (`id_campania`, `id_solicitud_campania`) VALUES
(1, 4),
(2, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloqueados`
--
ALTER TABLE `bloqueados`
  ADD PRIMARY KEY (`cedula_bloqueador`,`cedula_bloqueado`),
  ADD KEY `cedula_bloqueado` (`cedula_bloqueado`);

--
-- Indices de la tabla `campanias`
--
ALTER TABLE `campanias`
  ADD PRIMARY KEY (`id_campania`),
  ADD KEY `cedula_creador_camp` (`cedula_creador_camp`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_publicacion` (`id_publicacion`),
  ADD KEY `id_publicacion_blog` (`id_publicacion_blog`),
  ADD KEY `id_padre` (`id_padre`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado_solicitud`),
  ADD KEY `cedula_jefe_camp` (`cedula_jefe_camp`),
  ADD KEY `id_reporte` (`id_reporte`),
  ADD KEY `id_solicitud_campania` (`id_solicitud_campania`),
  ADD KEY `id_denuncia` (`id_denuncia`),
  ADD KEY `id_solicitud_jefe` (`id_solicitud_jefe`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id_etiqueta`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `grupo_roles`
--
ALTER TABLE `grupo_roles`
  ADD PRIMARY KEY (`id_grupo`,`cedula`,`id_rol`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id_publicacion` (`id_publicacion`),
  ADD KEY `id_comentario` (`id_comentario`),
  ADD KEY `id_publicacion_blog` (`id_publicacion_blog`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `cedula_reminente` (`cedula_remitente`),
  ADD KEY `cedula_destinatario` (`cedula_destinatario`);

--
-- Indices de la tabla `mensajes_grupo`
--
ALTER TABLE `mensajes_grupo`
  ADD PRIMARY KEY (`id_mensaje_grupo`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id_publicacion`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_campania` (`id_campania`);

--
-- Indices de la tabla `publicaciones_blog`
--
ALTER TABLE `publicaciones_blog`
  ADD PRIMARY KEY (`id_publicacion_blog`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `publicaciones_etiquetas`
--
ALTER TABLE `publicaciones_etiquetas`
  ADD KEY `id_publicacion` (`id_publicacion`),
  ADD KEY `id_publicacion_blog` (`id_publicacion_blog`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `id_publicacion` (`id_publicacion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`cedula_seguidor`,`cedula_seguido`),
  ADD KEY `cedula_seguido` (`cedula_seguido`);

--
-- Indices de la tabla `solicitudes_campanias`
--
ALTER TABLE `solicitudes_campanias`
  ADD PRIMARY KEY (`id_solicitud_campania`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_publicacion` (`id_publicacion`),
  ADD KEY `id_campania` (`id_campania`);

--
-- Indices de la tabla `solicitudes_usuario_jefe`
--
ALTER TABLE `solicitudes_usuario_jefe`
  ADD PRIMARY KEY (`id_solicitud_u`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `solicitud_denuncias`
--
ALTER TABLE `solicitud_denuncias`
  ADD PRIMARY KEY (`id_denuncia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `usuarios_grupo`
--
ALTER TABLE `usuarios_grupo`
  ADD PRIMARY KEY (`cedula`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  ADD PRIMARY KEY (`cedula`,`id_rol`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `voluntarios_campanias`
--
ALTER TABLE `voluntarios_campanias`
  ADD PRIMARY KEY (`id_campania`,`id_solicitud_campania`),
  ADD KEY `id_solicitud_campania` (`id_solicitud_campania`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campanias`
--
ALTER TABLE `campanias`
  MODIFY `id_campania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id_etiqueta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT de la tabla `mensajes_grupo`
--
ALTER TABLE `mensajes_grupo`
  MODIFY `id_mensaje_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `publicaciones_blog`
--
ALTER TABLE `publicaciones_blog`
  MODIFY `id_publicacion_blog` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes_campanias`
--
ALTER TABLE `solicitudes_campanias`
  MODIFY `id_solicitud_campania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `solicitudes_usuario_jefe`
--
ALTER TABLE `solicitudes_usuario_jefe`
  MODIFY `id_solicitud_u` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_denuncias`
--
ALTER TABLE `solicitud_denuncias`
  MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cedula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305590893;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bloqueados`
--
ALTER TABLE `bloqueados`
  ADD CONSTRAINT `bloqueados_ibfk_1` FOREIGN KEY (`cedula_bloqueador`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `bloqueados_ibfk_2` FOREIGN KEY (`cedula_bloqueado`) REFERENCES `usuarios` (`cedula`);

--
-- Filtros para la tabla `campanias`
--
ALTER TABLE `campanias`
  ADD CONSTRAINT `campanias_ibfk_1` FOREIGN KEY (`cedula_creador_camp`) REFERENCES `usuarios` (`cedula`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id_publicacion`),
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`id_publicacion_blog`) REFERENCES `publicaciones_blog` (`id_publicacion_blog`),
  ADD CONSTRAINT `comentarios_ibfk_4` FOREIGN KEY (`id_padre`) REFERENCES `comentarios` (`id_comentario`);

--
-- Filtros para la tabla `estados`
--
ALTER TABLE `estados`
  ADD CONSTRAINT `estados_ibfk_1` FOREIGN KEY (`cedula_jefe_camp`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `estados_ibfk_2` FOREIGN KEY (`id_reporte`) REFERENCES `reportes` (`id_reporte`),
  ADD CONSTRAINT `estados_ibfk_3` FOREIGN KEY (`id_solicitud_campania`) REFERENCES `solicitudes_campanias` (`id_solicitud_campania`),
  ADD CONSTRAINT `estados_ibfk_4` FOREIGN KEY (`id_denuncia`) REFERENCES `solicitud_denuncias` (`id_denuncia`),
  ADD CONSTRAINT `estados_ibfk_5` FOREIGN KEY (`id_solicitud_jefe`) REFERENCES `solicitudes_usuario_jefe` (`id_solicitud_u`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`);

--
-- Filtros para la tabla `grupo_roles`
--
ALTER TABLE `grupo_roles`
  ADD CONSTRAINT `grupo_roles_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`),
  ADD CONSTRAINT `grupo_roles_ibfk_2` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `grupo_roles_ibfk_3` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id_publicacion`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id_comentario`),
  ADD CONSTRAINT `likes_ibfk_3` FOREIGN KEY (`id_publicacion_blog`) REFERENCES `publicaciones_blog` (`id_publicacion_blog`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`cedula_remitente`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`cedula_destinatario`) REFERENCES `usuarios` (`cedula`);

--
-- Filtros para la tabla `mensajes_grupo`
--
ALTER TABLE `mensajes_grupo`
  ADD CONSTRAINT `mensajes_grupo_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `mensajes_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `publicaciones_ibfk_2` FOREIGN KEY (`id_campania`) REFERENCES `campanias` (`id_campania`);

--
-- Filtros para la tabla `publicaciones_blog`
--
ALTER TABLE `publicaciones_blog`
  ADD CONSTRAINT `publicaciones_blog_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id_publicacion`);

--
-- Filtros para la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD CONSTRAINT `seguidores_ibfk_1` FOREIGN KEY (`cedula_seguidor`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `seguidores_ibfk_2` FOREIGN KEY (`cedula_seguido`) REFERENCES `usuarios` (`cedula`);

--
-- Filtros para la tabla `solicitudes_campanias`
--
ALTER TABLE `solicitudes_campanias`
  ADD CONSTRAINT `solicitudes_campanias_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `solicitudes_campanias_ibfk_2` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id_publicacion`),
  ADD CONSTRAINT `solicitudes_campanias_ibfk_3` FOREIGN KEY (`id_campania`) REFERENCES `campanias` (`id_campania`);

--
-- Filtros para la tabla `solicitudes_usuario_jefe`
--
ALTER TABLE `solicitudes_usuario_jefe`
  ADD CONSTRAINT `solicitudes_usuario_jefe_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`);

--
-- Filtros para la tabla `usuarios_grupo`
--
ALTER TABLE `usuarios_grupo`
  ADD CONSTRAINT `usuarios_grupo_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `usuarios_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  ADD CONSTRAINT `usuario_roles_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `usuario_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `voluntarios_campanias`
--
ALTER TABLE `voluntarios_campanias`
  ADD CONSTRAINT `voluntarios_campanias_ibfk_1` FOREIGN KEY (`id_campania`) REFERENCES `campanias` (`id_campania`),
  ADD CONSTRAINT `voluntarios_campanias_ibfk_2` FOREIGN KEY (`id_solicitud_campania`) REFERENCES `solicitudes_campanias` (`id_solicitud_campania`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
