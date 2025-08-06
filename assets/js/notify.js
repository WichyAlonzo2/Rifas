/*!
 * Notificaciones web
 *
 * Creado 2021-23
 * Licencia solo para WichyAlonzo
 *
 * @author Luis angel alonzo calderon
 * @version 5.156.ABC
 */
var eventSource = new EventSource('app/noti.php');
var hasReceivedData = false;
let messageNoti;
eventSource.addEventListener('data', function(event) {
    var jsonData = JSON.parse(event.data);
    if (hasReceivedData) {
        console.log(jsonData);
        var jsonDatax = JSON.parse(jsonData);
        var nameNoti = jsonDatax.nombre;
        var stateNoti = jsonDatax.estado;
        var cantNoti = jsonDatax.cant;
        var boletosNoti = jsonDatax.boletos;
        var maximoCaracteres = 100;

        // Contar los caracteres
        var numeroCaracteres = boletosNoti.length;

        // Si el número de caracteres es mayor al máximo permitido, truncar y agregar puntos suspensivos
        if (numeroCaracteres > maximoCaracteres) {
            boletosNoti = boletosNoti.substring(0, maximoCaracteres - 3) + '...';
        }

        var toastElement = document.querySelector('.toast__notifi');
        var toastMessageElement = document.getElementById('toastMessage');
        var mns__notifi = document.getElementById('mns__notifi');
        if (cantNoti === 1) {
            messageNoti = nameNoti + ' acaba de comprar ' + cantNoti + ' Boleto 😱<br>(' + boletosNoti + ')';

        } else if (cantNoti > 2) {
            messageNoti = nameNoti + ' acaba de comprar ' + cantNoti + ' Boleto(s) 😱<br>(' + boletosNoti + ')';

        }
        mns__notifi.innerHTML = messageNoti;
        var toast = new bootstrap.Toast(toastElement);
        toast.show();
    }
    hasReceivedData = true;
});