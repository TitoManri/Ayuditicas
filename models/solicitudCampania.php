<?php
require_once '../config/conexion.php';
require_once '../models/campanias.php';

class SolicitudCampania extends Conexion
{
    //Conexion
    protected static $cnx;

    //Atributos
    private $id_solicitud_campania;
    private $cedula;
    private $id_publicacion;
    private $id_campania;
    private $contacto;
    private $razon_interes;
    private $habilidades;
    private $fecha_hora_envio;
    private $aceptada;
    private $nombreUsuario;
    private $nombreCompleto;

    private $FechaNacimiento;




    //Constructor
    public function __construct() {}

    // Getters
    public function getIdSolicitudCampania()
    {
        return $this->id_solicitud_campania;
    }

    public function getCedula()
    {
        return $this->cedula;
    }

    public function getIdPublicacion()
    {
        return $this->id_publicacion;
    }

    public function getIdCampania()
    {
        return $this->id_campania;
    }

    public function getContacto()
    {
        return $this->contacto;
    }

    public function getRazonInteres()
    {
        return $this->razon_interes;
    }

    public function getHabilidades()
    {
        return $this->habilidades;
    }

    public function getFechaHoraEnvio()
    {
        return $this->fecha_hora_envio;
    }

    public function getAceptada()
    {
        return $this->aceptada;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getFechaNacimiento()
    {
        return $this->FechaNacimiento;
    }

    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    // Setters
    public function setIdSolicitudCampania($id_solicitud_campania)
    {
        $this->id_solicitud_campania = $id_solicitud_campania;
    }

    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    public function setIdPublicacion($id_publicacion)
    {
        $this->id_publicacion = $id_publicacion;
    }

    public function setIdCampania($id_campania)
    {
        $this->id_campania = $id_campania;
    }

    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
    }

    public function setRazonInteres($razon_interes)
    {
        $this->razon_interes = $razon_interes;
    }

    public function setHabilidades($habilidades)
    {
        $this->habilidades = $habilidades;
    }

    public function setFechaHoraEnvio($fecha_hora_envio)
    {
        $this->fecha_hora_envio = $fecha_hora_envio;
    }

    public function setAceptada($aceptada)
    {
        $this->aceptada = $aceptada;
    }

    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function setFechaNacimiento($FechaNacimiento)
    {
        $this->FechaNacimiento = $FechaNacimiento;
    }

    public function setNombreCompleto($nombreCompleto)
    {
        $this->nombreCompleto = $nombreCompleto;
    }

    //Metodos
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }
    public static function desconectar()
    {
        self::$cnx = null;
    }

    public function enviarSolicitud()
    {
        $query = "INSERT INTO `solicitudes_campanias`(`cedula`, `id_publicacion`, `id_campania`, `contacto`, `razon_interes`, `habilidades`, `aceptada`) 
        VALUES (:cedula, :id_publicacion, :id_campania, :contacto, :razon_interes, :habilidades, 0)";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $cedula = $this->getCedula();
            $id_publicacion = $this->getIdPublicacion();
            $id_campania = $this->getIdCampania();
            $contacto = $this->getContacto();
            $razon_interes = $this->getRazonInteres();
            $habilidades = $this->getHabilidades();

            $resultado->bindParam(':cedula', $cedula, PDO::PARAM_INT);
            $resultado->bindParam(':id_publicacion', $id_publicacion, PDO::PARAM_INT);
            $resultado->bindParam(':id_campania', $id_campania, PDO::PARAM_INT);
            $resultado->bindParam(':contacto', $contacto, PDO::PARAM_STR);
            $resultado->bindParam(':razon_interes', $razon_interes, PDO::PARAM_STR);
            $resultado->bindParam(':habilidades', $habilidades, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            return $resultado;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }

    public function conseguirSolicitudesPorCampanas()
    {
        $query = "SELECT s.`id_solicitud_campania`, c.`nombre`, s.`cedula`, s.`id_campania`, s.`aceptada`, s.`fecha_hora_envio` FROM `solicitudes_campanias` s JOIN campanias c ON c.id_campania = s.id_campania WHERE c.cedula_creador_camp = :ID_Creador AND s.`aceptada`=0 ORDER BY s.`id_campania`";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $id = $this->getCedula();
            $resultado->bindParam(":ID_Creador", $id, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            $solicitudes = [];
            $datos = $resultado->fetchAll();
            foreach ($datos as $encontrado) {
                $solicitud = new SolicitudCampania();

                $solicitud->setIdSolicitudCampania($encontrado['id_solicitud_campania']);
                $solicitud->setNombreCompleto($encontrado['nombre']);
                $solicitud->setCedula($encontrado['cedula']);
                $solicitud->setIdCampania($encontrado['id_campania']);
                $solicitud->setAceptada($encontrado['aceptada']);
                $solicitud->setFechaHoraEnvio($encontrado['fecha_hora_envio']);
                $solicitudes[] = $solicitud;
            }
            return $solicitudes;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();;
            return json_encode($error);
        }
    }

    public function aceptarSolicitud()
    {
        $idSoli = $this->getIdSolicitudCampania();
        $idCamp = $this->getIdCampania();
        $query1 = "INSERT INTO `voluntarios_campanias`(`id_campania`, `id_solicitud_campania`) VALUES (:ID_Camp, :ID_Solicitud)";
        $query2 = "UPDATE `solicitudes_campanias` SET `aceptada`= 1 WHERE `id_solicitud_campania` = :ID_Solicitud";

        try {
            self::getConexion();
            $resultado1 = self::$cnx->prepare($query1);
            $resultado1->bindParam(":ID_Camp", $idCamp, PDO::PARAM_INT);
            $resultado1->bindParam(":ID_Solicitud", $idSoli, PDO::PARAM_INT);

            $resultado2 = self::$cnx->prepare($query2);
            $resultado2->bindParam(":ID_Solicitud", $idSoli, PDO::PARAM_INT);

            $resultado1->execute();
            $resultado2->execute();
            self::desconectar();
            if ($resultado1 && $resultado2) {
                return true;
            }
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();;
            return json_encode($error);
        }
    }

    public function rechazarSolicitud()
    {
        $idSoli = $this->getIdSolicitudCampania();
        $query = "DELETE FROM `solicitudes_campanias` WHERE `id_solicitud_campania` = :ID_Soli";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":ID_Soli", $idSoli, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            if ($resultado) {
                return true;
            }
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();;
            return json_encode($error);
        }
    }

    public function conseguirInfoDeSolicitud()
    {
        $idSoli = $this->getIdSolicitudCampania();
        $query = "SELECT
	                u.nombre_usuario, 
                    CONCAT(u.nombre, ' ', u.primer_apellido, ' ', u.segundo_apellido) AS NombreCompleto, 
                    u.fecha_nacimiento, 
                    s.contacto, 
                    s.razon_interes, 
                    s.habilidades,
                    s.id_campania
                    FROM `solicitudes_campanias` s 
                    JOIN usuarios u ON u.cedula = s.cedula 
                    WHERE s.id_solicitud_campania = :ID_Soli";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":ID_Soli", $idSoli, PDO::PARAM_INT);
            $resultado->execute();
            $solicitud = new SolicitudCampania();
            $datos = $resultado->fetchAll();

            foreach ($datos as $encontrado) {
                $solicitud->setIdCampania($idSoli);
                $solicitud->setNombreUsuario($encontrado['nombre_usuario']);
                $solicitud->setNombreCompleto($encontrado['NombreCompleto']);
                $solicitud->setFechaNacimiento($encontrado['fecha_nacimiento']);
                $solicitud->setContacto($encontrado['contacto']);
                $solicitud->setRazonInteres($encontrado['razon_interes']);
                $solicitud->setHabilidades($encontrado['habilidades']);
                $solicitud->setIdCampania($encontrado['id_campania']);
            }
            return $solicitud;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();;
            return json_encode($error);
        }
    }
}
