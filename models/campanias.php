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

    public function SelectCampanias()
    {
        $query = "SELECT `id_campania`,`cedula_creador_camp`, `nombre`, `descripcion`, `voluntarios_requeridos`, `fecha_hora_culminacion`, `terminada` FROM `campanias`";
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
                $campaniaIndividual->setDescripcion($encontrado['descripcion']);
                $campaniaIndividual->setVoluntariosRequeridos($encontrado['voluntarios_requeridos']);
                $campaniaIndividual->setFechaHoraCulminacion($encontrado['fecha_hora_culminacion']);
                $campaniaIndividual->setTerminada($encontrado['terminada']);
                $campanias[] = $campaniaIndividual;
            }
            return $campanias;
        } catch (Exception $ex) {
            self::desconectar();
            $error = "Hubo un error al conseguir las etiquetas.\n" . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }

    public function crearCampaña()
    {
        $query = "INSERT INTO `campanias`
        (`cedula_creador_camp`, `nombre`, `descripcion`, `voluntarios_requeridos`, `fecha_hora_culminacion`, `terminada`) 
        VALUES (:cedula, :nombre, :descripcion, :voluntarios, :fecha, :terminada)";
        $query2 = "SELECT LAST_INSERT_ID() as ID";
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

    public function conseguirID() {
        $query = "SELECT 
        `cedula_creador_camp`, `nombre`, `descripcion`, `voluntarios_requeridos`, `fecha_hora_culminacion`, `terminada` 
        FROM `campanias` 
        WHERE `id_campania` = :ID_Camp";
        $id = $this -> getIdCampania();
        try{
            self::getConexion();
            $resultado = self::$cnx ->prepare($query);
            $resultado -> bindParam(":ID_Camp", $id, PDO::PARAM_INT);
            $resultado -> execute();
            $resultados = null;
            self::desconectar();
            $datos = $resultado -> fetchAll();
            foreach ($datos as $encontrado) {
                $campania = new Campania();
                $campania -> setCedulaCreadorCamp($encontrado['cedula_creador_camp']);
                $campania -> setNombre($encontrado['nombre']);
                $campania -> setDescripcion($encontrado['descripcion']);
                $campania -> setVoluntariosRequeridos($encontrado['voluntarios_requeridos']);
                $campania -> setFechaHoraCulminacion($encontrado['fecha_hora_culminacion']);
                $campania -> setTerminada($encontrado['terminada']);
                $resultados = $campania;
            }
            return $resultados;
        }catch(Exception $ex){
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
            $error = "Hubo un error al conseguir las etiquetas.\n" . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }
}
