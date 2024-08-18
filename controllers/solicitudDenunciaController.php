<?php
require_once '../models/SolicitudDenunciaModel.php';

switch ($_GET["op"]) {
    case 'crearSoliDenuncia':
        $tipoDenuncia =filter_input(INPUT_POST, 'selectTipo', FILTER_SANITIZE_STRING);
        $detalle = isset($_POST["detalle"]) ? trim($_POST["detalle"]) : "";
        $img = $_FILES["imgDen"];
        $imgArr = guardarFotoNombre($img);
        if ($imgArr['exito'] == 1) {
            $imgDir = $imgArr['contenido'];
        } else {
            echo json_encode($imgArr);
            return;
        }
        $latitud = isset($_POST["latitud"]) ? trim($_POST["latitud"]) : "34.052235";
        $longitud = isset($_POST["longitud"]) ? trim($_POST["longitud"]) : "-118.243683";
        $fechaHoraEnvio = date("Y-m-d H:i:s");
        $fechaHoraConfirmacion = '0000-00-00 00:00:00';
        $confirmacion = 'Pendiente';

        $soliDen = new SolicitudDenuncia();

        $soliDen->setTipoDenuncia($tipoDenuncia);
        $soliDen->setDetalle($detalle);
        $soliDen->setImg($imgDir);
        $soliDen->setLatitud($latitud);
        $soliDen->setLongitud($longitud);
        $soliDen->setFechaHoraEnvio($fechaHoraEnvio);
        $soliDen->setFechaHoraConfirmacion($fechaHoraConfirmacion);
        $soliDen->setConfirmacion($confirmacion);

        $soliDen->crearSoliDenuncia();
        break;
    case 'verSolicitudDenunciaEspec':
        $idDenuncia = isset($_POST["idDenunciaEsp"]) ? $_POST["idDenunciaEsp"] : "";
        $denuncia = new SolicitudDenuncia();
        $denuncia->setIdDenuncia($idDenuncia);
        $encontrado = $denuncia->verSolicitudDenunciaEspec($idDenuncia);
        if ($encontrado != null) {
            $datosDenuncia = Array();
            $datosDenuncia[] = [
                "idDenuncia" => $encontrado->getIdDenuncia(),
                "tipoDenuncia" => $encontrado->getTipoDenuncia(),
                "detalle" => $encontrado->getDetalle(),
                "img" => $encontrado->getImg(),
                "latitud" => $encontrado->getLatitud(),
                "longitud" => $encontrado->getLongitud(),
                "fechaHoraEnvio" => $encontrado->getFechaHoraEnvio(),
                "fechaHoraConfirmacion" => $encontrado->getFechaHoraConfirmacion(),
                "confirmacion" => $encontrado->getConfirmacion()
            ];
            echo json_encode($datosDenuncia);
        } else {
            echo json_encode(["error" => "No se encontró la denuncia"]);
        }
        break;
    case 'verDenuncias':
        $denuncia = new SolicitudDenuncia();
        $soliDen = $denuncia->verDenuncias();
        $data = array();
        foreach ($soliDen as $reg) {
            $data[] = array(
                //cambiar esto para que muestre la denuncia específica
                "0" => ($reg->getConfirmacion()=='Aceptada') ? "<form method='post' action='./detalleDenunciaA.php'>
                            <input type='hidden' id='idDenuncia' name='idDenuncia' value='" . $reg->getIdDenuncia() . "'>
                            <button type='submit' id='enviarIdDenuncia'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill'
                                    viewBox='0 0 16 16'>
                                    <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0' />
                                    <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7' />
                                </svg>
                            </button>
                        </form>" : "<form method='post' action='./confirmarDenunciaA.php'>
                            <input type='hidden' id='idDenuncia' name='idDenuncia' value='" . $reg->getIdDenuncia() . "'>
                            <button type='submit' id='enviarIdDenuncia'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill'
                                    viewBox='0 0 16 16'>
                                    <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0' />
                                    <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7' />
                                </svg>
                            </button>
                        </form>",
                "1" => $reg->getTipoDenuncia(),
                "2" => $reg->getLatitud(),
                "3" => $reg->getLongitud(),
                "4" => $reg->getConfirmacion()
            );
        }
        $resultados = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;
    case 'rechazarSolicitudDenuncia':
        $ul = new SolicitudDenuncia();
        $ul->setIdDenuncia(trim($_POST['idDenunciaR']));
        $rspta = $ul->rechazarSolicitudDenuncia();
        echo $rspta;
        break;
    case 'aceptarSolicitudDenuncia':
        $ul = new SolicitudDenuncia();
        $ul->setIdDenuncia(trim($_POST['idDenunciaA']));
        $rspta = $ul->aceptarSolicitudDenuncia();
        echo $rspta;
        break;
}

function guardarFotoNombre($img){
    $imgName = $img['name'];
    $imgTmp = $img['tmp_name'];
    $imgError = $img['error'];

    $imgExt = explode('.', $imgName);
    $imgActualExt = strtolower(end($imgExt));

    $permitir = array('jpg', 'jpeg', 'png');

    if (in_array($imgActualExt, $permitir)) {
        if ($imgError === 0) {
            //reemplazar por el id de la denuncia
            $imgNameNew = uniqid('', true) . "." . $imgActualExt;
            $imgDestination = '../views/assets/img/' . $imgNameNew;
            move_uploaded_file($imgTmp, $imgDestination);
            $datos= array("exito" => "1", "contenido" => "./assets/img/". $imgNameNew."");
            return $datos;
        } else {
            $datos= array("exito" => "0", "contenido" => "Hubo un error al cargar la imagen");
            return $datos;
        }
    } else {
        $datos= array("exito" => "0", "contenido" => "No se permite este tipo de archivo");
        return $datos;
    }
}

?>