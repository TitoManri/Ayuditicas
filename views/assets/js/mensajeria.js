//lista de usuarios (habría que cargarlo de la base de datos)
const listaUsuarios = {
    'Usuario 1': 'Usuario 1',
    'Usuario 2': 'Usuario 2',
    'Usuario 3': 'Usuario 3'
};

//listas para guardar mensajes por usuario (habría que cargarlo de la base de datos)
const mensajesPorUsuario = {
    'Usuario 1': [],
    'Usuario 2': [],
    'Grupo 1': [],
    'Grupo 2': []
};

//Guardar miembros del grupo (habría que cargarlo de la base de datos)
const miembrosDeGrupo = {
    'Grupo 1': ['Miembro 1', 'Miembro 2'],
    'Grupo 2': ['Miembro 2', 'Miembro 1']
};

//se recuperan todos los usuarios/grupos (cada nav-link es un chat de la lista)
const usuarios = document.querySelectorAll('.nav-link');
//variable que cambia dependiendo del usuario/grupo con el que se esté chateando
let chatActual = null; 

//formulario para envío de mensajes
const enviarFormulario = document.getElementById('enviarMsj');
//mensaje (texto que introduce el usuario)
const inputMensaje = document.getElementById('mensaje');
//botón para enviar los mensajes
const btnEnviar = document.getElementById('btnEnviar');
//espacio en blanco donde van los mensajes
const contenedorChat = document.getElementById('chatContainer');
//botón para enviar los mensajes
const btnSubirImagen = document.getElementById('btnImg');

//Deshabilitar input, botón enviar mensaje y botón enviar foto hasta que seleccione un usuario
inputMensaje.disabled = true;
btnEnviar.disabled = true;
btnSubirImagen.disabled = true;

//ACTUALIZAR CHAT CUANDO SE SELECCIONE UN USUARIO
function actualizarChat(nombre, imagenUrl) {
    //el nombre del usuario/grupo seleccionado (viene de los atributos)
    chatActual = nombre;

    //elemento en el header para mostrar el usuario con el que se está chateando
    const chatActualElemento = document.getElementById('chatActual');
    //si el nombre coincide con un grupo se muestran los miembros de ese grupo sino se deja vacío
    const miembrosGrupo = miembrosDeGrupo[nombre] ? mostrarMiembros(miembrosDeGrupo[nombre]) : '';

    //se modifica el código dentro del div para que ahora muestre los datos del usuario seleccionado (se reemplazan)
    chatActualElemento.innerHTML = `
            <img src="${imagenUrl}" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong class="text-white">${nombre}</strong> ${miembrosGrupo}
        `;

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

//MOSTRAR MIEMBROS DE UN GRUPO
function mostrarMiembros(miembros) {
    //se crea la lista para ponerle adentro a los usuarios
    let miembrosGrupo = '<ul class="list-inline mb-0 text-white">';
    miembros.forEach((miembro, index) => {
        if (index !== 0) {
            //por cada miembro del arreglo se le pone una ", "
            miembrosGrupo += ', ';
        }
        //se agrega un list element por cada miembro
        miembrosGrupo += `<li class="list-inline-item text-white">${miembro}</li>`;
    });
    //se cierra la lista html
    miembrosGrupo += '</ul>';
    return miembrosGrupo;
}

//CREAR UN ELEMENTO DE MENSAJE
function crearMensajeElemento(mensaje) {
    //dentro del div de mensajes se crea un nuevo div
    const mensajeElemento = document.createElement('div');
    //si el usuario es igual a usuario logeado (esto habría que pasarlo con una variable de sesión)
    if (mensaje.remitente === 'Usuario Logueado') {
        //se le asigna el estilo al mensaje del css del usuario logueado
        mensajeElemento.classList.add('chat-message', 'user-message');
    } else {
        //sino se le aisgna el estilo al mensaje de cualquier otro usuario
        mensajeElemento.classList.add('chat-message', 'other-message');
    }

    if (mensaje.esImagen) {
        //si el mensaje es una imagen se agregar el código hmtl para la imagen
        mensajeElemento.innerHTML = `
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <img src="${mensaje.mensaje}" alt="Imagen subida" style="max-width: 200px;">
            `;
    } else {
        //sino solo se agrega el código html para un mensaje de txt
        mensajeElemento.innerHTML = `
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                ${mensaje.mensaje}
            `;
    }

    //decuelve el código ya completo con los mensajes
    return mensajeElemento;
}

//EVENTO DE CLICK PARA LOS USUARIOS/GRUPOS
usuarios.forEach(usuario => {
    //cuando se le dé click a un usuario se evita que se mande el form
    usuario.addEventListener('click', function (e) {
        e.preventDefault();

        //quita la clase activa de todos los usuarios
        usuarios.forEach(u => u.classList.remove('active'));

        //agregar la clase activa al usuario seleccionado
        this.classList.add('active');

        //recibe el nombre de usuario que pasa el enlace junto con su imagen 
        const nombre = this.getAttribute('data-usuario');
        const imagenUrl = this.getAttribute('data-imagen');

        //actualiza el header con ese nombre e imagen
        actualizarChat(nombre, imagenUrl);

        //habilita el input, botón y foto
        inputMensaje.disabled = false;
        btnEnviar.disabled = false;
        btnSubirImagen.disabled = false;
    });
});

//EVENTO PARA ENVIAR MENSAJE
enviarFormulario.addEventListener('submit', function (e) {
    //evitar que el formulario se envíe y recargue la página
    e.preventDefault(); 

    //agarra el valor del input y lo guarda en mensaje
    let mensaje = inputMensaje.value.trim();
    //si no está vacío
    if (mensaje !== '') {
        //se agrega el mensaje al contenedor del chat
        agregarMensaje('Usuario Logueado', chatActual, mensaje); 
        //limpia el input después de enviar el mensaje
        inputMensaje.value = ''; 
    }
});

//EVENTO PARA SUBIR UNA IMAGEN
//se almacena el formulario en una variable
const formularioSubida = document.getElementById('imgForm');
//se le agrega el evento de submit
formularioSubida.addEventListener('submit', function (e) {

    e.preventDefault();

    //se guarda el input de la imagen 
    const inputArchivo = document.getElementById('imgInput');
    //si la longitud del input es 0 (no se subió una imagen) muestra mensaje de error
    if (inputArchivo.files.length === 0) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Por favor selecciona una imagen para subir."
        });
        return;
    }

    //recopila toda la info del form en un objeto tipo formdata y permite enviarlo
    const formData = new FormData(formularioSubida);
    //se crea una url temporal para mostrar la imagen 
    const imagenUrl = URL.createObjectURL(formData.get('image'));

    //muestra el mensaje en el contenedor de mensajes (el true es de que es una imagen)
    agregarMensaje('Usuario Logueado', chatActual, imagenUrl, true);

    //Cerrar el modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('cargarModal'));
    modal.hide();

    //Limpiar input 
    inputArchivo.value = '';
});

//AGREGA UN MENSAJE EN EL CONTENEDOR DE CHATS Y LOS AGREGA A LA LISTA DE MENSAJES
function agregarMensaje(usuarioRemitente, usuarioDestinatario, mensaje, esImagen = false) {
    //a los mensajes del usuario destinatario se le agrega un mensaje más usando push
    mensajesPorUsuario[usuarioDestinatario].push({ remitente: usuarioRemitente, mensaje, esImagen });

    if (usuarioDestinatario === chatActual) {
        //si el destinatario es igual al chat actual se crea un elemento visible de mensaje 
        const mensajeElemento = crearMensajeElemento({ remitente: usuarioRemitente, mensaje, esImagen });
        //se agrega al contenedor (chat)
        contenedorChat.appendChild(mensajeElemento);
        //se hace scroll hacia abajo automático
        contenedorChat.scrollTop = contenedorChat.scrollHeight; 
    }
}

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
                actualizarChat(nombre, imagenUrl);

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
            actualizarChat(nombre, imagenUrl);

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
