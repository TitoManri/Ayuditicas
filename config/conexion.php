<?php
require_once 'global.php';

class Conexion {
    function __construct() {}

    public static function conectar() {
        try {
            $cn = new PDO("mysql:host=".db_host.";dbname=".db_name.";charset=utf8", db_user, db_pass);
            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $cn;
        } catch (PDOException $ex) {
            die("Error en la conexión: " . $ex->getMessage());
        }
    }
}

//Descomentario esto para ver si tenemos una conexion exitosa
//Conexion::conectar();
?>
