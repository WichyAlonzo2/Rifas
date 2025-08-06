<?php
include '../../app/vConn.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // variables para insertar
    $apiKey = $_POST['apiKey'];
    $authDomain = $_POST['authDomain'];
    $databaseURL = $_POST['databaseURL'];
    $projectId = $_POST['projectId'];
    $storageBucket = $_POST['storageBucket'];
    $messagingSenderId = $_POST['messagingSenderId'];
    $appId = $_POST['appId'];
    $measurementId = $_POST['measurementId'];
    $Clavedelservidor = $_POST['Clavedelservidor'];

    $data = [
        "apiKey" => $apiKey,
        "authDomain" => $authDomain,
        "databaseURL" => $databaseURL,
        "projectId" => $projectId,
        "storageBucket" => $storageBucket,
        "messagingSenderId" => $messagingSenderId,
        "appId" => $appId,
        "measurementId" => $measurementId,
        "Clavedelservidor" => $Clavedelservidor
        

    ];

    $json_data = json_encode($data);
    $file_name = '../../app/firebase.json';
    
    file_put_contents($file_name, $json_data);
    header('location:' . $urlPartner . 'panel/notify');

} else {
    echo "No se ha enviado ningún formulario.";
}
