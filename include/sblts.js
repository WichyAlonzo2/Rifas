/*!
 * Check Boletos
 *
 * Creado 2021-23
 * Licencia solo para WichyAlonzo
 *
 * @author Luis angel alonzo calderon
 * @version 5.156.ABC
 */
$(document).ready(function() {
    $("#txtbusca").keypress(function(e) {
        var compilerx = "compiler=" + compiler;
        if (e.which == 13) {
            var xd = $("#txtbusca").val().length;
            if (xd == 0) {
                $(".salida").prop('hidden', true)
                return true;

            } else {
                var parametros = "txtbusca=" + $(this).val()
                $(".salida").prop('hidden', false)
                $.ajax({
                    data: parametros + "&" + compilerx,
                    url: 'function/buscarBoletosVerificacion.php',
                    type: 'post',
                    beforeSend: function() {},
                    success: function(response) {
                        $(".salida").html(response);
                    },
                    error: function() {
                        alert("error")
                    }
                });
            }
        }
    });
});