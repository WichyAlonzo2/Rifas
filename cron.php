<?php
include('app/conn.php');
date_default_timezone_set('America/Mexico_City');

$fechaLimite = date('Y-m-d H:i:s', strtotime('-30 minutes'));
$otraFecha = date("Y-m-d H:i:s", strtotime(" -1 hour")   );

echo $fechaLimite;
echo '<br>';
echo $otraFecha;


$sql = "DELETE FROM info_boletos WHERE statusBoleto = 'Apartado' AND timeCompra < '$fechaLimite'";
echo $sql;

if ($db->query($sql) === TRUE) {
    echo "Registros eliminados correctamente";
} else {
    echo "Error al eliminar registros: " . $db->error;
}

$db->close();