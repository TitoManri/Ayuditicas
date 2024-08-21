let formulario = document.querySelector("#EnvioCampana");

$(function(){
    //Consigue fecha actual del sistema
    let fechaActual = new Date();
    //Le suma una semana a la fecha actual
    fechaActual.setDate(fechaActual.getDate() + 3)
    //Consigue el valor de dia, mes y año
    let mes = fechaActual.getMonth() + 1;
    let dia = fechaActual.getDate();
    let anno = fechaActual.getFullYear();
    //Si el mes o dia es menor que 10, se agrega un 0 para que se pueda agregar el minimo
    if(mes < 10)
        mes = '0' + mes.toString();
    if(dia < 10)
        dia = '0' + dia.toString();
    
    //Crea la fecha minima
    let fechaMin = anno + '-' + mes + '-' + dia;
    //Agrega el requisito al elemento con id 'fechaCita' (En este caso, un input)
    $('#FechaFinalizacion').attr('min', fechaMin);
});

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
                            confirmButtonText: "Ver campaña",
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "./DentroCamp.php?ID_Camp="+intNum;
                            }
                        });
                    }else{
                        Swal.fire({
                            title: "Se ha creado la campaña!",
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