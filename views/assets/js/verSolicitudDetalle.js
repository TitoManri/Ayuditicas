function VerInfoSolicitud() {
    let id = userData.id_solicitud;
    console.log(id);
    console.log(userData);
    $.ajax({
        url: '../controllers/solicitudesCampsController.php?op=verDetallesSolicitud',
        type: 'GET',
        data: { id_solicitud: id },
        dataType: 'json',
        success: function (responseInfo) {
            console.log(responseInfo);
            var fechaNacimiento = responseInfo.fecha_nacimiento;
            var edad = new Date(new Date() - new Date(fechaNacimiento)).getFullYear() - 1970;
            $("#DatosPersona").append('<p class="h3">Nombre del usuario: <br>'+responseInfo.nombre_usuario+'</p>')
            $("#DatosPersona").append('<p>Nombre completo del usuario: <br>'+responseInfo.nombreCompleto+'</p>');
            $("#DatosPersona").append('<p>Edad: '+ edad+'</p>');
            $("#RazonInteres").append('<p>'+responseInfo.razon_interes +'</p>');
            $("#Habilidades").append('<p>'+responseInfo.habilidades +'</p>');
            $("#AceptarDiv").append('<form method="POST" id="Aceptar"><input type="hidden" value="'+responseInfo.id_solicitud+'" name="ID_Solicitud" id="ID_Solicitud"></input><input type="hidden" value="'+responseInfo.id_campania+'" name="ID_Camp" id="ID_Camp"></input><button type="submit" class="btn btn-success btn-lg">Aceptar</button></form>');
            $("#DenegarDiv").append('<form method="POST" id="Denegar"><input type="hidden" value="'+responseInfo.id_solicitud+'" name="ID_Solicitud" id="ID_Solicitud"></input><input type="hidden" value="'+responseInfo.id_campania+'" name="ID_Camp" id="ID_Camp"></input><button type="submit" class="btn btn-danger btn-lg">Denegar</button></form>');

        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

$(function () {
    VerInfoSolicitud();
});

$(document).on('submit', '#Aceptar', function (event) {
    event.preventDefault();
    let form = $(this);
    bootbox.confirm('¿Desea aceptar la solicitud?', function (result) {
        if (result) {
            let formData = form.serialize();
            console.log(formData);
            $.ajax({
                url: '../controllers/solicitudesCampsController.php?op=aceptarSolicitud',
                type: 'POST',
                data: formData,
                success: function (datos) {
                    Swal.fire({
                        title: "Se aceptó la solicitud!",
                        allowOutsideClick: false,
                        confirmButtonText: "Ver otra solicitud",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "./verSolicitudesCampanias.php";
                        }
                    });
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });
});

$(document).on('submit', '#Denegar', function (event) {
    event.preventDefault();
    let form = $(this);
    bootbox.confirm('¿Desea rechazar la solicitud?', function (result) {
        if (result) {
            let formData = form.serialize();
            console.log(formData);
            console.log(formData);
            $.ajax({
                url: '../controllers/solicitudesCampsController.php?op=rechazarSolicitud',
                type: 'POST',
                data: formData,
                success: function (datos) {
                    Swal.fire({
                        title: "Se rechazó la solicitud!",
                        allowOutsideClick: false,
                        confirmButtonText: "Seguir viendo solicitudes",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "./verSolicitudesCampanias.php";
                        }
                    });
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });
});