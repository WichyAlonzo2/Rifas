<?php 
    include $urlPartner . '/app/conn.php';
    include $urlPartner . '/app/vConn.php';
    include $urlPartner . '/root.php';
    include $urlPartner . '/app/varGlobal.php';
    include $urlPartner . '/logica/whatsapp.php';
    include $urlPartner . '/sys.php';
    include $urlPartner . '/includes/fecha.php';
    include $urlPartner . '/includes/errr.php';
    include $urlPartner . '/firebase.php';
    include $urlPartner . '/logica/whatsapp.php';
    include $urlPartner . '/includes/pixel.php';

    session_start();
    $arrayPersonas = [];
    $user = $_SESSION['user'];

    // Validacion de ID
    if(!empty($_REQUEST['id'])) {
      echo $_REQUEST['id'];

    }else{
      header('Location: ../status.php');

    }

    $idRegistros = $_REQUEST['id'];
    $query = "SELECT * FROM sorteomini WHERE folio='$idRegistros'";
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


    }

    date_default_timezone_set("America/Mexico_City");
    $fechaPago = date('Y-m-d H:i:s');
    $idRegistros = $_REQUEST['id'];
    $update = ("UPDATE `info_boletos` 
    SET 
        `user`='$user',
        `statusBoleto`='Pagado',
        `pagos`='0',
        `total`='$pagos',
        `pagado`='Si',
        `timePay`='$fechaPago'
    WHERE folio='$idRegistros'
    "); 

    $updateDos = ("UPDATE `boletos` 
    SET 
        `user`='$user',
        `statusBoleto`='Pagado',
        `pagos`='0',
        `total`='$pagos',
        `pagado`='Si',
        `timePay`='$fechaPago'
    WHERE folio='$idRegistros'
    "); 
    
    $sortUp = ("UPDATE `sorteomini` 
        SET 
            `user`='$user',
            `statusBoleto`='Pagado',
            `pagos`='0',
            `total`='$pagos',
            `pagado`='Si',
            `timePay`='$fechaPago'
        WHERE folio='$idRegistros'
        "); 



    $result_updat = mysqli_query($db, $sortUp);
    $result_update = mysqli_query($db, $update);
    $result_update = mysqli_query($db, $updateDos);
    
    if($update == true){
        
        }else{
            // Crear pagina por si no se Realizo el Cambio
            
    }

    $nombreX = "*" . $nombre . "*"; // Listo
    $sorteoX = "*" . $infoSorteoNombre . "*"; // Listo
    $pageX = "*" . $importanteNombreSorteo . "*"; // Listo
    $totalX = "*$" . $total . "*"; // Listo
    $cantidadX = "*" . $cant . "*"; // Listo
    $boletosX = "" . $boletoOpp . ""; // Listo
    $folioX = "*" . $idRegistros . "*"; // Listo
    $payX = "" . $urlPartner . "" . $linkPPago . ""; // Listo
    $checX = "" . $urlPartner . "" . $linkPCheck . ""; // Listo
    $inxX = "" . $urlPartner  . ""; // Listo
    $boletoDigital = '' . $urlPartner . '' . $linkPBoleto . '?mkultra=' . $idRegistros;

    // Mensaje completo que se va enviar
    $mnsTp = str_replace('</br>', '%0A', $mnsPagoBr); // Espacios
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
            


?>

<script type="text/javascript">
  window.open("https://api.whatsapp.com/send?phone=<?php echo $numero; ?>&text=<?php echo $mnsInx; ?>", "_blank");
  // window.open("status.php", "_blank");
  // window.close();
  location.reload();
</script>