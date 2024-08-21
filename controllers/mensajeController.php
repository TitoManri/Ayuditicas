<?php
//se hace la llamda de los models
require_once '../models/MensajeModel.php';
require_once '../models/UserModel.php';

switch ($_GET["op"]) {
    case 'mostrarMensajesChat':
        //se busca la información del usuario logueado y del usuario con el que chatea
        $usuario1 = isset($_POST["usuario1"]) ? trim($_POST["usuario1"]) : "";
        $usuario2 = isset($_POST["usuario2"]) ? trim($_POST["usuario2"]) : "";

        //se crea un objeto 
        $mensaje = new MensajeModel();

        //se llama la función
        $todosMensajes = $mensaje->mostrarMensajesChat($usuario1, $usuario2);

        //arreglo para guardar los mensajes 
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
            //devuelve los datos
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "No se pudieron obtener los mensajes."]);
        }
        break;
    case 'enviarMensaje':
        $imgDir = null;

        //busca los datos del mensaje 
        $cedulaRemitente = isset($_POST["cedulaRemitente"]) ? trim($_POST["cedulaRemitente"]) : "";
        $cedulaDestinatario = isset($_POST["cedulaDestinatario"]) ? trim($_POST["cedulaDestinatario"]) : "";
        $cuerpoMensaje = isset($_POST["cuerpoMensaje"]) ? trim($_POST["cuerpoMensaje"]) : null;
        $img = isset($_FILES["imagen"]) ? $_FILES["imagen"] : null;

        //si hay una imagen entonces se guarda la foto usando la función, se valida su éxito
        if ($img != null) {
            $imgArr = guardarFotoNombre($img);
            if ($imgArr['exito'] == 1) {
                $imgDir = $imgArr['contenido'];
            } else {
                echo json_encode($imgArr);
                return;
            }
        }

        //se guardan los datos
        $mensaje = new MensajeModel();
        $mensaje->setCedulaRemitente($cedulaRemitente);
        $mensaje->setCedulaDestinatario($cedulaDestinatario);
        $mensaje->setCuerpoMensaje($cuerpoMensaje);
        $mensaje->setImg($imgDir);

        //se crea el mensaje 
        $resultado = $mensaje->enviarMensaje();
        if ($resultado === "exito") {
            //se devuelve los datos del mensaje 
            if ($img != null) {
                echo json_encode(["img" => $imgDir]);
            } else {
                echo json_encode(["contenido" => $cuerpoMensaje]);
            }
        } else {
            echo json_encode(["error" => $resultado]);
        }
        break;

    case 'updateLeido':
        //se obtienen los datos del chat
        $cedRemitente = isset($_POST["cedRemitente"]) ? trim($_POST["cedRemitente"]) : "";
        $cedDestinatario = isset($_POST["cedDestinatario"]) ? trim($_POST["cedDestinatario"]) : "";

        //se crea objeto mensaje 
        $mensaje = new MensajeModel();

        //se actualiza el leido del mensaje 
        $resultado = $mensaje->updateLeido($cedRemitente, $cedDestinatario);
        if ($resultado > 0) {
            //se devuelve un mensaje de éxito o error
            echo json_encode(["msj" => "Actualizado correctamente"]);
        } else {
            echo json_encode(["err" => "Error al actualizar el estado del mensaje"]);
        }
        break;
    case 'listarContactos':
        //se obtiene datos del usuario logueado
        $cedulaUsuarioActual = isset($_POST["cedulaUsuarioActual"]) ? trim($_POST["cedulaUsuarioActual"]) : "";
        $user = new UserModel();
        //se listan los usuarios que tienen relación con el usuario logueado
        $contacto = $user->listarContactos($cedulaUsuarioActual);
        $arr = array();
        foreach ($contacto as $reg) {
            $arr[] = array(
                //se obtienen los datos de los usuarios
                'cedula' => $reg->getCedula(),
                'nombreUsuario' => $reg->getNombreUsuario(),
                'img' => $reg->getImg()
            );
        }
        //devuelve los datos
        echo json_encode($arr);
        break;
    case 'buscarTodosContactos':
        $usuario = new UserModel();
        //busca todos los usuarios
        $todosUsuarios = $usuario->listasTodosUsuarios();
        $data = array();

        if ($todosUsuarios) {
            foreach ($todosUsuarios as $usr) {
                $data[] = array(
                    //obtiene los datos
                    "cedula" => $usr->getCedula(),
                    "nombreUsuario" => $usr->getNombreUsuario(),
                    "img" => $usr->getImg()
                );
            }
            //devuelve los datos
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "No se pudieron obtener los mensajes."]);
        }
}

function guardarFotoNombre($img)
{
    //bsuca los datos de qe devuelve el arreglo de la imagen
    $imgName = $img['name'];
    $imgTmp = $img['tmp_name'];
    $imgError = $img['error'];

    //obtiene el tipo
    $imgExt = explode('.', $imgName);
    //lo pone en minúscula
    $imgActualExt = strtolower(end($imgExt));

    //arreglo de los tipos permitidos
    $permitir = array('jpg', 'jpeg', 'png');

    if (in_array($imgActualExt, $permitir)) {
        if ($imgError === 0) {
            //crea un id único con la hora de subida
            $imgNameNew = uniqid('', true) . "." . $imgActualExt;
            //determina la nueva dirección
            $imgDestination = '../views/assets/img/' . $imgNameNew;
            //guarda la imagen
            move_uploaded_file($imgTmp, $imgDestination);
            //devuelve un mensaje de éxito
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