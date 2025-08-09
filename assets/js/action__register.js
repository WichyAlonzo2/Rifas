/*!
 * Registro de conn
 *
 * Creado 2021-23
 * Licencia solo para WichyAlonzo
 *
 * @author Luis angel alonzo calderon
 * @version 5.156.ABC
 */

$(".bs").on('click', function() {
    var server = $(".server-form").val();
    var user = $(".user-form").val();
    var pass = $(".pass-form").val();
    var db = $(".db-form").val();
    var url = $(".url-form").val();

    $.get("servidor.php", {
        server: server,
        user: user,
        pass: pass,
        db: db,
        url: url

    }, function(dato) {
        $('.datos').html(dato);
    });
});