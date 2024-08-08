//arreglo del toggle
let tipos = [null, "Basura en las calles", "Maltrato animal", "Deforestación"];

//FUNCIÓN PRINCIPAL
$("#formDenuncia").on("submit", function enviarDenuncia(e) {
    e.preventDefault();

    //se traen todos los datos relacionados a la denuncia 
    //select del tipo
    const selectIndex = document.getElementById("selectTipo").selectedIndex;
    const denunciaSeleccionada = tipos[selectIndex];
    //el detalle
    const detalle = document.getElementById("detalle").value;
    //la foto
    const foto = document.getElementById("imgDen").files[0];
    

    //falta la dirección

    $("#btn_enviar").prop('disabled', true);

    // Verifica que todos los campos obligatorios estén llenos
    if (selectIndex === 0 || detalle.trim() === '' || !foto) {
        Swal.fire({
            title: "Campos Incompletos",
            text: "Por favor completa todos los campos del formulario.",
            icon: "error"
        });
        $("#btn_enviar").removeAttr('disabled');
    } else {
        var formData = new FormData($("#formDenuncia")[0]);
        $.ajax({
            url: '../controllers/solicitudDenunciaController.php?op=crearSoliDenuncia',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                Swal.fire({
                    title: "Envío correcto",
                    text: "Revisaremos la solicitud antes de procesarla.",
                    icon: "success"
                });
                $("#btn_enviar").removeAttr('disabled');
                //limpiar campos del formulario
                $("#formDenuncia").trigger('reset');
            },
            error: function () {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error al enviar la solicitud.",
                    icon: "error"
                });
                $("#btn_enviar").removeAttr('disabled');
            }
        });
    }
});
