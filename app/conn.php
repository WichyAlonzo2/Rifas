<?php
    include 'vConn.php';
    $servidor= $local;
    $usuario= $usuario;
    $password = $contra;
    $nombreBD= $dataBase;
    
    $db = new mysqli($servidor, $usuario, $password, $nombreBD);
    if ($db->connect_error) {
        die("Error con la conexión al servidor " . $db->connect_error);
    }
    
    if (!$db->set_charset("utf8mb4")) {exit();}           

    $urlPartner = 'https://localhost/';
    $production = false;
?>