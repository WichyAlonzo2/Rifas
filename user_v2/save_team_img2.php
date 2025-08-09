<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeros = $_POST["nombreTeamlLocal"];
    $valores = $_POST["nombreTeamVisitante"];
    $imglocal = $_POST["local"];
    $imgvisitante = $_POST["visitante"];

    $data = array();

    for ($i = 0; $i < count($numeros); $i++) {
        $numero = str_pad($i + 1, 3, '0', STR_PAD_LEFT); // Convierte a formato "001", "002", ...
        $team1 = $numeros[$i]; // Cambia el nombre del equipo según el número local
        $team2 = $valores[$i]; // Cambia el nombre del equipo según el número visitante

        $nombreImagen1 = $imglocal[$i];
        $nombreImagen2 = $imgvisitante[$i];
        
        $nombreImagen1 = $imglocal[$i];
        $nombreImagen1 = str_replace('assets/img/team/', '', $nombreImagen1);

        $nombreImagen2 = $imgvisitante[$i];
        $nombreImagen2 = str_replace('assets/img/team/', '', $nombreImagen2);



        $partido = array(
            "team1" => $team1,
            "img1" => $nombreImagen1,
            "switch1" => "L",
            "gol1" => 0,
            "team2" => $team2,
            "img2" => $nombreImagen2,
            "switch2" => "V",
            "gol2" => 0,
            "compiler" => "",
            // Agrega otros datos necesarios para el partido
        );

        $data[$numero] = array($partido);
    }

    // Codifica los datos como JSON
    $nuevoContenidoJson = json_encode($data, JSON_PRETTY_PRINT);

    // echo $nuevoContenidoJson;
     $archivoJson = '../app/team2.json';
    file_put_contents($archivoJson, $nuevoContenidoJson);
    header('location: settings');

    // No se guardan las imágenes, solo se obtienen sus nombres de archivo
}else{
    echo '  <script type="text/javascript">
                window.location.href = "settings"; // Reemplaza con la URL a la que deseas redirigir
            </script>';
}
?>
