$(document).ready(function () {
    console.log(userData.cedula);
    verSolicitudesDeUsuario();
});

function verSolicitudesDeUsuario() {
    $.ajax({
        url: '../controllers/solicitudesCampsController.php?op=listarSolicitudes',
        type: 'GET',
        data: { cedula: userData.cedula },
        dataType: 'json',
        success: function (responseInfo) {
            let section = $("#MostrarAplicacionesEtiquetas");
            guardarNombre = "";
            numDiv = 0;
            console.log(responseInfo)
            if(responseInfo.length == 0){
                section.append("<h1 class='text-center'>No hay solicitudes para aceptar</h1>")
            }
            $.each(responseInfo, function (index, campania) {
                codigoSolicitud = "";

                if(campania.id_campania != guardarNombre || guardarNombre == ""){
                    numDiv++;
                    guardarNombre = campania.id_campania;
                    codigoSolicitud+='<h1>'+campania.id_campania+'</h1>'
                    section.append('<div class="row" id="Div' + numDiv + '">');
                }
                let divID = $('#Div' + numDiv);
                codigoSolicitud+= "<br>";
                codigoSolicitud+= '<div class="Solicitud row">';
                codigoSolicitud+='<div class="col-2"><p>Enviado por: '+campania.cedula+'</p></div>';
                codigoSolicitud+='<div class="col-2"><p>Fecha de envio: '+campania.fecha_hora_envio+'</p></div>';
                codigoSolicitud+='<div class="col-3"></div>';
                codigoSolicitud+='<div class="col-1"><form method="POST" id="Aceptar"><input type="hidden" value="'+campania.id_solicitud_campania+'" name="ID_Solicitud" id="ID_Solicitud"></input><input type="hidden" value="'+campania.id_campania+'" name="ID_Camp" id="ID_Camp"></input><button type="submit" class="btn btn-success btn-lg">Aceptar</button></form></div>';
                codigoSolicitud+='<div class="col-1"><form method="POST" id="Denegar"><input type="hidden" value="'+campania.id_solicitud_campania+'" name="ID_Solicitud" id="ID_Solicitud"></input><input type="hidden" value="'+campania.id_campania+'" name="ID_Camp" id="ID_Camp"></input><button type="submit" class="btn btn-danger btn-lg">Denegar</button></form></div>';
                codigoSolicitud+='<div class="col-1"></div>';
                codigoSolicitud+='<div class="col-2"><form action="./VerSolicitud.php" method="POST"><input type="hidden" value="'+campania.id_solicitud_campania+'" name="ID_Solicitud" id="ID_Solicitud"></input><button type="submit" class="btn btn-primary btn-lg">Ver Detalles</button></form></div>'
                codigoSolicitud+='</div>';
                if(responseInfo[index+1] && responseInfo[index+1].id_campania != guardarNombre){
                    codigoSolicitud+='</div><br>';
                }
                codigoSolicitud+= '<div class=" row"></div>';
                divID.append(codigoSolicitud);
                divID.append('<br>');
            });

        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}


$(document).on('submit', '#Aceptar', function (event) {
    event.preventDefault();
    let form = $(this);
    bootbox.confirm('¿Desea aceptar la solicitud?', function (result) {
        if (result) {
            let formData = form.serialize();
            console.log(formData);
            console.log(formData);
            $.ajax({
                url: '../controllers/solicitudesCampsController.php?op=aceptarSolicitud',
                type: 'POST',
                data: formData,
                success: function (datos) {
                    Swal.fire({
                        title: "Se aceptó la solicitud!",
                        allowOutsideClick: false,
                        confirmButtonText: "Seguir viendo solicitudes",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
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
                            location.reload();
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
