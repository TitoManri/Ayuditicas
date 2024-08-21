function listarCampsAside() {
    $.ajax({
        url: '../controllers/campaniasController.php?op=conseguirCampsAside',
        type: 'GET',
        dataType: 'json',
        success: function (responseHref) {
            if (responseHref.length != 0) {
                $.each(responseHref, function (index, campania) {

                    let div = $('#CampanasAside');
                    let codigoHref = "";
                    codigoHref += '<div class="Etiquetas"><a href="./DentroCamp.php?ID_Camp=' + campania.id_campania + '"><div class="row"><div class="col d-flex justify-content-center"><i class="fa fa-solid fa-people-roof fa-1x" ></i></div>'
                    codigoHref += '<div class="col"><div class="row mb-3" style="height: 30%;"><p>' + campania.nombre + '</p></div>'
                    codigoHref += '<div class="row"><p style="font-size: 14px; opacity: 47%;" class="text-truncate">' + campania.descripcion + '</p>'
                    codigoHref += '</div></div></div></a></div></br>'
                    div.append(codigoHref);
                });
            }
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

function VerEtiquetasAside() {
    $.ajax({
        url: '../controllers/etiquetasController.php?op=mostrarEtiquetasAside',
        type: 'GET',
        data: $('#SelectEtiqueta').serialize(),
        dataType: 'json',
        success: function (responseEtiquetas) {
            let div = $('#EtiquetasAside');
            if (responseEtiquetas.length != 0) {
                $.each(responseEtiquetas, function (index, etiqueta) {
                    let varr = '<div class="Etiquetas"><a href="./VerPostEtiqueta.php?SelectEtiqueta=' + etiqueta.id_etiqueta + '"><i class="bi bi-tag-fill" style="color: #bcc9b8;"></i> ' + etiqueta.nombre + '</a></div><br>'
                    div.append(varr);
                });
            }
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}



$(function () {
    listarCampsAside();
    VerEtiquetasAside();
});