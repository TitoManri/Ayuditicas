<?php
require_once '../models/MensajeModel.php';
require_once '../models/UserModel.php';

switch ($_GET["op"]) {
    case 'mostrarMensajesChat':
        //usuario logueado
        $usuario1 = isset($_POST["usuario1"]) ? trim($_POST["usuario1"]) : "";
        $usuario2 = isset($_POST["usuario2"]) ? trim($_POST["usuario2"]) : "";

        $mensaje = new MensajeModel();
        $todosMensajes = $mensaje->mostrarMensajesChat($usuario1, $usuario2);
        $data = array();

        if ($todosMensajes) {
            foreach ($todosMensajes as $msj) {
                $data[] = array(
                    "idMensaje" => $msj->getIdMensaje(),
                    "remitente" => $msj->getCedulaRemitente(),
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
    case 'enviarMensaje':
        $cedulaRemitente = isset($_POST["cedulaRemitente"]) ? trim($_POST["cedulaRemitente"]) : "";
        $cedulaDestinatario = isset($_POST["cedulaDestinatario"]) ? trim($_POST["cedulaDestinatario"]) : "";
        $cuerpoMensaje = isset($_POST["cuerpoMensaje"]) ? trim($_POST["cuerpoMensaje"]) : null;
        $img = isset($_POST["img"]) ? trim($_POST["img"]) : null;

        $mensaje = new MensajeModel();
        $mensaje->setCedulaRemitente($cedulaRemitente);
        $mensaje->setCedulaDestinatario($cedulaDestinatario);
        $mensaje->setCuerpoMensaje($cuerpoMensaje);
        $mensaje->setImg($img);

        $resultado = $mensaje->enviarMensaje();
        if ($resultado === "exito") {
            echo json_encode(["msj" => "Se envió el mensaje correctamente."]);
        } else {
            echo json_encode(["error" => $resultado]);
        }
        break;

    case 'updateLeido':
        $idMensaje = isset($_POST["idMensaje"]) ? trim($_POST["idMensaje"]) : "";
        $mensaje = new MensajeModel();
        $mensaje->setIdMensaje($idMensaje);
        $mensaje->updateLeido();
        break;
    case 'listarContactos':
        $cedulaUsuarioActual = isset($_POST["cedulaUsuarioActual"]) ? trim($_POST["cedulaUsuarioActual"]) : "";
        $user = new UserModel();
        $contacto = $user->listarContactos($cedulaUsuarioActual);
        $arr = array();
        foreach ($contacto as $reg) {
            $arr[] = array(
                'cedula' => $reg->getCedula(),
                'nombreUsuario' => $reg->getNombreUsuario(),
                'img' => $reg->getImg()
            );
        }
        echo json_encode($arr);
        break;
}
?>