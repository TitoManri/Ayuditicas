<?php
require_once '../config/Conexion.php';

class PublicacionModel extends Conexion {

    protected static $cnx;

    private $idPublicacion;
    private $cedula;
    private $idCampania;
    private $img;
    private $titulo;
    private $numLike;
    private $descripcion;
    private $inscripcion;

    // Getters y Setters
    public function getIdPublicacion() {
        return $this->idPublicacion;
    }

    public function setIdPublicacion($idPublicacion) {
        $this->idPublicacion = $idPublicacion;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getIdCampania() {
        return $this->idCampania;
    }

    public function setIdCampania($idCampania) {
        $this->idCampania = $idCampania;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
    }

    public function getNumLike() {
        return $this->numLike;
    }

    public function setNumLike($numLike) {
        $this->numLike = $numLike;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function isInscripcion() {
        return $this->inscripcion;
    }

    public function setInscripcion($inscripcion) {
        $this->inscripcion = $inscripcion;
    }

    public function __construct(){}

    public static function getConexion(){ 
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar(){
        self::$cnx = null;
    }

    //Guardar datos publicaciones
    public function guardarDatosPublicacionRegular() {
        $query = "INSERT INTO `PUBLICACIONES` (`cedula`, `id_campania`, `img`, `titulo`, `num_like`, `descripcion`, `inscripcion`, `fecha_hora_creacion`) 
                  VALUES (:cedulaPDO, :id_campaniaPDO, :imgPDO, :tituloPDO, 0, :descripcionPDO, :inscripcionPDO, NOW())";
        
        try {
            self::getConexion();
            
            $cedulaPDO = $this->getCedula();
            $id_campaniaPDO = $this->getIdCampania();
            $imgPDO = $this->getImg();
            $tituloPDO = $this->getTitulo();
            $descripcionPDO = $this->getDescripcion();
            $inscripcionPDO = $this->isInscripcion();
            
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedulaPDO", $cedulaPDO, PDO::PARAM_INT);
            $resultado->bindParam(":id_campaniaPDO", $id_campaniaPDO, PDO::PARAM_INT);
            $resultado->bindParam(":imgPDO", $imgPDO, PDO::PARAM_STR);
            $resultado->bindParam(":tituloPDO", $tituloPDO, PDO::PARAM_STR);
            $resultado->bindParam(":descripcionPDO", $descripcionPDO, PDO::PARAM_STR);
            $resultado->bindParam(":inscripcionPDO", $inscripcionPDO, PDO::PARAM_BOOL);
            
            $resultado->execute();
            $idPublicacion = self::$cnx->lastInsertId();
            
            self::desconectar();
            return $idPublicacion;
        } catch (PDOException $ex) {
            self::desconectar();
            return json_encode(array("exitoFormulario" => false, "message" => "Error en la base de datos: " . $ex->getMessage()));
        }
    }
    

    //Mostrar publicaciones sin Campania
    public function mostrarPublicaciones($cedula) {
        $query = "SELECT p.id_publicacion, p.titulo, p.descripcion, p.img, p.num_like, u.nombre_usuario, 
                 (CASE WHEN l.cedula IS NOT NULL THEN 1 ELSE 0 END) AS tieneLike
          FROM publicaciones p
          LEFT JOIN likes l ON p.id_publicacion = l.id_publicacion AND l.cedula = :cedula
          JOIN usuarios u ON p.cedula = u.cedula
          WHERE p.id_campania IS NULL
          ORDER BY p.fecha_hora_creacion DESC";  

        
        try {
            self::getConexion();
            
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(':cedula', $cedula, PDO::PARAM_STR); // Enlaza el parámetro cedula
            $resultado->execute();
            
            $publicaciones = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
            self::desconectar();
            
            return json_encode($publicaciones);
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }
    
    
    //Mostrar publicaciones con campania especifica
    public function mostrarPublicacionesPorCampania($id_campania, $cedula) {
        $query = "SELECT p.id_publicacion, p.titulo, p.descripcion, p.img, p.num_like, u.nombre_usuario, 
                 (CASE WHEN l.cedula IS NOT NULL THEN 1 ELSE 0 END) AS tieneLike
            FROM publicaciones p
            LEFT JOIN likes l ON p.id_publicacion = l.id_publicacion AND l.cedula = :cedula
            JOIN usuarios u ON p.cedula = u.cedula
            WHERE `id_campania` = :id_campaniaPDO
            ORDER BY p.fecha_hora_creacion DESC";
        
        try {
            self::getConexion();
            
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_campaniaPDO", $id_campania, PDO::PARAM_INT);
            $resultado->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $resultado->execute();
            
            $publicaciones = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
            self::desconectar();
            
            return json_encode($publicaciones);
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }

    public function aumentarLike($id_publicacion, $cedula) {
        self::getConexion();
        $queryCheck = "SELECT * FROM LIKES WHERE id_publicacion = :id_publicacion AND cedula = :cedula";
        $stmtCheck = self::$cnx->prepare($queryCheck);
        $stmtCheck->bindParam(':id_publicacion', $id_publicacion, PDO::PARAM_INT);
        $stmtCheck->bindParam(':cedula', $cedula, PDO::PARAM_INT);
        $stmtCheck->execute();
    
        if ($stmtCheck->rowCount() == 0) {
            $queryInsert = "INSERT INTO LIKES (cedula, id_publicacion) VALUES (:cedula, :id_publicacion)";
            $stmtInsert = self::$cnx->prepare($queryInsert);
            $stmtInsert->bindParam(':cedula', $cedula, PDO::PARAM_INT);
            $stmtInsert->bindParam(':id_publicacion', $id_publicacion, PDO::PARAM_INT);
            $stmtInsert->execute();
        }
    
        $queryUpdate = "UPDATE PUBLICACIONES SET num_like = num_like + 1 WHERE id_publicacion = :id_publicacion";
        $stmtUpdate = self::$cnx->prepare($queryUpdate);
        $stmtUpdate->bindParam(':id_publicacion', $id_publicacion, PDO::PARAM_INT);
        $stmtUpdate->execute();
        self::desconectar();
        return json_encode(["success" => true, "message" => "Like incremented successfully"]);
    }
    
    public function reducirLike($id_publicacion, $cedula) {
        self::getConexion();
        $queryCheck = "SELECT * FROM LIKES WHERE id_publicacion = :id_publicacion AND cedula = :cedula";
        $stmtCheck = self::$cnx->prepare($queryCheck);
        $stmtCheck->bindParam(':id_publicacion', $id_publicacion, PDO::PARAM_INT);
        $stmtCheck->bindParam(':cedula', $cedula, PDO::PARAM_INT);
        $stmtCheck->execute();
    
        if ($stmtCheck->rowCount() > 0) {
            $queryDelete = "DELETE FROM LIKES WHERE id_publicacion = :id_publicacion AND cedula = :cedula";
            $stmtDelete = self::$cnx->prepare($queryDelete);
            $stmtDelete->bindParam(':id_publicacion', $id_publicacion, PDO::PARAM_INT);
            $stmtDelete->bindParam(':cedula', $cedula, PDO::PARAM_INT);
            $stmtDelete->execute();
    
            $queryUpdate = "UPDATE PUBLICACIONES SET num_like = num_like - 1 WHERE id_publicacion = :id_publicacion";
            $stmtUpdate = self::$cnx->prepare($queryUpdate);
            $stmtUpdate->bindParam(':id_publicacion', $id_publicacion, PDO::PARAM_INT);
            $stmtUpdate->execute();
        }
        self::desconectar();
        return json_encode(["success" => true, "message" => "Like decremented successfully"]);
    }
    
    
    public function verificarLike($id_publicacion, $cedula) {
        self::getConexion(); // Asegúrate de que la conexión esté establecida
    
        $query = "SELECT COUNT(*) FROM LIKES WHERE id_publicacion = :id_publicacion AND cedula = :cedula";
        $stmt = self::$cnx->prepare($query);
        $stmt->bindParam(':id_publicacion', $id_publicacion, PDO::PARAM_INT);
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
        $stmt->execute();
    
        $count = $stmt->fetchColumn();
        self::desconectar();
        // Devuelve true si el usuario ha dado "like", de lo contrario false
        return $count > 0;
    }
    public function actualizarImagen($idPublicacion, $nombreImagen) {
        $query = "UPDATE `PUBLICACIONES` SET `img` = :imgPDO WHERE `id_publicacion` = :id_publicacionPDO";
        
        try {
            self::getConexion();
            
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":imgPDO", $nombreImagen, PDO::PARAM_STR);
            $resultado->bindParam(":id_publicacionPDO", $idPublicacion, PDO::PARAM_INT);
            
            $resultado->execute();
            
            self::desconectar();
            return true;
        } catch (PDOException $ex) {
            self::desconectar();
            return false;
        }
    }
    public function obtenerPublicacion($id_publicacion) {
        $query = "SELECT p.id_publicacion, p.titulo, p.descripcion, p.img, p.num_like, p.fecha_hora_creacion, u.nombre_usuario
                  FROM publicaciones p
                  JOIN usuarios u ON p.cedula = u.cedula
                  WHERE p.id_publicacion = :id_publicacion";
    
        try {
            self::getConexion();
    
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_publicacion", $id_publicacion, PDO::PARAM_INT);
            $resultado->execute();
    
            $publicacion = $resultado->fetch(PDO::FETCH_ASSOC);
    
            self::desconectar();
    
            return json_encode($publicacion);
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode(array("exitoFormulario" => false, "message" => $error));
        }
    }

    public function conseguirUltimoID(){
        $query = "SELECT MAX(id_publicacion) as ID FROM publicaciones";
        try {
            self::getConexion();
    
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();  
            $fila = $resultado->fetch();  
            self::desconectar();
    
            return $fila['ID'];
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode(array("exitoFormulario" => false, "message" => $error));
        }
    }
    
    public function mostrarPublicacionesPorIds($IDS, $cedula)
    {
        $listaIds = implode(',', array_map('intval', $IDS));
            $query = "SELECT p.id_publicacion, p.titulo, p.descripcion, p.img, p.num_like, u.nombre_usuario, 
                         (CASE WHEN l.cedula IS NOT NULL THEN 1 ELSE 0 END) AS tieneLike
                  FROM publicaciones p
                  LEFT JOIN likes l ON p.id_publicacion = l.id_publicacion AND l.cedula = :cedula
                  RIGHT JOIN publicaciones_etiquetas e ON e.id_publicacion = p.id_publicacion
                  JOIN usuarios u ON p.cedula = u.cedula
                  WHERE e.id_publicacion IN ($listaIds)
                  ORDER BY p.fecha_hora_creacion DESC";  
    
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(':cedula', $cedula, PDO::PARAM_STR);
            $resultado->execute();
            $publicaciones = $resultado->fetchAll(PDO::FETCH_ASSOC);
            self::desconectar();
            return json_encode($publicaciones);
    
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }
    
}
?>
