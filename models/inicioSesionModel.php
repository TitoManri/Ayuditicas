<?php
require_once '../config/conexion.php';
class inicioSesionModel extends conexion {
    protected static $cnx; 
    private $nombreUsuario=null;
    private $contrasenia=null;
    private $cedula = null;
    private $nombre = null;
    private $primerApellido = null;
    private $segundoApellido = null;
    private $genero = null;
    private $fechaNacimiento = null;
    private $telefono = null;
    private $correo = null;
    private $numSeguidores = null;
    private $img = null;
    private $rol = null;

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }
    
    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    public function __construct() {
        
    }
    public function getCedula() { 
        return $this->cedula; 
    }
    public function setCedula($cedula) { 
        $this->cedula = $cedula; 
    }

    public function getNombre() { 
        return $this->nombre; 
    }
    public function setNombre($nombre) { 
        $this->nombre = $nombre; 
    }

    public function getPrimerApellido() { 
        return $this->primerApellido; 
    }
    public function setPrimerApellido($primerApellido) { 
        $this->primerApellido = $primerApellido; 
    }

    public function getSegundoApellido() { 
        return $this->segundoApellido; 
    }
    public function setSegundoApellido($segundoApellido) { 
        $this->segundoApellido = $segundoApellido; 
    }

    public function getGenero() { 
        return $this->genero; 
    }
    public function setGenero($genero) { 
        $this->genero = $genero; 
    }

    public function getFechaNacimiento() { 
        return $this->fechaNacimiento; 
    }
    public function setFechaNacimiento($fechaNacimiento) { 
        $this->fechaNacimiento = $fechaNacimiento; 
    }

    public function getTelefono() { 
        return $this->telefono; 
    }
    public function setTelefono($telefono) { 
        $this->telefono = $telefono; 
    }

    public function getCorreo() { 
        return $this->correo; 
    }
    public function setCorreo($correo) { 
        $this->correo = $correo; 
    }

    public function getNumSeguidores() { 
        return $this->numSeguidores; 
    }

    public function setNumSeguidores($numSeguidores) { 
        $this->numSeguidores = $numSeguidores; 
    }

    public function getImg() { 
        return $this->img; 
    }

    public function setImg($img) { 
        $this->img = $img; 
    }

    public function getRol() { 
        return $this->rol; 
    }

    public function setRol($rol) { 
        $this->rol = $rol; 
    }

    public static function getConexion() {
        self::$cnx = conexion::conectar();
    }

    public static function desconectar() {
        self::$cnx = null;
    }

    public function verificarExistenciaDb() {
        try {
            self::getConexion();
            if ($this->getNombreUsuario() && $this->getContrasenia()) {
                $query = "SELECT U.cedula, U.nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento, nombre_usuario, telefono, 
                                correo, num_seguidores, img, contrasena, R.nombre as nombre_rol
                          FROM usuarios U 
                          inner join usuario_roles UR 
                            on U.cedula = UR.cedula 
                          inner join roles R 
                            on UR.id_rol = R.id_rol
                          WHERE nombre_usuario = :nombreUsuario";

                $stmt = self::$cnx->prepare($query);
                $stmt->bindParam(':nombreUsuario', $this->nombreUsuario, PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($this->getContrasenia(), $usuario['contrasena'])) {
                        $this->setCedula($usuario['cedula']);
                        $this->setNombre($usuario['nombre']);
                        $this->setPrimerApellido($usuario['primer_apellido']);
                        $this->setSegundoApellido($usuario['segundo_apellido']);
                        $this->setGenero($usuario['genero']);
                        $this->setFechaNacimiento($usuario['fecha_nacimiento']);
                        $this->setTelefono($usuario['telefono']);
                        $this->setCorreo($usuario['correo']);
                        $this->setNumSeguidores($usuario['num_seguidores']);
                        $this->setImg($usuario['img']);
                        $this->setRol($usuario['nombre_rol']);
                        self::desconectar();
                        return array("exito" => true, "msg" => "Inicio de sesión exitoso");
                        
                    } else {
                        return array("exito" => false, "msg" => "Contraseña incorrecta");
                    }
                } else {
                    return array("exito" => false, "msg" => "Usuario no encontrado");
                }
            } else {
                return array("exito" => false, "msg" => "Nombre de usuario y contraseña son requeridos");
            }
            
        } catch (PDOException $e) {
            return array("exito" => false, "msg" => "Error al intentar iniciar sesión: " . $e->getMessage());
        }
    }
}
?>