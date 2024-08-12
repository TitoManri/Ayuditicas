let map;
let marker;
let geocoder;
let responseDiv;
let response;


let longitud;
let latitud;

//arreglo del toggle
let tipos = [null, "Basura en las calles", "Maltrato animal", "Deforestación"];


function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 8,
        center: { lat: -34.397, lng: 150.644 },
        mapTypeControl: false,
        mapId: "DEMO_MAP_ID",
    });
    geocoder = new google.maps.Geocoder();

    const inputText = document.createElement("input");

    inputText.type = "text";
    inputText.placeholder = "Enter a location";

    const submitButton = document.createElement("input");

    submitButton.type = "button";
    submitButton.value = "Geocode";
    submitButton.classList.add("button", "button-primary");

    response = document.createElement("pre");
    response.id = "response";
    response.innerText = "";
    responseDiv = document.createElement("div");
    responseDiv.id = "response-container";
    responseDiv.appendChild(response);

    
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputText);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(submitButton);

    map.controls[google.maps.ControlPosition.LEFT_TOP].push(responseDiv);
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

function clear() {
    marker.map = null;
}

function geocode(request) {
    clear();
    geocoder
        .geocode(request)
        .then((result) => {
            const { results } = result;

            map.setCenter(results[0].geometry.location);
            marker.position= results[0].geometry.location;
            marker.map = map;
            //esto es para mostrar los resultados en en mapa
            //response.innerText = JSON.stringify(result, null, 2);

            latitud = results[0].geometry.location.lat();
            longitud = results[0].geometry.location.lng();

            console.log(latitud);
            console.log(longitud);

            document.getElementById("latitud").value=latitud;
            document.getElementById("longitud").value=longitud;

            return results;
        })
        .catch((e) => {
            alert("Geocode was not successful for the following reason: " + e);
        });
}

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

    

    //falta la dirección

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



