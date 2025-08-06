<?php
include $urlPartner . '/app/conn.php';
include $urlPartner . '/app/vConn.php';
include $urlPartner . '/root.php';
include $urlPartner . '/app/varGlobal.php';
include $urlPartner . '/logica/whatsapp.php';
include $urlPartner . '/sys.php';
include $urlPartner . '/includes/fecha.php';
include $urlPartner . '/includes/errr.php';

$status = intval($_GET['id']);
if ($status === 1){
    $compilerdb = '';

}else if ($status === 2){
    $compilerdb = '_two';

}else if ($status === 3){
    $compilerdb = '_tree';

}



// Consulta SQL para obtener los datos
$sql = "SELECT * FROM info_boletos$compilerdb";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // Crear un array para almacenar los datos
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convertir el array a formato JSON
    $json_data = json_encode($data);

    // Configurar las cabeceras HTTP para descargar el archivo JSON
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="datos.json"');

    // Imprimir el JSON para la descarga
    echo $json_data;
} else {
    echo "No se encontraron resultados";
}

// Cerrar la conexión a la base de datos
$db->close();
// echo "<script>window.location.href = 'status';</script>";
?>