<?php
require_once '../models/campanias.php';

switch ($_GET["op"]) {
    case 'crearCampana': {
            $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
            $nombre = isset($_POST["Nombre_Camp"]) ? trim($_POST["Nombre_Camp"]) : "";
            $descripcion = isset($_POST["Descripcion"]) ? trim($_POST["Descripcion"]) : "";
            $voluntarios = isset($_POST["Cantidad_Personas"]) ? trim($_POST["Cantidad_Personas"]) : "";
            $fecha = isset($_POST["FechaFinalizacion"]) ? trim($_POST["FechaFinalizacion"]) : "";
            $terminada = 0;

            $campania = new Campania();
            $campania->setCedulaCreadorCamp($cedula);
            $campania->setNombre($nombre);
            $campania->setDescripcion($descripcion);
            $campania->setVoluntariosRequeridos($voluntarios);
            $campania->setFechaHoraCulminacion($fecha);
            $campania->setTerminada($terminada);
            $resultado = $campania->crearCampaña();

            if (is_int($resultado)) {
                echo $resultado;
            } else {
                echo "Error";
            }
            break;
        }

    case 'conseguirInfo': {
            $id = isset($_GET["ID_Camp"]) ? trim($_GET["ID_Camp"]) : "";
            $campania = new Campania();
            $campania->setIdCampania($id);
            $resultado = $campania->conseguirID();
            $data = array(
                "cedula_creador_camp" => $resultado->getCedulaCreadorCamp(),
                "nombre" => $resultado->getNombre(),
                'nombre_usuario' => $resultado->getNombreUsuario(),
                "descripcion" => $resultado->getDescripcion(),
                "voluntarios" => $resultado->getVoluntariosRequeridos(),
                "fechaCulminacion" => $resultado->getFechaHoraCulminacion(),
                "terminada" => $resultado->getTerminada()
            );
            echo json_encode($data);
            break;
        }
    case 'conseguirCamps': {
            $camp = new Campania();
            $camps = $camp->SelectCampanias();
            $data = [];
            foreach ($camps as $reg) {
                $data[] = array(
                    'id_campania' => $reg->getIdCampania(),
                    'cedula_creador_camp' => $reg->getCedulaCreadorCamp(),
                    'nombre_usuario' => $reg->getNombreUsuario(),
                    'nombre' => $reg->getNombre(),
                    'descripcion' => $reg->getDescripcion(),
                    'voluntarios_requeridos' => $reg->getVoluntariosRequeridos(),
                    'fecha_hora_culminacion' => $reg->getFechaHoraCulminacion(),
                    'terminada' => $reg->getTerminada()
                );
            }
            echo json_encode($data);
            break;
        }
        case 'conseguirCampsAside':{
            $camp = new Campania();
            $camps = $camp->SelectCampaniasAside();
            foreach ($camps as $reg) {
                $data[] = array(
                    'id_campania' => $reg->getIdCampania(),
                    'nombre' => $reg->getNombre(),
                    'descripcion' => $reg->getDescripcion(),
                    'voluntarios_requeridos' => $reg->getVoluntariosRequeridos(),
                );
            }
            echo json_encode($data);
            break;
        }
}
