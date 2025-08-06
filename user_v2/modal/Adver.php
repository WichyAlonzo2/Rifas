<?php 
    include $urlPartner . '/app/conn.php';
    include $urlPartner . '/app/vConn.php';
    include $urlPartner . '/root.php';
    include $urlPartner . '/app/varGlobal.php';
    include $urlPartner . '/logica/whatsapp.php';
    include $urlPartner . '/sys.php';
    include $urlPartner . '/includes/fecha.php';
    include $urlPartner . '/includes/errr.php';
    include $urlPartner . '/logica/whatsapp.php';

    session_start();
    $user = $_SESSION['user'];

    // Validacion de ID
    if(!empty($_REQUEST['id'])) {
      // Si hay ID
      

    }else{
      // No hay ID
      header('Location: ../status.php');

    }

      $idRegistros = $_REQUEST['id'];
      $compiler = $_REQUEST['compiler'];
      $compilerX = intval($compiler);
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

      $query = "SELECT * FROM sorteomini$compilerdb WHERE folio='$idRegistros'";
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


          // $nombreX = "*" . $nombre . "*"; // Listo
          // $sorteoX = "*" . $infoSorteoNombre . "*"; // Listo
          // $pageX = "*" . $importanteNombreSorteo . "*"; // Listo
          // $totalX = "*$" . $total . "*"; // Listo
          // $cantidadX = "*" . $cant . "*"; // Listo
          // $boletosX = str_replace("<br>\n", "%0A", $boletoOpp); // Listo
          // $folioX = "*" . $idRegistros . "*"; // Listo
          // $payX = "" . $urlPartner . "" . $linkPPago . ""; // Listo
          // $checX = "" . $urlPartner . "" . $linkPCheck . ""; // Listo
          // $inxX = "" . $urlPartner  . ""; // Listo
          // $boletoDigital = '' . $urlPartner . '' . $linkPBoleto . '?mkultra=' . $idRegistros;


          
          $nombreX = '*' . $nombre . '*';
          $sorteoX = '*' . $infoSorteoNombreCompiler . '*';
          $pageX = '*' . $importanteNombreSorteo . '*';
          $cantidadX = '*' . $cant . '*';
          $totalX = '*$' . $total . '*';
          $boletosX = str_replace("<br>\n", "%0A", $boletoOpp); // Listo
          $folioX = '*' . $idRegistros . '*';
          $payX = '' . $urlPartner . '' . $linkPPago . '';
          $checX = '' . $urlPartner . '' . $linkPCheck . $compileCheckTick . '';
          $boletoDigital = '' . $urlPartner . '' . $linkPBoleto . '?mkultra' . $compileCheckTick . '=' . $idRegistros;
          $inxX = '' . $urlPartner . $linkPSorteoX . '';
      
          // Mensaje completo que se va enviar
          $mnsTp = str_replace('</br>', '%0A', $mnsAdvertenciaBr); // Espacios
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
          
             echo '<script type="text/javascript">
                window.open("https://api.whatsapp.com/send?phone=' . $numero . '&text='. $mnsInx . '", "_blank");
                // window.open("status.php", "_blank");
                // window.close();
                location.reload();
              </script>';
          


       }

      
?>




