<?php
    // Archivo JSON a monitorear
    $jsonFile = 'noti.json';

    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');

    // Función para enviar eventos SSE al navegador
    function sendEvent($data) {
        echo "event: data\n";
        echo "data: " . json_encode($data) . "\n\n";
        ob_flush();
        flush();
    }

    // Función para verificar cambios en el archivo JSON
    function checkFileChanges($jsonFile) {
        static $lastModifiedTime = null;

        clearstatcache();
        $currentModifiedTime = filemtime($jsonFile);

        if ($currentModifiedTime !== $lastModifiedTime) {
            $lastModifiedTime = $currentModifiedTime;

            // Leer el contenido del archivo JSON
            $jsonContent = file_get_contents($jsonFile);
            $jsonData = json_decode($jsonContent, true);
            $lastData = end($jsonData);

            $jsonLast = json_encode($lastData);


            // Enviar solo los datos que han cambiado
            sendEvent($jsonLast);

            return true; // Indicar que se ha enviado un evento
        }

        return false; // Indicar que no se ha enviado ningún evento
    }

    // Verificar cambios inicialmente al iniciar la conexión SSE
    if (checkFileChanges($jsonFile)) {
        sleep(1); // Si se ha enviado un evento, esperar 1 segundo antes de verificar nuevamente
    }

    // Ciclo principal para monitorear cambios
    while (true) {
        if (!checkFileChanges($jsonFile)) {
            usleep(100000); // Esperar 100 milisegundos antes de verificar nuevamente si no se ha enviado ningún evento
        }
    }
    
?>
