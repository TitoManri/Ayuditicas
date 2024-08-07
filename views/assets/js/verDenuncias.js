/*Funcion para cargar el listado en el Datatable*/
function listarDenuncias() {
    tabla = $('#listadoDenuncias').dataTable({
        aProcessing: true, //actiavmos el procesamiento de datatables
        aServerSide: true, //paginacion y filtrado del lado del serevr
        dom: 'Bfrtip', //definimos los elementos del control de tabla
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


//FUNCION PRINCIPAL
$(function () {
    listarDenuncias();
});