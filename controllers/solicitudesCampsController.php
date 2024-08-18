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
            $solicitudCreacion -> setCedula($cedula);
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
}
