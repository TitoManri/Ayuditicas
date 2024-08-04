<?php
require_once '../models/MensajeGrupoModel.php';
switch ($_GET["op"]) {
    case 'readMensajes':
        $mensajeGrupo = new MensajeGrupoModel();
        $todosMensajesGrupo = $mensajeGrupo -> readMensajes();
        $data = array();
        foreach ($todosMensajesGrupo as $msjG) {
            $data[] = array(
                "0" => $msjG->getIdMensajeGrupo(),
                "1" => $msjG->getIdGrupo(),
                "2" => $msjG->getCedula(),
                "3" => $msjG->getContenido(),
                "4" => $msjG->getImg(),   
                "5" => $msjG->getFechaHoraEnvio(),
                "6" => $msjG->getLeido()
            );
        }
        break;
    case 'createMensaje':
        //ahorita hay que modificar los valores de esto
        $idMensajeGrupo = isset($_POST["idMensajeGrupo"]) ? trim($_POST["idMensajeGrupo"]) : "";
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
        $idGrupo = isset($_POST["idGrupo"]) ? trim($_POST["idGrupo"]) : "";
        $contenido = isset($_POST["contenido"]) ? trim($_POST["contenido"]) : "";
        $img = isset($_POST["img"]) ? trim($_POST["img"]) : "";
        $fechaHoraEnvio = localtime();
        $leido = 0;
        
        $mensaje = new MensajeGrupoModel();
        $mensaje -> setIdMensajeGrupo($idMensajeGrupo);
        $mensaje -> setCedula($cedula);
        $mensaje -> setIdGrupo($idGrupo);
        $mensaje -> setContenido($contenido);
        $mensaje -> setImg($img);
        $mensaje -> setFechaHoraEnvio($fechaHoraEnvio);
        $mensaje -> setLeido($leido);
        $mensaje -> createMensaje();
        break;
    case 'updateLeido':
        $idMensajeGrupo = isset($_POST["idMensajeGrupo"]) ? trim($_POST["idMensajeGrupo"]) : "";
        $mensaje = new MensajeGrupoModel();
        $mensaje -> setIdMensajeGrupo($idMensajeGrupo);
        $mensaje -> updateLeido();
        break;
}
?>