//variables para el uso del mapa
let map;
let marker;
let geocoder;
let responseDiv;
let response;

//variables de longitud y latitud
let longitud;
let latitud;

//arreglo del toggle
let tipos = [null, "Basura en las calles", "Maltrato animal", "Deforestación"];

//función que inicia el mapa
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 8,
        center: { lat: -34.397, lng: 150.644 },
        mapTypeControl: false,
        mapId: "DEMO_MAP_ID",
    });

    //inicia un objeto de tipo geocoder
    geocoder = new google.maps.Geocoder();

    //se agrega un input para la dirección
    const inputText = document.createElement("input");

    //se le agrega un tipo y placeholder
    inputText.type = "text";
    inputText.placeholder = "Enter a location";

    //se agrega un botón
    const submitButton = document.createElement("input");

    //con tipo valor y clases
    submitButton.type = "button";
    submitButton.value = "Geocode";
    submitButton.classList.add("button", "button-primary");

    //se crea un elemento de respuesta
    response = document.createElement("pre");
    //se le asigna el id
    response.id = "response";
    //contenido del elmento
    response.innerText = "";
    //se crea un div
    responseDiv = document.createElement("div");
    //se le asigna un id y se le añade la respuesta
    responseDiv.id = "response-container";
    responseDiv.appendChild(response);

    //se añaden los componentes a los controles del mapa
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputText);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(submitButton);

    //se añade el div 
    map.controls[google.maps.ControlPosition.LEFT_TOP].push(responseDiv);
    //se crea el marker encargado ubicar el punto exacto de la ubicación
    marker = new google.maps.marker.AdvancedMarkerElement({
        map,
    });
    map.addListener("click", (e) => {
        geocode({ location: e.latLng });
    });
    submitButton.addEventListener("click", () =>
        geocode({ address: inputText.value })
    );
    clear();
}

//se borran los datos que tenga el marker
function clear() {
    marker.map = null;
}

//función de geocode recibe 
function geocode(request) {
    //se limpian los datos que pueda haber 
    clear();
    //se hace uso de las funciones del api para buscar la dirección y guardar sus coordenadas
    geocoder
        .geocode(request)
        .then((result) => {
            const { results } = result;

            map.setCenter(results[0].geometry.location);
            marker.position= results[0].geometry.location;
            marker.map = map;

            //esto es para mostrar los resultados en en mapa
            //response.innerText = JSON.stringify(result, null, 2);

            //se obtiene la latitud y longitud
            latitud = results[0].geometry.location.lat();
            longitud = results[0].geometry.location.lng();

            document.getElementById("latitud").value=latitud;
            document.getElementById("longitud").value=longitud;

            //devuelve estos valores
            return results;
        })
        .catch((e) => {
            alert("Geocode was not successful for the following reason: " + e);
        });
}

//inicia el mapa cuando carga la página
window.initMap = initMap;



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


    $("#btn_enviar").prop('disabled', true);

    // Verifica que todos los campos obligatorios estén llenos
    if (selectIndex === 0 || detalle.trim() === '' || !foto  || latitud == null || longitud == null) {
        Swal.fire({
            title: "Campos Incompletos",
            text: "Por favor completa todos los campos del formulario.",
            icon: "error"
        });
        $("#btn_enviar").removeAttr('disabled');
    } else {
        //guarda los datos del formulario para enviarlos en el ajax
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
                //se quita el atributo desabilitado al botón
                $("#btn_enviar").removeAttr('disabled');
                //limpiar campos del formulario
                $("#formDenuncia").trigger('reset');
            },
            //muestra mensajes de error
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



