// Datos para autocompletar (simulados)
const datosAutocompletar = {
    tipoDenuncia: "Basura en las calles",
    detalle: "Descripción detallada de la denuncia.",
    ubicacion: "Teatro Real, Madrid",
    imagen: "https://upload.wikimedia.org/wikipedia/commons/6/68/Contaminaci%C3%B3n_en_Maracaibo%2C_Venezuela.jpg"
};

// Función para autocompletar y deshabilitar campos
function autocompletarFormulario() {
    //autocompletar el tipo de denuncia
    const tipoDenuncia = document.getElementById("tipoDenuncia");
    tipoDenuncia.value = datosAutocompletar.tipoDenuncia;

    //autocompletar el detalle
    const detalle = document.getElementById("IdDetalle");
    detalle.value = datosAutocompletar.detalle;

    //const ubicacion = document.getElementById("ubicacion");
    //ubicacion.innerHTML = datosAutocompletar.ubicacion;

    //autocompletar la imagen
    const imgDenuncia = document.getElementById("imgDenuncia");
    imgDenuncia.src = datosAutocompletar.imagen;
    //se ajusta el tamaño
    imgDenuncia.style.width = "300px"; 
    imgDenuncia.style.height = "150px"; 

}

//Ejecutar la función para autocompletar al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    autocompletarFormulario();
});

//EVITAR QUE EL FORMULARIO SE ENVÍE 
document.getElementById("formDenuncia").addEventListener("submit", function(event) {
    event.preventDefault();

    //toma el valor del botón presionado
    const botonPresionado = event.submitter.value;

    if (botonPresionado === "Aceptar") {
        //botón para confirmar la denuncia
        Swal.fire({
            title: "Denuncia confirmada",
            text: "La denuncia ha sido confirmada correctamente.",
            icon: "success"
        });
    } else if (botonPresionado === "Eliminar") {
        //botón para eliminar la denuncia
        Swal.fire({
            title: "Denuncia eliminada",
            text: "La denuncia ha sido eliminada.",
            icon: "error"
        });
    }

});