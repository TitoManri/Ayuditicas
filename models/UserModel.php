<?php
require_once '../config/Conexion.php';

class UserModel extends Conexion
{
    //variable para usar la conexión
    protected static $cnx;

    //variables de usuario
    private $nombreUsuario = null;
    private $cedula = null;

    private $img = null;

    //getter
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getCedula()
    {
        return $this->cedula;
    }

    public function getImg()
    {
        return $this->img;
    }

    //setter
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    public function setImg($img)
    {
        $this->img = $img;
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

    //función para listar los contactos con los que el usuario ha tenido interacción
    public function listarContactos($cedulaUsuarioActual)
    {
        $query = "SELECT DISTINCT u.nombre_usuario, u.cedula, u.img 
        FROM mensajes m 
        JOIN usuarios u ON (u.cedula = m.cedula_remitente 
        AND m.cedula_remitente != :cedulaUsActualPDO) OR (u.cedula = m.cedula_destinatario AND m.cedula_destinatario != :cedulaUsActualPDO) 
        WHERE :cedulaUsActualPDO IN (m.cedula_remitente, m.cedula_destinatario) 
        ORDER BY m.fecha_hora_envio DESC";

        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedulaUsActualPDO", $cedulaUsuarioActual, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll() as $encontrado) {
                $contacto = new UserModel();
                $contacto->setCedula($encontrado["cedula"]);
                $contacto->setNombreUsuario($encontrado["nombre_usuario"]);
                $contacto->setImg($encontrado["img"]);
                $arr[] = $contacto;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    //MOSTRAR TODOS LOS CONTACTOS (todos los usuarios existentes)
    public function listasTodosUsuarios()
    {
        $query = "SELECT * FROM `usuarios`";

        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll() as $encontrado) {
                $contacto = new UserModel();
                $contacto->setCedula($encontrado["cedula"]);
                $contacto->setNombreUsuario($encontrado["nombre_usuario"]);
                $contacto->setImg($encontrado["img"]);
                $arr[] = $contacto;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }
}
?>