$(".payCloud__prt").click(function() {
    var pay_Param = {
        "id": $(".pay__cloud").val()
    };
    $.ajax({
        data: pay_Param,
        url: 'modal/pay.php',
        method: 'POST',
        success: function(aviso) {
            $("#cuadro2pay").html(aviso);

        }
    });
});

$(".adverCloud__prt").click(function() {
    console.log(true);
    var parametros = {
        "id": $(".adver__cloud").val()
    };
    $.ajax({
        data: parametros,
        url: 'modal/Adver.php',
        method: 'POST',
        success: function(aviso) {
            $("#cuadro2ad").html(aviso);

        }
    });
});

$(".delCloud__pQm").click(function() {
    var parametros = {
        "id": $(".del__cloud").val()
    };
    $.ajax({
        data: parametros,
        url: 'modal/del.php',
        method: 'POST',
        success: function(aviso) {
            $("#cuadro2x").html(aviso);

        }
    });
});