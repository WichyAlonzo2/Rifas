<?php
$jsonData = file_get_contents('app/rootv2.json');
$data = json_decode($jsonData, true);


// PRINCIPAL
$nombreRifa         = $data['principal']['nombreRifa'];
$nombreCorto        = $data['principal']['nombrecorto'];
$ubicacion          = $data['principal']['ubicacion'];
$descripcionMeta    = $data['principal']['descripcionMetaData'];
$favicon    = $data['principal']['favicon'];
$logo    = $data['principal']['Logo'];
$portadaprincipal    = $data['principal']['portadaprincipal'];


// SOCIAL
$facebook           = $data['social']['facebook'];
$instagram          = $data['social']['instagram'];
$whatsapp           = $data['social']['whatsapp'];


// FAQ Aqui hay que hacer el ciclo
$faqspregunta      = $data['faq']['faq1'];
$faqsrespuesta     = $data['faq']['faq1']['respuesta'];


// SORTEOS
$s1_titulo          = $data['sorteos']['str1']['titulo'];
$s1_fecha           = $data['sorteos']['str1']['fecha'];
$s1_detalles        = $data['sorteos']['str1']['detallesBoletoSorteo'];
$s1_premioBonos     = $data['sorteos']['str1']['premioBonos'];
$s1_detallesIndex   = $data['sorteos']['str1']['detallesIndex'];
$s1_precio          = $data['sorteos']['str1']['precio'];
$s1_db              = $data['sorteos']['str1']['db'];
// Crear el ciclo
$img1_db              = $data['sorteos']['str1']['img'];


// LINKPAGES
$link_s1            = $data['linkPages']['s1'];
$link_s2            = $data['linkPages']['s2'];
$link_s3            = $data['linkPages']['s3'];
$link_s4            = $data['linkPages']['s4'];
$linkPPago          = $data['linkPages']['pago'];
$linkPCheck         = $data['linkPages']['check'];
$link_boletoDigital = $data['linkPages']['boletoDigital'];
?>
