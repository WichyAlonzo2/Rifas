function initPayPalButton() {
    paypal.Buttons({
        createOrder: function(data, actions) {
            let inputValue = document.getElementById("amount").value;
            let inputDetalles = document.getElementById("descript").value;
            return actions.order.create({
                purchase_units: [{
                    "amount": {
                        "currency_code": "MXN",
                        "value": inputValue
                    },
                    "description": inputDetalles
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                console.log(JSON.stringify(orderData, null, 2));

                // var idPay = JSON.stringify(orderData['id'], null, 2);

                const element = document.getElementById('paypal-button-container');

                element.innerHTML = '';
                element.innerHTML = '<h3>Gracias por tu pago en PayPal!</h3>';

                document.getElementById('amount').value = "";
                document.getElementById('descript').value = "";
                // Or go to another URL:  actions.redirect('thank_you.html');


                $.ajax({
                    type: "POST",
                    url: "paypal/paypal.php",
                    data: { paypal: orderData },
                    success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);

                    }
                });
            });

        },

        onError: function(err) {
            alert(err);
            console.log(err);
        }
    }).render('#paypal-button-container');
}
initPayPalButton();