$(document).ready(function () {
    $('#crearPublicacionForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: '../controllers/PublicacionController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                const respuestaDeJSON = JSON.parse(response);
                if (respuestaDeJSON.exitoFormulario) {
                    $('#response').html('<div class="alert alert-success">' + respuestaDeJSON.message + '</div>');
                    console.log("Publicación creada con éxito");
                    $('#crearPublicacionModal').modal('hide'); 
                } else {
                    $('#response').html('<div class="alert alert-danger">' + respuestaDeJSON.message + '</div>');
                    console.log("Error al crear la publicación");
                }
            },
            error: function(err) {
                $('#response').html('<div class="alert alert-danger">Error al crear la publicación.</div>');
                console.log("Error en la solicitud AJAX");
            }
        });
    });

    window.displaySelectedImage = function(event, imgElementId) {
        var input = event.target;
        var file = input.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#' + imgElementId).attr('src', e.target.result);
        }
        reader.readAsDataURL(file);
    }
});

$(document).ready(function() {
    $('input[name="inlineRadioOptions"]').on('change', function() {
        if ($('#inlineRadio1').is(':checked')) {
            $('#comunidadSection').show();
        } else {
            $('#comunidadSection').hide();
        }
    });
});

$(document).ready(function() {
    var input = document.getElementById('tags');
    var tagify = new Tagify(input, {
      maxTags: 3,
      delimiters: ",| ",  
      dropdown: {
        enabled: 0 
      }
    });

    input.addEventListener('keydown', function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        tagify.addTags(input.value.trim());
        input.value = '';
      }
    });
  });