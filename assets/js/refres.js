/*!
 * Actualizar x segundos 
 *
 * Creado 2021-23
 * Licencia solo para WichyAlonzo
 *
 * @author Luis angel alonzo calderon
 * @version 5.156.ABC
 */
setInterval(function() {
    $.ajax({
        url: window.location.href,
        success: function(data) {
            var newContent = $(data).find('#content'); // Reemplaza '#content' por el ID del elemento que quieres actualizar
            $('#content').html(newContent);
            // console.log('se actualizo');
        }
    });
}, 5000);