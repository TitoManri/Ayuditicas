<?php
//llamado del model
require_once '../models/SolicitudDenunciaModel.php';

//switch para manejar la opción
switch ($_GET["op"]) {
    case 'crearSoliDenuncia':
        //obtener datos del select y los demás datos de la denuncia
        $tipoDenuncia =filter_input(INPUT_POST, 'selectTipo', FILTER_SANITIZE_STRING);
        $detalle = isset($_POST["detalle"]) ? trim($_POST["detalle"]) : "";
        $img = $_FILES["imgDen"];

        //llamada a la función de guardar imagen y validación de guardado
        $imgArr = guardarFotoNombre($img);
        if ($imgArr['exito'] == 1) {
            $imgDir = $imgArr['contenido'];
        } else {
            echo json_encode($imgArr);
            return;
        }

        //asignación de los valores 
        $latitud = isset($_POST["latitud"]) ? trim($_POST["latitud"]) : "34.052235";
        $longitud = isset($_POST["longitud"]) ? trim($_POST["longitud"]) : "-118.243683";
        $fechaHoraEnvio = date("Y-m-d H:i:s");
        $fechaHoraConfirmacion = '0000-00-00 00:00:00';
        $confirmacion = 'Pendiente';

        //creación de objeto denuncia
        $soliDen = new SolicitudDenuncia();

        //Asignación de valores 
        $soliDen->setTipoDenuncia($tipoDenuncia);
        $soliDen->setDetalle($detalle);
        $soliDen->setImg($imgDir);
        $soliDen->setLatitud($latitud);
        $soliDen->setLongitud($longitud);
        $soliDen->setFechaHoraEnvio($fechaHoraEnvio);
        $soliDen->setFechaHoraConfirmacion($fechaHoraConfirmacion);
        $soliDen->setConfirmacion($confirmacion);

        //creación de la denuncia
        $soliDen->crearSoliDenuncia();
        break;
    case 'verSolicitudDenunciaEspec':
        //se obtiene el id de la denuncia específica
        $idDenuncia = isset($_POST["idDenunciaEsp"]) ? $_POST["idDenunciaEsp"] : "";
        //creación del objeto
        $denuncia = new SolicitudDenuncia();
        //asignación de valores
        $denuncia->setIdDenuncia($idDenuncia);
        //busqueda la denuncia
        $encontrado = $denuncia->verSolicitudDenunciaEspec($idDenuncia);
        if ($encontrado != null) {
            //guardado en arreglo d los datos
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
        //creación del objeto
        $denuncia = new SolicitudDenuncia();
        //llamado del método para ver las reservas
        $soliDen = $denuncia->verDenuncias();
        //arreglo que guarda los resultados
        $data = array();
        foreach ($soliDen as $reg) {
            //arreglo
            $data[] = array(
                //si la confimación es aceptada redirecciona a ver detalle, sino se manda a confirmar denuncia
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
        //se envían a la tabla los datos
        $resultados = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;
    case 'rechazarSolicitudDenuncia':
        //creación de obejto, llamado del método y búsqueda por denuncia
        $ul = new SolicitudDenuncia();
        $ul->setIdDenuncia(trim($_POST['idDenunciaR']));
        $rspta = $ul->rechazarSolicitudDenuncia();
        echo $rspta;
        break;
    case 'aceptarSolicitudDenuncia':
        //creación de obejto, llamado del método y búsqueda por denuncia
        $ul = new SolicitudDenuncia();
        $ul->setIdDenuncia(trim($_POST['idDenunciaA']));
        $rspta = $ul->aceptarSolicitudDenuncia();
        echo $rspta;
        break;
}

function guardarFotoNombre($img){
    //obtención de los datos que devuleve el arreglo de la imagen
    $imgName = $img['name'];
    $imgTmp = $img['tmp_name'];
    $imgError = $img['error'];

    //se acorta el nombre a lo que hay después del punto
    $imgExt = explode('.', $imgName);
    //se pasa a minúscula 
    $imgActualExt = strtolower(end($imgExt));

    //arreglo de los formatos permitidos
    $permitir = array('jpg', 'jpeg', 'png');

    //si el tipo del archivo se permite 
    if (in_array($imgActualExt, $permitir)) {
        if ($imgError === 0) {
            //generación de id único con la hora de subida
            $imgNameNew = uniqid('', true) . "." . $imgActualExt;
            //asignación del destino
            $imgDestination = '../views/assets/img/' . $imgNameNew;
            //subida de la imagen a la carpeta
            move_uploaded_file($imgTmp, $imgDestination);
            //devolución de los datos
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