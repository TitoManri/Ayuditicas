$('#FormSolicitud').on('submit', function (event) {
    event.preventDefault();
    let params = new URLSearchParams(location.search);
    let id = params.get("ID_Camp");
    bootbox.confirm('¿Enviar la solicitud?', function (result) {
        if (result) {
            let formData = $("#FormSolicitud").serialize();
            console.log(formData);
            $.ajax({
                url: '../controllers/solicitudesCampsController.php?op=enviarSolicitud',
                type: 'POST',
                data: formData,
                success: function (datos) {
                    Swal.fire({
                        title: "Se ha enviado la solicitud! \nQuieres verla?",
                        confirmButtonText: "Ver campaña",
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "./DentroCamp.php?ID_Camp="+id;
                        }
                    });
                },
                error: function(error){
                    console.log(error);
                    Swal.fire({
                        title: "Ha ocurrido un error. Porfavor, vuelve a intentarlo",
                        confirmButtonText: "Ver campaña",
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            })
        }
    })
})