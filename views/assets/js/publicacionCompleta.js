function agregarNuevoComentario() {
    //Comentario del textarea
    const nuevoComentario = document.getElementById('nuevo-comentario-text').value;
    //Evitar que se pongan espacios en blanco
    if (nuevoComentario.trim() !== '') {
        //Lista no ordenada de los comentarios anteriores
        const listaComentarios = document.getElementById('commentarios-lista');
        //Se usa para ver si hay comentarios o no, si no muestra el mensaje de No hay comentarios aun.
        const comentarioNoMensajes = document.getElementById('no-commentarios');
        //Crea la etiqueta <li> para la lista
        const nuevoItemComentario = document.createElement('li');
        //Agregar el css de comentario
        nuevoItemComentario.classList.add('comentario', 'mt-2');
        //Agrega el comentario escrito por el usuario
        nuevoItemComentario.textContent = nuevoComentario;

        //Remplaza los saltos de linea del usuario por <br> para simular el salto
        nuevoItemComentario.innerHTML = nuevoItemComentario.innerHTML.replace(/\n/g, '<br>');

        //Agrega el comentario al final de la lista
        listaComentarios.appendChild(nuevoItemComentario);

        //Limpia el textarea despues de agregar el comentario
        document.getElementById('nuevo-comentario-text').value = '';

        //Oculta el mensaje de 'No hay comentarios aun' si si hay comentarios
        if (comentarioNoMensajes) {
            comentarioNoMensajes.style.display = 'none';
        }

        //Hace el "scroll" hasta el fondo para ver el comentario nuevp
        listaComentarios.scrollTop = listaComentarios.scrollHeight;
    }
}

//Sirve para que el textarea se pueda mandar con el enter y que si quiere hacer salto de linea lo haga
document.getElementById('nuevo-comentario-text').addEventListener('keydown', function (event) {
    if (event.key === 'Enter' && !event.shiftKey) {  
        event.preventDefault();
        agregarNuevoComentario();
    }
});
