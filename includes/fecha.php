<?php
// Definir nombres de los meses en español
include $urlPartner . '/root.php';
include $urlPartner . '/app/varGlobal.php';
include $urlPartner . '/logica/whatsapp.php';
include $urlPartner . '/sys.php';
$meses = array(
    'January' => 'Enero',
    'February' => 'Febrero',
    'March' => 'Marzo',
    'April' => 'Abril',
    'May' => 'Mayo',
    'June' => 'Junio',
    'July' => 'Julio',
    'August' => 'Agosto',
    'September' => 'Septiembre',
    'October' => 'Octubre',
    'November' => 'Noviembre',
    'December' => 'Diciembre'
);

// Establecer la zona horaria
date_default_timezone_set('America/Mexico_City');

// Obtener la fecha y hora actual en Guadalajara
$fechaActualGuadalajara = new DateTime();
$fechaActualGuadalajara->setTimezone(new DateTimeZone('America/Mexico_City'));


// Formatear la fecha y hora actual en Guadalajara
$fechaFormateadaMain = $fechaActualGuadalajara->format('j \d\e F, H:i');
$infoSorteoFechaMain = strtr($fechaFormateadaMain, $meses);

// Formatear la fecha de quiniela 1
$fechaQuiniela1 = new DateTime($infoSorteoFechaOpen);
$fechaQuiniela1Close = new DateTime($infoSorteoFechaClose);
$fechaFormateada = $fechaQuiniela1->format('j \d\e F, H:i');
$infoSorteoFecha = strtr($fechaFormateada, $meses);



// Close 
$fechaFormateadaClose = $fechaQuiniela1Close->format('j \d\e F, H:i');
$infoSorteoFechaClose = strtr($fechaFormateadaClose, $meses);



// Formatear la fecha de quiniela 2
$fechaQuiniela2 = new DateTime($infoSorteoFechaOpen2);
$fechaQuiniela2Close = new DateTime($infoSorteoFechaClose2);
$fechaFormateada2 = $fechaQuiniela2->format('j \d\e F, H:i');
$infoSorteoFecha2 = strtr($fechaFormateada2, $meses);
$infoSorteoFecha2Libre = ltrim($infoSorteoFecha2);


// Close 
$fechaFormateada2Close = $fechaQuiniela2->format('j \d\e F, H:i');
$infoSorteoFecha2Close = strtr($fechaFormateada2Close, $meses);
$infoSorteoFecha2LibreClose = ltrim($infoSorteoFecha2Close);


// Determinar el estado de las quinielas
// $fechaTitleQuiniela1 = ($fechaActualGuadalajara >= $fechaQuiniela1) ? 'Activa' : 'En espera';
// $fechaTitleQuiniela1 = ($fechaActualGuadalajara >= $fechaQuiniela1Close) ? 'Cerrada' : 'Activa';
if ($fechaActualGuadalajara >= $fechaQuiniela1Close) {
    $fechaTitleQuiniela1 = 'Cerrada';
} elseif ($fechaActualGuadalajara >= $fechaQuiniela1) {
    $fechaTitleQuiniela1 = 'Activa';
} else {
    $fechaTitleQuiniela1 = 'En espera';
}




// echo $fechaTitleQuiniela1 . '<br>';
// $fechaTitleQuiniela2 = ($fechaActualGuadalajara >= $fechaQuiniela2) ? 'Activa' : 'En espera';
if ($fechaActualGuadalajara >= $fechaQuiniela2Close) {
    $fechaTitleQuiniela2 = 'Cerrada';

} elseif ($fechaActualGuadalajara >= $fechaQuiniela2) {
    $fechaTitleQuiniela2 = 'Activa';

} else {
    $fechaTitleQuiniela2 = 'En espera';

}




?>
