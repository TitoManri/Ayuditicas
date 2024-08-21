// Cargar datos de la denuncia

//variables para guardar la latitud y la longitud
let lat;
let lng;

$(document).ready(function () {
    var idDenunciaEsp = $("#idDenunciaEsp").val();
  //se envía el id de la denuncia 
    $.ajax({
        url: '../controllers/solicitudDenunciaController.php?op=verSolicitudDenunciaEspec',
        type: 'POST',
        data: { idDenunciaEsp: $("#idDenunciaEsp").val() },
        success: function (response) {
            //console.log('Respuesta del servidor:', response);
            try {
              //se convierte el json de resultado de la consulta 
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

//se inicia el mapa 
function initMap() {
  //se crea un objeto tipo mapa
  const geocoder = new google.maps.Geocoder();
  //se busca el elemento que contiene gmp-map
  const map = document.querySelector('gmp-map').innerMap;
  //se crea un objeto de tipo info window
  const infoWindow = new google.maps.InfoWindow();

  //se llama a la función de geocodificación
  geocodeLatLng(geocoder, map, infoWindow);
}

//recibe la latitud y longitud 
async function geocodeLatLng(geocoder, map, infoWindow) {
  const latlng = {
    lat: parseFloat(lat),
    lng: parseFloat(lng),
  };

  try {
      //crea el marker para mostrar el punto de la ubicación en el punto específico
    const response = await geocoder.geocode({location: latlng});
    const marker = document.querySelector('gmp-advanced-marker');

    map.setZoom(11);
    marker.position = latlng;
    infoWindow.setContent(response.results[0].formatted_address);
    infoWindow.open({anchor: marker});
  } catch (e) {
    console.log(`Geocoder failed due to: ${e}`);
  }
}

//se carga el mapa cuando carga la página
window.initMap = initMap;




