<?php
include '../../app/vConn.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // variables para insertar
    $nombreSorteoCorto = $_POST['nombreSorteoCorto'];
    $nombreSorteos = $_POST['nombreSorteos'];
    $ubicacion = $_POST['ubicacion'];
    $psorteo = $_POST['psorteo'];
    $psorteo2 = $_POST['psorteo2'];
    $psorteo3 = $_POST['psorteo3'];
    $ppago = $_POST['ppago'];
    $pcheck = $_POST['pcheck'];
    // $izquierda = $_POST['izquierda'];
    $faq1 = $_POST['faq1'];
    $respuesta1 = $_POST['respuesta1'];
    $faq2 = $_POST['faq2'];
    $respuesta2 = $_POST['respuesta2'];
    $faq3 = $_POST['faq3'];
    $respuesta3 = $_POST['respuesta3'];
    $faq4 = $_POST['faq4'];
    $respuesta4 = $_POST['respuesta4'];
    $faq5 = $_POST['faq5'];
    $respuesta5 = $_POST['respuesta5'];





    $nombreSorteoActual = $_POST['nombreSorteoActual'];
    $tipoQuiniela = $_POST['tipoQuiniela'];

    $fechaSorteoOpen = $_POST['fechaSorteoOpen'];
    $fechaSorteoCierre = $_POST['fechaSorteoCierre'];

    $detallesBoletoSorteoActual = $_POST['detallesBoletoSorteoActual'];
    $premioBonosSorteoActual = $_POST['premioBonosSorteoActual'];
    // $detallesIndexSorteoActual = $_POST['detallesIndexSorteoActual'];
    $precioSorteoActual = $_POST['precioSorteoActual'];






    $nombreSorteoActual2 = $_POST['nombreSorteoActual2'];
    $tipoQuiniela2 = $_POST['tipoQuiniela2'];

    $fechaSorteoOpen2 = $_POST['fechaSorteoOpen2'];
    $fechaSorteoCierre2 = $_POST['fechaSorteoCierre2'];

    $detallesBoletoSorteoActual2 = $_POST['detallesBoletoSorteoActual2'];
    $premioBonosSorteoActual2 = $_POST['premioBonosSorteoActual2'];
    // $detallesIndexSorteoActual2 = $_POST['detallesIndexSorteoActual2'];
    $precioSorteoActual2 = $_POST['precioSorteoActual2'];



    $nombreSorteoActual3 = $_POST['nombreSorteoActual3'];
    $tipoQuiniela3 = $_POST['tipoQuiniela3'];

    $fechaSorteoOpen3 = $_POST['fechaSorteoOpen3'];
    $fechaSorteoCierre3 = $_POST['fechaSorteoCierre3'];

    $detallesBoletoSorteoActual3 = $_POST['detallesBoletoSorteoActual3'];
    $premioBonosSorteoActual3 = $_POST['premioBonosSorteoActual3'];
    // $detallesIndexSorteoActual2 = $_POST['detallesIndexSorteoActual2'];
    $precioSorteoActual3 = $_POST['precioSorteoActual3'];

    // agregar el campo "linkPages" al array asociativo
    $linkPages = [
        'q1' => $psorteo,
        'q2' => $psorteo2,
        'q3' => $psorteo3,
        'ppago' => $ppago,
        'pcheck' => $pcheck,
        'pDigital' => 'ticket'
    ];

    $description = [
        // 'izquierda' => $izquierda,
    ];

    $sorteoActual = [
        'nombre' => $nombreSorteoActual,
        'tipo' => $tipoQuiniela,
        'fechaOpen' => $fechaSorteoOpen,
        'fechaClose' => $fechaSorteoCierre,
        'detallesBoletoSorteo' => $detallesBoletoSorteoActual,
        'premioBonos' => $premioBonosSorteoActual,
        'detallesIndex' => "detallesIndexSorteoActual",
        'precio' => $precioSorteoActual,
    ];

    $sorteoActual_two = [
        'nombre' => $nombreSorteoActual2,
        'tipo' => $tipoQuiniela2,
        'fechaOpen' => $fechaSorteoOpen2,
        'fechaClose' => $fechaSorteoCierre2,
        'detallesBoletoSorteo' => $detallesBoletoSorteoActual2,
        'premioBonos' => $premioBonosSorteoActual2,
        'detallesIndex' => "detallesIndexSorteoActual2",
        'precio' => $precioSorteoActual2,
    ];

    $sorteoActual_tree = [
        'nombre' => $nombreSorteoActual3,
        'tipo' => $tipoQuiniela3,
        'fechaOpen' => $fechaSorteoOpen3,
        'fechaClose' => $fechaSorteoCierre3,
        'detallesBoletoSorteo' => $detallesBoletoSorteoActual3,
        'premioBonos' => $premioBonosSorteoActual3,
        'detallesIndex' => "detallesIndexSorteoActual2",
        'precio' => $precioSorteoActual3,
    ];

    $data = [
        "nombreSorteoCorto" => $nombreSorteoCorto,
        "nombreSorteos" => $nombreSorteos,
        "ubicacion" => $ubicacion,
        "linkPages" => $linkPages,
        "descripcion" => $description,
        "faq" => [
            "faq1" => [
                "faq" => $faq1,
                "respuesta" => $respuesta1
            ],
            "faq2" => [
                "faq" => $faq2,
                "respuesta" => $respuesta2
            ],
            "faq3" => [
                "faq" => $faq3,
                "respuesta" => $respuesta3
            ],
            "faq4" => [
                "faq" => $faq4,
                "respuesta" => $respuesta4
            ],
            "faq5" => [
                "faq" => $faq5,
                "respuesta" => $respuesta5
            ],
        ],
        "sorteoActual" => $sorteoActual,
        "sorteoActual_two" => $sorteoActual_two,
        "sorteoActual_tree" => $sorteoActual_tree

    ];

    // convertir el array en una cadena JSON
    $json_data = json_encode($data);

    // guardar la cadena JSON en un archivo
    $file_name = '../../app/root.json';
    file_put_contents($file_name, $json_data);


    $directorio = '../../'; // Cambia esta ruta a la ubicaci��n donde deseas buscar y renombrar archivos.
    $patron = 'jornada-'; // Patr��n para buscar archivos que contengan "jornada-".

    $archivos = scandir($directorio);

    if ($archivos !== false) {
        foreach ($archivos as $archivo) {
            // Verifica si el nombre del archivo contiene "jornada-"
            if (strpos($archivo, $patron) !== false) {
                echo "Archivo encontrado: $archivo<br>";

                $nombreAnterior = $directorio . '/' . $archivo;
                $nombreNuevo = $directorio . '/jornada-' . $psorteo2 . '.php';
                echo " <script>
            window.location.href = 'user_v2/settings';
        </script>";

                if (rename($nombreAnterior, $nombreNuevo)) {
                    echo "El archivo se ha renombrado exitosamente.<br>";
                    echo " <script>
            window.location.href = 'user_v2/settings';
        </script>";

                } else {
                    echo "Hubo un error al intentar renombrar el archivo.<br>";

                    $error = error_get_last();
                    echo "Error: " . $error['message'] . "<br>";
                }
            }
            echo " <script>
            window.location.href = user_v2/settings;
        </script>";

        }
        echo " <script>
            window.location.href = user_v2/settings;
        </script>";

    } else {
        echo "No se encontraron archivos en el directorio especificado.";
        echo " <script>
            window.location.href = '/user_v2/settings';
        </script>";
    }
    echo " <script>
    window.location.href = '/user_v2/settings';
</script>";
} else {
    echo "No se ha enviado ningun formulario.";
    echo " <script>
            window.location.href = '/user_v2/settings';
        </script>";
}
