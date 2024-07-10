// Datos para autocompletar (simulados)
const datosAutocompletar = {
    tipoDenuncia: "Basura en las calles",
    detalle: "Descripción detallada de la denuncia.",
    ubicacion: "Teatro Real, Madrid",
    imagen: "https://upload.wikimedia.org/wikipedia/commons/6/68/Contaminaci%C3%B3n_en_Maracaibo%2C_Venezuela.jpg"
};

// Función para autocompletar y deshabilitar campos
function autocompletarFormulario() {
    // Autocompletar el tipo de denuncia
    const tipoDenuncia = document.getElementById("tipoDenuncia");
    tipoDenuncia.value = datosAutocompletar.tipoDenuncia;

    // Autocompletar la descripción
    const descripcion = document.getElementById("IdDetalle");
    descripcion.value = datosAutocompletar.detalle;

    //const ubicacion = document.getElementById("ubicacion");
    //ubicacion.innerHTML = datosAutocompletar.ubicacion;

    // Autocompletar la imagen
    const imagenPreview = document.getElementById("imagenPreview");
    imagenPreview.src = datosAutocompletar.imagen;
    imagenPreview.style.width = "300px"; 
    imagenPreview.style.height = "150px"; 

}

// Ejecutar la función para autocompletar al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    autocompletarFormulario();
});

// Evitar que el formulario se envíe automáticamente
document.getElementById("formDenuncia").addEventListener("submit", function(event) {
    event.preventDefault();

    const botonPresionado = event.submitter.value;

    if (botonPresionado === "Aceptar") {
        // Lógica para confirmar la denuncia
        Swal.fire({
            title: "Denuncia confirmada",
            text: "La denuncia ha sido confirmada correctamente.",
            icon: "success"
        });
    } else if (botonPresionado === "Eliminar") {
        // Lógica para eliminar la denuncia
        Swal.fire({
            title: "Denuncia eliminada",
            text: "La denuncia ha sido eliminada.",
            icon: "error"
        });
    }

});

