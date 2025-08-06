<?php
include '../../app/vConn.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // variables para insertar
    $barra = $_POST['barra'];
    $porcentaje = $_POST['porcentaje'];
    $textBoletos = $_POST['textBoletos'];

    if($barra === "Si"){
        $barraValue = true;

    }else{
        $barraValue = false;

    }

    if($textBoletos === "Si"){
        $textBoletosValue = true;

    }else{
        $textBoletosValue = false;

    }

    if($porcentaje === "Si"){
        $porcentajeValue = true;

    }else{
        $porcentajeValue = false;

    }


    $data = [
        "numberprocess" => $porcentajeValue,
        "progressbar_colors" => $barraValue,
        "wins" => "-",
        "textboletos" => $textBoletosValue,
    
    ];

    // convertir el array en una cadena JSON
    $json_data = json_encode($data);

    // guardar la cadena JSON en un archivo
    $file_name = '../../app/settings.json';
    file_put_contents($file_name, $json_data);
    echo " <script>
    window.location.href = '/user_v2/settings';
</script>";

} else {
    echo "No se ha enviado ningun formulario.";
    echo " <script>
            window.location.href = user_v2/settings;
        </script>";
}
