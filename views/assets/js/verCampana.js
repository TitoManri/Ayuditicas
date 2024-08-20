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
            escribir.append($('<p style="font-size: 18px; opacity: 47%;">Creada por: ' + responseInfo.nombre_usuario + '</p>'));
            escribir.append($('<p style="font-size: 18px; opacity: 47%;">' + responseInfo.descripcion + '</p>'));
            escribir.append($('<p style="font-size: 18px; opacity: 47%;">Se requiere: ' + responseInfo.voluntarios + '</p>'));
            escribir.append($('<p style="font-size: 18px; opacity: 47%;">Termina en: ' + fechaCortada + '</p>'));
            confirmarSiUsuarioEstaInscrito(responseInfo.cedula_creador_camp);
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

function confirmarSiUsuarioEstaInscrito(cedulaCreador) {
    let params = new URLSearchParams(location.search);
    let id = params.get("ID_Camp");
    let cedula = userData.cedula;
    $.ajax({
        url: '../controllers/campaniasController.php?op=InscritoCamp',
        type: 'GET',
        data: { ID_Camp: id, cedula: cedula},
        dataType: 'json',
        success: function (responseBoolean) {
            debugger;
            let boton = $('#BotonCampana')
            if(cedulaCreador == cedula){
                boton.append('<form method="POST" id="TerminarCamp"><input type="hidden" name="ID_Camp" id="ID_Camp" value="'+id+'"></input><button type="submit" class="btn btn-light">Terminar Campaña</button></form>');
            }else if(responseBoolean){
                boton.append('<a href=""class="btn btn-light ">Subir una publicacion</a>');
            }else{
                boton.append('<a href="./EnviarSoli.php?ID_Camp='+id+'"class="btn btn-light ">Unirse a la causa</a>')
            }
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

$(function () {
    VerInfoCamps();
});

$(document).on('submit', '#TerminarCamp', function (event) {
    event.preventDefault();
    bootbox.confirm('¿Desea terminar la campaña?', function (result) {
        if (result) {
            let formData = $("#TerminarCamp").serialize();
            console.log(formData);
            $.ajax({
                url: '../controllers/campaniasController.php?op=terminarCampana',
                type: 'POST',
                data: formData,
                success: function (datos) {
                    if(Number.isInteger(parseInt(datos, 10))){
                        intNum = parseInt(datos, 10);
                        Swal.fire({
                            title: "Se ha cerrado la campaña! \nQuieres verla?",
                            confirmButtonText: "Ver campaña",
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "./DentroCamp.php?ID_Camp="+intNum;
                            }
                        });
                    }else{
                        Swal.fire({
                            title: "Se ha cerrado la campaña!",
                            allowOutsideClick: false,
                            confirmButtonText: "Volver al inicio",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "./redSocial.php";
                            }
                        });
                    }
                },
                error: function(error){
                    console.log(error);
                }
            })
        }
    })
})