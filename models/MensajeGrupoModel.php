<?php
require_once '../config/Conexion.php';

class MensajeGrupoModel extends Conexion
{
    //variable para la conexión
    protected static $cnx;

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        VARIABLES MENSAJE GRUPO
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    private $idMensajeGrupo = null;
    private $cedula = null;
    private $idGrupo = null;
    private $contenido = null;
    private $img = null;
    private $fechaHoraEnvio = null;
    private $leido = null;

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        GETTERS
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    public function getIdMensajeGrupo()
    {
        return $this->idMensajeGrupo;
    }
    public function getCedula()
    {
        return $this->cedula;
    }
    public function getIdGrupo()
    {
        return $this->idGrupo;
    }
    public function getContenido()
    {
        return $this->contenido;
    }
    public function getImg()
    {
        return $this->img;
    }
    public function getFechaHoraEnvio()
    {
        return $this->fechaHoraEnvio;
    }
    public function getLeido()
    {
        return $this->leido;
    }

    /*-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
        SETTERS
    -.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-*/
    public function setIdMensajeGrupo($idMensajeGrupo)
    {
        $this->idMensajeGrupo = $idMensajeGrupo;
    }
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }
    public function setIdGrupo($idGrupo)
    {
        $this->idGrupo = $idGrupo;
    }
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }
    public function setImg($img)
    {
        $this->img = $img;
    }
    public function setFechaHoraEnvio($fechaHoraEnvio)
    {
        $this->fechaHoraEnvio = $fechaHoraEnvio;
    }
    public function setLeido($leido)
    {
        $this->leido = $leido;
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

    public function createMensaje()
    {
        //método 2 (correcto)
        $query = "INSERT INTO `mensajes_grupo`(`id_mensaje_grupo`, `cedula`, `id_grupo`, `contenido`, `img`, `fecha_hora_envio`, `leido`) 
        VALUES (:idMensajeGrupoPDO, :cedulaPDO, :idGrupoPDO, :contenidoPDO, :imgPDO, :fechaHoraEnvioPDO, :leidoPDO)";
        try {
            //conectarse
            self::getConexion();
            //obtener valores
            $idMensajeGrupo = $this->getIdMensajeGrupo();
            $cedula = $this->getCedula();
            $idGrupo = $this->getIdGrupo();
            $contenido = $this->getContenido();
            $img = $this->getImg();
            $fechaHoraEnvio = $this->getFechaHoraEnvio();
            $leido = $this->getLeido();

            //preparar el query
            $resultado = self::$cnx->prepare($query);
            //reemplazar el parámetro 
            $resultado->bindParam(":idMensajeGrupoPDO", $idMensajeGrupo, PDO::PARAM_INT);
            $resultado->bindParam(":cedulaPDO", $cedula, PDO::PARAM_INT);
            $resultado->bindParam(":idGrupoPDO", $idGrupo, PDO::PARAM_INT);
            $resultado->bindParam(":contenidoPDO", $contenido, PDO::PARAM_STR);
            $resultado->bindParam(":imgPDO", $img, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_hora_envioPDO", $fechaHoraEnvio, PDO::PARAM_STR);
            $resultado->bindParam(":leidoPDO", $leido, PDO::PARAM_INT);
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
        $query = "SELECT * FROM `mensajes_grupo` 
        WHERE cedula = :cedulaPDO 
        OR id_grupo = :id_grupoPDO 
        ORDER BY fecha_hora_envio DESC";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $cedula = $this -> getCedula();
            $resultado->bindParam(':cedulaPDO', $cedula, PDO::PARAM_INT);
            $idGrupo = $this -> getIdGrupo();
            $resultado->bindParam(':id_grupoPDO', $idGrupo, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $mensaje = new MensajeGrupoModel();
                $mensaje->setIdMensajeGrupo($encontrado['idMensajeGrupo']);
                $mensaje->setCedula($encontrado['cedula']);
                $mensaje->setIdGrupo($encontrado['idGrupo']);
                $mensaje->setContenido($encontrado['contenido']);
                $mensaje->setImg($encontrado['img']);
                $mensaje->setFechaHoraEnvio($encontrado['fechaHoraEnvio']);
                $mensaje->setLeido($encontrado['leido']);
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
        $idMensajeGrupo = $this->getIdMensajeGrupo();
            $query = "UPDATE `mensajes_grupo` SET `leido`=1 WHERE id_mensaje_grupo=:idMensajeGrupo";
           try {
             self::getConexion();
              $resultado = self::$cnx->prepare($query);
              $resultado->bindParam(":idMensajeGrupo",$idMensajeGrupo,PDO::PARAM_INT);
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