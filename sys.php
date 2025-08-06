<?php 
$data = file_get_contents($urlPartner . "/app/sys.json");
$root = json_decode($data);

$favicon = $root->favicon;
$logo = $root->Logo;
$Creativo1 = $root->portadaprincipal;
$Creativo2 = $root->Sorteo1;
$Portada1 = $root->Sorteo2;
$Portada2 = $root->Sorteo3;

?>