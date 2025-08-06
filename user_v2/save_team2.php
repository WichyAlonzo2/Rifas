<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $clave = $_POST["clave"];

    $gol1 = $_POST["gol1"];
    $gol2 = $_POST["gol2"];

    // Leer el archivo JSON existente
    $jsonFile = '../app/team2.json';
    $jsonData = json_decode(file_get_contents($jsonFile), true);

    // Actualizar los datos en el archivo JSON
    if (isset($jsonData[$clave])) {
        $compiler = '';
        if ($gol1 === '-' && $gol2 === '-') {
            $compiler ='';
            $jsonData[$clave][0]["gol1"] = 0;
            $jsonData[$clave][0]["gol2"] = 0;
            $jsonData[$clave][0]["compiler"] = '-';

            // Guardar los datos actualizados en el archivo JSON
            $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);

            if (file_put_contents($jsonFile, $jsonString)) {
                $response = ["status" => "success", "message" => "Datos guardados correctamente."];
            } else {
                $response = ["status" => "error", "message" => "Error al guardar los datos en el archivo JSON."];
            }

        }else{
            if ($gol1 === $gol2) {
                echo 'empate';
                $compiler = 'E';
            } else if ($gol1 > $gol2) {
                echo 'Gana Local';
                $compiler = 'L';
            } else if ($gol2 > $gol1) {
                echo 'Gana Visitante';
                $compiler = 'V';
            }

            $jsonData[$clave][0]["gol1"] = $gol1;
            $jsonData[$clave][0]["gol2"] = $gol2;
            $jsonData[$clave][0]["compiler"] = $compiler;

            // Guardar los datos actualizados en el archivo JSON
            $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);

            if (file_put_contents($jsonFile, $jsonString)) {
                $response = ["status" => "success", "message" => "Datos guardados correctamente."];
            } else {
                $response = ["status" => "error", "message" => "Error al guardar los datos en el archivo JSON."];
            }
        }

    } else {
        $response = ["status" => "error", "message" => "Clave no encontrada en el archivo JSON."];
    }

    // Enviar la respuesta JSON de vuelta al cliente
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}else{
    echo '  <script type="text/javascript">
                window.location.href = "settings"; // Reemplaza con la URL a la que deseas redirigir
            </script>';
}
