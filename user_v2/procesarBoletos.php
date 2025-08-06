<?php
header('Content-Type: application/json');

include '../app/conn.php';

try {
    // Obtiene los datos enviados desde JavaScript
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['queries']) && is_array($data['queries'])) {
        foreach ($data['queries'] as $query) {
            // Ejecuta cada consulta
            if (!$db->query($query)) {
                throw new Exception('Error en la consulta: ' . $mysqli->error);
            }
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos inválidos.']);
    }
} catch (Exception $e) {
    // Registra el error en el log
    error_log($e->getMessage(), 3, '/path/to/your/error.log'); // Cambia la ruta al archivo de log deseado
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} finally {
    // Cierra la conexión
    if (isset($mysqli)) {
        $mysqli->close();
    }
}
?>