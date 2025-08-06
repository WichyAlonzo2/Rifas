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

    echo "Usando print_r:<br>";
    print_r($referidos);

    $jsonContent = file_get_contents($archivoJson);
    $jsonData = json_decode($jsonContent, true);

    if (!isset($jsonData['referidos'])) {
        $jsonData['referidos'] = array('users' => array());
    }

    // // Nueva variable para almacenar los cambios antes de convertirlo a JSON
    // $nuevosReferidos = array();

    // for ($i = 0; $i < count($referidos); $i++) {
    //     $numero = $referidos[$i];
    //     $valor = intval($valores[$i]);

    //     // Verificar si el referido ya existe antes de agregarlo
    //     if (!isset($jsonData['referidos']['users'][$numero]) || $jsonData['referidos']['users'][$numero] !== $valor) {
    //         // Almacenar los cambios en la nueva variable
    //         $nuevosReferidos[$numero] = $valor;
    //     }
    // }

    $data = array();
    
    for ($i = 0; $i < count($referidos); $i++) {
        $numero = $referidos[$i];
        $valor = intval($valores[$i]);
        
        if ($numero !== 0 && $valor !== 0) {
            $data[$numero] = $valor;
        }
    }

    // Codifica los datos como JSON
    $nuevoContenidoJson = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($archivoJson, $nuevoContenidoJson);

    // print_r($nuevosReferidos);
    // $jsonData['referidos']['users'] = array_merge($jsonData['referidos']['users'], $nuevosReferidos);
    // $nuevoContenidoJson = json_encode($jsonData, JSON_PRETTY_PRINT);
    // $bytesEscritos = file_put_contents($archivoJson, $nuevoContenidoJson);
    
    if ($bytesEscritos !== false) {
        echo 'Si';

    } else {
        echo '<script>alert("Error al guardar los datos, comunicate con Wichy");</script>';
    }

} else {
    echo "Este script solo maneja peticiones POST";
}
?>
