<?php

require_once '../config/Conexion.php';

class MensajeModel extends Conexion
{

    //variable para usar la conexión
    protected static $cnx;

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        VARIABLES MENSAJE
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    private $idMensaje = null;
    private $cedulaReminente = null;
    private $cedulaDestinatario = null;
    private $cuerpoMensaje = null;
    private $img = null;
    private $leido = null;
    private $fechaHoraEnvio = null;

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        GETTERS
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/

    public function getIdMensaje()
    {
        return $this->idMensaje;
    }
    public function getCedulaReminente()
    {
        return $this->cedulaReminente;
    }
    public function getCedulaDestinatario()
    {
        return $this->cedulaDestinatario;
    }
    public function getCuerpoMensaje()
    {
        return $this->cuerpoMensaje;
    }
    public function getImg()
    {
        return $this->img;
    }
    public function getLeido()
    {
        return $this->leido;
    }
    public function getFechaHoraEnvio()
    {
        return $this->fechaHoraEnvio;
    }

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        SETTERS
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    public function setIdMensaje($idMensaje)
    {
        $this->idMensaje = $idMensaje;
    }
    public function setCedulaReminente($cedulaReminente)
    {
        $this->cedulaReminente = $cedulaReminente;
    }
    public function setCedulaDestinatario($cedulaDestinatario)
    {
        $this->cedulaDestinatario = $cedulaDestinatario;
    }
    public function setCuerpoMensaje($cuerpoMensaje)
    {
        $this->cuerpoMensaje = $cuerpoMensaje;
    }
    public function setImg($img)
    {
        $this->img = $img;
    }
    public function setLeido($leido)
    {
        $this->leido = $leido;
    }
    public function setFechaHoraEnvio($fechaHoraEnvio)
    {
        $this->fechaHoraEnvio = $fechaHoraEnvio;
    }

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        CONSTRUCTOR
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    public function __construct()
    {
    }

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        FUNCIONES
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/

    //para conectar
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar(); //pregunta por $cnx
    }

    //para desconectar
    public static function desconectar()
    {
        self::$cnx = null;
    }

    //CREATE
    public function createMensaje()
    {
        //método 2 (correcto)
        $query = "INSERT INTO `mensajes`(`id_mensaje`, `cedula_reminente`, `cedula_destinatario`, `cuerpo_mensaje`, `img`, `leido`, `fecha_hora_envio`) 
        VALUES (:id_mensajePDO, :cedula_reminentePDO, :cedula_destinatarioPDO, :cuerpo_mensajePDO, :imgPDO, :leidoPDO, :fecha_hora_envioPDO)";
        try {
            //conectarse
            self::getConexion();
            //obtener valores
            $idMensaje = $this->getIdMensaje();
            $cedulaReminente = $this->getCedulaReminente();
            $cedulaDestinatario = $this->getCedulaDestinatario();
            $cuerpoMensaje = $this->getCuerpoMensaje();
            $img = $this->getImg();
            $leido = $this->getLeido();
            $fechaHoraEnvio = $this->getFechaHoraEnvio();

            //preparar el query
            $resultado = self::$cnx->prepare($query);
            //reemplazar el parámetro 
            $resultado->bindParam(":id_mensajePDO", $idMensaje, PDO::PARAM_INT);
            $resultado->bindParam(":cedula_reminentePDO", $cedulaReminente, PDO::PARAM_INT);
            $resultado->bindParam(":cedula_destinatarioPDO", $cedulaDestinatario, PDO::PARAM_INT);
            $resultado->bindParam(":cuerpo_mensajePDO", $cuerpoMensaje, PDO::PARAM_STR);
            $resultado->bindParam(":imgPDO", $img, PDO::PARAM_STR);
            $resultado->bindParam(":leidoPDO", $leido, PDO::PARAM_INT);
            $resultado->bindParam(":fecha_hora_envioPDO", $fechaHoraEnvio, PDO::PARAM_STR);
            //para correr el query
            $resultado->execute();
            //desconectar después de hacer la consulta
            echo "exito";
            self::desconectar();
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }

    }

    //READ
    public function readMensajes()
    {
        $query = "SELECT * FROM `mensajes` 
                  WHERE cedula_reminente = :cedulaReminentePDO 
                     OR cedula_destinatario = :cedulaDestinatarioPDO 
                  ORDER BY fecha_hora_envio DESC";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $cedulaReminente = $this -> getCedulaReminente();
            $resultado->bindParam(':cedulaReminentePDO', $cedulaReminente, PDO::PARAM_INT);
            $cedulaDestinatario = $this -> getCedulaDestinatario();
            $resultado->bindParam(':cedulaDestinatarioPDO', $cedulaDestinatario, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $mensaje = new MensajeModel();
                $mensaje->setIdMensaje($encontrado['idMensaje']);
                $mensaje->setCedulaReminente($encontrado['cedulaReminente']);
                $mensaje->setCedulaDestinatario($encontrado['cedulaDestinatario']);
                $mensaje->setCuerpoMensaje($encontrado['cuerpoMensaje']);
                $mensaje->setImg($encontrado['img']);
                $mensaje->setLeido($encontrado['leido']);
                $mensaje->setFechaHoraEnvio($encontrado['fechaHoraEnvio']);
                $arr[] = $mensaje;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }

    //CAMBIAR LEÍDO
    public function updateLeido(){
        $idMensaje = $this->getIdMensaje();
            $query = "UPDATE `mensajes` SET `leido`=1 WHERE id_mensaje=:idMensaje";
           try {
             self::getConexion();
              $resultado = self::$cnx->prepare($query);
              $resultado->bindParam(":idMensaje",$idMensaje,PDO::PARAM_INT);
              self::$cnx->beginTransaction();
              $resultado->execute();
              self::$cnx->commit();
              self::desconectar();
              return $resultado->rowCount();
             } catch (PDOException $Exception) {
               self::$cnx->rollBack();
               self::desconectar();
               $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
               return $error;
             }
    }

}

?>