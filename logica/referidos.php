<?php
    $ref = isset($_GET['r']) ? $_GET['r'] : null;
    $referido = '';
    if ($ref !== null) {
        $referido = $ref;
        $jsonFile = 'app/ref.json';
        $jsonContent = file_get_contents($jsonFile);
        $referidos = json_decode($jsonContent, true);
        if (isset($referidos['s' . $compiler]['referidos']['users'][$ref])) {
            $referidos['referidos']['users'][$ref]++;
            file_put_contents($jsonFile, json_encode($referidos, JSON_PRETTY_PRINT));
            $puntos = $referidos['referidos']['users'][$ref];
            // echo "Referido: $ref, Puntos: $puntos";

        }
    } else {
        $referido = '';
    }

?>