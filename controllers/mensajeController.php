<?php
require_once '../models/MensajeModel.php';
switch ($_GET["op"]) {
    case 'readMensaje':
        $mensaje = new MensajeModel();
        $todosMensajes = $mensaje -> readMensajes();
        $data = array();
        foreach ($todosMensajes as $msj) {
            $data[] = array(
                "0" => $msj->getIdMensaje(),
                "1" => $msj->getCedulaReminente(),
                "2" => $msj->getCedulaDestinatario(),
                "3" => $msj->getCuerpoMensaje(),
                "4" => $msj->getImg(),   
                "5" => $msj->getLeido(),
                "6" => $msj->getFechaHoraEnvio()
            );
        }
        break;
    case 'createMensaje':
        //ahorita hay que modificar los valores de esto
        $idMensaje = isset($_POST["idMensaje"]) ? trim($_POST["idMensaje"]) : "";
        $cedulaReminente = isset($_POST["cedulaReminente"]) ? trim($_POST["cedulaReminente"]) : "";
        $cedulaDestinatario = isset($_POST["cedulaDestinatario"]) ? trim($_POST["cedulaDestinatario"]) : "";
        $cuerpoMensaje = isset($_POST["cuerpoMensaje"]) ? trim($_POST["cuerpoMensaje"]) : "";
        $img = isset($_POST["img"]) ? trim($_POST["img"]) : "";
        $leido = 0;
        $fechaHoraEnvio = localtime();
        
        $mensaje = new MensajeModel();
        $mensaje -> setIdMensaje($idMensaje);
        $mensaje -> setCedulaReminente($cedulaReminente);
        $mensaje -> setCedulaDestinatario($cedulaDestinatario);
        $mensaje -> setCuerpoMensaje($cuerpoMensaje);
        $mensaje -> setImg($img);
        $mensaje -> setLeido($leido);
        $mensaje -> setFechaHoraEnvio($fechaHoraEnvio);
        $mensaje -> createMensaje();
        break;
    case 'updateLeido':
        $idMensaje = isset($_POST["idMensaje"]) ? trim($_POST["idMensaje"]) : "";
        $mensaje = new MensajeModel();
        $mensaje -> setIdMensaje($idMensaje);
        $mensaje -> updateLeido();
        break;
}
?>