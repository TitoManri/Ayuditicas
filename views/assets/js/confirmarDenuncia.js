// Cargar datos de la denuncia
$(document).ready(function () {
    var idDenunciaEsp = $("#idDenunciaEsp").val();

    $.ajax({
        url: '../controllers/solicitudDenunciaController.php?op=verSolicitudDenunciaEspec',
        type: 'POST',
        data: { idDenunciaEsp: $("#idDenunciaEsp").val() },
        success: function (response) {
            console.log('Respuesta del servidor:', response);
            try {
                var datosAutocompletar= JSON.parse(response);

                if (datosAutocompletar[0].error) {
                    console.log('Error: ' + datosAutocompletar[0].error);
                } else {
                    //autocompletar el tipo de denuncia
                    const tipoDenuncia = document.getElementById("tipoDenuncia");
                    tipoDenuncia.value = datosAutocompletar[0].tipoDenuncia;

                    //autocompletar el detalle
                    const detalle = document.getElementById("detalle");
                    detalle.value = datosAutocompletar[0].detalle;

                    //falta la direccion

                    //autocompletar la imagen
                    const imgDenuncia = document.getElementById("imgDenuncia");
                    //imgDenuncia.src = datosAutocompletar[0].img; //ruta dinámica falta
                    imgDenuncia.src = "https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1200,h_630/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/tsah7c9evnal289z5fig/Entrada%3A%20IMG%20Worlds%20of%20Adventure.jpg";
                    imgDenuncia.style.width = "300px";
                    imgDenuncia.style.height = "150px";
                }
            } catch (e) {
                console.log('Error al parsear JSON: ', e);
            }
        },
        error: function (err) {
            console.log('Hubo un error al leer la información:', err);
        }
    });
});


//CONFIRMAR DENUNCIA
document.getElementById("formDenuncia").addEventListener("submit", function (event) {
    event.preventDefault();

    //toma el valor del botón presionado
    const botonPresionado = event.submitter.value;

    if (botonPresionado === "Aceptar") {
        $.post(
            '../controllers/solicitudDenunciaController.php?op=aceptarSolicitudDenuncia',
            { idDenunciaA: $("#idDenunciaEsp").val() }
        );

        Swal.fire({
            title: "Denuncia confirmada",
            text: "La denuncia ha sido confirmada correctamente.",
            icon: "success"
        });

        //10 seg antes de que se devuelva a la página anterior
        setTimeout(function() { history.back();}, 3000);

    } else if (botonPresionado === "Eliminar") {
        $.post(
            '../controllers/solicitudDenunciaController.php?op=rechazarSolicitudDenuncia',
            { idDenunciaR: $("#idDenunciaEsp").val() }
        );

        Swal.fire({
            title: "Denuncia eliminada",
            text: "La denuncia ha sido eliminada.",
            icon: "error"
        });

        //10 seg antes de que se devuelva a la página anterior
        setTimeout(function() { history.back();}, 3000);

    }

});
