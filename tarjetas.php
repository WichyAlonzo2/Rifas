<?php

$jsonData = file_get_contents($urlPartner . '/app/tarjetas.json');
$datos = json_decode($jsonData, true);
$nombreBancos = array_column($datos, 'nombreBanco');
$jsonNombreBancos = json_encode($nombreBancos);
// header('Content-Type: application/json');

// echo $jsonNombreBancos;
