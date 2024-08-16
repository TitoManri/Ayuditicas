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
        $imgDir = null;

        $cedulaRemitente = isset($_POST["cedulaRemitente"]) ? trim($_POST["cedulaRemitente"]) : "";
        $cedulaDestinatario = isset($_POST["cedulaDestinatario"]) ? trim($_POST["cedulaDestinatario"]) : "";
        $cuerpoMensaje = isset($_POST["cuerpoMensaje"]) ? trim($_POST["cuerpoMensaje"]) : null;
        $img = isset($_FILES["imagen"]) ? $_FILES["imagen"] : null;

        if ($img != null) {
            $imgArr = guardarFotoNombre($img);
            if ($imgArr['exito'] == 1) {
                $imgDir = $imgArr['contenido'];
            } else {
                echo json_encode($imgArr);
                return;
            }
        }

        $mensaje = new MensajeModel();
        $mensaje->setCedulaRemitente($cedulaRemitente);
        $mensaje->setCedulaDestinatario($cedulaDestinatario);
        $mensaje->setCuerpoMensaje($cuerpoMensaje);
        $mensaje->setImg($imgDir);

        $resultado = $mensaje->enviarMensaje();
        if ($resultado === "exito") {
            //echo json_encode(["msj" => "Se envió el mensaje correctamente."]);
            if ($img!=null) {
                echo json_encode(["img" => $imgDir]);
            } else {
                echo json_encode(["contenido" => $cuerpoMensaje]);
            }
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

function guardarFotoNombre($img)
{
    $imgName = $img['name'];
    $imgTmp = $img['tmp_name'];
    $imgError = $img['error'];

    $imgExt = explode('.', $imgName);
    $imgActualExt = strtolower(end($imgExt));

    $permitir = array('jpg', 'jpeg', 'png');

    if (in_array($imgActualExt, $permitir)) {
        if ($imgError === 0) {
            //reemplazar por el id de la denuncia
            $imgNameNew = uniqid('', true) . "." . $imgActualExt;
            $imgDestination = '../views/assets/img/' . $imgNameNew;
            move_uploaded_file($imgTmp, $imgDestination);
            $datos = array("exito" => "1", "contenido" => "./assets/img/" . $imgNameNew . "");
            return $datos;
        } else {
            $datos = array("exito" => "0", "contenido" => "Hubo un error al cargar la imagen");
            return $datos;
        }
    } else {
        $datos = array("exito" => "0", "contenido" => "No se permite este tipo de archivo");
        return $datos;
    }
}
?>