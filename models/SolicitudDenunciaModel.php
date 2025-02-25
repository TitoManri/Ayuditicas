<?php
require_once '../config/Conexion.php';

class SolicitudDenuncia extends Conexion
{

    //variable para usar la conexión
    protected static $cnx;

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- 
        VARIABLES SOLICITUD DENUNCIA
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    private $idDenuncia = null;
    private $tipoDenuncia = null;
    private $detalle = null;
    private $img = null;
    private $latitud = null;
    private $longitud = null;
    private $fechaHoraEnvio = null;
    private $fechaHoraConfirmacion = null;
    private $confirmacion = null;

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- 
        GETTERS
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    public function getIdDenuncia()
    {
        return $this->idDenuncia;
    }
    public function getTipoDenuncia()
    {
        return $this->tipoDenuncia;
    }
    public function getDetalle()
    {
        return $this->detalle;
    }
    public function getImg()
    {
        return $this->img;
    }
    public function getLatitud()
    {
        return $this->latitud;
    }
    public function getLongitud()
    {
        return $this->longitud;
    }
    public function getFechaHoraEnvio()
    {
        return $this->fechaHoraEnvio;
    }
    public function getFechaHoraConfirmacion()
    {
        return $this->fechaHoraConfirmacion;
    }
    public function getConfirmacion()
    {
        return $this->confirmacion;
    }


    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- 
        SETTERS
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    public function setIdDenuncia($idDenuncia)
    {
        $this->idDenuncia = $idDenuncia;
    }
    public function setTipoDenuncia($tipoDenuncia)
    {
        $this->tipoDenuncia = $tipoDenuncia;
    }
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }
    public function setImg($img)
    {
        $this->img = $img;
    }
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }
    public function setFechaHoraEnvio($fechaHoraEnvio)
    {
        $this->fechaHoraEnvio = $fechaHoraEnvio;
    }
    public function setFechaHoraConfirmacion($fechaHoraConfirmacion)
    {
        $this->fechaHoraConfirmacion = $fechaHoraConfirmacion;
    }
    public function setConfirmacion($confirmacion)
    {
        $this->confirmacion = $confirmacion;
    }

    //CONSTRUCTOR
    public function __construct()
    {

    }

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.- 
        FUNCIONES
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    //para conectar
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    //para desconectar
    public static function desconectar()
    {
        self::$cnx = null;
    }

    //CREAR UNA DENUNCIA
    public function crearSoliDenuncia()
    {
        $query = "INSERT INTO `solicitud_denuncias`(`tipo_denuncia`, `detalle`, `img`, `latitud`, `longitud`, `fecha_hora_envio`, `fecha_hora_confirmacion`, `confirmacion`) 
        VALUES (:tipoDenunciaPDO, :detallePDO, :imgPDO, :latitudPDO, :longitudPDO, :fechaHoraEnvioPDO, :fechaHoraConfirmacionPDO, :confirmacionPDO)";

        try {
            //conectarse
            self::getConexion();
            //obtener datos
            $tipoDenuncia = $this->getTipoDenuncia();
            $detalle = $this->getDetalle();
            $img = $this->getImg();
            $latitud = $this->getLatitud();
            $longitud = $this->getLongitud();
            $fechaHoraEnvio = $this->getFechaHoraEnvio();
            $fechaHoraConfirmacion = $this->getFechaHoraConfirmacion();
            $confirmacion = $this->getConfirmacion();
            //preparar el query
            $resultado = self::$cnx->prepare($query);
            //reemplazar el parámetro 
            $resultado->bindParam(":tipoDenunciaPDO", $tipoDenuncia, PDO::PARAM_STR);
            $resultado->bindParam(":detallePDO", $detalle, PDO::PARAM_STR);
            $resultado->bindParam(":imgPDO", $img, PDO::PARAM_STR);
            $resultado->bindParam(":latitudPDO", $latitud, PDO::PARAM_STR);
            $resultado->bindParam(":longitudPDO", $longitud, PDO::PARAM_STR);
            $resultado->bindParam(":fechaHoraEnvioPDO", $fechaHoraEnvio, PDO::PARAM_STR);
            $resultado->bindParam(":fechaHoraConfirmacionPDO", $fechaHoraConfirmacion, PDO::PARAM_STR);
            $resultado->bindParam(":confirmacionPDO", $confirmacion, PDO::PARAM_STR);
            //para correr el query
            $resultado->execute();
            //desconectar después de hacer la consulta
            self::desconectar();
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode(["error" => $error]);
        }
    }

    //VER DENUNCIA ESPECÍFICA
    public function verSolicitudDenunciaEspec($idDenuncia)
    {
        $query = "SELECT * FROM `solicitud_denuncias` WHERE id_denuncia = :idDenuncia";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idDenuncia", $idDenuncia, PDO::PARAM_INT);
            $resultado->execute();

            $denEspec = $resultado->fetch();
            self::desconectar();

            if ($denEspec) {
                $denuncia = new SolicitudDenuncia();
                $denuncia->setIdDenuncia($denEspec['id_denuncia']);
                $denuncia->setTipoDenuncia($denEspec['tipo_denuncia']);
                $denuncia->setDetalle($denEspec['detalle']);
                $denuncia->setImg($denEspec['img']);
                $denuncia->setLatitud($denEspec['latitud']);
                $denuncia->setLongitud($denEspec['longitud']);
                $denuncia->setFechaHoraEnvio($denEspec['fecha_hora_envio']);
                $denuncia->setFechaHoraConfirmacion($denEspec['fecha_hora_confirmacion']);
                $denuncia->setConfirmacion($denEspec['confirmacion']);
                return $denuncia;
            }
            return null;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }


    //"ELIMINAR DENUNCIA" (INACTIVAR)
    public function rechazarSolicitudDenuncia()
    {
        $id = $this->getIdDenuncia();
        $query = "UPDATE `solicitud_denuncias` SET `fecha_hora_confirmacion`=NOW(), `confirmacion`='Rechazada' WHERE `id_denuncia`=:idDenuncia";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idDenuncia", $id, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    //VER TODAS LAS DENUNCIAS 
    public function verDenuncias()
    {
        $query = "SELECT * FROM `solicitud_denuncias` WHERE confirmacion != 'Rechazada'";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $soliDen = new SolicitudDenuncia();
                $soliDen->setIdDenuncia($encontrado['id_denuncia']);
                $soliDen->setTipoDenuncia($encontrado['tipo_denuncia']);
                $soliDen->setDetalle($encontrado['detalle']);
                $soliDen->setImg($encontrado['img']);
                $soliDen->setLatitud($encontrado['latitud']);
                $soliDen->setLongitud($encontrado['longitud']);
                $soliDen->setFechaHoraEnvio($encontrado['fecha_hora_envio']);
                $soliDen->setFechaHoraConfirmacion($encontrado['fecha_hora_confirmacion']);
                $soliDen->setConfirmacion($encontrado['confirmacion']);
                $arr[] = $soliDen;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }


    //ACEPTAR DENUNCIA (ACTIVAR)
    public function aceptarSolicitudDenuncia()
    {
        $id = $this->getIdDenuncia();
        $query = "UPDATE `solicitud_denuncias` SET `fecha_hora_confirmacion`=NOW(),`confirmacion`='Aceptada' WHERE `id_denuncia`= :idDenuncia";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idDenuncia", $id, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
}
?>