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

            if ($id_publicacion == null) {
                $id_publicacion = 0;
            }
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
        $query = "SELECT s.`id_solicitud_campania`, s.`cedula`, s.`id_campania`, s.`aceptada`, s.`fecha_hora_envio` FROM `solicitudes_campanias` s JOIN campanias c ON c.id_campania = s.id_campania WHERE c.cedula_creador_camp = :ID_Creador ORDER BY s.`id_campania`";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $id = $this -> getCedula();
            $resultado -> bindParam(":ID_Creador", $id, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            $solicitudes = [];
            $datos = $resultado->fetchAll();
            foreach ($datos as $encontrado) {
                $solicitud = new SolicitudCampania();

                $solicitud->setIdSolicitudCampania($encontrado['id_solicitud_campania']);
                $solicitud->setCedula($encontrado['cedula']);
                $solicitud->setIdCampania($encontrado['id_campania']);
                $solicitud->setAceptada($encontrado['aceptada']);
                $solicitud -> setFechaHoraEnvio($encontrado['fecha_hora_envio']);
                $solicitudes[] = $solicitud;
            }
            return $solicitudes;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();;
            return json_encode($error);
        }
    }
}
