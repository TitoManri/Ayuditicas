// Cargar datos de la denuncia

let lat;
let lng;

$(document).ready(function () {
    var idDenunciaEsp = $("#idDenunciaEsp").val();

    $.ajax({
        url: '../controllers/solicitudDenunciaController.php?op=verSolicitudDenunciaEspec',
        type: 'POST',
        data: { idDenunciaEsp: $("#idDenunciaEsp").val() },
        success: function (response) {
            //console.log('Respuesta del servidor:', response);
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
                    lat= datosAutocompletar[0].latitud;
                    lng= datosAutocompletar[0].longitud;

                    //autocompletar la imagen
                    const imgDenuncia = document.getElementById("imgDenuncia");
                    imgDenuncia.src = datosAutocompletar[0].img; 
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
document.getElementById("aceptar").addEventListener("click", function(event) {
    event.preventDefault(); // Evitar que se envíe el formulario

    $.post(
        '../controllers/solicitudDenunciaController.php?op=aceptarSolicitudDenuncia',
        { idDenunciaA: $("#idDenunciaEsp").val() }
    ).done(function() {
        Swal.fire({
            title: "Denuncia confirmada",
            text: "La denuncia ha sido confirmada correctamente.",
            icon: "success"
        });

        // 3 segundos antes de que se devuelva a la página anterior
        setTimeout(function() { history.back(); }, 3000);
    });
});

document.getElementById("eliminar").addEventListener("click", function(event) {
    event.preventDefault(); // Evitar que se envíe el formulario

    $.post(
        '../controllers/solicitudDenunciaController.php?op=rechazarSolicitudDenuncia',
        { idDenunciaR: $("#idDenunciaEsp").val() }
    ).done(function() {
        Swal.fire({
            title: "Denuncia eliminada",
            text: "La denuncia ha sido eliminada.",
            icon: "error"
        });

        // 3 segundos antes de que se devuelva a la página anterior
        setTimeout(function() { history.back(); }, 3000);
    });
});

function initMap() {
    const geocoder = new google.maps.Geocoder();
    const map = document.querySelector('gmp-map').innerMap;
    const infoWindow = new google.maps.InfoWindow();
  
    geocodeLatLng(geocoder, map, infoWindow);
  }
  
  async function geocodeLatLng(geocoder, map, infoWindow) {
    const latlng = {
      lat: parseFloat(lat),
      lng: parseFloat(lng),
    };
  
    try {
      const response = await geocoder.geocode({location: latlng});
      const marker = document.querySelector('gmp-advanced-marker');
  
      map.setZoom(11);
      marker.position = latlng;
      infoWindow.setContent(response.results[0].formatted_address);
      infoWindow.open({anchor: marker});
    } catch (e) {
      window.alert(`Geocoder failed due to: ${e}`);
    }
  }
  
  window.initMap = initMap;