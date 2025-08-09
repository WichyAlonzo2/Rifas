<?php
include 'app/conn.php';
include 'app/varGlobal.php';
include 'root.php';

// $compiler;
$compilerX = intval($compiler);
if ($compilerX === 1) {
    $stringCompiler = '';
    $stringCompilerRoot = 'sorteoActual';
    $promosCompiler = '';
    $compileCheckTick = '';
    $infoSorteoNombreCompiler = $infoSorteoNombre;
    $linkPSorteoX = $linkPSorteo;
} else if ($compilerX === 2) {
    $stringCompiler = '_two';
    $stringCompilerRoot = 'sorteoActual_two';
    $promosCompiler = '2';
    $compileCheckTick = '2';
    $infoSorteoNombreCompiler = $infoSorteoNombre2;
    $linkPSorteoX = $linkPSorteo2;
} else if ($compilerX === 3) {
    $stringCompiler = '_tree';
    $stringCompilerRoot = 'sorteoActual_tree';
    $promosCompiler = '3';
    $compileCheckTick = '3';
    $infoSorteoNombreCompiler = $infoSorteoNombre3;
    $linkPSorteoX = $linkPSorteo3;
}

// Archivos para notificaciones
$jsonNoti = 'app/noti.json';
$jsonContentNotifi = file_get_contents($jsonNoti);
$dataJsonNotifi = json_decode($jsonContentNotifi, true);

// Esto es para el precio
$jsonData = file_get_contents('app/root.json');
$data = json_decode($jsonData, true);

// Esto es para promociones
$jsonPromotions = file_get_contents('app/promotions' . $promosCompiler . '.json');
$promotions = json_decode($jsonPromotions, true);

// Logica para referencias
$ref = isset($_GET['r']) ? $_GET['r'] : null;
$referido = '';
function generateUUID()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

// 7200 de segundos a minutos = 2 Horas
$uuid = isset($_COOKIE['uuid']) ? $_COOKIE['uuid'] : null;
if ($uuid === null || time() - $_COOKIE['timestamp'] >= 7200) {
    $uuid = generateUUID();
    setcookie('uuid', $uuid, time() + 7200, '/');
    setcookie('timestamp', time(), time() + 7200, '/');

    if ($ref !== null) {
        $referido = $ref;
        $jsonFile = 'app/ref' . $stringCompiler . '.json';
        $jsonContent = file_get_contents($jsonFile);
        $referidos = json_decode($jsonContent, true);
        if (isset($referidos['referidos']['users'][$ref])) {
            $referidos['referidos']['users'][$ref]++;
            file_put_contents($jsonFile, json_encode($referidos, JSON_PRETTY_PRINT));
            $puntos = $referidos['referidos']['users'][$ref];
            // echo "Referido: $ref, Puntos: $puntos";

        } else {
            // echo "El referido '$ref' no fue encontrado";

        }
    } else {
        $referido = '';
    }
}

// echo $referido;
// Logica para Validar Referido
$jsonFileRefe = 'app/ref' . $stringCompiler . '.json';
$jsonDataRefe = json_decode(file_get_contents($jsonFileRefe), true);
$refDb = '';
if ($ref && isset($jsonDataRefe['referidos']['users'][$ref])) {
    $refDb = $ref;

} else {
    $refDb = '';

}


// echo $ref . '<br>';
// echo $uuid;
// Termina logica 

session_start();
error_reporting(0);
$sqlQueryComentarios  = ('SELECT statusBoleto FROM info_boletos' . $stringCompiler . '');
$resultComentarios    = mysqli_query($db, $sqlQueryComentarios);
$total_registro       = mysqli_num_rows($resultComentarios);

$sqlQueryComentariosX  = ('SELECT id, boleto, opp, statusBoleto FROM info_boletos' . $stringCompiler . ' WHERE statusBoleto="No"');
$resultComentariosX    = mysqli_query($db, $sqlQueryComentariosX);
$total_registroX       = mysqli_num_rows($resultComentariosX);

if (isset($_SESSION['whatsApp'])) {
} else {
    $query = "SELECT *
                    FROM (
                        SELECT *
                        FROM $ajustes
                        WHERE idWhatsApp = 1 
                        ORDER BY
                            rand()
                        LIMIT 1
                        ) q
                    ORDER BY id ASC";

    $result_tasks = mysqli_query($db, $query);
    while ($registroBoleto = $result_tasks->fetch_array(MYSQLI_BOTH)) {
        $whatsAppx = $registroBoleto['globalSer'];
    }
    $_SESSION['whatsApp'] = $whatsAppx;
}

date_default_timezone_set("America/Mexico_City");
$fechaClick = date('Y-m-d H:i:s');
$permitted_chars = '0123456789QWERTYUIOPASDFGHJKLZXCVBNM';
$randomLetras = substr(str_shuffle($permitted_chars), 0, 9);

if (isset($_POST['buy'])) {
    $boletosPay = ($_POST['w7qr']); // Boletos Pay
    $boletosPaySort = ($_POST['bltsPay']); // Boletos Pay
    $countBoletosArrayXD = count($boletosPay); // Boletos Pay
    $arrayBoletosPre = array(); // Boletos Pay
    $arrayErrr = array(); // Boletos Pay

    // Boletos Pay
    foreach ($boletosPay as $key => $value) {
        $query = "SELECT id, boleto, opp, statusBoleto FROM `info_boletos$stringCompiler` WHERE boleto=$value;";
        $result_tasks = mysqli_query($db, $query);
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)) {
            $flp = $global['statusBoleto'];
            $boletoArray = $global['boleto'];
            array_push($arrayBoletosPre, $value . ' ' . $flp);

            if ($flp === 'Apartado') {
                array_push($arrayErrr, $boletoArray);
            }
        }
    }
    $arrayBoletosPre = array_unique($arrayBoletosPre);
    $str = "/" . implode("/", $arrayBoletosPre) . "/";

    
    // echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx ' . $str;
    $count = substr_count($str, 'No');

    // Condicionante para el Tamaño de boletos a registrar  
    $countBolPre = count($arrayBoletosPre);
    if ($countBolPre > 90) {
        echo "<script>alert('Solo puedes apartar 2 boletos');</script>";

    } else {
        if ($countBoletosArrayXD === $count) {
            foreach ($_POST['w7qr'] as $ids) {
                $nameCliente = mysqli_real_escape_string($db, $_POST['name']);

                // Nombre cliente sin espacios
                $clienteSpace = ltrim($nameCliente);
                $ClienteFinal = rtrim($clienteSpace);

                // Datos Cliente
                $numCliente = mysqli_real_escape_string($db, $_POST['phone']);
                $stateCliente = mysqli_real_escape_string($db, $_POST['state']);

                if ($stateCliente === 'Estados unidos') {
                    $numComplet = '1' . $numCliente;
                } else {
                    $numComplet = "52" . $numCliente;
                }

                $nameRegEx = str_replace(' ', '', $nameCliente);
                $nameUniqueFiltro = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $nameRegEx);
                $nameUnique = substr($nameUniqueFiltro, 0, 8);
                $stateRegEx = str_replace(' ', '', $stateCliente);
                $stateUnique = substr($stateRegEx, 0, 3);
                $fechaRegEx = str_replace('-', '', $fechaClick);
                $fechaUnique = substr($fechaRegEx, 0, 3);

                $idUniqueSql = 'SORT-' . $nameUnique . '-' . $randomLetras;
                $uppx = strtoupper($idUniqueSql);
                $contBoletos = count($boletosPay, true);
                $mnsBoleto = '';
                if ($contBoletos < 1) {
                    $mnsBoleto = '☘️ ' . $contBoletos . ' Boleto ☘️';
                } else {
                    $mnsBoleto = '☘️ ' . $contBoletos . ' Boletos ☘️';
                }

                // Logica para las PROMOS
                $payCountBol = '';
                $jsonPromotions = file_get_contents('app/promotions' . $promosCompiler . '.json');
                $promotions = json_decode($jsonPromotions, true);

                if (array_key_exists($contBoletos, $promotions)) {
                    $payCountBol = $promotions[$contBoletos];
                } else {
                    $infoSorteoPrecio = floatval($data[$stringCompilerRoot]['precio']); // Convertir a float
                    $payCountBol = $contBoletos * $infoSorteoPrecio;
                }

                // Subir los datos a la base de datos
                $actualizar = $db->query("
                                            UPDATE info_boletos$stringCompiler
                                            SET 
                                                folio = '$uppx',
                                                refe = '$refDb',
                                                cant = '$contBoletos',
                                                nombre='$ClienteFinal',
                                                numero='$numComplet',
                                                estado='$stateCliente',
                                                pagos='$payCountBol',
                                                statusBoleto='$apartado',
                                                timeCompra='$fechaClick'
                                            WHERE 
                                                boleto='$ids'");
            }

            if ($actualizar === true) {
                sort($boletosPaySort);
                $jsonEncode = json_encode($boletosPaySort);
                $sinCorIz = str_replace('[', '', $jsonEncode);
                $sinCorDer = str_replace(']', '', $sinCorIz);
                $scap = str_replace(',', '', $sinCorDer);

                $ulRegEx = str_replace('"', '', $scap);
                $comBol = str_replace(' |', ', ', $ulRegEx);

                $boletosCompletos = trim($comBol);

                // Comprobar si el último carácter es un %0A
                if (substr($boletosCompletos, -3) === '%0A') {
                    $boletosCompletos = substr($boletosCompletos, 0, -3);
                }

                $contBoletos = count($boletosPaySort, true);
                $mnsBoleto = '';
                if ($contBoletos < 1) {
                    $mnsBoleto = '☘️ ' . $contBoletos . ' Boleto ☘️';
                } else {
                    $mnsBoleto = '☘️ ' . $contBoletos . ' Boletos ☘️';
                }

                // Logica para las PROMOS
                $payCountBol = '';
                if (array_key_exists($contBoletos, $promotions)) {
                    $payCountBol = $promotions[$contBoletos];
                } else {
                    $infoSorteoPrecio = floatval($data[$stringCompilerRoot]['precio']); // Convertir a float
                    $payCountBol = $contBoletos * $infoSorteoPrecio;
                }

                $sort = $db->query(
                    "INSERT 
                        INTO sorteomini$stringCompiler
                            (
                                folio,
                                refe,
                                cant,
                                boletoOpp,
                                nombre,
                                numero,
                                estado,
                                pagos,
                                statusBoleto,
                                timeCompra
                            ) 
                        VALUES 
                            (
                                '$uppx',
                                '$refDb',
                                '$contBoletos',
                                '$boletosCompletos',
                                '$ClienteFinal',
                                '$numComplet',
                                '$stateCliente',
                                '$payCountBol',
                                '$apartado',
                                '$fechaClick'
                            )"
                );

                $newDataNotifi = [
                    "nombre" => $ClienteFinal,
                    "estado" => $stateCliente,
                    "cant" => $contBoletos,
                    "boletos" => $boletosCompletos,
                ];


                $dataJsonNotifi[] = $newDataNotifi;
                if (count($dataJsonNotifi) >= 20) {
                    $dataJsonNotifi = array_slice($dataJsonNotifi, 500);
                }
                $jsonUpdated = json_encode($dataJsonNotifi, JSON_PRETTY_PRINT);
                file_put_contents($jsonNoti, $jsonUpdated);

                // Para subir el IDUnique
                $nameRegEx = str_replace(' ', '', $nameCliente);

                $nameUniqueFiltro = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $nameRegEx);

                $nameUnique = substr($nameUniqueFiltro, 0, 8);

                $stateRegEx = str_replace(' ', '', $stateCliente);
                $stateUnique = substr($stateRegEx, 0, 3);
                $fechaRegEx = str_replace('-', '', $fechaClick);
                $fechaUnique = substr($fechaRegEx, 0, 3);

                $idUniqueSqlx = 'STK-' . $nameUnique . '-' . $randomLetras;
                $upp = strtoupper($idUniqueSqlx);

                // Variables de mensaje
                $nombreX = '*' . $ClienteFinal . '*';
                $sorteoX = '*' . $infoSorteoNombreCompiler . '*';
                $pageX = '*' . $importanteNombreSorteo . '*';
                $cantidadX = '*' . $mnsBoleto . '*';
                $totalX = '*$' . $payCountBol . '*';
                $boletosX = '' . $comBol . '';
                $folioX = '*' . $upp . '*';
                $payX = '' . $urlPartner . '' . $linkPPago . '';
                $checX = '' . $urlPartner . '' . $linkPCheck . $compileCheckTick . '';
                $boletoDigital = '' . $urlPartner . '' . $linkPBoleto . '?mkultra' . $compileCheckTick . '=' . $upp;
                $inxX = '' . $urlPartner . $linkPSorteoX . '';

                // Mensaje completo que se va enviar
                $mnsTp = str_replace('</br>', '%0A', $mnsCompraBr); // Espacios
                $mnsIni = str_replace(' ', '%20', $mnsTp); // Espacios
                $mnsNombre = str_replace('$nombre', $nombreX, $mnsIni);
                $mnsSorteo = str_replace('$sorteo', $sorteoX, $mnsNombre);
                $mnsPage = str_replace('$page', $pageX, $mnsSorteo);
                $mnsCantidad = str_replace('$cantidad', $cantidadX, $mnsPage);
                $mnsTotal = str_replace('$total', $totalX, $mnsCantidad);
                $mnsBoletos = str_replace('$boletos', $boletosX, $mnsTotal);
                $mnsFolio = str_replace('$folio', $folioX, $mnsBoletos);
                $mnsPay = str_replace('$pay', $payX, $mnsFolio);
                $mnsChec = str_replace('$chec', $checX, $mnsPay);
                $mnsBoletoDigital = str_replace('$bolDi', $boletoDigital, $mnsChec);
                $mnsInx = str_replace('$inx', $inxX, $mnsBoletoDigital);

                $mnsWhatsApp = "https://api.whatsapp.com/send?phone=" . $_SESSION['whatsApp'] . "&text=" .  $mnsInx;
                header('Location:' . $mnsWhatsApp);
                die();
                // echo '<script language="javascript">window.location = `' . $mnsWhatsApp . '`;;</script>';


            } else {
                echo '<script language="javascript">alert(`No se ha registro tu compra, verifica si tienes Internet, si el problema sigue comunicate con' . $nombrePag . '`);</script>';
            }
        } else {
            // echo 'xxxxxxxxxxxxxxxxxx ' . $countBoletosArrayXD . " xxxxxxxxxxx " . $count;
            $countArrayBolets = count($arrayErrr);
            if ($countArrayBolets > 1) {
                $stBr = "Boletos " . implode(", ", $arrayErrr);
                echo '<script language="javascript">alert(`Ups! De ultimo momento alguien ya registro estos '

                    . $stBr . '
Escoge otros para Registrarlos`);</script>';
            } else {
                $stBr = "Boleto " . implode(", ", $arrayErrr);
                echo '<script language="javascript">alert(`Ups! De ultimo momento alguien ya registro este '

                    . $stBr . '
Escoge otro para Registrar`);</script>';
            }
        }
    }
}
