let formulario = document.querySelector("#EnvioCampana");


$('#EnvioCampana').on('submit', function (event) {
    event.preventDefault();
    bootbox.confirm('¿Desea crear la campaña?', function (result) {
        if (result) {
            let formData = $("#EnvioCampana").serialize();
            console.log(formData);
            $.ajax({
                url: '../controllers/campaniasController.php?op=crearCampana',
                type: 'POST',
                data: formData,
                success: function (datos) {
                    if(Number.isInteger(parseInt(datos, 10))){
                        intNum = parseInt(datos, 10);
                        Swal.fire({
                            title: "Se ha creado la campaña! \nQuieres verla?",
                            showCancelButton: true,
                            confirmButtonText: "Ver campaña",
                            cancelButtonText: "Seguir creando campañas",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "./DentroCamp.php?ID_Camp="+intNum;
                            }
                        });
                    }else{
                        Swal.fire({
                            title: "Se ha creado la campaña!",
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