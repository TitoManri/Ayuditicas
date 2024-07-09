let tipos = [null, "Basura en las calles", "Maltrato animal", "Deforestación"];

function llenarSelect() {
    const select = document.getElementById("selectTipo");

    for (let i = 0; i < tipos.length; i++) {
        let option = document.createElement("option");
        option.value = i.toString();
        option.textContent = tipos[i] === null ? "--Selecciona el tipo de denuncia--" : tipos[i];
        select.appendChild(option);
    }
}

llenarSelect();

document.getElementById("formDenuncia").addEventListener("submit", function enviarDenuncia(event) {
    event.preventDefault();

    const selectIndex = document.getElementById("selectTipo").selectedIndex;
    const denunciaSeleccionada = tipos[selectIndex];
    const descripcion = document.getElementById("IdDetalle").value;
    const foto = document.getElementById("formFile").files[0];

    // Verifica que todos los campos obligatorios estén llenos
    if (selectIndex === 0 || descripcion.trim() === '' || !foto) {
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
    }

    // Recarga la página después de 2 segundos 
    setTimeout(function () {
        window.location.reload();
    }, 3000);
});
