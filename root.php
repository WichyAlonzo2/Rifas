<?php
$data = file_get_contents($urlPartner . "/app/root.json");
$root = json_decode($data);
$mantenimiento = false;


// Importante
$nombreCorto = $root->nombreSorteoCorto;
$importanteNombreSorteo = $root->nombreSorteos;
$importanteUbicacion = $root->ubicacion;

// Link Paginas
$linkPSorteo = $root->linkPages->q1;
$linkPSorteo2 = $root->linkPages->q2;
$linkPSorteo3 = $root->linkPages->q3;
$linkPPago = $root->linkPages->ppago;
$linkPCheck = $root->linkPages->pcheck;
$linkPBoleto = $root->linkPages->pDigital;

// Descripcion del Sorteo
// $descripcionIzq = $root->descripcion->izquierda;

// Faq
$faqJ1 = $root->faq->faq1->faq;
$respuestaJ1 = $root->faq->faq1->respuesta;

$faqJ2 = $root->faq->faq2->faq;
$respuestaJ2 = $root->faq->faq2->respuesta;

$faqJ3 = $root->faq->faq3->faq;
$respuestaJ3 = $root->faq->faq3->respuesta;

$faqJ4 = $root->faq->faq4->faq;
$respuestaJ4 = $root->faq->faq4->respuesta;

$faqJ5 = $root->faq->faq5->faq;
$respuestaJ5 = $root->faq->faq5->respuesta;

// Info de Soteo Actual
$infoSorteoNombre = $root->sorteoActual->nombre;
$infoSorteTipo = $root->sorteoActual->tipo;

$infoSorteoFechaOpen = $root->sorteoActual->fechaOpen;
$infoSorteoFechaClose = $root->sorteoActual->fechaClose;


$infoSorteoDetallesBoletosSorteo = $root->sorteoActual->detallesBoletoSorteo;
$infoSorteoPremios = $root->sorteoActual->premioBonos;
$infoSorteoIndex = $root->sorteoActual->detallesIndex;
$intPrecio = $root->sorteoActual->precio;
$infoSorteoPrecio = intval($intPrecio);

// Info de Soteo Actual
$infoSorteoNombre2 = $root->sorteoActual_two->nombre;
$infoSorteoTipo2 = $root->sorteoActual_two->tipo;

$infoSorteoFechaOpen2 = $root->sorteoActual_two->fechaOpen;
$infoSorteoFechaClose2 = $root->sorteoActual_two->fechaClose;

$infoSorteoDetallesBoletosSorteo2 = $root->sorteoActual_two->detallesBoletoSorteo;
$infoSorteoPremios2 = $root->sorteoActual_two->premioBonos;
$infoSorteoIndex2 = $root->sorteoActual_two->detallesIndex;
$intPrecio2 = $root->sorteoActual_two->precio;
$infoSorteoPrecio2 = intval($intPrecio2);

// Info de Soteo Actual
$infoSorteoNombre3 = $root->sorteoActual_tree->nombre;
$infoSorteoTipo3 = $root->sorteoActual_tree->tipo;

$infoSorteoFechaOpen3 = $root->sorteoActual_tree->fechaOpen;
$infoSorteoFechaClose3 = $root->sorteoActual_tree->fechaClose;

$infoSorteoDetallesBoletosSorteo3 = $root->sorteoActual_tree->detallesBoletoSorteo;
$infoSorteoPremios3 = $root->sorteoActual_tree->premioBonos;
$infoSorteoIndex3 = $root->sorteoActual_tree->detallesIndex;
$intPrecio3 = $root->sorteoActual_tree->precio;
$infoSorteoPrecio3 = intval($intPrecio3);

$linkRifas = 'https://api.whatsapp.com/send?phone=5214451540656&text=Hola%20%F0%9F%94%A5%20Me%20interesa%20tener%20mi%20p%C3%A1gina%20%F0%9F%A6%81%0AVengo%20de%20*' . $nombreCorto . '*%0A%0AEn%20un%20momento%20te%20atendemos%20%F0%9F%A6%81';

// JS
$action_Register = '<script src="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119485/v3.45TEST/js/action__register_qnm9iw.js"></script>';
$bold_and_bright = '<script src="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119485/v3.45TEST/js/bold-and-bright_a9pfmg.js"></script>';
$jquery_jscroll = '<script src="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119485/v3.45TEST/js/jquery.jscroll_bjfamq.js"></script>';
$jquery_min = '<script src="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119486/v3.45TEST/js/jquery.min_da8u8s.js"></script>';
$notify = '<script src="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119485/v3.45TEST/js/notify_b5zgw9.js"></script>';
$paypal = '<script src="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119485/v3.45TEST/js/paypal_amxfzd.js"></script>';
$push_min = '<script src="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119485/v3.45TEST/js/push.min_qztbys.js"></script>';
$refres = '<script src="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119486/v3.45TEST/js/refres_tsz9cm.js"></script>';
$jbl = '<script src="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692120566/v3.45TEST/js/jbl-min_kqakzc.js"></script>';


// CSS
$ionicons_min ='<link rel="stylesheet" href="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119831/v3.45TEST/css/ionicons.min_skbjwa.css">';
$bootstrap_min ='<link rel="stylesheet" href="https://res.cloudinary.com/djqmdm8zd/raw/upload/v1692119873/v3.45TEST/css/bootstrap.min_wuhokj.css">';