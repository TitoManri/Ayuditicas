<?php
require_once "../models/Publicaciones_etiquetas.php";
switch($_GET["op"]){
    case 'listar_posts_etiquetas':{
        $etiquetaPost = new Publicaciones_etiquetas();
        $etiquetas = $etiquetaPost->SelectEtiquetasPosts(1);
        $data = [];
        foreach($etiquetas as $reg){
            $data[] = array(
                "id_etiqueta" => $reg->getId_etiqueta(),
                "nombre" => $reg->getNombre(),
                "cantidad" => $reg->getCantidad()
            );
        }
        echo json_encode($data);
        break;
    }
}