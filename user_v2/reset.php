<?php
include '../app/conn.php';
$table = $_GET['table'];
$numberTable =  '';
$pageNumber = '';

if($table === '1'){
    $numberTable = '';
    $pageNumber = '';

}else if($table === '2'){
    $numberTable = '_two';
    $pageNumber = '2';

}else if ($table === '3') {
    $numberTable = '_tree';
    $pageNumber = '3';
}

// Consulta SQL para eliminar registros de múltiples tablas
$sql = "DELETE FROM info_boletos$numberTable;
        DELETE FROM sorteomini$numberTable";

// Ejecutar las consultas SQL
if ($db->multi_query($sql)) {
    echo "Las tablas se han vaciado con éxito";
    echo "<script>window.location.href = 'status';</script>";
    
} else {
    echo "Error al vaciar las tablas: " . $db->error;

}

// Cerrar la conexión
$db->close();
?>
