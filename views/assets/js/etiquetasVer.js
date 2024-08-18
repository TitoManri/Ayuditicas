function VerPostsEtiquetas(){
    $.ajax({
        url: '../controllers/etiquetasController.php?op=mostrarPostPorEtiquetas',
        type: 'GET',
        data: $('#SelectEtiqueta').serialize(),
        dataType: 'json',
        success: function(responseEtiquetas) {
            console.log(responseEtiquetas)
        },
        error: function(error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

$(function (){
    VerPostsEtiquetas();
});