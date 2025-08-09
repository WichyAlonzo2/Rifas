// Variables
var nombre = '*Luis Angel Alonzo*';
var sorteo = '*500 Pesos Gratis en Efectivo*';
var page = '*WichyRifas*';
var cantidad = '*3 Boletos*';
var folio = '*SXX-ABC-DEF-GHI*';
var pay = 'http://tupagina/pay';
var boletos = '016 (026, 864, 123)\n016 (326, 874, 124)\n038 (045, 014, 983)';
var total = '$ *15*';
var check = 'http://tupagina/check';
var inx = 'http://tupagina/';
var bolDi = 'http://tupagina/ticket?mkultra=STK-XXX-XXX-XXXX';

// %20 Espacios 
// %0A Salto
// Acerca Izquierda
$("#text3").keyup(function() {
    var value = $(this).val();
    var texto = $('#text3').val();
    conNombre = texto.replace('$nombre', nombre);
    conSorteo = conNombre.replace('$sorteo', sorteo);
    conPage = conSorteo.replace('$page', page);
    conCantidad = conPage.replace('$cantidad', cantidad);
    conFolio = conCantidad.replace('$folio', folio);
    conPay = conFolio.replace('$pay', pay);
    conBoletos = conPay.replace('$boletos', boletos);
    conTotal = conBoletos.replace('$total', total);
    conChec = conTotal.replace("$chec", check);
    conIndex = conChec.replace("$inx", inx);
    conBolDi = conIndex.replace("$bolDi", bolDi);
    final = conBolDi.replace(/\n/g, "%0A");

    $("#descip3").html(final);
    fns = texto.replace(/\n/g, "</br>");


    $("#free3").html(fns);


}).keyup();

// Acerca Derecha
$("#text4").keyup(function() {
    var value = $(this).val();
    var texto = $('#text4').val();
    conNombre = texto.replace('$nombre', nombre);
    conSorteo = conNombre.replace('$sorteo', sorteo);
    conPage = conSorteo.replace('$page', page);
    conCantidad = conPage.replace('$cantidad', cantidad);
    conFolio = conCantidad.replace('$folio', folio);
    conPay = conFolio.replace('$pay', pay);
    conBoletos = conPay.replace('$boletos', boletos);
    conTotal = conBoletos.replace('$total', total);
    conChec = conTotal.replace("$chec", check);
    conIndex = conChec.replace("$inx", inx);
    conBolDi = conIndex.replace("$bolDi", bolDi);
    final = conBolDi.replace(/\n/g, "%0A");

    $("#descip4").html(final);
    fns = texto.replace(/\n/g, "</br>");


    $("#free4").html(fns);

}).keyup();


// Mensaje de pago
$("#text7").keyup(function() {
    var value = $(this).val();
    var texto = $('#text7').val();
    conNombre = texto.replace('$nombre', nombre);
    conSorteo = conNombre.replace('$sorteo', sorteo);
    conPage = conSorteo.replace('$page', page);
    conCantidad = conPage.replace('$cantidad', cantidad);
    conFolio = conCantidad.replace('$folio', folio);
    conPay = conFolio.replace('$pay', pay);
    conBoletos = conPay.replace('$boletos', boletos);
    conTotal = conBoletos.replace('$total', total);
    conChec = conTotal.replace("$chec", check);
    conIndex = conChec.replace("$inx", inx);
    conBolDi = conIndex.replace("$bolDi", bolDi);
    final = conBolDi.replace(/\n/g, "%0A");

    $("#descrip7").html(final);
    fns = texto.replace(/\n/g, "</br>");


    $("#free7").html(fns);

}).keyup();


// Mensaje de Advertencia
$("#text8").keyup(function() {
    var value = $(this).val();
    var texto = $('#text8').val();
    conNombre = texto.replace('$nombre', nombre);
    conSorteo = conNombre.replace('$sorteo', sorteo);
    conPage = conSorteo.replace('$page', page);
    conCantidad = conPage.replace('$cantidad', cantidad);
    conFolio = conCantidad.replace('$folio', folio);
    conPay = conFolio.replace('$pay', pay);
    conBoletos = conPay.replace('$boletos', boletos);
    conTotal = conBoletos.replace('$total', total);
    conChec = conTotal.replace("$chec", check);
    conIndex = conChec.replace("$inx", inx);
    conBolDi = conIndex.replace("$bolDi", bolDi);
    final = conBolDi.replace(/\n/g, "%0A");

    $("#descrip8").html(final);
    fns = texto.replace(/\n/g, "</br>");


    $("#free8").html(fns);

}).keyup();


// Mensaje de Pago
$("#text9").keyup(function() {
    var value = $(this).val();
    var texto = $('#text9').val();
    conNombre = texto.replace('$nombre', nombre);
    conSorteo = conNombre.replace('$sorteo', sorteo);
    conPage = conSorteo.replace('$page', page);
    conCantidad = conPage.replace('$cantidad', cantidad);
    conFolio = conCantidad.replace('$folio', folio);
    conPay = conFolio.replace('$pay', pay);
    conBoletos = conPay.replace('$boletos', boletos);
    conTotal = conBoletos.replace('$total', total);
    conChec = conTotal.replace("$chec", check);
    conIndex = conChec.replace("$inx", inx);
    conBolDi = conIndex.replace("$bolDi", bolDi);
    final = conBolDi.replace(/\n/g, "%0A");

    $("#descrip9").html(final);
    fns = texto.replace(/\n/g, "</br>");


    $("#free9").html(fns);

}).keyup();


// Mensaje de Eliminar
$("#text10").keyup(function() {
    var value = $(this).val();
    var texto = $('#text10').val();
    conNombre = texto.replace('$nombre', nombre);
    conSorteo = conNombre.replace('$sorteo', sorteo);
    conPage = conSorteo.replace('$page', page);
    conCantidad = conPage.replace('$cantidad', cantidad);
    conFolio = conCantidad.replace('$folio', folio);
    conPay = conFolio.replace('$pay', pay);
    conBoletos = conPay.replace('$boletos', boletos);
    conTotal = conBoletos.replace('$total', total);
    conChec = conTotal.replace("$chec", check);
    conIndex = conChec.replace("$inx", inx);
    conBolDi = conIndex.replace("$bolDi", bolDi);
    final = conBolDi.replace(/\n/g, "%0A");

    $("#descrip10").html(final);
    fns = texto.replace(/\n/g, "</br>");


    $("#free10").html(fns);

}).keyup();