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

    public function guardarDatosPublicacionRegular() {
        $query = "INSERT INTO `PUBLICACIONES` (`cedula`, `id_campania`, `img`, `titulo`, `num_like`, `descripcion`, `inscripcion`, `fecha_hora_creacion`) 
                  VALUES (:cedulaPDO, :id_campaniaPDO, :imgPDO, :tituloPDO, :num_likePDO, :descripcionPDO, :inscripcionPDO, NOW())";
        
        try {
            self::getConexion();
            
            $p_cedula = $this->getCedula();
            $p_id_campania = $this->getIdCampania();
            $p_img = $this->getImg();
            $p_titulo = $this->getTitulo();
            $p_num_like = $this->getNumLike();
            $p_descripcion = $this->getDescripcion();
            $p_inscripcion = $this->isInscripcion();
            
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedulaPDO", $p_cedula, PDO::PARAM_INT);
            $resultado->bindParam(":id_campaniaPDO", $p_id_campania, PDO::PARAM_INT);
            $resultado->bindParam(":imgPDO", $p_img, PDO::PARAM_STR);
            $resultado->bindParam(":tituloPDO", $p_titulo, PDO::PARAM_STR);
            $resultado->bindParam(":num_likePDO", $p_num_like, PDO::PARAM_INT);
            $resultado->bindParam(":descripcionPDO", $p_descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":inscripcionPDO", $p_inscripcion, PDO::PARAM_BOOL);
            
            $resultado->execute();
            
            self::desconectar();
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }  
}
?>
