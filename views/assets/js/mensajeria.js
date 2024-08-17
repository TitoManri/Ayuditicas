//listaUsuarios y mensajesPorUsuario
const listaUsuarios = {};
const mensajesPorUsuario = {};
const usuariosExistentes = {};

//variable que cambia dependiendo del usuario/grupo con el que se esté chateando
let chatActual = null;
let chatActualImg = null;
let chatActualCed = null;
//variable que contiene al usuario logueado en el momento
let usuarioDiv = document.getElementById('usuarioActual');

let usuarioLogueadoUser = usuarioDiv.getAttribute('data-usuario');
let logueadoImg = usuarioDiv.getAttribute('data-img');
if (logueadoImg == null || logueadoImg == "") {
    logueadoImg = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
}
let usuarioLogueado = usuarioDiv.getAttribute('data-ced');


//form para envío de mensajes
const enviarFormulario = document.getElementById('enviarMsj');
//mensaje (texto que introduce el usuario)
const inputMensaje = document.getElementById('mensaje');
//botón para enviar los mensajes
const btnEnviar = document.getElementById('btnEnviar');
//espacio en blanco donde van los mensajes
const contenedorChat = document.getElementById('chatContainer');
//botón para subir imágenes
const btnSubirImagen = document.getElementById('btnImg');

//deshabilitar input, botón enviar mensaje y botón enviar foto hasta que seleccione un usuario
inputMensaje.disabled = true;
btnEnviar.disabled = true;
btnSubirImagen.disabled = true;


function eventoClick(contacto) {
    contacto.querySelector('.nav-link').addEventListener('click', function (e) {
        e.preventDefault();

        //quita la clase activa de todos los usuarios
        const usuarios = document.querySelectorAll('.nav-link');
        usuarios.forEach(u => u.classList.remove('active'));

        //agrega la clase activa al usuario seleccionado
        this.classList.add('active');

        //toma el nombre de usuario y su imagen 
        chatActual = this.getAttribute('data-usuario');
        chatActualCed = this.getAttribute('data-cedula');
        imagenChat = this.getAttribute("data-img");
        if (imagenChat != null) {
            chatActualImg = this.getAttribute('data-img');
        } else {
             chatActualImg = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png";
        }


        if (chatActual != null) {
            actualizarChat(chatActual, chatActualImg);
            llenarArregloMensajes(chatActual, chatActualCed)
            actualizarLeido();
        }

        //permite usar el input, botón y foto
        inputMensaje.disabled = false;
        btnEnviar.disabled = false;
        btnSubirImagen.disabled = false;
    });
}

function actualizarLeido(){
    $.ajax({
        url: '../controllers/mensajeController.php?op=updateLeido',
        type: 'POST',
        data: { cedRemitente: chatActualCed, cedDestinatario: usuarioLogueado },
        dataType: 'json',
        success: function(response) {
            console.log('El estado de leído ha sido actualizado correctamente');
        },
        error: function () {
            console.log('Hubo un error al actualizar el estado de leído de los mensajes');
        }
    });
}


function listarUsuariosContactos() {
    $.ajax({
        url: '../controllers/mensajeController.php?op=listarContactos',
        type: 'POST',
        data: { cedulaUsuarioActual: usuarioLogueado },
        dataType: 'json',
        success: function (arr) {
            const listaU = document.getElementById("listaUsuarios");


            arr.forEach(function (usuario) {
                listaU[usuario.cedula] = usuario.nombreUsuario;
                mensajesPorUsuario[usuario.nombreUsuario] = [];


                const contacto = document.createElement('li');
                contacto.classList.add('nav-item', 'my-1');

                let imagenContacto=usuario.img;
                if (imagenContacto == null || imagenContacto == "") {
                    imagenContacto= "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                }

                contacto.innerHTML =
                    "<a href='#' class='nav-link' data-cedula='" + usuario.cedula + "' data-usuario='" + usuario.nombreUsuario + "' data-img='" + imagenContacto + "'>" +
                    "<img src='" + imagenContacto + "' alt='' width='32' height='32' class='rounded-circle me-2'>" +
                    "<strong>" + usuario.nombreUsuario + "</strong>" +
                    "</a>";

                //inserta el usuario antes del hr
                listaU.appendChild(contacto);

                //agregar evento para cada contacto/usuario
                eventoClick(contacto);
            });

        },
        error: function (err) {
            console.log('Hubo un error al cargar los usuarios en la lista de contactos ', err.responseText);
        }
    });
}

function llenarArregloMensajes(nombreUsuario, cedula) {
    $.ajax({
        url: '../controllers/mensajeController.php?op=mostrarMensajesChat',
        type: 'POST',
        data: { usuario1: usuarioLogueado, usuario2: cedula },
        dataType: 'json',
        success: function (mensajes) {
            mensajesPorUsuario[nombreUsuario] = mensajes;
        },
        error: function (err) {
            console.log('Hubo un error al cargar los usuarios en la lista de contactos ', err.responseText);
        }
    });
}

//función principal
document.addEventListener("DOMContentLoaded", function () {
    listarUsuariosContactos();
    llenarListaUsuarios();
});


//guardar miembros del grupo (habría que cargarlo de la base de datos) FALTA !!!!
const miembrosDeGrupo = {
    'Grupo 1': ['Miembro 1', 'Miembro 2'],
    'Grupo 2': ['Miembro 2', 'Miembro 1']
};

//ACTUALIZAR CHAT CUANDO SE SELECCIONE UN USUARIO
function actualizarChat(nombre, imagen) {
    //el nombre del usuario/grupo seleccionado (viene de los atributos)
    chatActual = nombre;
    //elemento en el header para mostrar el usuario con el que se está chateando
    const chatActualElemento = document.getElementById('chatActual');
    //si el nombre coincide con un grupo se muestran los miembros de ese grupo sino se deja vacío
    const miembrosGrupo = miembrosDeGrupo[nombre] ? mostrarMiembros(miembrosDeGrupo[nombre]) : '';

    //se modifica el código dentro del div para que ahora muestre los datos del usuario seleccionado (se reemplazan)
    chatActualElemento.innerHTML =
        "<img src=" + imagen + " alt='' width='32' height='32' class='rounded-circle me-2'>" +
        "<strong class='text-white'>" + nombre + "</strong>" + miembrosGrupo;

    //borra contenido del chat para que no aparezcan los msj de otro chat
    contenedorChat.innerHTML = '';

    //mostrar los mensajes del nuevo usuario/grupo, se cargan en el chat usando crearMensajeElemento y el append
    mensajesPorUsuario[nombre].forEach(mensaje => {
        const mensajeElemento = crearMensajeElemento(mensaje);
        contenedorChat.appendChild(mensajeElemento);
    });

    //scroll automático 
    contenedorChat.scrollTop = contenedorChat.scrollHeight;
}

//CREAR UN ELEMENTO DE MENSAJE
function crearMensajeElemento(mensaje) {
    //dentro del div de mensajes se crea un nuevo div
    const mensajeElemento = document.createElement('div');
    //si el usuario es igual a usuario logeado (esto habría que pasarlo con una variable de sesión)
    if (mensaje.remitente == usuarioLogueado) {
        //se le asigna el estilo al mensaje del css del usuario logueado
        mensajeElemento.classList.add('chat-message', 'user-message');
        if (mensaje.img != null) {
            //si el mensaje es una imagen se agregar el código hmtl para la imagen
            mensajeElemento.innerHTML =
                "<img src='" + logueadoImg + "' alt='' width='32' height='32' class='rounded-circle me-2'>" +
                "<img src=" + mensaje.img + " alt='Imagen subida' style='max-width: 200px;'>";
        } else {
            //sino solo se agrega el código html para un mensaje de txt
            mensajeElemento.innerHTML =
                "<img src='" + logueadoImg + "' alt='' width='32' height='32' class='rounded-circle me-2'>"
                + mensaje.cuerpo;
        }

    } else {
        //sino se le aisgna el estilo al mensaje de cualquier otro usuario
        mensajeElemento.classList.add('chat-message', 'other-message');
        if (mensaje.img != null) {
            //si el mensaje es una imagen se agregar el código hmtl para la imagen
            mensajeElemento.innerHTML =
                "<img src='" + chatActualImg + "' alt='' width='32' height='32' class='rounded-circle me-2'>" +
                "<img src=" + mensaje.img + " alt='Imagen subida' style='max-width: 200px;'>";
        } else {
            //sino solo se agrega el código html para un mensaje de txt
            mensajeElemento.innerHTML =
                "<img src='" + chatActualImg + "' alt='' width='32' height='32' class='rounded-circle me-2'>"
                + mensaje.cuerpo;
        }
    }


    //decuelve el código ya completo con los mensajes
    return mensajeElemento;
}

//MOSTRAR MIEMBROS DE UN GRUPO !!!!FALTA
function mostrarMiembros(miembros) {
    //se crea la lista para ponerle adentro a los usuarios
    let miembrosGrupo = "<ul class='list-inline mb-0 text-white'>";
    miembros.forEach((miembro, index) => {
        if (index !== 0) {
            //por cada miembro del arreglo se le pone una ", "
            miembrosGrupo += ",";
        }
        //se agrega un list element por cada miembro
        miembrosGrupo += "<li class='list-inline-item text-white'>" + miembro + "</li>";
    });
    //se cierra la lista html
    miembrosGrupo += "</ul>";
    return miembrosGrupo;
}

//EVENTO PARA ENVIAR MENSAJE
enviarFormulario.addEventListener('submit', function (e) {
    //evitar que el formulario se envíe y recargue la página
    e.preventDefault();

    //agarra el valor del input y lo guarda en mensaje
    let mensaje = inputMensaje.value.trim();
    //si no está vacío
    if (mensaje !== '') {
        //se agrega el mensaje al contenedor del chat
        agregarMensaje(usuarioLogueado, chatActualCed, mensaje, null);
        //limpia el input después de enviar el mensaje
        inputMensaje.value = '';
    }
});

//EVENTO PARA SUBIR UNA IMAGEN !!FALTA
//se almacena el formulario en una variable
const formularioSubida = document.getElementById('imgForm');
//se le agrega el evento de submit
formularioSubida.addEventListener('submit', function (e) {
    e.preventDefault();

    const inputArchivo = document.getElementById('imagen');
    if (inputArchivo.files.length === 0) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Por favor selecciona una imagen para subir."
        });
        return;
    }

    const imgData = inputArchivo.files[0];

    // Envía la imagen
    agregarMensaje(usuarioLogueado, chatActualCed, null, imgData);

    // Cerrar el modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('cargarModal'));
    modal.hide();

    // Limpiar input 
    inputArchivo.value = '';
});

//AGREGA UN MENSAJE EN EL CONTENEDOR DE CHATS Y LOS AGREGA A LA LISTA DE MENSAJES
function agregarMensaje(usuarioRemitente, usuarioDestinatario, mensaje, imgData) {
    let datos = null;

    if (imgData == null) {
        datos = { cedulaRemitente: usuarioRemitente, cedulaDestinatario: usuarioDestinatario, cuerpoMensaje: mensaje, img: null };

        $.ajax({
            url: '../controllers/mensajeController.php?op=enviarMensaje',
            type: 'POST',
            data: datos,
            dataType: 'json',
            success: function (response) {
                if (response.msj) {
                    console.log('Mensaje enviado correctamente: ', response.msj);

                    // Crear y añadir el nuevo mensaje al chat
                    const nuevoMensaje = {
                        remitente: usuarioRemitente,
                        cuerpo: response.msj,
                        img: null
                    };
                    mensajesPorUsuario[chatActual].push(nuevoMensaje);
                    const mensajeElemento = crearMensajeElemento(nuevoMensaje);
                    contenedorChat.appendChild(mensajeElemento);
                    contenedorChat.scrollTop = contenedorChat.scrollHeight;

                } else if (response.error) {
                    console.log('Error al enviar el mensaje: ', response.error);
                }
            },
            error: function (err) {
                console.log('Error al enviar el mensaje: ', err.responseText);
            }
        });
    } else {
        const formData = new FormData();
        formData.append('cedulaRemitente', usuarioRemitente);
        formData.append('cedulaDestinatario', usuarioDestinatario);
        formData.append('imagen', imgData);

        $.ajax({
            url: '../controllers/mensajeController.php?op=enviarMensaje',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.img) {
                    console.log('Imagen enviada correctamente: ', response.img);

                    // Crear y añadir el nuevo mensaje con imagen al chat
                    const nuevoMensaje = {
                        remitente: usuarioRemitente,
                        cuerpo: '',
                        img: response.img
                    };
                    mensajesPorUsuario[chatActual].push(nuevoMensaje);
                    const mensajeElemento = crearMensajeElemento(nuevoMensaje);
                    contenedorChat.appendChild(mensajeElemento);
                    contenedorChat.scrollTop = contenedorChat.scrollHeight;

                } else if (response.error) {
                    console.log('Error al enviar la imagen: ', response.error);
                }
            },
            error: function (err) {
                console.log('Error al enviar la imagen: ', err.responseText);
            }
        });
    }
}

function actualizarMensajes() {
    $.ajax({
        url: '../controllers/mensajeController.php?op=mostrarMensajesChat',
        type: 'POST',
        data: { usuario1: usuarioLogueado, usuario2: chatActualCed },
        dataType: 'json',
        success: function (mensajes) {
            if (mensajes) {
                // Actualiza el arreglo de mensajes
                mensajesPorUsuario[chatActual] = mensajes;
                // Limpiar el contenedor del chat
                contenedorChat.innerHTML = '';
                // Mostrar los mensajes actualizados
                mensajes.forEach(mensaje => {
                    const mensajeElemento = crearMensajeElemento(mensaje);
                    contenedorChat.appendChild(mensajeElemento);
                });
                // Scroll automático al final del chat
                contenedorChat.scrollTop = contenedorChat.scrollHeight;
            }
        },
        error: function (err) {
            console.log('Error al actualizar mensajes: ', err.responseText);
        }
    });
}

// Llamar a la función cada ciertos segundos
setInterval(actualizarMensajes, 1000); // Actualiza cada 5 segundos

//----------------------------------------------------------------------------------------------------------------------------------------
//LLENAR LISTA DE TODOS LOS USUARIOS
function llenarListaUsuarios() {
    $.ajax({
        url: '../controllers/mensajeController.php?op=buscarTodosContactos',
        type: 'GET',
        dataType: 'json',
        success: function (usuarios) {
            usuarios.forEach(function (usuario) {
                usuariosExistentes[usuario.nombreUsuario] = usuario;
                //console.log(usuariosExistentes);
            });
        },
        error: function (err) {
            console.log('Hubo un error al cargar los usuarios en la lista de contactos ', err.responseText);
        }
    });
}

//ARREGLAR LOS DOS AGREGAR GRUPO Y USUARIO

//FUNCIÓN PARA AGREGAR UN USUARIO
document.getElementById("btnAgrUsuario").addEventListener('click', function () {
    // Obtiene el valor del input del usuario
    let nomUsuario = document.getElementById('username').value.trim();

    // Verifica si el usuario está en la lista de usuarios reales
    if (nomUsuario != usuarioLogueadoUser) {
        if (usuariosExistentes[nomUsuario]) {
            // Verifica si no existe en la lista de chats
            if (!mensajesPorUsuario[nomUsuario]) {
                // Agrega un usuario a la lista de chats
                mensajesPorUsuario[nomUsuario] = [];
    
                // Mensaje de que se agregó correctamente
                Swal.fire({
                    title: "¡Todo listo!",
                    text: "Usuario agregado correctamente",
                    icon: "success"
                });
    
                const listaU = document.getElementById("listaUsuarios");
    
                const contacto = document.createElement('li');
                contacto.classList.add('nav-item', 'my-1');
                contacto.innerHTML =
                    "<a href='#' class='nav-link' data-cedula='" + usuariosExistentes[nomUsuario].cedula + "' data-usuario='" + usuariosExistentes[nomUsuario].nombreUsuario + "' data-img='" + usuariosExistentes[nomUsuario].img + "'>" +
                    "<img src='" + usuariosExistentes[nomUsuario].img + "' alt='' width='32' height='32' class='rounded-circle me-2'>" +
                    "<strong>" + usuariosExistentes[nomUsuario].nombreUsuario + "</strong>" +
                    "</a>";
    
                listaU.appendChild(contacto);
    
                // Agregar evento para cada contacto/usuario
                eventoClick(contacto);
    
    
                document.getElementById('username').value = '';
    
            } else {
                // Muestra un error si el usuario ya está en los chats
                Swal.fire({
                    icon: "error",
                    title: "Hubo un error...",
                    text: "El usuario ya está agregado"
                });
            }
        } else {
            // Da un error si el usuario del todo no existe
            Swal.fire({
                icon: "error",
                title: "Hubo un error...",
                text: "El usuario ingresado no existe"
            });
        }
    } else {
        // Da un error si el usuario del todo no existe
        Swal.fire({
            icon: "error",
            title: "Hubo un error...",
            text: "No puede iniciar un chat con su usuario"
        });
    }

    // Cerrar el modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('usernameModal'));
    modal.hide();
});

