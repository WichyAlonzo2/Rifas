<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["referidor"])) {
        echo "Recibí referidor";
        $referidos = $_POST["referidor"];
        $valores = $_POST["numero"];
        $archivoJson = '../app/ref.json';

    } elseif (isset($_POST["referidor_two"])) {
        echo "Recibí referidor_two";
        $referidos = $_POST["referidor_two"];
        $valores = $_POST["numero_two"];
        $archivoJson = '../app/ref_two.json';

    } elseif (isset($_POST["referidor_tree"])) {
        echo "Recibí referidor_tree";
        $referidos = $_POST["referidor_tree"];
        $valores = $_POST["numero_tree"];
        $archivoJson = '../app/ref_tree.json';

    } else {
        echo "No se recibió ninguna variable conocida";
        exit;
    }

    $jsonContent = file_get_contents($archivoJson);
    $jsonData = json_decode($jsonContent, true);

    if (!isset($jsonData['referidos'])) {
        $jsonData['referidos'] = array('users' => array());

    }

    $data = array();
    for ($i = 0; $i < count($referidos); $i++) {
        $numero = $referidos[$i];
        $valor = intval($valores[$i]);
        $data['referidos']['users'][$numero] = $valor;
    }
    
    // Codifica los datos como JSON
    $nuevoContenidoJson = json_encode($data, JSON_PRETTY_PRINT);
    $bytesEscritos = file_put_contents($archivoJson, $nuevoContenidoJson);
    if ($bytesEscritos !== false) {
        echo '<script>window.location.href = "settings";</script>';
        echo 'Si';

    } else {
        echo '<script>alert("Error al guardar los datos, comunicate con Wichy");</script>';
    }

} else {
    echo "Este script solo maneja peticiones POST";
}
?>
