<?php
require_once '../models/MensajeModel.php';
require_once '../models/UserModel.php';

switch ($_GET["op"]) {
    case 'mostrarMensajesChat':
        //usuario logueado
        $usuario1 = 305590892;
        $usuario2 = isset($_POST["usuario2"]) ? trim($_POST["usuario2"]) : "";

        $mensaje = new MensajeModel();
        $todosMensajes = $mensaje->mostrarMensajesChat($usuario1, $usuario2);
        $data = array();

        if ($todosMensajes) {
            foreach ($todosMensajes as $msj) {
                $data[] = array(
                    "idMensaje" => $msj->getIdMensaje(),
                    "reminente" => $msj->getCedulaReminente(),
                    "destinatario" => $msj->getCedulaDestinatario(),
                    "cuerpo" => $msj->getCuerpoMensaje(),
                    "img" => $msj->getImg(),
                    "leido" => $msj->getLeido(),
                    "fechaEnvio" => $msj->getFechaHoraEnvio()
                );
            }
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "No se pudieron obtener los mensajes."]);
        }
        break;
    case 'createMensaje':
        //ahorita hay que modificar los valores de esto
        $cedulaReminente = isset($_POST["cedulaReminente"]) ? trim($_POST["cedulaReminente"]) : "";
        $cedulaDestinatario = isset($_POST["cedulaDestinatario"]) ? trim($_POST["cedulaDestinatario"]) : "";
        $cuerpoMensaje = isset($_POST["cuerpoMensaje"]) ? trim($_POST["cuerpoMensaje"]) : "";
        $img = isset($_POST["img"]) ? trim($_POST["img"]) : "";

        $mensaje = new MensajeModel();
        $mensaje->setCedulaReminente($cedulaReminente);
        $mensaje->setCedulaDestinatario($cedulaDestinatario);
        $mensaje->setCuerpoMensaje($cuerpoMensaje);
        $mensaje->setImg($img);
        $mensaje->createMensaje();
        break;
    case 'updateLeido':
        $idMensaje = isset($_POST["idMensaje"]) ? trim($_POST["idMensaje"]) : "";
        $mensaje = new MensajeModel();
        $mensaje->setIdMensaje($idMensaje);
        $mensaje->updateLeido();
        break;
    case 'listarContactos':
        //$cedulaUsuarioActual = isset($_POST["idMensaje"]) ? trim($_POST["idMensaje"]) : "";
        $cedulaUsuarioActual = 305590892;
        $user = new UserModel();
        $contacto = $user->listarContactos($cedulaUsuarioActual);
        $arr = array();
        foreach ($contacto as $reg) {
            $arr[] = array(
                'cedula' => $reg->getCedula(),
                'nombreUsuario' => $reg->getNombreUsuario(),
            );
        }
        echo json_encode($arr);
        if (!$contacto) {
            echo json_encode(["error" => "No se pudieron obtener los contactos."]);
            exit;
        }
        break;
}
?>