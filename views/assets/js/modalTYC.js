document.getElementById('registro').addEventListener('submit', function(event) {
  event.preventDefault();
  $('#exampleModal').modal('show');
});

document.getElementById('aceptarBtn').addEventListener('click', function() {
  $('#exampleModal').modal('hide');
  document.getElementById('registro').submit();
});

document.getElementById('rechazarBtn').addEventListener('click', function() {
  Swal.fire({
    icon: "error",
    title: "¡Cuidado!",
    text: "Si no acepta los términos y condiciones no podrá ingresar"
  });
});
