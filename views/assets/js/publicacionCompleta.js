function addNewComment() {
    //Comentario del textarea
    const newCommentText = document.getElementById('nuevo-comentario-text').value;
    //Evitar que se pongan espacios en blanco
    if (newCommentText.trim() !== '') {
        //Lista no ordenada de los comentarios anteriores
        const commentsList = document.getElementById('commentarios-lista');
        //Se usa para ver si hay comentarios o no, si no muestra el mensaje de No hay comentarios aun.
        const noCommentsMessage = document.getElementById('no-commentarios');
        //Crea la etiqueta <li> para la lista
        const newCommentItem = document.createElement('li');
        //Agregar el css de comentario
        newCommentItem.classList.add('comentario', 'mt-2');
        //Agrega el comentario escrito por el usuario
        newCommentItem.textContent = newCommentText;

        //Remplaza los saltos de linea del usuario por <br> para simular el salto
        newCommentItem.innerHTML = newCommentItem.innerHTML.replace(/\n/g, '<br>');

        //Agrega el comentario al final de la lista
        commentsList.appendChild(newCommentItem);

        //Limpia el textarea despues de agregar el comentario
        document.getElementById('nuevo-comentario-text').value = '';

        //Oculta el mensaje de 'No hay comentarios aun' si si hay comentarios
        if (noCommentsMessage) {
            noCommentsMessage.style.display = 'none';
        }

        //Hace el "scroll" hasta el fondo para ver el comentario nuevp
        commentsList.scrollTop = commentsList.scrollHeight;
    }
}

//Sirve para que el textarea se pueda mandar con el enter y que si quiere hacer salto de linea lo haga
document.getElementById('nuevo-comentario-text').addEventListener('keydown', function (event) {
    if (event.key === 'Enter' && !event.shiftKey) {  
        event.preventDefault();
        addNewComment();
    }
});
