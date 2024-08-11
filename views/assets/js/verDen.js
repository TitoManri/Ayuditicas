/*Funcion para cargar el listado en el Datatable*/
function listarDenuncias() {
    tabla = $('#listadoDenuncias').dataTable({
        aProcessing: true, 
        aServerSide: true, 
        dom: 'Bfrtip', 
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../controllers/solicitudDenunciaController.php?op=verDenuncias',
            type: 'get',
            dataType: 'json',
            error: function (e) {
                console.log('Hubo un error al poner lo datos en la tabla');
            },
            bDestroy: true,
            iDisplayLength: 5,
        },
    });
}



$(function () {
    listarDenuncias();

    //refrescar la página cada 5 seg
    setTimeout(function () {
        tabla.ajax.reload(null, false);
    }, 3000);
    
});
