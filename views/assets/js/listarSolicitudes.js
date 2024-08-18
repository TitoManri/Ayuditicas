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
            $.each(responseInfo, function (index, campania) {
                console.log(responseInfo)
                codigoSolicitud = "";

                if(campania.id_campania != guardarNombre || guardarNombre == ""){
                    numDiv++;
                    guardarNombre = campania.id_campania;
                    codigoSolicitud+='<h1>'+campania.id_campania+'</h1>'
                }
                let divID = $('#Div' + numDiv);
                codigoSolicitud+= "<br>";
                codigoSolicitud+= '<div class="Solicitud row">';
                codigoSolicitud+='<div class="col-2"><p>Enviado por: '+campania.cedula+'</p></div>';
                codigoSolicitud+='<div class="col-2"><p>Fecha de envio: '+campania.fecha_hora_envio+'</p></div>';
                codigoSolicitud+='<div class="col-3"></div>';
                codigoSolicitud+='<div class="col-1"><form method="POST" id="Aceptar"><button class="btn btn-success btn-lg">Aceptar</button></form></div>';
                codigoSolicitud+='<div class="col-1"><form method="POST" id="Denegar"><button class="btn btn-danger btn-lg">Denegar</button></form></div>';
                codigoSolicitud+='<div class="col-1"></div>';
                codigoSolicitud+='<div class="col-2"><a href="./verSolicitudesCampanias.php?ID_Solicitud='+campania.id_solicitud_campania+'" class="btn btn-primary btn-lg">Ver detalles</a></div>'
                codigoSolicitud+='</div>';
                if(responseInfo[index+1] && responseInfo[index+1].id_campania != guardarNombre){
                    codigoSolicitud+='</div>';
                }
                divID.append(codigoSolicitud);
            });

        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}