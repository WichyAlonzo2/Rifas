<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $from = 1;
    $numeros = $_POST["numero"];
    $valores = $_POST["valor"];

    $fromInt = intval($from);
    $valorJson;

    if($fromInt === 1){
        $valorJson = 'promotions';
        $valorJson2 = 'promotions';

    }else if($fromInt === 2){
        $valorJson = 'promotions_two';
        $valorJson2 = 'promotions2';

    }else if($fromInt === 3){
        $valorJson = 'promotions_tree';
        $valorJson2 = 'promotions3';

    }
    
    $data = array();
    
    for ($i = 0; $i < count($numeros); $i++) {
        $numero = intval($numeros[$i]);
        $valor = intval($valores[$i]);
        
        if ($numero !== 0 && $valor !== 0) {
            $data[$numero] = $valor;
        }
    }

    // Codifica los datos como JSON
    $nuevoContenidoJson = json_encode($data, JSON_PRETTY_PRINT);

    // Guarda el nuevo contenido en el archivo JSON
    $archivoJson = '../app/'. $valorJson . '.json';
    $archivoJson2 = '../app/'. $valorJson2 . '.json';
    file_put_contents($archivoJson, $nuevoContenidoJson);
    file_put_contents($archivoJson2, $nuevoContenidoJson);

    header('location: settings');
}else{
    echo '  <script type="text/javascript">
                window.location.href = "settings"; // Reemplaza con la URL a la que deseas redirigir
            </script>';
}
?>
