create table USUARIOS(
    cedula int not null,
    nombre varchar(50) not null,
    primer_apellido varchar(50) not null,
    segundo_apellido varchar(50) not null,
    genero varchar(50) not null,
    fecha_nacimiento date not null,
    nombre_usuario varchar(50) not null,
    telefono int not null,
    correo varchar(128) not null,
    contrasena varchar(100) not null,
    num_seguidores int not null,
    img varchar(1024),
    fecha_creacion date not null,
    primary key (cedula) 
);

create table ROLES(
    id_rol int not null,
    tipo_rol varchar(50) not null,
    nombre varchar(50) not null,
    descripcion varchar(50) not null,
    primary key(id_rol)
);

create table GRUPOS(
    id_grupo int not null,
    cedula int not null,
    nombre varchar(50) not null,
    fecha_creacion date not null,
    primary key(id_grupo),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula)
);

create table CAMPANIAS(
    id_campania int not null,
    cedula_creador_camp int not null,
    nombre varchar(50) not null,
    descripcion varchar(1024) not null,
    voluntarios_requeridos int not null,
    fecha_hora_creacion datetime DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_culminacion datetime not null,
    terminada boolean not null,
    primary key(id_campania), 
    FOREIGN KEY (cedula_creador_camp) REFERENCES usuarios(cedula)
);

create table PUBLICACIONES(
    id_publicacion int not null,
    cedula int not null,
    id_campania int,
    img varchar(512),
    num_like int not null,
    descripcion varchar(512),
    inscripcion boolean not null,
    fecha_hora_creacion datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(id_publicacion),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_campania) REFERENCES campanias(id_campania) 
);

create table PUBLICACIONES_BLOG(
    id_publicacion_blog int not null,
    cedula int not null,
    titulo varchar(50) not null,
    contenido varchar(1024) not null,
    img varchar(512) not null,
    num_like int not null,
    fecha_hora_creacion datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(id_publicacion_blog),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula)
);

create table ETIQUETAS(
  id_etiqueta int not null,
  tipo_etiqueta varchar(50),
  nombre varchar(100),
  primary key(id_etiqueta)
);

create table USUARIO_ROLES(
    cedula int not null,
    id_rol int not null,
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);
create table GRUPO_ROLES(
    id_grupo int not null,
    cedula int not null,
    id_rol int not null,
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo), 
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula), 
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

create table USUARIOS_GRUPO(
    cedula int not null,
    id_grupo int not null,
    fecha_ingreso datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo) 
);

create table MENSAJES(
    id_mensaje int not null,
    cedula_reminente int not null,
    cedula_destinatario int not null,
    cuerpo_mensaje varchar(1024),
    img varchar(512),
    leido boolean not null,
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(id_mensaje), 
    FOREIGN KEY (cedula_reminente) REFERENCES usuarios(cedula), 
    FOREIGN KEY (cedula_destinatario) REFERENCES usuarios(cedula) 
);

create table MENSAJES_GRUPO(
    id_mensaje_grupo int not null,
    cedula int not null,
    id_grupo int not null,
    contenido varchar(1024),
    img varchar(512),
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    leido boolean not null,
     primary key(id_mensaje_grupo), 
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo) 
);

create table COMENTARIOS(
    id_comentario int not null,
    cedula int not null,
    id_publicacion int,
    id_publicacion_blog int,
    id_padre int, 
    tipo_comentario varchar(50) not null,
    num_like int not null,
    contenido varchar(512) not null,
    img varchar(512),
    fecha_hora_creacion datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(id_comentario),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_publicacion) REFERENCES publicaciones(id_publicacion),
    FOREIGN KEY (id_publicacion_blog) REFERENCES publicaciones_blog(id_publicacion_blog),
    FOREIGN KEY (id_padre) REFERENCES comentarios(id_comentario)
);

create table LIKES(
    id_like int not null,
    id_publicacion int not null,
    id_comentario int not null,
    id_publicacion_blog int not null,
    primary key(id_like),
    FOREIGN KEY (id_publicacion) REFERENCES publicaciones(id_publicacion),
    FOREIGN KEY (id_comentario) REFERENCES comentarios(id_comentario),
    FOREIGN KEY (id_publicacion_blog) REFERENCES publicaciones_blog(id_publicacion_blog)
);

create table REPORTES(
    id_reporte int not null,
    id_publicacion int not null,
    tipo_reporte varchar(50) not null,
    cuerpo_mensaje varchar(50) not null,
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_cierre datetime,
    primary key(id_reporte),
    FOREIGN KEY (id_publicacion) REFERENCES publicaciones(id_publicacion)
);
create table SOLICITUDES_CAMPANIAS(
    id_solicitud_campania int not null,
    cedula int not null,
    id_publicacion int,
    id_campania int not null,
    contacto int not null,
    razon_interes varchar(50) not null,
    habilidades varchar(150) not null,
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    aceptada boolean not null,
    primary key(id_solicitud_campania), 
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula), 
    FOREIGN KEY (id_publicacion) REFERENCES publicaciones(id_publicacion),
    FOREIGN KEY (id_campania) REFERENCES campanias(id_campania)
);

create table SEGUIDORES(
    cedula_seguidor int not null,
    cedula_seguido int not null,
    FOREIGN KEY (cedula_seguidor) REFERENCES usuarios(cedula),
    FOREIGN KEY (cedula_seguido) REFERENCES usuarios(cedula)
);

create table BLOQUEADOS( 
    cedula_bloqueador int not null,
    cedula_bloqueado int not null, 
    FOREIGN KEY (cedula_bloqueador) REFERENCES usuarios(cedula),
    FOREIGN KEY (cedula_bloqueado) REFERENCES usuarios(cedula)
);


create table PUBLICACIONES_ETIQUETAS(
    id_etiqueta int not null,
    id_publicacion int,
    id_publicacion_blog int,
    FOREIGN KEY (id_etiqueta) REFERENCES etiquetas(id_etiqueta),
    FOREIGN KEY (id_publicacion) REFERENCES publicaciones(id_publicacion),
    FOREIGN KEY (id_publicacion_blog) REFERENCES publicaciones_blog(id_publicacion_blog)
);

create table VOLUNTARIOS_CAMPANIAS(
    id_campania int not null,
    id_solicitud_campania int not null,
    FOREIGN KEY (id_campania) REFERENCES campanias(id_campania),
    FOREIGN KEY (id_solicitud_campania) REFERENCES solicitudes_campanias(id_solicitud_campania)
);

create table SOLICITUD_DENUNCIAS(
    id_denuncia int not null,
    cedula int not null,
    tipo_denuncia varchar(50),
    detalle varchar(1024),
    img varchar(512),
    latitud varchar(512),
    longitud varchar(512),
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_confirmacion datetime not null,
    confirmacion varchar(50),
    primary key(id_denuncia),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula)
);

create table SOLICITUDES_USUARIO_JEFE(
    id_solicitud_u int not null,
    cedula int not null,
    mensaje varchar(512) not null,
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_cierre datetime not null,
    confirmacion varchar(512) not null,
    primary key(id_solicitud_u),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula)
);

create table ESTADOS(
    id_estado_solicitud int not null,
    cedula_jefe_camp int not null,
    id_reporte int,
    id_solicitud_campania int,
    id_denuncia int,
    id_solicitud_jefe int,
    tipo_estado varchar(50) not null,
    progreso varchar(50) not null,
    is_resuleto boolean not null,
    aceptada boolean not null,
    primary key(id_estado_solicitud),
    FOREIGN KEY (cedula_jefe_camp) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_reporte) REFERENCES reportes(id_reporte),
    FOREIGN KEY (id_solicitud_campania) REFERENCES Solicitudes_Campanias(id_solicitud_campania),
    FOREIGN KEY (id_denuncia) REFERENCES  solicitud_denuncias(id_denuncia),
    FOREIGN KEY (id_solicitud_jefe) REFERENCES solicitudes_usuario_Jefe(id_solicitud_u)
=======
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

create table ROLES(
    id_rol int not null,
    tipo_rol varchar(50) not null,
    nombre varchar(50) not null,
    descripcion varchar(50) not null,
    primary key(id_rol)
);

create table GRUPOS(
    id_grupo int not null,
    cedula int not null,
    nombre varchar(50) not null,
    fecha_creacion date not null,
    primary key(id_grupo),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula)
);

create table CAMPANIAS(
    id_campania int not null,
    cedula_creador_camp int not null,
    nombre varchar(50) not null,
    descripcion varchar(1024) not null,
    voluntarios_requeridos int not null,
    fecha_hora_creacion datetime DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_culminacion datetime not null,
    terminada boolean not null,
    primary key(id_campania), 
    FOREIGN KEY (cedula_creador_camp) REFERENCES usuarios(cedula)
);

create table PUBLICACIONES(
    id_publicacion int not null,
    cedula int not null,
    id_campania int,
    img varchar(512),
    num_like int not null,
    descripcion varchar(512),
    inscripcion boolean not null,
    fecha_hora_creacion datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(id_publicacion),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_campania) REFERENCES campanias(id_campania) 
);

create table PUBLICACIONES_BLOG(
    id_publicacion_blog int not null,
    cedula int not null,
    titulo varchar(50) not null,
    contenido varchar(1024) not null,
    img varchar(512) not null,
    num_like int not null,
    fecha_hora_creacion datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(id_publicacion_blog),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula)
);

create table ETIQUETAS(
  id_etiqueta int not null,
  tipo_etiqueta varchar(50),
  nombre varchar(100),
  primary key(id_etiqueta)
);

create table USUARIO_ROLES(
    cedula int not null,
    id_rol int not null,
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);
create table GRUPO_ROLES(
    id_grupo int not null,
    cedula int not null,
    id_rol int not null,
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo), 
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula), 
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

create table USUARIOS_GRUPO(
    cedula int not null,
    id_grupo int not null,
    fecha_ingreso datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo) 
);

create table MENSAJES(
    id_mensaje int not null,
    cedula_reminente int not null,
    cedula_destinatario int not null,
    cuerpo_mensaje varchar(1024),
    img varchar(512),
    leido boolean not null,
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(id_mensaje), 
    FOREIGN KEY (cedula_reminente) REFERENCES usuarios(cedula), 
    FOREIGN KEY (cedula_destinatario) REFERENCES usuarios(cedula) 
);

create table MENSAJES_GRUPO(
    id_mensaje_grupo int not null,
    cedula int not null,
    id_grupo int not null,
    contenido varchar(1024),
    img varchar(512),
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    leido boolean not null,
     primary key(id_mensaje_grupo), 
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo) 
);

create table COMENTARIOS(
    id_comentario int not null,
    cedula int not null,
    id_publicacion int,
    id_publicacion_blog int,
    id_padre int, 
    tipo_comentario varchar(50) not null,
    num_like int not null,
    contenido varchar(512) not null,
    img varchar(512),
    fecha_hora_creacion datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(id_comentario),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_publicacion) REFERENCES publicaciones(id_publicacion),
    FOREIGN KEY (id_publicacion_blog) REFERENCES publicaciones_blog(id_publicacion_blog),
    FOREIGN KEY (id_padre) REFERENCES comentarios(id_comentario)
);

CREATE TABLE LIKES (
    id_like INT AUTO_INCREMENT PRIMARY KEY,
    cedula INT,
    id_publicacion INT,
    id_comentario INT,
    id_publicacion_blog INT,
    FOREIGN KEY (id_publicacion) REFERENCES PUBLICACIONES(id_publicacion),
    FOREIGN KEY (id_comentario) REFERENCES COMENTARIOS(id_comentario),
    FOREIGN KEY (id_publicacion_blog) REFERENCES PUBLICACIONES_BLOG(id_publicacion_blog),
    FOREIGN KEY (cedula) REFERENCES USUARIOS(cedula)
);

create table REPORTES(
    id_reporte int not null,
    id_publicacion int not null,
    tipo_reporte varchar(50) not null,
    cuerpo_mensaje varchar(50) not null,
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_cierre datetime,
    primary key(id_reporte),
    FOREIGN KEY (id_publicacion) REFERENCES publicaciones(id_publicacion)
);
create table SOLICITUDES_CAMPANIAS(
    id_solicitud_campania int not null,
    cedula int not null,
    id_publicacion int not null,
    id_campania int not null,
    contacto int not null,
    razon_interes varchar(50) not null,
    habilidades varchar(150) not null,
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    aceptada boolean not null,
    primary key(id_solicitud_campania), 
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula), 
    FOREIGN KEY (id_publicacion) REFERENCES publicaciones(id_publicacion),
    FOREIGN KEY (id_campania) REFERENCES campanias(id_campania)
);

create table SEGUIDORES(
    cedula_seguidor int not null,
    cedula_seguido int not null,
    FOREIGN KEY (cedula_seguidor) REFERENCES usuarios(cedula),
    FOREIGN KEY (cedula_seguido) REFERENCES usuarios(cedula)
);

create table BLOQUEADOS( 
    cedula_bloqueador int not null,
    cedula_bloqueado int not null, 
    FOREIGN KEY (cedula_bloqueador) REFERENCES usuarios(cedula),
    FOREIGN KEY (cedula_bloqueado) REFERENCES usuarios(cedula)
);


create table PUBLICACIONES_ETIQUETAS(
    id_etiqueta int not null,
    id_publicacion int,
    id_publicacion_blog int,
    FOREIGN KEY (id_etiqueta) REFERENCES etiquetas(id_etiqueta),
    FOREIGN KEY (id_publicacion) REFERENCES publicaciones(id_publicacion),
    FOREIGN KEY (id_publicacion_blog) REFERENCES publicaciones_blog(id_publicacion_blog)
);

create table VOLUNTARIOS_CAMPANIAS(
    id_campania int not null,
    id_solicitud_campania int not null,
    FOREIGN KEY (id_campania) REFERENCES campanias(id_campania),
    FOREIGN KEY (id_solicitud_campania) REFERENCES solicitudes_campanias(id_solicitud_campania)
);

create table SOLICITUD_DENUNCIAS(
    id_denuncia int not null,
    cedula int not null,
    tipo_denuncia varchar(50),
    detalle varchar(1024),
    img varchar(512),
    latitud varchar(512),
    longitud varchar(512),
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_confirmacion datetime not null,
    confirmacion varchar(50),
    primary key(id_denuncia),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula)
);

create table SOLICITUDES_USUARIO_JEFE(
    id_solicitud_u int not null,
    cedula int not null,
    mensaje varchar(512) not null,
    fecha_hora_envio datetime DEFAULT CURRENT_TIMESTAMP,
    fecha_hora_cierre datetime not null,
    confirmacion varchar(512) not null,
    primary key(id_solicitud_u),
    FOREIGN KEY (cedula) REFERENCES usuarios(cedula)
);

create table ESTADOS(
    id_estado_solicitud int not null,
    cedula_jefe_camp int not null,
    id_reporte int,
    id_solicitud_campania int,
    id_denuncia int,
    id_solicitud_jefe int,
    tipo_estado varchar(50) not null,
    progreso varchar(50) not null,
    is_resuleto boolean not null,
    aceptada boolean not null,
    primary key(id_estado_solicitud),
    FOREIGN KEY (cedula_jefe_camp) REFERENCES usuarios(cedula),
    FOREIGN KEY (id_reporte) REFERENCES reportes(id_reporte),
    FOREIGN KEY (id_solicitud_campania) REFERENCES Solicitudes_Campanias(id_solicitud_campania),
    FOREIGN KEY (id_denuncia) REFERENCES  solicitud_denuncias(id_denuncia),
    FOREIGN KEY (id_solicitud_jefe) REFERENCES solicitudes_usuario_Jefe(id_solicitud_u)
);
