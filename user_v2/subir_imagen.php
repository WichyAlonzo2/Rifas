<?php
$directorio = "../assets/img/team"; // Ruta de la carpeta de imágenes
$extensiones_validas = array("jpg", "jpeg", "png", "gif"); // Extensiones de archivo válidas

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["imagen"])) {
    $archivo = $_FILES["imagen"];
    $nombre = $archivo["name"];
    $tipo = $archivo["type"];
    $tmp_name = $archivo["tmp_name"];

    $extension = pathinfo($nombre, PATHINFO_EXTENSION);

    // Verifica si la extensión del archivo es válida
    if (!in_array(strtolower($extension), $extensiones_validas)) {
        echo json_encode(["error" => "Formato de imagen no válido"]);
        exit;
    }

    // Mueve el archivo a la carpeta de imágenes
    $ruta_destino = $directorio . "/" . $nombre;
    move_uploaded_file($tmp_name, $ruta_destino);

    // Obtén la lista actualizada de imágenes
    $archivos = scandir($directorio);

    $imagenes = array();
    foreach ($archivos as $archivo) {
        $extension = pathinfo($archivo, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $extensiones_validas)) {
            $imagenes[] = $archivo;
        }
    }

    echo json_encode(["imagenes" => $imagenes]);
} else {
    echo json_encode(["error" => "No se ha recibido ninguna imagen"]);
}
?>
