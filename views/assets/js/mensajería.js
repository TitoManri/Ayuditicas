//listaUsuarios y mensajesPorUsuario
const listaUsuarios = {};
const mensajesPorUsuario = {};

//variable que cambia dependiendo del usuario/grupo con el que se esté chateando
let chatActual = null;
let chatActualImg = null;
let chatActualCed = null;
//variable que contiene al usuario logueado en el momento
let usuarioLogueado = 305590892;
let logueadoImg = "https://static.vecteezy.com/system/resources/previews/005/544/718/non_2x/profile-icon-design-free-vector.jpg";

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
        chatActualImg = this.getAttribute('data-img');


        if (chatActual != null) {
            actualizarChat(chatActual, chatActualImg);
            llenarArregloMensajes(chatActual, chatActualCed)
        }

        //permite usar el input, botón y foto
        inputMensaje.disabled = false;
        btnEnviar.disabled = false;
        btnSubirImagen.disabled = false;
    });
}

function listarUsuariosContactos() {
    $.ajax({
        url: '../controllers/mensajeController.php?op=listarContactos',
        type: 'POST',
        data: { cedulaUsuarioActual: usuarioLogueado},
        dataType: 'json',
        success: function (arr) {
            const listaU = document.getElementById("listaUsuarios");
            const hr = listaU.querySelector('hr');


            arr.forEach(function (usuario) {
                listaU[usuario.cedula] = usuario.nombreUsuario;
                mensajesPorUsuario[usuario.nombreUsuario] = [];


                const contacto = document.createElement('li');
                contacto.classList.add('nav-item', 'my-1');
                contacto.innerHTML =
                    "<a href='#' class='nav-link' data-cedula='" + usuario.cedula + "' data-usuario='" + usuario.nombreUsuario + "' data-img='" + usuario.img + "'>" +
                    "<img src='" + usuario.img + "' alt='' width='32' height='32' class='rounded-circle me-2'>" +
                    "<strong>" + usuario.nombreUsuario + "</strong>" +
                    "</a>";

                //inserta el usuario antes del hr
                listaU.insertBefore(contacto, hr);

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

    // Verifica si es un mensaje de texto o una imagen
    if (imgData == null) {
        datos = { cedulaRemitente: usuarioRemitente, cedulaDestinatario: usuarioDestinatario, cuerpoMensaje: mensaje };
    } else {
        datos = new FormData();
        datos.append('cedulaRemitente', usuarioRemitente);
        datos.append('cedulaDestinatario', usuarioDestinatario);
        datos.append('imagen', imgData);
    }

    $.ajax({
        url: '../controllers/mensajeController.php?op=enviarMensaje',
        type: 'POST',
        data: datos,
        processData: false, // Evita que jQuery procese los datos automáticamente
        contentType: false, // Evita que jQuery establezca el tipo de contenido
        dataType: 'json',
        success: function (response) {
            if (response.msj) {
                console.log('Mensaje enviado correctamente: ', response.msj);

                // Añadir el mensaje enviado al chat actual inmediatamente
                const nuevoMensaje = {
                    remitente: usuarioRemitente,
                    cuerpo: mensaje,
                    img: response.img ? response.img : null // Asegúrate de recibir la URL de la imagen desde el backend
                };

                // Actualiza el arreglo de mensajes para el chat actual
                mensajesPorUsuario[chatActual].push(nuevoMensaje);

                // Crear y añadir el nuevo mensaje al chat
                const mensajeElemento = crearMensajeElemento(nuevoMensaje);
                contenedorChat.appendChild(mensajeElemento);

                // Scroll automático al final del chat
                contenedorChat.scrollTop = contenedorChat.scrollHeight;

            } else if (response.error) {
                console.log('Error al enviar el mensaje: ', response.error);
            }
        },
        error: function (err) {
            console.log('Hubo un error al enviar un mensaje: ', err.responseText);
        }
    });
}




//ARREGLAR LOS DOS AGREGAR GRUPO Y USUARIO

//FUNCIÓN PARA AGREGAR UN USUARIO
document.getElementById("btnAgrUsuario").addEventListener('click', function () {
    //agarra el valor del input del usuario
    let nomUsuario = document.getElementById('username').value.trim();

    // verifica si el usuario está en la lista de usuarios reales
    if (listaUsuarios[nomUsuario]) {
        // Verifica si no existe en la lista de chats
        if (!mensajesPorUsuario[nomUsuario]) {
            //agrega un usuario a la lista de chats 
            mensajesPorUsuario[nomUsuario] = [];

            //mensaje de que se agregó correctamente
            Swal.fire({
                title: "¡Todo listo!",
                text: "Usuario agregado correctamente",
                icon: "success"
            });

            // Añadir el nuevo usuario a la lista de usuarios creando un list element 
            const nuevoUsuarioElemento = document.createElement('li');
            //le agrega un nav item
            nuevoUsuarioElemento.classList.add('nav-item');
            //detro del nav item escribe el código del usuario
            nuevoUsuarioElemento.innerHTML = `
                <a href="#" class="nav-link" data-usuario="${nomUsuario}" data-imagen="https://github.com/mdo.png">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>${nomUsuario}</strong>
                </a>
            `;

            // Encontrar hr después de la sección de chats
            const hrElement = document.querySelector('.nav-pills').querySelector('hr');

            // Insertar el nuevo usuario antes del hr
            hrElement.parentNode.insertBefore(nuevoUsuarioElemento, hrElement);

            // Agregar evento click al nuevo usuario
            nuevoUsuarioElemento.querySelector('.nav-link').addEventListener('click', function (e) {
                e.preventDefault();

                //quita la clase 'active' de todos los usuarios y añadirla al seleccionado
                usuarios.forEach(u => u.classList.remove('active'));
                this.classList.add('active');

                const nombre = this.getAttribute('data-usuario');
                const imagenUrl = this.getAttribute('data-imagen');

                // Llamar a la función para actualizar el chat con el nuevo usuario
                if (nombre != null) {
                    actualizarChat(nombre, imagenUrl);
                }

                // Habilitar los controles de mensajes
                inputMensaje.disabled = false;
                btnEnviar.disabled = false;
                btnSubirImagen.disabled = false;
            });
        } else {
            //muestra un error si el usuario ya está en los chats
            Swal.fire({
                icon: "error",
                title: "Hubo un error...",
                text: "El usuario ya está agregado"
            });
        }
    } else {
        //da un error si el usuario del todo no existe
        Swal.fire({
            icon: "error",
            title: "Hubo un error...",
            text: "El usuario ingresado no existe"
        });
    }

    // Cerrar el modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('usernameModal'));
    modal.hide();
});


//FUNCIÓN PARA AGREGAR UN GRUPO
document.querySelector('#grupoModal .btn-success').addEventListener('click', function () {
    let nomGrupo = document.getElementById('nombreGrupo').value.trim();

    // Verificar si ya existe en la estructura de mensajes
    if (!mensajesPorUsuario[nomGrupo]) {
        mensajesPorUsuario[nomGrupo] = [];

        Swal.fire({
            title: "¡Todo listo!",
            text: "Grupo agregado correctamente",
            icon: "success"
        });

        // Añadir el nuevo usuario a la lista de usuarios
        const nuevoGrupoElemento = document.createElement('li');
        nuevoGrupoElemento.classList.add('nav-item');
        nuevoGrupoElemento.innerHTML = `
                <a href="#" class="nav-link" data-usuario="${nomGrupo}" data-imagen="https://github.com/mdo.png">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>${nomGrupo}</strong>
                </a>
            `;

        document.querySelector('.nav-pills').appendChild(nuevoGrupoElemento);

        // Agregar evento click al nuevo grupo
        nuevoGrupoElemento.querySelector('.nav-link').addEventListener('click', function (e) {
            e.preventDefault();

            // Remover la clase 'active' de todos los usuarios y añadirla al seleccionado
            usuarios.forEach(u => u.classList.remove('active'));
            this.classList.add('active');

            const nombre = this.getAttribute('data-usuario');
            const imagenUrl = this.getAttribute('data-imagen');

            // Llamar a la función para actualizar el chat con el nuevo usuario
            if (nombre != null) {
                actualizarChat(nombre, imagenUrl);
            }

            // Habilitar los controles de mensajes
            inputMensaje.disabled = false;
            btnEnviar.disabled = false;
            btnSubirImagen.disabled = false;
        });
    } else {
        //muestra un error si ya está agregado
        Swal.fire({
            icon: "error",
            title: "Hubo un error...",
            text: "El grupo ya está agregado"
        });
    }

    // Cerrar el modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('grupoModal'));
    modal.hide();
});

//función para autorefrescar el chat actual
function autorefrescarChat() {
    if (chatActual != null) {
        //prueba (quitar esto desués de la prueba)
        console.log('Refrescando chat para:', chatActual);

        //borrar el contenido del chat actual
        contenedorChat.innerHTML = '';

        //vuelve a cargar los mensajes del usuario actual
        mensajesPorUsuario[chatActual].forEach(mensaje => {
            const mensajeElemento = crearMensajeElemento(mensaje);
            contenedorChat.appendChild(mensajeElemento);
        });

        //hacer scroll automático al final del chat
        contenedorChat.scrollTop = contenedorChat.scrollHeight;
    }
}

//cada 5 segundos se refrecsa el chat 
setInterval(autorefrescarChat, 1000);
