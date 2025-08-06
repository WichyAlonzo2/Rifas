<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el JSON desde el archivo
    $jsonFile = '../app/tarjetas.json';
    $jsonData = json_decode(file_get_contents($jsonFile), true);
    $tipoValue = $_POST["tipoValue"];
    $tipoValue2 = $_POST["tipoValue2"];


    $parametro = $_POST["parametro"];
    $imgValue = $_POST["imgValueInput"];
    $nombreBanco = $_POST["nombreBanco"];
    $nombreValue = $_POST["nombreValue"];
    $clabeValue = $_POST["clabeValue"];
    $numeroValue = $_POST["numeroValue"];
    $tipoValueComp = empty($tipoValue) ? $tipoValue2 : $tipoValue;
    // echo "Elementos del JSON:<br>";
    // foreach ($jsonData as $indice => $elemento) {
    //     echo "Índice: $indice<br>";
    //     print_r($elemento);
    //     echo "<br>";
    // }

    if (isset($jsonData[$parametro])) {
        $elementoEncontrado = $jsonData[$parametro];
        if ($parametro == $parametro) {
            $imgValue = str_replace('../assets/img/pay/', '', $imgValue);
            $jsonData[$parametro]["nombreBanco"] = $nombreBanco;
            $jsonData[$parametro]["info"][0]["nombrePersona"] = $nombreValue;
            $jsonData[$parametro]["info"][0]["clave"] = $clabeValue;
            $jsonData[$parametro]["info"][0]["numero"] = $numeroValue;
            $jsonData[$parametro]["tipo"] = $tipoValueComp;
            $jsonData[$parametro]["logoBanco"] = $imgValue;

            // Guardar el JSON actualizado
            file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT));

            echo "<br>El índice 2 ha sido actualizado en el JSON:<br>";
            print_r($jsonData[$parametro]);
        } else {
            echo "<br>El índice no es 2, no se realizó ninguna actualización.";
        }
    } else {
        echo "<br>Índice no encontrado en el JSON.";
    }

} else {
    echo "Este script solo maneja peticiones POST";
}
