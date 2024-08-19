<?php
require_once  '../config/conexion.php';
class perfilModel extends conexion {
    protected static $cnx;

    private $nombrePersona=null;
    private $primerApellido=null;
    private $segundoApellido=null;
    private $genero=null;
    private $fechaNacimiento=null;
    private $correo=null;
    private $cedula=null;
    private $telefono=null;
    private $nombreUsuario=null;
    private $contrasenia=null;
    private $img=null;
    private $fechaUnion=null;

    public function getNombrePersona() {
        return $this->nombrePersona;
    }

    public function getPrimerApellido() {
        return $this->primerApellido;
    }

    public function getSegundoApellido() {
        return $this->segundoApellido;
    }
    
    public function getGenero() {
        return $this->genero;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function getImg() {
        return $this->img;
    }

    public function getFechaUnion() {
        return $this->fechaUnion;
    }

    public function setNombrePersona($NombrePersona) {
        $this->nombrePersona = $NombrePersona;
    }

    public function setPrimerApellido($PrimerApellido) {
        $this->primerApellido = $PrimerApellido;
    }

    public function setSegundoApellido($SegundoApellido) {
        $this->segundoApellido = $SegundoApellido;
    }

    public function setGenero($Genero) {
        $this->genero = $Genero;
    }

    public function setFechaNacimiento($FechaNacimiento) {
        $this->fechaNacimiento = $FechaNacimiento;
    }

    public function setCorreo($Correo) {
        $this->correo = $Correo;
    }

    public function setCedula($Cedula) {
        $this->cedula = $Cedula;
    }

    public function setTelefono($Telefono) {
        $this->telefono = $Telefono;
    }

    public function setNombreUsuario($NombreUsuario) {
        $this->nombreUsuario = $NombreUsuario;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    public function setImg($img) {
        $this->img = $img;
    }

    public function setFechaUnion($FechaUnion) {
        $this->fechaUnion = $FechaUnion;
    }

    public function __construct() {
        
    }

    public static function getConexion() {
        self::$cnx = conexion::conectar();
    }

    public static function desconectar() {
        self::$cnx = null;
    }

    public function mostrarPerfil($Cedula){
        $query = "SELECT * FROM `usuarios` WHERE `cedula`=:cedulaPDO";

        try {
            self::getConexion();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedulaPDO", $Cedula, PDO::PARAM_INT);
            $resultado->execute();

            $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC); 
            
            return json_encode($usuarios);
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }
    public function actualizarPerfil() {
        try {
            self::getConexion();
            $querySelect = "SELECT nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento, nombre_usuario, telefono, correo, contrasena, img FROM `usuarios` WHERE `cedula` = :cedulaPDO";
            $stmtSelect = self::$cnx->prepare($querySelect);
            $cedulaPDO = $this->getCedula();
            $stmtSelect->bindParam(":cedulaPDO", $cedulaPDO);
            $stmtSelect->execute();
            
            $valoresViejos = $stmtSelect->fetch(PDO::FETCH_ASSOC);
            if ($valoresViejos === false) {
                self::desconectar();
                return json_encode(["exitoFormulario" => false, "message" => "Error al obtener los valores actuales del usuario."]);
            }
    
            $imgPDO = $valoresViejos['img'];
    
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../views/assets/img_app/usuarios/';
                $fileTmpPath = $_FILES['img']['tmp_name'];
                $fileName = $_FILES['img']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
    
                if (in_array($fileExtension, $allowedExts)) {
                    $uniqueId = uniqid();
                    $newFileName = $uniqueId . '.' . $fileExtension;
                    $destPath = $uploadDir . $newFileName;
    
                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $imgPDO = $newFileName; 
                    } else {
                        return json_encode(["exitoFormulario" => false, "message" => "Error al mover la imagen subida."]);
                    }
                } else {
                    return json_encode(["exitoFormulario" => false, "message" => "Extensión de archivo no permitida. Solo se permiten JPG, JPEG, PNG y GIF."]);
                }
            } else if (isset($_FILES['img']) && $_FILES['img']['error'] !== UPLOAD_ERR_NO_FILE) {
                return json_encode(["exitoFormulario" => false, "message" => "Error al subir la imagen."]);
            }
    
            // Validar campos
            $nombrePersonaPDO = $this->getNombrePersona() ?: $valoresViejos['nombre'];
            $primerApellidoPDO = $this->getPrimerApellido() ?: $valoresViejos['primer_apellido'];
            $segundoApellidoPDO = $this->getSegundoApellido() ?: $valoresViejos['segundo_apellido'];
            $generoPDO = $this->getGenero() ?: $valoresViejos['genero'];
            $fechaNacimientoPDO = $this->getFechaNacimiento() ?: $valoresViejos['fecha_nacimiento'];
            $nombreUsuarioPDO = $this->getNombreUsuario() ?: $valoresViejos['nombre_usuario'];
            $telefonoPDO = $this->getTelefono() ?: $valoresViejos['telefono'];
            $correoPDO = $this->getCorreo() ?: $valoresViejos['correo'];
            $contrasenaPDO = $this->getContrasenia() ?: $valoresViejos['contrasena'];
    
            // Actualizar en la base de datos
            $queryUpdate = "UPDATE `usuarios` SET 
                            `nombre`= :nombrePersonaPDO,
                            `primer_apellido`= :primerApellidoPDO,
                            `segundo_apellido`= :segundoApellidoPDO,
                            `genero`= :generoPDO,
                            `fecha_nacimiento`= :fechaNacimientoPDO,
                            `nombre_usuario`= :nombreUsuarioPDO,
                            `telefono`= :telefonoPDO,
                            `correo`= :correoPDO,
                            `contrasena`= :contrasenaPDO,
                            `img`= :imgPDO
                            WHERE `cedula`= :cedulaPDO";
    
            $usuUpdate = self::$cnx->prepare($queryUpdate);
    
            $usuUpdate->bindParam(":nombrePersonaPDO", $nombrePersonaPDO);
            $usuUpdate->bindParam(":primerApellidoPDO", $primerApellidoPDO);
            $usuUpdate->bindParam(":segundoApellidoPDO", $segundoApellidoPDO);
            $usuUpdate->bindParam(":generoPDO", $generoPDO);
            $usuUpdate->bindParam(":fechaNacimientoPDO", $fechaNacimientoPDO);
            $usuUpdate->bindParam(":nombreUsuarioPDO", $nombreUsuarioPDO);
            $usuUpdate->bindParam(":telefonoPDO", $telefonoPDO);
            $usuUpdate->bindParam(":correoPDO", $correoPDO);
            $usuUpdate->bindParam(":contrasenaPDO", $contrasenaPDO);
            $usuUpdate->bindParam(":imgPDO", $imgPDO);
            $usuUpdate->bindParam(":cedulaPDO", $cedulaPDO);
    
            if ($usuUpdate->execute()) {
                $filasAfectadas = $usuUpdate->rowCount();
                if ($filasAfectadas > 0) {
                    self::desconectar();
                    return json_encode(["exitoFormulario" => true, "message" => "Perfil actualizado correctamente"]);
                } else {
                    self::desconectar();
                    return json_encode(["exitoFormulario" => false, "message" => "No se actualizó el perfil. Verifica si los datos son correctos."]);
                }
            } else {
                self::desconectar();
                return json_encode(["exitoFormulario" => false, "message" => "Error en la actualización del perfil."]);
            }
        } catch (PDOException $ex) {
            self::desconectar();
            return json_encode(["exitoFormulario" => false, "message" => "Error " . $ex->getCode() . ": " . $ex->getMessage()]);
        }
    }
    
    
    
    
}
?>