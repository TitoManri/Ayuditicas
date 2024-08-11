function listarUsuariosTodos() {
    tabla = $('#tbllistado').dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: 'Bfrtip', 
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../controllers/usuarioController.php?op=listar_para_tabla',
        type: 'get',
        dataType: 'json',
        error: function (e) {
          console.log(e.responseText);
        },
        bDestroy: true,
        iDisplayLength: 5,
      },
    });
  }