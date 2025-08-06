<?php
include $urlPartner . '/app/conn.php';
include $urlPartner . '/app/varGlobal.php';
include $urlPartner . '/tarjetas.php';
include $urlPartner . '/sys.php';
include $urlPartner . '/root.php';
include $urlPartner . '/settings_sort.php';

session_start();
$usuarioingresado = $_SESSION['user'];
$pass = $_SESSION['pass'];
$rol = $_SESSION['rol'];

if (isset($_SESSION['user'])) {

    if ($rol == 1 || $rol == 2 || $rol == 3) {
        // No Code

    } elseif ($rol == 4) {
        echo '  <script type="text/javascript">
                    window.location.href = "param"; // Reemplaza con la URL a la que deseas redirigir
                </script>';
    }
} else {
    header('location: /user_v2/');
}


// PROMOS
// 1
$dataPromos = array();
$archivoJsonPromos = '../app/promotions.json';
if (file_exists($archivoJsonPromos) && ($contenidoJsonPromos = file_get_contents($archivoJsonPromos)) !== false) {
    $dataPromos = json_decode($contenidoJsonPromos, true);
}

// 2
$dataPromos_two = array();
$archivoJsonPromos_two = '../app/promotions2.json';
if (file_exists($archivoJsonPromos_two) && ($contenidoJsonPromos_two = file_get_contents($archivoJsonPromos_two)) !== false) {
    $dataPromos_two = json_decode($contenidoJsonPromos_two, true);
}

// 3
$dataPromos_tree = array();
$archivoJsonPromos_tree = '../app/promotions3.json';
if (file_exists($archivoJsonPromos_tree) && ($contenidoJsonPromos_tree = file_get_contents($archivoJsonPromos_tree)) !== false) {
    $dataPromos_tree = json_decode($contenidoJsonPromos_tree, true);
}

// REFERIDOS
// 1
$dataRef = array();
$archivoJsonRef = '../app/ref.json';
if (file_exists($archivoJsonRef) && ($contenidoJsonRef = file_get_contents($archivoJsonRef)) !== false) {
    $dataRef = json_decode($contenidoJsonRef, true);
}

// 2
$dataRef_two = array();
$archivoJsonRef_two = '../app/ref_two.json';
if (file_exists($archivoJsonRef_two) && ($contenidoJsonRef_two = file_get_contents($archivoJsonRef_two)) !== false) {
    $dataRef_two = json_decode($contenidoJsonRef_two, true);
}

// 3
$dataRef_tree = array();
$archivoJsonRef_tree = '../app/ref_tree.json';
if (file_exists($archivoJsonRef_tree) && ($contenidoJsoRefs_tree = file_get_contents($archivoJsonRef_tree)) !== false) {
    $dataRef_tree = json_decode($contenidoJsoRefs_tree, true);
}




// Subir imagen
$uploadPath = $urlPartner . '/assets/img/';
$status = $statusMsg = '';

if (isset($_POST["sub__img"])) {
    $status = 'error';

    $favicon = $_POST["favicon"];
    $Logo = $_POST["Logo"];
    $Creativo1 = $_POST["Creativo1"];
    $Creativo2 = $_POST["Creativo2"];
    $Portada1 = $_POST["Portada1"];
    $Portada2 = $_POST["Portada2"];

    $data = array(
        "favicon" => $favicon,
        "Logo" => $Logo,
        "portadaprincipal" => $Creativo1,
        "Sorteo1" => $Portada1,
        "Sorteo2" => $Creativo2,
        "Sorteo3" => $Portada2
    );


    // $data = array(
    //     "favicon" => $favicon,
    //     "Logo" => $Logo,
    //     "portadaprincipal" => $Creativo1,
    //     "Sorteo1" => $Creativo2,
    //     "Sorteo2" => $Portada1,
    //     "Sorteo3" => $Portada2
    // );

    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    $file_path = $urlPartner . '/app/sys.json';
    if (file_put_contents($file_path, $json_data)) {
    } else {
        echo "Error al guardar los datos en $file_path.";
    }
}

// Mensajes
if (isset($_POST['mns'])) {
    foreach ($_POST['idalu'] as $ids) {
        $editID = mysqli_real_escape_string($db, $_POST['idalu2'][$ids]);
        $editNom = mysqli_real_escape_string($db, $_POST['paWa'][$ids]);
        $editXD = mysqli_real_escape_string($db, $_POST['free'][$ids]);
        $actualizar = $db->query("UPDATE global SET globalSer='$editNom', descripLibre='$editXD' WHERE id='$ids'");
    }

    if ($actualizar == true) {
        header('Location: settings');
    } else {
        echo "No se subio la informacion correctamente, comunicate con Wichy";
    }
}

// Sociales
if (isset($_POST['social'])) {
    foreach ($_POST['idalu'] as $ids) {
        $editID = mysqli_real_escape_string($db, $_POST['idalu2'][$ids]);
        $editXD = mysqli_real_escape_string($db, $_POST['nom'][$ids]);
        $actualizar = $db->query("UPDATE global SET globalSer='$editXD', descripLibre='$editXD' WHERE id='$ids'");
    }

    if ($actualizar == true) {
        header('Location: settings');
    } else {
        echo "No se subio la informacion correctamente, comunicate con Wichy";
    }
}

?>
<!DOCTYPE html>
<html lang="en" class="dark-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Ajustes - <?php echo $importanteNombreCorto ?></title>


    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5">
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <!-- <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css"> -->
    <!-- <link rel="stylesheet" href="assets/vendor/fonts/afontawesome.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="assets/vendor/fonts/tabler-icons.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core-dark.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default-dark.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="assets/css/demo.css">



    <link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css">
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css">
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css">
    <style>
        .img__Server {
            margin-bottom: 12px !important;
            padding: 2px;
            border-radius: 15px;
            object-fit: cover;
            width: 150px;
            height: 150px;
        }
    </style>

    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    <script>
        function handleImageClick(imageUrl) {
            document.getElementById("imgValueInput").value = imageUrl;
            document.getElementById("imgValue").src = imageUrl;
            $('#imageModal4').modal('hide');
        }
    </script>
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            <?php
            include 'include/menu.php';
            ?>
            <!-- / Menu -->



            <!-- Layout container -->
            <div class="layout-page">





                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper mb-0">
                                <h3 class="nav-item nav-link search-toggler d-flex align-items-center px-0 m-0">Hola 👋 Estamos trabajando aqui</h3>
                            </div>
                        </div>

                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Quick links  -->
                            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class='ti ti-layout-grid-add ti-md'></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end py-0">
                                    <div class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Accesos directos</h5>
                                        </div>
                                    </div>
                                    <div class="dropdown-shortcuts-list scrollable-container">
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-ticket"></i>
                                                </span>
                                                <a href="/user_v2/status?id=1" class="stretched-link">Status Rifa / Sorteo</a>
                                                <small class="text-muted mb-0"><?php echo $infoSorteoNombre; ?></small>
                                            </div>
                                            <?php
                                            if ($infoSorteoNombre2 != ' ') { ?>
                                                <div class="dropdown-shortcuts-item col">
                                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                        <i class="ti ti-ticket"></i>
                                                    </span>
                                                    <a href="/user_v2/status?id=2" class="stretched-link">Status Rifa / Sorteo</a>
                                                    <small class="text-muted mb-0"><?php echo $infoSorteoNombre2; ?></small>
                                                </div>

                                            <?php } ?>
                                        </div>
                                        <?php
                                        if ($infoSorteoNombre3 != ' ') { ?>
                                            <div class="row row-bordered overflow-visible g-0">
                                                <div class="dropdown-shortcuts-item col">
                                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                        <i class="ti ti-ticket"></i>
                                                    </span>
                                                    <a href="/user_v2/status?id=3" class="stretched-link">Status Rifa / Sorteo</a>
                                                    <small class="text-muted mb-0"><?php echo $infoSorteoNombre3; ?></small>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                            <!-- Quick links -->


                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="assets/img/avatars/1.png" alt="" class="h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="assets/img/avatars/1.png" alt="" class="h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block"><?php echo $usuarioingresado; ?></span>
                                                    <small class="text-muted">Eres: <?php
                                                                                    if ($rol === '1') {
                                                                                        echo 'Super Admin';
                                                                                    } else if ($rol === '4') {
                                                                                        echo 'Only Manager';
                                                                                    }
                                                                                    ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/user_v2/settings">
                                            <i class="ti ti-settings me-2 ti-sm"></i>
                                            <span class="align-middle">Ajustes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/user_v2/logout" target="_blank">
                                            <i class="ti ti-logout me-2 ti-sm"></i>
                                            <span class="align-middle">Cerrar sesión</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->



                        </ul>
                    </div>


                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper  d-none">
                        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
                        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
                    </div>



                </nav>


                <!-- / Navbar -->



                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

                    <!-- 1era parte -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">

                        </div>
                    </div>

                    <!-- 2nda parte -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row">
                            <div class="container d-flex" style="flex-direction: column;align-items: center">
                                <h3 class="fw-bolder">Generador de Boletos para Sorteos</h3>
                                <!-- Formulario para  -->
                                <form id="formulario">
                                    <label for="numeroFinal" class="mb-1">Ultimo Número:</label>
                                    <input type="number" id="numeroFinal" name="numeroFinal" required class="form-control mb-2">
                                    <label for="oportunidades" class="mb-1">Oportunidades:</label>
                                    <input type="number" id="oportunidades" name="oportunidades" class="form-control mb-2">
                                    <label for="oportunidades" class="mb-1">Boletos para:</label>
                                    <?php
                                    echo "<select class='form-control' name='sorteo' id='sorteo' required>";
                                    if (!empty($infoSorteoNombre)) {
                                        echo "<option value='1'>$infoSorteoNombre</option>";
                                    }
                                    if (!empty($infoSorteoNombre2)) {
                                        echo "<option value='2'>$infoSorteoNombre2</option>";
                                    }
                                    if (!empty($infoSorteoNombre3)) {
                                        echo "<option value='3'>$infoSorteoNombre3</option>";
                                    }
                                    echo "</select>\n";
                                    ?>
                                    <button class="mt-3 btn btn-dark w-100" type="submit">Generar</button>
                                </form>
                                <h2>Resultado:</h2>
                                <pre id="resultado"></pre>

                                <!-- <script>
                                    function generarArraysAleatorios(numeroFinal, oportunidades = 0) {
                                        const resultados = [];
                                        const queries = [];
                                        function convertirA2Digitos(numero, final) {
                                            const longitudFinal = final.toString().length;
                                            const longitud = numero.toString().length;
                                            const ceros = '0'.repeat(longitudFinal - longitud);
                                            return ceros + numero.toString();
                                        }
                                        const sorteoSeleccionado = document.getElementById('sorteo').value;
                                        let dbSelect = '';
                                        if (sorteoSeleccionado === '1') {
                                            dbSelect = 'info_boletos';

                                        } else if (sorteoSeleccionado === '2') {
                                            dbSelect = 'info_boletos_two';

                                        } else if (sorteoSeleccionado === '3') {
                                            dbSelect = 'info_boletos_tree';

                                        }
                                        if (oportunidades === 0) {
                                            for (let i = 0; i <= numeroFinal; i++) {
                                                const boleto = convertirA2Digitos(i, numeroFinal); // Formatea a longitud consistente.
                                                const insertSQL = `INSERT INTO ${dbSelect} (boleto, opp, statusBoleto) VALUES ('${boleto}', '', 'No');`;
                                                queries.push(insertSQL);
                                                resultados.push([boleto]);
                                            }
                                        } else {
                                            const numeroF = numeroFinal + 1;
                                            const maximo = numeroF * oportunidades;
                                            const final = maximo - 1;
                                            const todosLosNumerosPrimeros = Array.from({
                                                length: maximo
                                            }, (_, i) => i).slice(numeroF);

                                            const sorteoSeleccionado = document.getElementById('sorteo').value;
                                            let dbSelect = '';
                                            if (sorteoSeleccionado === 1) {
                                                dbSelect = 'info_boletos';

                                            } else if (sorteoSeleccionado === 2) {
                                                dbSelect = 'info_boletos_two';

                                            } else if (sorteoSeleccionado === 3) {
                                                dbSelect = 'info_boletos_tree';

                                            }

                                            for (let i = 0; i <= numeroFinal; i++) {
                                                const arrayTemporal = [];
                                                const primerElemento = convertirA2Digitos(i, final);
                                                arrayTemporal.push(primerElemento);

                                                for (let j = 0; j < oportunidades - 1; j++) {
                                                    if (todosLosNumerosPrimeros.length === 0) break;

                                                    const indiceAleatorio = Math.floor(Math.random() * todosLosNumerosPrimeros.length);
                                                    const numeroAleatorioFormateado = convertirA2Digitos(todosLosNumerosPrimeros[indiceAleatorio], final);
                                                    arrayTemporal.push(numeroAleatorioFormateado);

                                                    todosLosNumerosPrimeros.splice(indiceAleatorio, 1);
                                                }

                                                const valores = arrayTemporal.slice(1).join(", ");
                                                const insertSQL = `INSERT INTO ${dbSelect} (boleto, opp, statusBoleto) VALUES ('${primerElemento}', '${valores}', 'No');`;
                                                queries.push(insertSQL);
                                                resultados.push(arrayTemporal);
                                            }
                                        }

                                        return {
                                            resultados,
                                            queries
                                        };
                                    }

                                    function tieneNumerosRepetidos(array) {
                                        const conjuntoNumeros = new Set(array);
                                        return array.length !== conjuntoNumeros.size;
                                    }


                                    // Ejemplo de uso
                                    document.getElementById('formulario').addEventListener('submit', function(e) {
                                        e.preventDefault();

                                        const numeroFinal = parseInt(document.getElementById('numeroFinal').value);
                                        let oportunidades = parseInt(document.getElementById('oportunidades').value);

                                        // Si oportunidades no se proporciona o es NaN, ajustamos a 0.
                                        if (isNaN(oportunidades)) {
                                            oportunidades = 0;
                                        }

                                        const {
                                            resultados,
                                            queries
                                        } = generarArraysAleatorios(numeroFinal, oportunidades);

                                        const hayRepeticiones = resultados.some(array => tieneNumerosRepetidos(array));

                                        if (hayRepeticiones) {
                                            alert("Hay números repetidos en los arrays.");
                                        } else {
                                            alert("Todo listo para subir a la base de datos.");
                                            console.log(JSON.stringify({
                                                queries
                                            }));

                                            fetch('procesarBoletos.php', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json'
                                                    },
                                                    body: JSON.stringify({
                                                        queries
                                                    })
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        alert("Datos insertados correctamente.");
                                                    } else {
                                                        alert("Error al insertar los datos.");
                                                        console.error(data.error);
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error("Error en la solicitud:", error);
                                                });
                                        }

                                        document.getElementById('resultado').textContent = JSON.stringify(resultados, null, 2);
                                    });
                                </script> -->
                                <script>
                                    function generarArraysAleatorios(numeroFinal, oportunidades = 0) {
                                        const resultados = [];
                                        const queries = [];

                                        function convertirA2Digitos(numero, final) {
                                            const longitudFinal = final.toString().length;
                                            const longitud = numero.toString().length;
                                            const ceros = '0'.repeat(longitudFinal - longitud);
                                            return ceros + numero.toString();
                                        }
                                        const sorteoSeleccionado = document.getElementById('sorteo').value;
                                        let dbSelect = '';
                                        if (sorteoSeleccionado === '1') {
                                            dbSelect = 'info_boletos';
                                        } else if (sorteoSeleccionado === '2') {
                                            dbSelect = 'info_boletos_two';
                                        } else if (sorteoSeleccionado === '3') {
                                            dbSelect = 'info_boletos_tree';
                                        }

                                        if (oportunidades === 0) {
                                            for (let i = 0; i <= numeroFinal; i++) {
                                                const boleto = convertirA2Digitos(i, numeroFinal);
                                                const insertSQL = `INSERT INTO ${dbSelect} (boleto, opp, statusBoleto) VALUES ('${boleto}', '', 'No');`;
                                                // console.log(insertSQL);
                                                queries.push(insertSQL);
                                                resultados.push([boleto]);
                                            }
                                        } else {
                                            const numeroF = numeroFinal + 1;
                                            const maximo = numeroF * oportunidades;
                                            const final = maximo - 1;
                                            const todosLosNumerosPrimeros = Array.from({
                                                length: maximo
                                            }, (_, i) => i).slice(numeroF);

                                            for (let i = 0; i <= numeroFinal; i++) {
                                                const arrayTemporal = [];
                                                const primerElemento = convertirA2Digitos(i, final);
                                                arrayTemporal.push(primerElemento);

                                                for (let j = 0; j < oportunidades - 1; j++) {
                                                    if (todosLosNumerosPrimeros.length === 0) break;

                                                    const indiceAleatorio = Math.floor(Math.random() * todosLosNumerosPrimeros.length);
                                                    const numeroAleatorioFormateado = convertirA2Digitos(todosLosNumerosPrimeros[indiceAleatorio], final);
                                                    arrayTemporal.push(numeroAleatorioFormateado);

                                                    todosLosNumerosPrimeros.splice(indiceAleatorio, 1);
                                                }

                                                const valores = arrayTemporal.slice(1).join(", ");
                                                const insertSQL = `INSERT INTO ${dbSelect} (boleto, opp, statusBoleto) VALUES ('${primerElemento}', '${valores}', 'No');`;
                                                // console.log(insertSQL);
                                                queries.push(insertSQL);
                                                resultados.push(arrayTemporal);
                                            }
                                        }

                                        return {
                                            resultados,
                                            queries
                                        };
                                    }

                                    function tieneNumerosRepetidos(array) {
                                        const conjuntoNumeros = new Set(array);
                                        return array.length !== conjuntoNumeros.size;
                                    }

                                    async function subirDatosEnChunks(queries, chunkSize = 2000) {
                                        for (let i = 0; i < queries.length; i += chunkSize) {
                                            const chunk = queries.slice(i, i + chunkSize);

                                            try {
                                                const response = await fetch('procesarBoletos.php', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json'
                                                    },
                                                    body: JSON.stringify({
                                                        queries: chunk
                                                    })
                                                });
                                                const data = await response.json();

                                                if (!data.success) {
                                                    console.error(`Error al insertar el chunk:`, data.error);
                                                } else {
                                                    console.log(`Chunk ${i / chunkSize + 1} subido correctamente.`);
                                                }
                                            } catch (error) {
                                                console.error(`Error en la solicitud para el chunk ${i / chunkSize + 1}:`, error);
                                            }
                                        }

                                        alert('Todos los datos han sido subidos correctamente.');
                                    }

                                    document.getElementById('formulario').addEventListener('submit', async function(e) {
                                        e.preventDefault();

                                        const numeroFinal = parseInt(document.getElementById('numeroFinal').value);
                                        let oportunidades = parseInt(document.getElementById('oportunidades').value);

                                        if (isNaN(oportunidades)) {
                                            oportunidades = 0;
                                        }

                                        const {
                                            resultados,
                                            queries
                                        } = generarArraysAleatorios(numeroFinal, oportunidades);

                                        const hayRepeticiones = resultados.some(array => tieneNumerosRepetidos(array));

                                        if (hayRepeticiones) {
                                            alert("Hay números repetidos en los arrays.");
                                        } else {
                                            alert("Comenzando la carga en chunks.");
                                            await subirDatosEnChunks(queries);
                                        }

                                        document.getElementById('resultado').textContent = JSON.stringify(resultados, null, 2);
                                    });
                                </script>

                            </div>
                        </div>
                    </div>


                    <!-- / Content -->
                    <div class="content-wrapper">
                        <?php include 'include/footer.php'; ?>
                        <!-- / Footer -->


                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>



            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>


            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>

        </div>
        <!-- / Layout wrapper -->





        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="assets/vendor/libs/jquery/jquery.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js" integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/cleanpaste/trumbowyg.cleanpaste.min.js" integrity="sha512-UInqT8f+K1tkck6llPo0HDxlT/Zxv8t4OGeCuVfsIlXLrnP1ZKDGb+tBsBPMqDW15OcmV8NDfQe9+EaAG4aXeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/pasteimage/trumbowyg.pasteimage.min.js" integrity="sha512-ixvsqe8yYdC0qzr+u6sjbUZeYq3wWD+D/SJSgQ9pt/wm5qbeZBzUBrfqGKlWnqnqRwvTFoF2kva6OKt39a1Cww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/colors/trumbowyg.colors.min.js" integrity="sha512-SHpxBJFbCaHlqGpH13FqtSA+QQkQfdgwtpmcWedAXFCDxAYMgrqj9wbVfwgp9+HgIT6TdozNh2UlyWaXRkiurw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/mns.js"></script>

        <script src="assets/vendor/libs/popper/popper.js"></script>
        <script src="assets/vendor/js/bootstrap.js"></script>
        <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
        <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="assets/vendor/libs/hammer/hammer.js"></script>
        <script src="assets/vendor/libs/i18n/i18n.js"></script>
        <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
        <script src="assets/vendor/js/menu.js"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="assets/js/main.js"></script>


        <!-- Page JS -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
        <script src="assets/js/dashboards-crm.js"></script>
        <script>
            $(document).ready(function() {
                $('.referidoLink').on('click', function(event) {
                    event.preventDefault();
                    var textoReferido = $(this).attr('href');
                    var titleRifa = $(this).data('titlesort');

                    // Crea un elemento de texto oculto
                    var tempInput = $('<textarea>');
                    tempInput.css('position', 'absolute');
                    tempInput.css('left', '-9999px');
                    tempInput.css('top', '-9999px');
                    tempInput.val(`Participa en *${titleRifa}* usando mi codigo
${textoReferido}`);

                    // Añade el elemento al DOM
                    $('body').append(tempInput);

                    // Selecciona y copia el contenido del elemento
                    tempInput.select();
                    document.execCommand('copy');

                    // Elimina el elemento temporal
                    tempInput.remove();

                    // Puedes mostrar una alerta u otra notificación al usuario
                    alert('Link copiado al portapapeles');

                    // Redirecciona al usuario al enlace original
                    // window.location.href = $(this).attr('href');
                });
                $('.simple-editor').trumbowyg({
                    btns: [
                        ['viewHTML'],
                        ['undo', 'redo'], // Only supported in Blink browsers
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['superscript', 'subscript'],
                        ['link'],
                        // ['insertImage'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['removeformat'],
                        ['fullscreen'],
                        ['foreColor', 'backColor']
                    ]

                });

                $('.col').click(function() {
                    var id = $(this).attr('id');
                    var idParam = $(this).attr('idParam');
                    var imgValue = $(this).find('.imgBanco').attr('src');
                    var bacoValue = $(this).find('.nombreBanco').val();
                    var tipoValue = $(this).find('.tipo').val();
                    var nombreValue = $(this).find('.nombrePersona').val();
                    var clabeValue = $(this).find('.clave').val();
                    var numeroValue = $(this).find('.numero').val();

                    $("#tarjetasModal").modal("show");
                    $('#nombreBanco').val(bacoValue);
                    $('#parametro').val(idParam);
                    $('#imgValue').attr('src', imgValue);
                    $('#imgValueInput').val(imgValue);
                    $('#tipoValue').val(tipoValue);
                    $('.tipoValue').text('Actualmente: ' + tipoValue);
                    $('#nombreValue').val(nombreValue);
                    $('#clabeValue').val(clabeValue);
                    $('#numeroValue').val(numeroValue);
                });

                $('#imgValue').click(function() {
                    $("#imageModal4").modal("show");

                });

                $('.img_modal_src4 .imagen').click(function() {
                    console.log('Click');
                    var urlImagen = $(this).attr('src');

                });
            });



            let globalData_field = '';

            $(document).ready(function() {
                // Configurar evento de eliminación para las filas
                $("#promoTable").on("click", ".removeRowButton", function() {
                    $(this).closest("tr").remove();
                });

                $("#promoTable2").on("click", ".removeRowButton2", function() {
                    $(this).closest("tr").remove();
                });

                $("#promoTable3").on("click", ".removeRowButton3", function() {
                    $(this).closest("tr").remove();
                });


                // Referidos
                $("#refTable").on("click", ".removeRowButton4", function() {
                    $(this).closest("tr").remove();
                });

                $("#refTable2").on("click", ".removeRowButton5", function() {
                    $(this).closest("tr").remove();
                });

                $("#refTable3").on("click", ".removeRowButton6", function() {
                    $(this).closest("tr").remove();
                });

                // Promos
                $("#addRowButton").click(function() {
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="number" name="numero[]" placeholder="Boleto" min="1" step="1"></td>
                                            <td><input class='form-control buttons__rad' type="number" name="valor[]" placeholder="Precio" min="1" step="1"></td>
                                            <td><button class='btn btn-danger removeRowButton buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#promoTable tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                $("#addRowButton2").click(function() {
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="number" name="numero_two[]" placeholder="Boleto" min="1" step="1"></td>
                                            <td><input class='form-control buttons__rad' type="number" name="valor_two[]" placeholder="Precio" min="1" step="1"></td>
                                            <td><button class='btn btn-danger removeRowButton2 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#promoTable2 tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                $("#addRowButton3").click(function() {
                    console.log('click');
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="number" name="numero_tree[]" placeholder="Boleto" min="1" step="1"></td>
                                            <td><input class='form-control buttons__rad' type="number" name="valor_tree[]" placeholder="Precio" min="1" step="1"></td>
                                            <td><button class='btn btn-danger removeRowButton3 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#promoTable3 tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                // Referidos
                $("#addRowButton1").click(function() {
                    console.log('clo');
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="text" name="referidor[]" placeholder="Escribe un nuevo Referido" pattern="[A-Za-z]+" title="Solo se permiten letras" value="">
                                            <input class='form-control buttons__rad d-none' type="text" name="numero[]" placeholder="Escribe un nuevo Referido" title="Solo se permiten letras" value="0"></td>
                                            <td><button class='btn btn-danger removeRowButton4 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#refTable tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                $("#addRowButton21").click(function() {
                    console.log('clo');
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="text" name="referidor_two[]" placeholder="Escribe un nuevo Referido" pattern="[A-Za-z]+" title="Solo se permiten letras" value="">
                                            <input class='form-control buttons__rad d-none' type="text" name="numero_two[]" placeholder="Escribe un nuevo Referido" title="Solo se permiten letras" value="0"></td>
                                            <td><button class='btn btn-danger removeRowButton5 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#refTable2 tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });

                $("#addRowButton31").click(function() {
                    console.log('clo');
                    const newRow = `
                                        <tr>
                                            <td><input class='form-control buttons__rad' type="text" name="referidor_tree[]" placeholder="Escribe un nuevo Referido" pattern="[A-Za-z]+" title="Solo se permiten letras" value="">
                                            <input class='form-control buttons__rad d-none' type="text" name="numero_tree[]" placeholder="Escribe un nuevo Referido" title="Solo se permiten letras" value="0"></td>
                                            <td><button class='btn btn-danger removeRowButton6 buttons__rad' type="button">Eliminar</button></td>
                                        </tr>
                                    `;
                    $("#refTable3 tbody").append(newRow); // Agregar la nueva fila dentro de <tbody>
                });


            });


            // Variable para almacenar el índice de fila
            let rowIndex = -1;
            let rowIndex2 = -1;
            let rowIndex3 = -1;


            $(document).ready(function() {
                // Función para adjuntar el manejador de eventos al botón "Local"
                let cam = '';
                let cam2 = '';
                let cam3 = '';


                function attachButtonClickHandler(column) {
                    $(`.openModal[data-column="${column}"]`).on("click", function() {
                        // Encontrar la fila (tr) en la que se hizo clic
                        const clickedRow = $(this).closest("tr");
                        // Obtener el índice de fila y almacenarlo en la variable externa
                        rowIndex = $("#dataTable tr").index(clickedRow);
                        // Mostrar el índice de la fila en la consola
                        console.log(`Se hizo clic en el botón ${column} en la fila #` + rowIndex);
                        cam = column;
                    });
                }

                function attachButtonClickHandler2(column) {
                    $(`.openModal2[data-column="${column}"]`).on("click", function() {
                        // Encontrar la fila (tr) en la que se hizo clic
                        const clickedRow = $(this).closest("tr");
                        // Obtener el índice de fila y almacenarlo en la variable externa
                        rowIndex = $("#dataTable2 tr").index(clickedRow);
                        // Mostrar el índice de la fila en la consola
                        console.log(`2 Se hizo clic en el botón ${column} en la fila #` + rowIndex);
                        cam2 = column;
                    });
                }

                function attachButtonClickHandler3(column) {
                    $(`.openModal3[data-field="${column}"]`).on("click", function() {
                        console.log('click fiels');
                        const clickedRow = $(this);
                        console.log(clickedRow);
                    });
                }

                // Adjuntar un manejador de eventos 'click' en '#imageModal img' una sola vez
                $(document).on("click", "#imageModal img", function() {
                    if (rowIndex !== -1) {
                        // Obtener el nombre de la imagen desde el atributo "alt"
                        const imageName = $(this).attr("alt");
                        // Mostrar el nombre de la imagen en la consola junto con rowIndex
                        console.log("Nombre de la imagen: " + imageName + ' ' + rowIndex + ' ' + cam);
                        // Establecer el valor en el input 'Local' correspondiente en la misma fila
                        const localInputForRow = $("#dataTable tr").eq(rowIndex).find(`input.${cam.toLowerCase()}`);
                        console.log(localInputForRow);
                        localInputForRow.val(imageName);

                        const imageForRow = $("#dataTable tr").eq(rowIndex).find(`img.${cam.toLowerCase()}`);
                        imageForRow.attr("src", '../assets/img/team/' + imageName);

                        $("#imageModal").modal("hide");
                    }
                });

                $(document).on("click", "#imageModal2 img", function() {
                    console.log('click 2');
                    if (rowIndex !== -1) {
                        // Obtener el nombre de la imagen desde el atributo "alt"
                        const imageName = $(this).attr("alt");
                        // Mostrar el nombre de la imagen en la consola junto con rowIndex
                        console.log("2Nombre de la imagen: " + imageName + ' ' + rowIndex + ' ' + cam2);
                        // Establecer el valor en el input 'Local' correspondiente en la misma fila
                        const localInputForRow = $("#dataTable2 tr").eq(rowIndex).find(`input.${cam2.toLowerCase()}`);
                        console.log(localInputForRow);
                        localInputForRow.val(imageName);

                        const imageForRow = $("#dataTable2 tr").eq(rowIndex).find(`img.${cam2.toLowerCase()}`);
                        imageForRow.attr("src", '../assets/img/team/' + imageName);

                        $("#imageModal2").modal("hide");
                    }
                });

                $(document).on("click", "#imageModal3 img", function() {
                    const imageName = $(this).attr("alt");
                    $("img[data-field='" + globalData_field + "']").attr("src", "/assets/img/" + imageName);
                    $("input[data-target='" + globalData_field + "']").val(imageName);
                    $("#imageModal3").modal("hide");

                });



                // Adjuntar un manejador de eventos 'click' en el botón "Agregar"
                $("#addRow").click(function() {
                    const newRow = `
                <tr>
                    <td class=''>
                    <!--<input class='form-control buttons__rad' type='text' name="nombreTeamlLocal[]" value=''> -->
                        <input class="form-control buttons__rad" list="teams" id="team" name='nombreTeamlLocal[]' value=''>
                        <datalist id="teams">
                            <option value="América">
                            <option value="Atlas">
                            <option value="A. San Luis">
                            <option value="Xolos">
                            <option value="Cruz azul">
                            <option value="Bravos">
                            <option value="Chivas">
                            <option value="León">
                            <option value="Mazatlán">
                            <option value="Rayado">
                            <option value="Necaxa">
                            <option value="Pachuca">
                            <option value="Puebla">
                            <option value="Pumas">
                            <option value="G. Blancos">
                            <option value="Santos">
                            <option value="Tigres">
                            <option value="Tocula">
                        </datalist>
                        <input type='text' class='local' name='local[]' value='' hidden>
                        <img class="local mt-2 buttons__rad" src='../assets/img/no-pic.png' alt='' style="width:130px;height: 130px;object-fit: cover;border: solid #00000017;">
                        <button class='btn btn-primary openModal buttons__rad' type="button" data-column='Local' data-image=''>Local</button>
                    </td>
                    <td class=''>
                        <!-- <input class='form-control buttons__rad' type='text' name="nombreTeamVisitante[]" value=''> -->
                        <input class="form-control buttons__rad" list="teams" id="team" name='nombreTeamVisitante[]' value=''>
                        <datalist id="teams">
                            <option value="América">
                            <option value="Atlas">
                            <option value="A. San Luis">
                            <option value="Xolos">
                            <option value="Cruz azul">
                            <option value="Bravos">
                            <option value="Chivas">
                            <option value="León">
                            <option value="Mazatlán">
                            <option value="Rayado">
                            <option value="Necaxa">
                            <option value="Pachuca">
                            <option value="Puebla">
                            <option value="Pumas">
                            <option value="G. Blancos">
                            <option value="Santos">
                            <option value="Tigres">
                            <option value="Tocula">
                        </datalist>
                        <input type='text' class='visitante' name='visitante[]' value='' hidden>
                        <img class="visitante mt-2 buttons__rad" src='../assets/img/no-pic.png' alt='' style="width:130px;height: 130px;object-fit: cover;border: solid #00000017;">
                        <button class='btn btn-success openModal buttons__rad' type="button" data-column='Visitante' data-image=''>Visitante</button>
                    </td>
                    <td>
                        <button class='btn btn-danger deleteRow buttons__rad' type="button">Eliminar</button>
                    </td>
                </tr>
            `;


                    $("#dataTable").append(newRow);
                    // Adjuntar el manejador de eventos al botón "Local" en la fila recién creada
                    // attachLocalButtonClickHandler();
                    attachButtonClickHandler("Local");
                    attachButtonClickHandler("Visitante");


                });

                $("#addRow2").click(function() {
                    const newRow = `
                <tr>
                    <td class=''>
                        <!--<input class='form-control buttons__rad' type='text' name="nombreTeamlLocal[]" value=''> -->
                        <input class="form-control buttons__rad" list="teams" id="team" name='nombreTeamlLocal[]' value=''>
                        <datalist id="teams">
                            <option value="América">
                            <option value="Atlas">
                            <option value="A. San Luis">
                            <option value="Xolos">
                            <option value="Cruz azul">
                            <option value="Bravos">
                            <option value="Chivas">
                            <option value="León">
                            <option value="Mazatlán">
                            <option value="Rayado">
                            <option value="Necaxa">
                            <option value="Pachuca">
                            <option value="Puebla">
                            <option value="Pumas">
                            <option value="G. Blancos">
                            <option value="Santos">
                            <option value="Tigres">
                            <option value="Tocula">
                        </datalist>
                        <input type='text' class='local' name='local[]' value='' hidden>
                        <img class="local mt-2 buttons__rad" src='../assets/img/no-pic.png' alt='' style="width:130px;height: 130px;object-fit: cover;border: solid #00000017;">
                        <button class='btn btn-primary openModal2 buttons__rad' type="button" data-column='Local' data-image=''>Local</button>
                    </td>
                    <td class=''>
                        <!-- <input class='form-control buttons__rad' type='text' name="nombreTeamVisitante[]" value=''> -->
                        <input class="form-control buttons__rad" list="teams" id="team" name='nombreTeamVisitante[]' value=''>
                        <datalist id="teams">
                            <option value="América">
                            <option value="Atlas">
                            <option value="A. San Luis">
                            <option value="Xolos">
                            <option value="Cruz azul">
                            <option value="Bravos">
                            <option value="Chivas">
                            <option value="León">
                            <option value="Mazatlán">
                            <option value="Rayado">
                            <option value="Necaxa">
                            <option value="Pachuca">
                            <option value="Puebla">
                            <option value="Pumas">
                            <option value="G. Blancos">
                            <option value="Santos">
                            <option value="Tigres">
                            <option value="Tocula">
                        </datalist>
                        <input type='text' class='visitante' name='visitante[]' value='' hidden>
                        <img class="visitante mt-2 buttons__rad" src='../assets/img/no-pic.png' alt='' style="width:130px;height: 130px;object-fit: cover;border: solid #00000017;">
                        <button class='btn btn-success openModal2 buttons__rad' type="button" data-column='Visitante' data-image=''>Visitante</button>
                    </td>
                    <td>
                        <button class='btn btn-danger deleteRow buttons__rad' type="button">Eliminar</button>
                    </td>
                </tr>
            `;


                    $("#dataTable2").append(newRow);
                    // Adjuntar el manejador de eventos al botón "Local" en la fila recién creada
                    // attachLocalButtonClickHandler();
                    attachButtonClickHandler2("Local");
                    attachButtonClickHandler2("Visitante");
                });

                // Adjuntar el manejador de eventos al botón "Local" en las filas existentes
                // attachLocalButtonClickHandler();
                attachButtonClickHandler("Local");
                attachButtonClickHandler("Visitante");

                attachButtonClickHandler2("Local");
                attachButtonClickHandler2("Visitante");

                attachButtonClickHandler3("favicon");
                attachButtonClickHandler3("Logo");
                attachButtonClickHandler3("Creativo1");
                attachButtonClickHandler3("Creativo2");
                attachButtonClickHandler3("Portada1");
                attachButtonClickHandler3("Portada2");


                // Eliminar una fila al hacer clic en el botón "Eliminar"
                $(document).on("click", ".deleteRow", function() {
                    $(this).closest("tr").remove();
                });

                // Abrir el modal al hacer clic en los botones "Local" o "Visitante" y mostrar la columna
                $(document).on("click", ".openModal", function() {
                    const imageSrc = $(this).data("image");
                    const column = $(this).data("column");
                    console.log('xxxxxxxxxxxxxxxxxxxxx');
                    $("#modalImage").attr("src", imageSrc);
                    console.log($("#modalImage").attr("src", imageSrc));
                    $("#imageModalLabel").text("1 Imágenes de " + column);
                    $("#imageModal").modal("show");
                });

                $(document).on("click", ".openModal2", function() {
                    const imageSrc = $(this).data("image");
                    const column = $(this).data("column");
                    console.log('yyyyyyyyyyyy');
                    $("#modalImage2").attr("src", imageSrc);
                    console.log($("#modalImage2").attr("src", imageSrc));
                    $("#imageModalLabel2").text("2 Imágenes de " + column);
                    $("#imageModal2").modal("show");
                });

                $(document).on("click", ".openModal3", function() {
                    globalData_field = $(this).data("field");
                    console.log(globalData_field);


                    // globalData_field
                    $("#imageModal3").modal("show");

                });

            });




            // esto es para subir la imagen 
            const inputImagen = document.getElementById("imagen");
            inputImagen.addEventListener("change", function() {
                const formData = new FormData();
                formData.append("imagen", inputImagen.files[0]);

                // Envía la imagen al servidor
                fetch("subir_imagen.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Actualiza el modal con las nuevas imágenes
                        const modalBody = document.querySelector(".img_modal_src");
                        modalBody.innerHTML = "";

                        data.imagenes.forEach(imagen => {
                            modalBody.innerHTML += `
                        <img src="../assets/img/team/${imagen}" alt="${imagen}" class="img-fluid imagen-modal m-2" data-nombre="${imagen}" style="width:100px;height: 100px;object-fit: cover;">
                    `;
                        });

                        // Limpia el campo de carga de imágenes
                        inputImagen.value = "";
                    })
                    .catch(error => console.error("Error al cargar la imagen:", error));
            });

            const inputImagen2 = document.getElementById("imagen2");
            inputImagen2.addEventListener("change", function() {
                const formData = new FormData();
                formData.append("imagen", inputImagen2.files[0]);

                // Envía la imagen al servidor
                fetch("subir_imagen.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Actualiza el modal con las nuevas imágenes
                        const modalBody = document.querySelector(".img_modal_src2");
                        modalBody.innerHTML = "";

                        data.imagenes.forEach(imagen => {
                            modalBody.innerHTML += `
                        <img src="../assets/img/team/${imagen}" alt="${imagen}" class="img-fluid imagen-modal m-2" data-nombre="${imagen}" style="width:100px;height: 100px;object-fit: cover;">
                    `;
                        });

                        // Limpia el campo de carga de imágenes
                        inputImagen2.value = "";
                    })
                    .catch(error => console.error("Error al cargar la imagen:", error));
            });

            const inputImagen3 = document.getElementById("imagen3");
            inputImagen3.addEventListener("change", function() {
                const formData = new FormData();
                formData.append("imagen", inputImagen3.files[0]);

                // Envía la imagen al servidor
                fetch("subir_imagen_creativos.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Actualiza el modal con las nuevas imágenes
                        const modalBody = document.querySelector(".img_modal_src3");
                        modalBody.innerHTML = "";

                        data.imagenes.forEach(imagen => {
                            modalBody.innerHTML += `
                        <img src="../assets/img/${imagen}" alt="${imagen}" class="img-fluid imagen-modal m-2" data-nombre="${imagen}" style="width:100px;height: 100px;object-fit: cover;">
                    `;
                        });

                        // Limpia el campo de carga de imágenes
                        inputImagen3.value = "";
                    })
                    .catch(error => console.error("Error al cargar la imagen:", error));
            });
        </script>
        <script src="edit.js"></script>
        <script src="js/ajax__actions.js"></script>

</body>

</html>