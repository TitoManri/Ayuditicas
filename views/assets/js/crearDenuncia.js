//arreglo del toggle
let tipos = [null, "Basura en las calles", "Maltrato animal", "Deforestación"];

//función  para envío del form
document.getElementById("formDenuncia").addEventListener("submit", function enviarDenuncia(event) {
    event.preventDefault();

    //se traen todos los datos relacionados a la denuncia 
    //select del tipo
    const selectIndex = document.getElementById("selectTipo").selectedIndex;
    const denunciaSeleccionada = tipos[selectIndex];
    //el detalle
    const detalle = document.getElementById("IdDetalle").value;
    //la foto
    const foto = document.getElementById("formFile").files[0];
    //falta la dirección

    // Verifica que todos los campos obligatorios estén llenos
    if (selectIndex === 0 || detalle.trim() === '' || !foto) {
        Swal.fire({
            title: "Campos Incompletos",
            text: "Por favor completa todos los campos del formulario.",
            icon: "error"
        });
    } else {
        // Si todos los campos están llenos, muestra mensaje de éxito
        Swal.fire({
            title: "Envío correcto",
            text: "Revisaremos la solicitud antes de procesarla.",
            icon: "success"
        });
        //const form = document.getElementById("formDenuncia");
        //form.submit();
    }
    
});