<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeros = $_POST["numero_tree"];
    $valores = $_POST["valor_tree"];
    
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
    $archivoJson = '../app/promotions3.json';
    $archivoJson2 = '../app/promotions_tree.json';
    file_put_contents($archivoJson, $nuevoContenidoJson);
    file_put_contents($archivoJson2, $nuevoContenidoJson);

    header('location: settings');
}else{
    echo '  <script type="text/javascript">
                window.location.href = "settings"; // Reemplaza con la URL a la que deseas redirigir
            </script>';
}
?>
