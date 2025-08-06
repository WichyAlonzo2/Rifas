<?php
    include 'conn.php';

    $cliente = true;
    $apartado = 'Apartado';
    $pendiente = 'Pendiente';
    $payCompleto = 'Pagado';

    //////////////////////////// BASE DE DATOS VAR  ////////////////////////////
    // Variables Base de Datos (Soporta 2)
    // Variables Globales
    $maquinita = 'maquinita';
    $estados = 'estados';


    // Tabla 1
    $info_bol = 'info_boletos'; 
    $sort_min = 'sorteomini';
    $ajustes = 'global';

    // Tabla dos
    $info_bolx = 'info_boletos_two'; 
    $sort_minx = 'sorteomini_two';
    $ajustesx = 'globaldos';

    $info_bolxx = 'info_boletos_tree'; 
    $sort_minxx = 'sorteomini_tree';
    $ajustesxx = 'globaldos';


    ////////////////////////////// Mensajes //////////////////////////////
    // Mensaje de Compra
    $query = "SELECT * FROM `global` WHERE id=2;";  
    $result_tasks = mysqli_query($db, $query); 
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
            $mnsCompra =  $global['globalSer'];
            $mnsCompraBr =  $global['descripLibre'];
        }

    // Mensaje de Advertencia
    $query = "SELECT * FROM `global` WHERE id=3;";  
    $result_tasks = mysqli_query($db, $query); 
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
            $mnsAdvertencia =  $global['globalSer'];
            $mnsAdvertenciaBr =  $global['descripLibre'];
        }

    // Mensaje de Eliminar
    $query = "SELECT * FROM `global` WHERE id=4;";  
    $result_tasks = mysqli_query($db, $query); 
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
            $mnsEliminar =  $global['globalSer'];
            $mnsEliminarBr =  $global['descripLibre'];
        }

    // Mensaje de Pago
    $query = "SELECT * FROM `global` WHERE id=6;";  
    $result_tasks = mysqli_query($db, $query); 
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
            $mnsPago =  $global['globalSer'];
            $mnsPagoBr =  $global['descripLibre'];
        }

    

    ////////////////////////////// Redes sociales //////////////////////////////
    // WhatsApp 1
    $query = "SELECT * FROM `global` WHERE id=11;";  
    $result_tasks = mysqli_query($db, $query); 
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
            $whatsAppUno =  $global['globalSer'];
        }


    // WhatsApp 2
    $query = "SELECT * FROM `global` WHERE id=12;";  
    $result_tasks = mysqli_query($db, $query); 
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
            $whatsAppDos =  $global['globalSer'];
        }

    // WhatsApp 3
    $query = "SELECT * FROM `global` WHERE id=13;";  
    $result_tasks = mysqli_query($db, $query); 
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
            $whatsAppTres =  $global['globalSer'];
        }

    // WhatsApp 4
    $query = "SELECT * FROM `global` WHERE id=14;";  
    $result_tasks = mysqli_query($db, $query); 
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
            $whatsAppCuatro =  $global['globalSer'];
        }

    // WhatsApp 5
    $query = "SELECT * FROM `global` WHERE id=15;";  
    $result_tasks = mysqli_query($db, $query); 
        while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
            $whatsAppCinco =  $global['globalSer'];
        }


    $query = "SELECT * FROM `global` WHERE idWhatsApp=1;";  
    $result_tasks = mysqli_query($db, $query); 
    while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
        $whatsAppRandom =  $global['globalSer'];
    }



    // Facebook
    $query = "SELECT * FROM `global` WHERE id=7;";  
    $result_tasks = mysqli_query($db, $query); 
    while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
        $facebook =  $global['globalSer'];
    }

    // Instagram
    $query = "SELECT * FROM `global` WHERE id=8;";  
    $result_tasks = mysqli_query($db, $query); 
    while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
        $instagram =  $global['globalSer'];
    }

    // Twitter
    $query = "SELECT * FROM `global` WHERE id=9;";  
    $result_tasks = mysqli_query($db, $query); 
    while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
        $tiktok =  $global['globalSer'];
    }

    // Youtube
    $query = "SELECT * FROM `global` WHERE id=10;";  
    $result_tasks = mysqli_query($db, $query); 
    while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
        $youtube =  $global['globalSer'];
    }

    // Youtube
    $query = "SELECT * FROM `global` WHERE id=16;";  
    $result_tasks = mysqli_query($db, $query); 
    while ($global = $result_tasks->fetch_array(MYSQLI_BOTH)){
        $grupoWhatsApp =  $global['globalSer'];
    }

?>