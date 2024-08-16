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
    private $cedulaRemitente = null;
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
    public function getCedulaRemitente()
    {
        return $this->cedulaRemitente;
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
    public function setCedulaRemitente($cedulaRemitente)
    {
        $this->cedulaRemitente = $cedulaRemitente;
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
    public function enviarMensaje()
    {
        $query = "INSERT INTO `mensajes`(`cedula_remitente`, `cedula_destinatario`, `cuerpo_mensaje`, `img`, `leido`, `fecha_hora_envio`) 
              VALUES (:cedula_remitentePDO, :cedula_destinatarioPDO, :cuerpo_mensajePDO, :imgPDO, 0, now())";
        try {
            self::getConexion();
            $cedulaRemitente = $this->getCedulaRemitente();
            $cedulaDestinatario = $this->getCedulaDestinatario();
            $cuerpoMensaje = $this->getCuerpoMensaje();
            $img = $this->getImg();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedula_remitentePDO", $cedulaRemitente, PDO::PARAM_INT);
            $resultado->bindParam(":cedula_destinatarioPDO", $cedulaDestinatario, PDO::PARAM_INT);
            $resultado->bindParam(":cuerpo_mensajePDO", $cuerpoMensaje, PDO::PARAM_STR);
            $resultado->bindParam(":imgPDO", $img, PDO::PARAM_STR);

            $resultado->execute();
            self::desconectar();
            return "exito";
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return $error;
        }
    }


    //READ
    public function mostrarMensajesChat($usuario1, $usuario2)
    {
        $query = "SELECT * FROM `mensajes` WHERE cedula_remitente = :usuario1PDO AND cedula_destinatario = :usuario2PDO 
    OR cedula_remitente = :usuario2PDO AND cedula_destinatario = :usuario1PDO ORDER BY fecha_hora_envio ASC";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(':usuario1PDO', $usuario1, PDO::PARAM_INT);
            $resultado->bindParam(':usuario2PDO', $usuario2, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();

            $resultados = $resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $encontrado) {
                $mensaje = new MensajeModel();
                $mensaje->setIdMensaje($encontrado['id_mensaje']);
                $mensaje->setCedulaRemitente($encontrado['cedula_remitente']);
                $mensaje->setCedulaDestinatario($encontrado['cedula_destinatario']);
                $mensaje->setCuerpoMensaje($encontrado['cuerpo_mensaje']);
                $mensaje->setImg($encontrado['img']);
                $mensaje->setLeido($encontrado['leido']);
                $mensaje->setFechaHoraEnvio($encontrado['fecha_hora_envio']);
                $arr[] = $mensaje;
            }
            return $arr;

        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }


    //CAMBIAR LEÍDO
    public function updateLeido()
    {
        $idMensaje = $this->getIdMensaje();
        $query = "UPDATE `mensajes` SET `leido`=1 WHERE id_mensaje=:idMensaje";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idMensaje", $idMensaje, PDO::PARAM_INT);
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

//$prueba = new MensajeModel();
//var_dump($prueba->mostrarMensajesChat(305590892,108070862));

?>