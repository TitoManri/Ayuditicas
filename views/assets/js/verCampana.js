function VerInfoCamps() {
    let params = new URLSearchParams(location.search);
    let id = params.get("ID_Camp");
    $.ajax({
        url: '../controllers/campaniasController.php?op=conseguirInfo',
        type: 'GET',
        data: { ID_Camp: id },
        dataType: 'json',
        success: function (responseInfo) {
            let fecha = responseInfo.fechaCulminacion;
            let fechaCortada = fecha.split(" ")[0];
            let escribir = $("#InfoCamps");
            escribir.append($('<p class="h1 font-weight-bold">' + responseInfo.nombre + '</p>'));
            escribir.append($('<br>'));
            escribir.append($('<p style="font-size: 18px; opacity: 47%;">' + responseInfo.descripcion + '</p>'));
            escribir.append($('<p style="font-size: 18px; opacity: 47%;">Se requiere: ' + responseInfo.voluntarios + '</p>'));
            escribir.append($('<p style="font-size: 18px; opacity: 47%;">Termina en: ' + fechaCortada + '</p>'));
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

$(function () {
    VerInfoCamps();
});