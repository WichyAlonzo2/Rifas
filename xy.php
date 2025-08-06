<?php
function optimizarYMostrarImagen($rutaImagen) {
    $rutaCompletaImagen1 = __DIR__ . '/assets/img/' . $rutaImagen;
    $rutaCompletaImagen2 = __DIR__ . '/assets/img/ganadores/' . $rutaImagen;
    $rutaCompletaImagenPay = __DIR__ . '/assets/img/pay/' . $rutaImagen;

    if (file_exists($rutaCompletaImagen1)) {
        $img = imagecreatefrompng($rutaCompletaImagen1);

    } elseif (file_exists($rutaCompletaImagen2)) {
        $img = imagecreatefrompng($rutaCompletaImagen2);

    } elseif (file_exists($rutaCompletaImagenPay)) {
        $img = imagecreatefrompng($rutaCompletaImagenPay);

    }else{
        $img = imagecreate(200, 100);
        $background = imagecolorallocate($img, 255, 255, 255);
        $textColor = imagecolorallocate($img, 0, 0, 0);
        imagestring($img, 5, 10, 40, "Imagen no encontrada", $textColor);
    }

    $anchoOriginal = imagesx($img);
    $altoOriginal = imagesy($img);
    $nuevoAncho = 800;
    $nuevoAlto = ($altoOriginal / $anchoOriginal) * $nuevoAncho;
    $imgNueva = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
    imagealphablending($imgNueva, false);
    imagesavealpha($imgNueva, true);
    imagecopyresampled($imgNueva, $img, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $anchoOriginal, $altoOriginal);
    header('Content-Type: image/png');
    imagepng($imgNueva, null, 9);

    imagedestroy($img);
    imagedestroy($imgNueva);

}
if(isset($_GET['xy'])) {
    $rutaImagen = $_GET['xy'];
    optimizarYMostrarImagen($rutaImagen);

} else {
    echo "Errr al traer la imagen de la url";
    
}
?>
