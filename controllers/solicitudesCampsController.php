<?php
require_once '../models/solicitudCampania.php';

switch ($_GET["op"]) {
    case 'enviarSolicitud': {
            $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
            $id_publicacion = isset($_POST["id_publicacion"]) ? trim($_POST["id_publicacion"]) : "";
            $id_campania = isset($_POST["id_campania"]) ? trim($_POST["id_campania"]) : "";
            $contacto = isset($_POST["Contacto"]) ? trim($_POST["Contacto"]) : "";
            $razon_interes = isset($_POST["RazonInteres"]) ? trim($_POST["RazonInteres"]) : "";
            $habilidades = isset($_POST["Habilidades"]) ? trim($_POST["Habilidades"]) : "";

            $solicitud = new SolicitudCampania();
            $solicitud->setCedula($cedula);
            $solicitud->setIdCampania($id_campania);
            $solicitud->setIdPublicacion($id_publicacion);
            $solicitud->setContacto($contacto);
            $solicitud->setRazonInteres($razon_interes);
            $solicitud->setHabilidades($habilidades);

            $resultado = $solicitud->enviarSolicitud();

            if ($resultado) {
                echo $resultado;
            } else {
                echo "Error";
            }
            break;
        }
    case 'listarSolicitudes': {
            $cedula = isset($_GET["cedula"]) ? trim($_GET["cedula"]) : "";

            $solicitudCreacion = new SolicitudCampania();
            $solicitudCreacion->setCedula($cedula);
            $solicitudes = $solicitudCreacion->conseguirSolicitudesPorCampanas();
            $data = [];
            foreach ($solicitudes as $sol) {
                $data[] = array(
                    'id_solicitud_campania' => $sol->getIdSolicitudCampania(),
                    'cedula' => $sol->getCedula(),
                    'id_publicacion' => $sol->getIdPublicacion(),
                    'id_campania' => $sol->getIdCampania(),
                    'fecha_hora_envio' => $sol->getFechaHoraEnvio(),
                    'aceptada' => $sol->getAceptada()
                );
            }
            echo json_encode($data);
            break;
        }

    case 'aceptarSolicitud': {
            $ID_Solicitud = isset($_POST["ID_Solicitud"]) ? trim($_POST["ID_Solicitud"]) : "";
            $ID_Camp = isset($_POST["ID_Camp"]) ? trim($_POST["ID_Camp"]) : "";
            $solicitud = new SolicitudCampania();
            $solicitud->setIdCampania($ID_Camp);
            $solicitud->setIdSolicitudCampania($ID_Solicitud);
            $resultado = $solicitud->aceptarSolicitud();
            if ($resultado) {
                echo "Exito";
            }
            break;
        }

    case 'rechazarSolicitud': {
            $ID_Solicitud = isset($_POST["ID_Solicitud"]) ? trim($_POST["ID_Solicitud"]) : "";
            $solicitud = new SolicitudCampania();
            $solicitud->setIdSolicitudCampania($ID_Solicitud);
            $resultado = $solicitud->rechazarSolicitud();
            if ($resultado) {
                echo "Exito";
            }
            break;
        }

    case 'verDetallesSolicitud': {
            $id_solicitud = isset($_GET["id_solicitud"]) ? trim($_GET["id_solicitud"]) : "";
            $solicitud = new SolicitudCampania();
            $solicitud->setIdSolicitudCampania($id_solicitud);
            $dato = $solicitud->conseguirInfoDeSolicitud();

            $data = array(
                "id_solicitud" => $id_solicitud,
                "nombre_usuario" => $dato->getNombreUsuario(),
                "nombreCompleto" => $dato->getNombreCompleto(),
                "fecha_nacimiento" => $dato->getFechaNacimiento(),
                "contacto" => $dato->getContacto(),
                "razon_interes" => $dato->getRazonInteres(),
                "habilidades" => $dato->getHabilidades(),
                "id_campania" => $dato->getIdCampania()
            );
            echo json_encode($data);
            break;
        }
}
