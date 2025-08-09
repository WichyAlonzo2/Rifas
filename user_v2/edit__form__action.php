<?php

include $urlPartner . '/app/conn.php';
include $urlPartner . '/app/vConn.php';
include $urlPartner . '/root.php';
include $urlPartner . '/app/varGlobal.php';
include $urlPartner . '/sys.php';
include $urlPartner . '/includes/errr.php';
include $urlPartner . '/logica/whatsapp.php';

session_start();
$arrayPersonas = [];
$user = $_SESSION['user'];

if (!empty($_GET['nombre'])) {
  // Si hay ID


} else {
  header('Location: status');
}
date_default_timezone_set("America/Mexico_City");
$fechaPago = date('Y-m-d H:i:s');

$folio = $_GET['folio'];
$status = $_GET['status'];
$folioX = "*" . $folio . "*"; // Listo
if (isset($_GET['nombre'])) {
  $nombreX = $_GET['nombre'];
  $numeroX = $_GET['numero'];
  $numeroX = $_GET['numero'];
  $estadoX = $_GET['estado'];
  $statusX = $_GET['status'];
  $compraX = $_GET['compra'];
  $payX = $_GET['pay'];
  $formasPagoX = $_GET['formasPago'];
  $compiler = $_GET['compiler'];
  $compilerX = intval($compiler);
}

if ($compilerX === 1) {
  $stringCompiler = '';
  $compilerdb = '';
  $promosCompiler = '';
  $compileCheckTick = '';
  $infoSorteoNombreCompiler = $infoSorteoNombre;
  $linkPSorteoX = $linkPSorteo;
} else if ($compilerX === 2) {
  $stringCompiler = '_two';
  $compilerdb = '_two';
  $promosCompiler = '2';
  $compileCheckTick = '2';
  $infoSorteoNombreCompiler = $infoSorteoNombre2;
  $linkPSorteoX = $linkPSorteo2;
} else if ($compilerX === 3) {
  $stringCompiler = '_tree';
  $compilerdb = '_tree';
  $promosCompiler = '3';
  $compileCheckTick = '3';
  $infoSorteoNombreCompiler = $infoSorteoNombre3;
  $linkPSorteoX = $linkPSorteo3;
}


// Obtener nombres ya pasalos al
$sql = "SELECT nombre FROM sorteomini$compilerdb where folio ='$folio'";
$result = $db->query($sql);
if ($result) {
  while ($row = $result->fetch_assoc()) {
    $nombre = $row["nombre"];
    $arrayPersonas[] = $nombre;
  }
}




switch ($status) {
  case 'No':

    $query = "SELECT * FROM sorteomini$compilerdb WHERE folio='$folio'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result);
      $nombre = $row['nombre']; //Listo
      $numero = $row['numero']; //Listo
      $estado = $row['estado']; //Listo
      $boletoOpp = $row['boletoOpp']; //Listo
      $cant = $row['cant']; //Listo
      $status = $row['statusBoleto']; //Listo
      $pagos = $row['pagos']; //Listo
      $total = $row['total']; //Listo
      $pagado = $row['pagado']; //Listo
      $prontoPago = $row['prontoPago']; //Listo
      $timeCompra = $row['timeCompra']; //Listo
      $timePay = $row['timePay']; //Listo


      // Aqui es update
      $update = ("UPDATE `info_boletos$compilerdb` 
    SET 
        `refe`='',
        `cant`='',
        `user`='',
        `folio`='',
        `nombre`='',
        `numero`='',
        `estado`='',
        `statusBoleto`='No',
        `pagos`=0,
        `total`=0,
        `prontoPago`='',
        `pagado`='',
        `timeCompra`='',
        `timePay`=''
    WHERE folio='" . $folio . "'");

      $del2 = ("DELETE FROM `sorteomini$compilerdb`WHERE folio='" . $folio   . "'");


      // Aquie nos quedamos
      // Resolver las consultas y cambios de variables
      $nombreX = '*' . $nombre . '*'; // si
      $sorteoX = '*' . $infoSorteoNombreCompiler . '*'; // si
      $pageX = '*' . $importanteNombreSorteo . '*'; // si
      $cantidadX = '*' . $cant . '*'; // si
      $totalX = '*$' . $total . '*'; // si
      $boletosX = '' . $boletoOpp . ''; // si
      $folioX = '*' . $folio . '*'; // si
      $payX = '' . $urlPartner . '' . $linkPPago . ''; // soi
      $checX = '' . $urlPartner . '' . $linkPCheck . $compileCheckTick . '';
      $boletoDigital = '' . $urlPartner . '' . $linkPBoleto . '?mkultra' . $compileCheckTick . '=' . $folio;
      $inxX = '' . $urlPartner . $linkPSorteoX . '';

      // Mensaje completo que se va enviar
      $mnsTp = str_replace('</br>', '%0A', $mnsEliminarBr); // Espacios
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
      $mnsInx = str_replace('$inx', $inxX, $mnsChec);


      $resultdelBoletos = mysqli_query($db, $update);
      $resultdelInfo_Boletos = mysqli_query($db, $del2);

      if ($resultdelBoletos == true) {
        echo '
            <div id="snoAlertBox" class="alert alert-success" data-alert="alert">Se actualizo el Registro (DEL)</div>
            <script type="text/javascript">
            closeSnoAlertBox();
            function closeSnoAlertBox(){
            window.setTimeout(function () {
            $("#snoAlertBox").fadeOut(5000)
            // location.reload();

            }, 5000);
            } 

            window.open("https://api.whatsapp.com/send?phone=' . $numero . '&text=' . $mnsInx . '", "_blank");

            </script>';
      } else {
        echo 'No se elimino';
      }
    }



    break;

  case 'Apartado':
    $query = "SELECT * FROM sorteomini$compilerdb WHERE folio='$folio'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result);
      $verifi = $row['statusBoleto']; //Listo
      $boleto = $row['boletoOpp']; //Listo
      $nam = $row['nombre']; //Listo
      $numero = $row['numero']; //Listo
      $idCls = $row['id']; //Listo
      $pagos = $row['pagos']; //Listo
      $total = $row['total']; //Listo
      $totalSq = $row['total']; //Listo
      $cant = $row['cant']; //Listo


    }


    if (in_array($nam, $arrayPersonas)) {
      // echo 'Si esta dentro';
      if ($status === $verifi) {
        // echo 'Esta mandando el mismo Apartado 1';

        // 1er consulta
        $update = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `nombre`='$nombreX',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',
                            `typePay`='-',
                            `timeCompra`='$compraX',
                            `timePay`=''
                        WHERE folio = '" . $folio . "' AND nombre = '" . $nombreX . "'
                    ");

        $update2 = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',
                            `typePay`='-',
                            `timeCompra`='$compraX',
                            `timePay`=''
                        WHERE folio = '" . $folio . "' AND nombre != '" . $nombreX . "'
          ");

        //  Segunda consulta
        $updateDos = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `nombre`='$nombreX',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',
                                `typePay`='-',
                                `timeCompra`='$compraX',
                                `timePay`=''
                            WHERE folio = '" . $folio . "' AND nombre = '" . $nombreX . "'
                        ");

        $updateDos2 = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',
                                `typePay`='-',
                                `timeCompra`='$compraX',
                                `timePay`=''
                            WHERE folio = '" . $folio . "' AND nombre != '" . $nombreX . "'
                        ");
      } else {
        // echo 'Esta mandando diferente1';

        // 1er consulta
        $update = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',
                            `pagos`='$totalSq',
                            `total`='0',
                            `typePay`='-',
                            `timeCompra`='$compraX',
                            `timePay`=''
                        WHERE folio = '" . $folio . "'
                    ");

        $update2 = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',
                            `pagos`='$totalSq',
                            `total`='0',
                            `typePay`='-',
                            `timeCompra`='$compraX',
                            `timePay`=''
                        WHERE folio = '" . $folio . "'
          ");

        //  Segunda consulta
        $updateDos = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',
                                `pagos`='$totalSq',
                                `total`='0',
                                `typePay`='-',
                                `timeCompra`='$compraX',
                                `timePay`=''
                            WHERE folio = '" . $folio . "'
                        ");

        $updateDos2 = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',
                                `pagos`='$totalSq',
                                `total`='0',
                                `typePay`='-',
                                `timeCompra`='$compraX',
                                `timePay`=''
                            WHERE folio = '" . $folio . "'
                        ");
      }
    } else {
      // echo 'No esta dentro';
      if ($status === $verifi) {
        // echo 'Esta mandando el mismo Apartado 1';

        // 1er consulta
        $update = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',
                            `typePay`='-',
                            `timeCompra`='$compraX',
                            `timePay`=''
                        WHERE folio = '" . $folio . "' AND nombre = '" . $nombreX . "'
                    ");

        $update2 = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',
                            `typePay`='-',
                            `timeCompra`='$compraX',
                            `timePay`=''
                        WHERE folio = '" . $folio . "' AND nombre != '" . $nombreX . "'
          ");

        //  Segunda consulta
        $updateDos = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',
                                `typePay`='-',
                                `timeCompra`='$compraX',
                                `timePay`=''
                            WHERE folio = '" . $folio . "' AND nombre = '" . $nombreX . "'
                        ");

        $updateDos2 = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',
                                `typePay`='-',
                                `timeCompra`='$compraX',
                                `timePay`=''
                            WHERE folio = '" . $folio . "' AND nombre != '" . $nombreX . "'
                        ");
      } else {
        // echo 'Esta mandando diferente1';

        // 1er consulta
        $update = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',
                            `pagos`='$totalSq',
                            `total`='0',
                            `typePay`='-',
                            `timeCompra`='$compraX',
                            `timePay`=''
                        WHERE folio = '" . $folio . "'
                    ");

        $update2 = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',
                            `pagos`='$totalSq',
                            `total`='0',
                            `typePay`='-',
                            `timeCompra`='$compraX',
                            `timePay`=''
                        WHERE folio = '" . $folio . "'
          ");

        //  Segunda consulta
        $updateDos = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',
                                `pagos`='$totalSq',
                                `total`='0',
                                `typePay`='-',
                                `timeCompra`='$compraX',
                                `timePay`=''
                            WHERE folio = '" . $folio . "'
                        ");

        $updateDos2 = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',
                                `pagos`='$totalSq',
                                `total`='0',
                                `typePay`='-',
                                `timeCompra`='$compraX',
                                `timePay`=''
                            WHERE folio = '" . $folio . "'
                        ");
      }
    }




    $result_update = mysqli_query($db, $update);
    $result_update = mysqli_query($db, $update2);
    $result_update = mysqli_query($db, $updateDos);
    $result_update = mysqli_query($db, $updateDos2);

    if ($update == true) {
      echo '
                <div id="snoAlertBox" class="alert alert-success" data-alert="alert">Se actualizo el Registro (Apartado)</div>
                <script type="text/javascript">
                  closeSnoAlertBox();
                  function closeSnoAlertBox(){
                    window.setTimeout(function () {
                      $("#snoAlertBox").fadeOut(5000)
                      location.reload();

                    }, 5000);
                  } 

                </script>';
    } else {
      echo 'No se elimino';
    }

    break;

  case 'Pagado':
    $query = "SELECT * FROM sorteomini$compilerdb WHERE folio='$folio'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result);
      $verifi = $row['statusBoleto']; //Listo
      $boleto = $row['boletoOpp']; //Listo
      $nam = $row['nombre']; //Listo
      $numero = $row['numero']; //Listo
      $idCls = $row['id']; //Listo
      $totalSq = $row['total']; //Listo
      $cantBol = $row['cant']; //Listo
      $pagos = $row['pagos']; //Listo
      $total = $row['total']; //Listo
    }
    $query = '';


    if (in_array($nam, $arrayPersonas)) {
      // echo 'Si esta dentro';
      if ($status === $verifi) {
        // echo 'Esta mandando el mismo Apartado 1';

        // 1er consulta
        $update = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `nombre`='$nombreX',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',

                      `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                        WHERE folio = '" . $folio . "' AND nombre = '" . $nombreX . "'
                    ");

        $update2 = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',

                            `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                        WHERE folio = '" . $folio . "' AND nombre != '" . $nombreX . "'
          ");

        //  Segunda consulta
        $updateDos = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `nombre`='$nombreX',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',

                                `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                            WHERE folio = '" . $folio . "' AND nombre = '" . $nombreX . "'
                        ");

        $updateDos2 = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',

                      `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                            WHERE folio = '" . $folio . "' AND nombre != '" . $nombreX . "'
                        ");
      } else {
        // echo 'Esta mandando diferente1';

        // 1er consulta
        $update = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',

                            `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                        WHERE folio = '" . $folio . "'
                    ");

        $update2 = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',

                            `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                        WHERE folio = '" . $folio . "'
          ");

        //  Segunda consulta
        $updateDos = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',

                                `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                            WHERE folio = '" . $folio . "'
                        ");

        $updateDos2 = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',

                                `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                            WHERE folio = '" . $folio . "'
                        ");
      }
    } else {
      // echo 'No esta dentro';
      if ($status === $verifi) {
        // echo 'Esta mandando el mismo Apartado 1';

        // 1er consulta
        $update = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',

                            `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                        WHERE folio = '" . $folio . "' AND nombre = '" . $nombreX . "'
                    ");

        $update2 = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',

                            `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                        WHERE folio = '" . $folio . "' AND nombre != '" . $nombreX . "'
          ");

        //  Segunda consulta
        $updateDos = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',

                                `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                            WHERE folio = '" . $folio . "' AND nombre = '" . $nombreX . "'
                        ");

        $updateDos2 = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',

                      `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                            WHERE folio = '" . $folio . "' AND nombre != '" . $nombreX . "'
                        ");
      } else {
        // echo 'Esta mandando diferente1';

        // 1er consulta
        $update = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',


                            `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                        WHERE folio = '" . $folio . "'
                    ");

        $update2 = ("UPDATE `sorteomini$compilerdb` 
                        SET 
                            `user`='$user',
                            `numero`='$numeroX',
                            `estado`='$estadoX',
                            `statusBoleto`='$statusX',


                            `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                        WHERE folio = '" . $folio . "'
          ");

        //  Segunda consulta
        $updateDos = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',


                      `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                            WHERE folio = '" . $folio . "'
                        ");

        $updateDos2 = ("UPDATE `info_boletos$compilerdb` 
                            SET 
                                `user`='$user',
                                `numero`='$numeroX',
                                `estado`='$estadoX',
                                `statusBoleto`='$statusX',


                                `pagos`='0',
                      `total`='$pagos',
                      `typePay`= '$formasPagoX',

                      `timeCompra`='$compraX',
                      `timePay`='$fechaPago'
                            WHERE folio = '" . $folio . "'
                        ");
      }
    }

    // Variables para el Mensaje de Pago`
    $nombreX = '*' . $nombre . '*'; // si
    $sorteoX = '*' . $infoSorteoNombreCompiler . '*'; // si
    $pageX = '*' . $importanteNombreSorteo . '*'; // si
    $cantidadX = '*' . $cant . '*'; // si
    $totalX = '*$' . $total . '*'; // si
    $boletosX = '' . $boletoOpp . ''; // si
    $folioX = '*' . $folio . '*'; // si
    $payX = '' . $urlPartner . '' . $linkPPago . ''; // soi
    $checX = '' . $urlPartner . '' . $linkPCheck . $compileCheckTick . '';
    $boletoDigital = '' . $urlPartner . '' . $linkPBoleto . '?mkultra' . $compileCheckTick . '=' . $folio;
    $inxX = '' . $urlPartner . $linkPSorteoX . '';

    // Mensaje completo que se va enviar
    $mnsTp = str_replace('</br>', '%0A', $mnsPagoBr); // Espacios
    $mnsIni = str_replace(' ', '%20', $mnsTp); // Espacios
    $mnsNombre = str_replace('$nombre', $nombreX, $mnsIni); // x
    $mnsSorteo = str_replace('$sorteo', $sorteoX, $mnsNombre); // x
    $mnsPage = str_replace('$page', $pageX, $mnsSorteo); // x
    $mnsCantidad = str_replace('$cantidad', $cantBol, $mnsPage); // x
    $mnsTotal = str_replace('$total', $totalX, $mnsCantidad); // x
    $mnsBoletos = str_replace('$boletos', $boletosX, $mnsTotal); // x
    $mnsFolio = str_replace('$folio', $folioX, $mnsBoletos); // x
    $mnsPay = str_replace('$pay', $payX, $mnsFolio); // x
    $mnsChec = str_replace('$chec', $checX, $mnsPay); // x
    $mnsInx = str_replace('$inx', $inxX, $mnsChec); // x
    $mnsBoletoDigital = str_replace('$bolDi', $boletoDigital, $mnsChec);
    $mnsInx = str_replace('$inx', $inxX, $mnsBoletoDigital);

    $result_update = mysqli_query($db, $update);
    $result_update = mysqli_query($db, $update2);
    $result_update = mysqli_query($db, $updateDos);
    $result_update = mysqli_query($db, $updateDos2);

    if ($update == true) {
      echo '
      <div id="snoAlertBox" class="alert alert-success" data-alert="alert">Se actualizo el Registro (PAGO)</div>
              <script type="text/javascript">
                closeSnoAlertBox();
                function closeSnoAlertBox(){
                  window.setTimeout(function () {
                    $("#snoAlertBox").fadeOut(5000)
                    location.reload();
                    
                  }, 5000);
                } 

                window.open("https://api.whatsapp.com/send?phone=' . $numero . '&text=' . $mnsInx . '", "_blank");

              </script>';
    } else {
      echo 'No se elimino';
    }

    break;
}
