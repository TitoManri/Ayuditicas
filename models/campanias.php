<?php
require_once '../config/conexion.php';

class Campania extends Conexion
{

    //Conexion
    protected static $cnx;

    //Atributos
    private $id_campania = null;
    private $cedula_creador_camp = null;
    private $nombre = null;
    private $descripcion = null;
    private $voluntarios_requeridos = null;
    private $fecha_hora_creacion = null;
    private $fecha_hora_culminacion = null;
    private $terminada     = null;

    private $nombreUsuario = null;

    //Constructor
    public function __construct() {}

    //Getters
    public function getIdCampania()
    {
        return $this->id_campania;
    }

    public function getCedulaCreadorCamp()
    {
        return $this->cedula_creador_camp;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getVoluntariosRequeridos()
    {
        return $this->voluntarios_requeridos;
    }
    public function getFechaHoraCreacion()
    {
        return $this->fecha_hora_creacion;
    }

    public function getFechaHoraCulminacion()
    {
        return $this->fecha_hora_culminacion;
    }
    public function getTerminada()
    {
        return $this->terminada;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    //Setters
    public function setIdCampania($id_campania)
    {
        $this->id_campania = $id_campania;
    }

    public function setCedulaCreadorCamp($cedula_creador_camp)
    {
        $this->cedula_creador_camp = $cedula_creador_camp;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setVoluntariosRequeridos($voluntarios_requeridos)
    {
        $this->voluntarios_requeridos = $voluntarios_requeridos;
    }

    public function setFechaHoraCreacion($fecha_hora_creacion)
    {
        $this->fecha_hora_creacion = $fecha_hora_creacion;
    }

    public function setFechaHoraCulminacion($fecha_hora_culminacion)
    {
        $this->fecha_hora_culminacion = $fecha_hora_culminacion;
    }

    public function setTerminada($terminada)
    {
        $this->terminada = $terminada;
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

    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }



    public function SelectCampanias()
    {
        $query = "SELECT c.id_campania, c.cedula_creador_camp, u.nombre_usuario, c.nombre, c.descripcion, c.voluntarios_requeridos, c.fecha_hora_culminacion, c.terminada FROM campanias c JOIN usuarios u ON u.cedula = cedula_creador_camp  WHERE c.terminada = 0";
        $campanias = [];

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $campaniaIndividual = new Campania();
                $campaniaIndividual->setIdCampania($encontrado['id_campania']);
                $campaniaIndividual->setCedulaCreadorCamp($encontrado['cedula_creador_camp']);
                $campaniaIndividual->setNombreUsuario($encontrado['nombre_usuario']);
                $campaniaIndividual->setNombre($encontrado['nombre']);
                $campaniaIndividual->setDescripcion($encontrado['descripcion']);
                $campaniaIndividual->setVoluntariosRequeridos($encontrado['voluntarios_requeridos']);
                $campaniaIndividual->setFechaHoraCulminacion($encontrado['fecha_hora_culminacion']);
                $campaniaIndividual->setTerminada($encontrado['terminada']);
                $campanias[] = $campaniaIndividual;
            }
            return $campanias;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Hubo un error al conseguir las campañas.\n" . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }

    public function SelectCampaniasAside()
    {
        $query = "SELECT `id_campania`, `nombre`, `descripcion`, `voluntarios_requeridos` FROM `campanias` WHERE terminada = 0 ORDER BY `id_campania` DESC LIMIT 2";
        $campanias = [];

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $campaniaIndividual = new Campania();
                $campaniaIndividual->setIdCampania($encontrado['id_campania']);
                $campaniaIndividual->setNombre($encontrado['nombre']);
                $campaniaIndividual->setDescripcion($encontrado['descripcion']);
                $campaniaIndividual->setVoluntariosRequeridos($encontrado['voluntarios_requeridos']);
                $campanias[] = $campaniaIndividual;
            }
            return $campanias;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Hubo un error al conseguir las campañas.\n" . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }

    public function crearCampaña()
    {
        $query = "INSERT INTO `campanias`
        (`cedula_creador_camp`, `nombre`, `descripcion`, `voluntarios_requeridos`, `fecha_hora_culminacion`, `terminada`) 
        VALUES (:cedula, :nombre, :descripcion, :voluntarios, :fecha, :terminada)";
        $query2 = "SELECT MAX(id_campania) as ID FROM campanias";
        try {
            self::getConexion();
            $cedula = $this->getCedulaCreadorCamp();
            $nombre = $this->getNombre();
            $descripcion = $this->getDescripcion();
            $voluntarios = $this->getVoluntariosRequeridos();
            $fecha = $this->getFechaHoraCulminacion();
            $terminada = 0;

            $resultado = self::$cnx->prepare($query);
            $resultado2 = self::$cnx->prepare($query2);

            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_STR);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":voluntarios", $voluntarios, PDO::PARAM_INT);
            $resultado->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $resultado->bindParam(":terminada", $terminada, PDO::PARAM_INT);
            $resultado->execute();
            $resultado2->execute();
            $id = $resultado2->fetch(PDO::FETCH_ASSOC);
            self::desconectar();
            $lastInsertId = $id['ID'];
            return $lastInsertId;
        } catch (Exception $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }

    public function conseguirID()
    {
        $query = "SELECT c.cedula_creador_camp, u.nombre_usuario, c.nombre, c.descripcion, c.voluntarios_requeridos, c.fecha_hora_culminacion, c.terminada FROM campanias c JOIN usuarios u ON u.cedula = cedula_creador_camp
        WHERE `id_campania` = :ID_Camp";
        $id = $this->getIdCampania();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":ID_Camp", $id, PDO::PARAM_INT);
            $resultado->execute();
            $resultados = null;
            self::desconectar();
            $datos = $resultado->fetchAll();
            foreach ($datos as $encontrado) {
                $campania = new Campania();
                $campania->setCedulaCreadorCamp($encontrado['cedula_creador_camp']);
                $campania->setNombre($encontrado['nombre']);
                $campania->setNombreUsuario($encontrado['nombre_usuario']);
                $campania->setDescripcion($encontrado['descripcion']);
                $campania->setVoluntariosRequeridos($encontrado['voluntarios_requeridos']);
                $campania->setFechaHoraCulminacion($encontrado['fecha_hora_culminacion']);
                $campania->setTerminada($encontrado['terminada']);
                $resultados = $campania;
            }
            return $resultados;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();;
            return json_encode($error);
        }
    }

    public function SelectCampaniasIDNombre()
    {
        $query = "SELECT `id_campania`,`cedula_creador_camp`, `nombre` FROM `campanias` WHERE `terminada` = 0";
        $campanias = [];

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $campaniaIndividual = new Campania();
                $campaniaIndividual->setIdCampania($encontrado['id_campania']);
                $campaniaIndividual->setCedulaCreadorCamp($encontrado['cedula_creador_camp']);
                $campaniaIndividual->setNombre($encontrado['nombre']);
                $campanias[] = $campaniaIndividual;
            }
            return $campanias;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Hubo un error al conseguir las campañas.\n" . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }
    public function inscrito()
    {
        $query = "SELECT s.cedula FROM `voluntarios_campanias` v 
                  JOIN solicitudes_campanias s ON s.id_solicitud_campania = v.id_solicitud_campania 
                  WHERE s.id_campania = :id_camp AND s.cedula = :cedula AND s.aceptada = 1";

        $idCamp = $this->getIdCampania();
        $cedula = $this->getCedulaCreadorCamp();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_camp", $idCamp, PDO::PARAM_INT);
            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $resultado->execute();

            $existe = $resultado->fetch() !== false;

            self::desconectar();
            return $existe;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }

    public function terminarCampana()
    {
        $query = "UPDATE `campanias` SET `terminada`= 1 WHERE `id_campania` = :ID_Camp";
        $idCamp = $this->getIdCampania();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":ID_Camp", $idCamp, PDO::PARAM_INT);
            $resultado->execute();
            $exito = $resultado->rowCount() > 0;
            self::desconectar();
            return $exito;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }
}
