let contrasenia = document.getElementById("contrasenia")
let confirmar_contrasenia = document.getElementById("confirmar_contrasenia");
let cedula = document.getElementById("cedula");
let telefono = document.getElementById("telefono");

function validarContrasenia(){
  if(contrasenia.value != confirmar_contrasenia.value) {
    confirmar_contrasenia.setCustomValidity("Las contraseñas no coinciden");
      if(contrasenia.value.length !== 8){
        contrasenia.setCustomValidity("La contraseña debe tener minimo 8 caracteres.");
      }else{
        contrasenia.setCustomValidity("");
      }
  } else {
    confirmar_contrasenia.setCustomValidity('');
  }
}

function validarCedula() {
    if (cedula.value.length !== 9) {
      cedula.setCustomValidity("La cédula debe tener exactamente 9 caracteres.");
    } else {
      cedula.setCustomValidity("");
    }
  }

  function validarTelefono() {
    if (telefono.value.length !== 8) {
      telefono.setCustomValidity("El numero de Telefono debe tener exactamente 8 caracteres.");
    } else {
      telefono.setCustomValidity("");
    }
  }

contrasenia.onchange = validarContrasenia;
confirmar_contrasenia.onkeyup = validarContrasenia;
cedula.onkeyup = validarCedula;
cedula.onkeyup = validarCedula;


$(document).ready(function () { 
  $('#registro').on('submit', function (e) { 
      e.preventDefault(); 
      var formData = new FormData($('#registro')[0]);
      $.ajax({
          url: '../controllers/registroSesionController.php',
          type: 'POST', 
          data: formData,
          contentType : false,
          processData  : false, 

          success: function(response) { 
              try {
                  var jsonResponse = JSON.parse(response);
                  if (jsonResponse.exito) {
                      $('#response').html('<div class="alert alert-success">' + jsonResponse.msg + '</div>');
                      $('#registro')[0].reset();

                      $(location).attr('href','inicioSesion.php')
                  } else {
                      $('#response').html('<div class="alert alert-danger">' + jsonResponse.msg + '</div>');
                  }
              } catch (e) {
                  $('#response').html('<div class="alert alert-danger">Error al procesar la respuesta del servidor: ' + e.message + '</div>');
              }
          }, 
          error: function(err) { 
              $('#response').html('<div class="alert alert-danger">Error al registrar el usuario.</div>'); 
          } 
      }); 
  });
});
