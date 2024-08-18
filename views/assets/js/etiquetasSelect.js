function listarEtiquetas(){
    $.ajax({
        url: '../controllers/etiquetasController.php?op=listar_etiquetas',
        type: 'GET',
        dataType: 'json',
        success: function(responseSelect) {
            var select = $('#SelectEtiqueta');
            $.each(responseSelect, function(index, etiqueta) {
                select.append($('<option>', {
                    value: etiqueta.id_etiqueta,
                    text: etiqueta.nombre_etiqueta 
                }));
            });
            new MultiSelectTag('SelectEtiqueta')
        },
        error: function(error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

function listarPostsPorEtiquetas(){
    $.ajax({
        url: '../controllers/Publicaciones_etiquetasController.php?op=listar_posts_etiquetas',
        type: 'GET',
        dataType: 'json',
        success: function(responseHref) {
            var select = $('#EtiquetasPopularesConBD');
            let numDiv = 0;
            $.each(responseHref, function(index, etiqueta_post) {
                if(index % 3 == 0 || index == 0){
                    numDiv++;
                    select.append('<div class="row pb-5" id="Div'+numDiv+'">');
                }
                let divID = $('#Div'+numDiv);
                let codigoHref = "";
                codigoHref+='<div class="col-1"></div><a class="EtiquetasRecomendados col-3 text-center" href="./VerPostEtiqueta.php?SelectEtiqueta='+etiqueta_post.id_etiqueta+'">';
                codigoHref+="<br><br>";
                codigoHref+="<h3>"+etiqueta_post.nombre+"</h3>";
                codigoHref+="<br>";
                switch(etiqueta_post.cantidad){
                    case 0:{
                        codigoHref+="<h4>No hay publicaciones</h4></a>";
                        break;
                    }
                    case 1:{
                        codigoHref+="<h4>"+etiqueta_post.cantidad+" publicación</h4></a>";
                        break;
                    }
                    default:{
                        if(etiqueta_post.cantidad>=2){
                            codigoHref+="<h4>"+etiqueta_post.cantidad+" publicaciones</h4></a>";
                            break;
                        }
                        codigoHref+="<h4>Error al cargar la cantidad de publicaciones de etiquetas</h4></a>";
                        break;
                    }
                }
                divID.append(codigoHref);
            });
        },
        error: function(error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

$(function (){
    listarEtiquetas();
    listarPostsPorEtiquetas();
});