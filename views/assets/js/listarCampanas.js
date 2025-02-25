function listarCamps() {
    let cedula = userData.cedula;
    $.ajax({
        url: '../controllers/campaniasController.php?op=conseguirCamps',
        type: 'GET',
        dataType: 'json',
        success: function (responseHref) {
            console.log(responseHref);
            var select = $('#MostrarCampanias');
            let numDiv = 1;
            select.append('<div class="row pb-3" id="Div' + numDiv + '">');

            $.each(responseHref, function (index, campania) {
                let comprobar = false;
                let fecha = campania.fecha_hora_culminacion;
                let fechaCortada = fecha.split(" ")[0];

                if (index % 2 != 0 && index != 0) {
                    // Si es impar, cerramos el div anterior y creamos uno nuevo
                    select.append('<div class="row" id="Div' + numDiv + '">');
                }
                let divID = $('#Div' + numDiv);
                let codigoHref = "";
                codigoHref += '<section id="Campania' + campania.id_campania + '" class="col-4 mb-5 Etiquetas">';
                codigoHref += '<div class="d-flex justify-content-center"><h3><i class="bi bi-person-circle" style="color: #d2ac97"></i> ' + campania.nombre_usuario + '</h3><div class="ms-auto p-2">';
                codigoHref += '<div class="dropdown ms-auto p-2"><button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="Opciones">';
                codigoHref += '</ul></div></div></div>';
                codigoHref += '<div class="ms-5 pe-4">';
                codigoHref += '<h3>'+campania.nombre+'</h3>'
                codigoHref += '<p>' + campania.descripcion + '</p>';
                codigoHref += '<p style="font-size: 18px; opacity: 47%;">Se requiere: ' + campania.voluntarios_requeridos + '</p>';
                codigoHref += '<p style="font-size: 18px; opacity: 47%;">Termina en: ' + fechaCortada + '</p>';
                codigoHref += '<div class="d-flex justify-content-end pe-4">';
                codigoHref += '<a href="./DentroCamp.php?ID_Camp=' + campania.id_campania + '" class="btn btn-warning">Ingresar</a></div>';
                codigoHref += '</div></section>';
                if (index % 2 == 0) {
                    codigoHref += '<div class="col-1"></div>';
                }
                if (responseHref.length == index) {
                    if (index % 2 != 0) {
                        codigoHref += '</div>'
                    }
                    codigoHref += '</section>';
                }
                divID.append(codigoHref);
            });
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

$(function () {
    listarCamps();
});