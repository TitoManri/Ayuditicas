CREATE TABLE USUARIOS (
    cedula INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    primer_apellido VARCHAR(50) NOT NULL,
    segundo_apellido VARCHAR(50) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    nombre_usuario VARCHAR(50) NOT NULL,
    telefono INT NOT NULL,
    correo VARCHAR(128) NOT NULL,
    contrasena VARCHAR(100) NOT NULL,
    num_seguidores INT NOT NULL,
    img VARCHAR(1024),
    fecha_creacion DATE NOT NULL
);

CREATE TABLE ROLES (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    tipo_rol VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(50) NOT NULL
);

CREATE TABLE GRUPOS (
    id_grupo INT AUTO_INCREMENT PRIMARY KEY,
    cedula INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    fecha_creacion DATE NOT NULL,
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula)
);

CREATE TABLE CAMPANIAS (
    id_campania INT AUTO_INCREMENT PRIMARY KEY,
    cedula_creador_camp INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(1024) NOT NULL,
    voluntarios_requeridos INT NOT NULL,
    fecha_hora_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_culminacion TIMESTAMP NOT NULL,
    terminada BOOLEAN NOT NULL,
    FOREIGN KEY (cedula_creador_camp) REFERENCES USUARIOS(cedula)
);

CREATE TABLE PUBLICACIONES (
    id_publicacion INT AUTO_INCREMENT PRIMARY KEY,
    cedula INT NOT NULL,
    id_campania INT,
    img VARCHAR(512),
    titulo varchar(128),
    num_like INT NOT NULL,
    descripcion VARCHAR(512),
    inscripcion BOOLEAN NOT NULL,
    fecha_hora_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (id_campania) REFERENCES CAMPANIAS(id_campania)
);

CREATE TABLE PUBLICACIONES_BLOG (
    id_publicacion_blog INT AUTO_INCREMENT PRIMARY KEY,
    cedula INT NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    contenido VARCHAR(1024) NOT NULL,
    img VARCHAR(512),
    num_like INT NOT NULL,
    fecha_hora_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula)
);

CREATE TABLE ETIQUETAS (
    id_etiqueta INT AUTO_INCREMENT PRIMARY KEY,
    tipo_etiqueta VARCHAR(50),
    nombre VARCHAR(100)
);

CREATE TABLE USUARIO_ROLES (
    cedula INT NOT NULL,
    id_rol INT NOT NULL,
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (id_rol) REFERENCES ROLES(id_rol),
    PRIMARY KEY (cedula, id_rol)
);

CREATE TABLE GRUPO_ROLES (
    id_grupo INT NOT NULL,
    cedula INT NOT NULL,
    id_rol INT NOT NULL,
    FOREIGN KEY (id_grupo) REFERENCES GRUPOS(id_grupo),
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (id_rol) REFERENCES ROLES(id_rol),
    PRIMARY KEY (id_grupo, cedula, id_rol)
);

CREATE TABLE USUARIOS_GRUPO (
    cedula INT NOT NULL,
    id_grupo INT NOT NULL,
    fecha_ingreso TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (id_grupo) REFERENCES GRUPOS(id_grupo),
    PRIMARY KEY (cedula, id_grupo)
);

CREATE TABLE MENSAJES (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    cedula_reminente INT NOT NULL,
    cedula_destinatario INT NOT NULL,
    cuerpo_mensaje VARCHAR(1024),
    img VARCHAR(512),
    leido BOOLEAN NOT NULL,
    fecha_hora_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cedula_reminente) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (cedula_destinatario) REFERENCES USUARIOS(cedula)
);

CREATE TABLE MENSAJES_GRUPO (
    id_mensaje_grupo INT AUTO_INCREMENT PRIMARY KEY,
    cedula INT NOT NULL,
    id_grupo INT NOT NULL,
    contenido VARCHAR(1024),
    img VARCHAR(512),
    fecha_hora_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    leido BOOLEAN NOT NULL,
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (id_grupo) REFERENCES GRUPOS(id_grupo)
);

CREATE TABLE COMENTARIOS (
    id_comentario INT AUTO_INCREMENT PRIMARY KEY,
    cedula INT NOT NULL,
    id_publicacion INT,
    id_publicacion_blog INT,
    id_padre INT,
    tipo_comentario VARCHAR(50) NOT NULL,
    num_like INT NOT NULL,
    contenido VARCHAR(512) NOT NULL,
    img VARCHAR(512),
    fecha_hora_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (id_publicacion) REFERENCES PUBLICACIONES(id_publicacion),
    FOREIGN KEY (id_publicacion_blog) REFERENCES PUBLICACIONES_BLOG(id_publicacion_blog),
    FOREIGN KEY (id_padre) REFERENCES COMENTARIOS(id_comentario)
);

CREATE TABLE LIKES (
    id_like INT AUTO_INCREMENT PRIMARY KEY,
    id_publicacion INT,
    id_comentario INT,
    id_publicacion_blog INT,
    FOREIGN KEY (id_publicacion) REFERENCES PUBLICACIONES(id_publicacion),
    FOREIGN KEY (id_comentario) REFERENCES COMENTARIOS(id_comentario),
    FOREIGN KEY (id_publicacion_blog) REFERENCES PUBLICACIONES_BLOG(id_publicacion_blog)
);

CREATE TABLE REPORTES (
    id_reporte INT AUTO_INCREMENT PRIMARY KEY,
    id_publicacion INT,
    tipo_reporte VARCHAR(50) NOT NULL,
    cuerpo_mensaje VARCHAR(50) NOT NULL,
    fecha_hora_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_cierre TIMESTAMP,
    FOREIGN KEY (id_publicacion) REFERENCES PUBLICACIONES(id_publicacion)
);

CREATE TABLE SOLICITUDES_CAMPANIAS (
    id_solicitud_campania INT AUTO_INCREMENT PRIMARY KEY,
    cedula INT NOT NULL,
    id_publicacion INT NOT NULL,
    id_campania INT NOT NULL,
    contacto INT NOT NULL,
    razon_interes VARCHAR(50) NOT NULL,
    habilidades VARCHAR(150) NOT NULL,
    fecha_hora_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    aceptada BOOLEAN NOT NULL,
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (id_publicacion) REFERENCES PUBLICACIONES(id_publicacion),
    FOREIGN KEY (id_campania) REFERENCES CAMPANIAS(id_campania)
);

CREATE TABLE SEGUIDORES (
    cedula_seguidor INT NOT NULL,
    cedula_seguido INT NOT NULL,
    FOREIGN KEY (cedula_seguidor) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (cedula_seguido) REFERENCES USUARIOS(cedula),
    PRIMARY KEY (cedula_seguidor, cedula_seguido)
);

CREATE TABLE BLOQUEADOS (
    cedula_bloqueador INT NOT NULL,
    cedula_bloqueado INT NOT NULL,
    FOREIGN KEY (cedula_bloqueador) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (cedula_bloqueado) REFERENCES USUARIOS(cedula),
    PRIMARY KEY (cedula_bloqueador, cedula_bloqueado)
);

CREATE TABLE PUBLICACIONES_ETIQUETAS (
    id_etiqueta INT NOT NULL,
    id_publicacion INT,
    id_publicacion_blog INT,
    FOREIGN KEY (id_etiqueta) REFERENCES ETIQUETAS(id_etiqueta),
    FOREIGN KEY (id_publicacion) REFERENCES PUBLICACIONES(id_publicacion),
    FOREIGN KEY (id_publicacion_blog) REFERENCES PUBLICACIONES_BLOG(id_publicacion_blog),
    PRIMARY KEY (id_etiqueta, id_publicacion, id_publicacion_blog)
);

CREATE TABLE VOLUNTARIOS_CAMPANIAS (
    id_campania INT NOT NULL,
    id_solicitud_campania INT NOT NULL,
    FOREIGN KEY (id_campania) REFERENCES CAMPANIAS(id_campania),
    FOREIGN KEY (id_solicitud_campania) REFERENCES SOLICITUDES_CAMPANIAS(id_solicitud_campania),
    PRIMARY KEY (id_campania, id_solicitud_campania)
);

CREATE TABLE SOLICITUD_DENUNCIAS (
    id_denuncia INT AUTO_INCREMENT PRIMARY KEY,
    tipo_denuncia VARCHAR(50),
    detalle VARCHAR(1024),
    img VARCHAR(512),
    latitud VARCHAR(512),
    longitud VARCHAR(512),
    fecha_hora_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_confirmacion TIMESTAMP NOT NULL,
    confirmacion VARCHAR(50)
);

CREATE TABLE SOLICITUDES_USUARIO_JEFE (
    id_solicitud_u INT AUTO_INCREMENT PRIMARY KEY,
    cedula INT NOT NULL,
    mensaje VARCHAR(512) NOT NULL,
    fecha_hora_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_cierre TIMESTAMP NOT NULL,
    confirmacion VARCHAR(512) NOT NULL,
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula)
);

CREATE TABLE ESTADOS (
    id_estado_solicitud INT AUTO_INCREMENT PRIMARY KEY,
    cedula_jefe_camp INT NOT NULL,
    id_reporte INT,
    id_solicitud_campania INT,
    id_denuncia INT,
    id_solicitud_jefe INT,
    tipo_estado VARCHAR(50) NOT NULL,
    progreso VARCHAR(50) NOT NULL,
    is_resuelto BOOLEAN NOT NULL,
    aceptada BOOLEAN NOT NULL,
    FOREIGN KEY (cedula_jefe_camp) REFERENCES USUARIOS(cedula),
    FOREIGN KEY (id_reporte) REFERENCES REPORTES(id_reporte),
    FOREIGN KEY (id_solicitud_campania) REFERENCES SOLICITUDES_CAMPANIAS(id_solicitud_campania),
    FOREIGN KEY (id_denuncia) REFERENCES SOLICITUD_DENUNCIAS(id_denuncia),
    FOREIGN KEY (id_solicitud_jefe) REFERENCES SOLICITUDES_USUARIO_JEFE(id_solicitud_u)
);
