function removeOffcanvasBackdrop() {
    $(".offcanvas-backdrop.fade").remove();
}

function toggleOffcanvasBackdrop() {
    // Verificar si el offcanvas backdrop existe
    var backdrop = $(".offcanvas-backdrop.fade");

    if (backdrop.length === 0) {
        // Si no existe, crear el offcanvas backdrop
        backdrop = $('<div class="offcanvas-backdrop fade"></div>');
        $('body').append(backdrop);
        console.log('se crea');
    }

    // Alternar la clase 'show' en el offcanvas backdrop
    backdrop.toggleClass('show');
}

document.addEventListener('click', function(event) {
    if ($('.offcanvas.show').length > 0 && !$('#offcanvas-1').is(event.target) && $('#offcanvas-1').has(event.target).length === 0) {
        removeOffcanvasBackdrop();

    }
});

// Toast Referido
if (referido.trim() !== '') {

    $('#referidoClient').text(referido);
    const toastLiveExample = document.getElementById('liveToastReferido');
    const toast = new bootstrap.Toast(toastLiveExample);
    toast.show();
}


// Se mejoro este fragmento se agrega y quita class a div offcanvas
// str__compiler
let precioSorteo;
if (str__compiler === 1) {
    str_compilerSys = '';
    precioSorteo = 'sorteoActual';

} else if (str__compiler === 2) {
    str_compilerSys = '_two';
    precioSorteo = 'sorteoActual_two';

} else if (str__compiler === 3) {
    str_compilerSys = '_tree';
    precioSorteo = 'sorteoActual_tree';

}


$('.btn-cart').click(function() {
    var $boletosx = $(".bol__prin").length;
    if ($boletosx == 0) {
        // $('.form__').css('display', 'none');
        // offcanvasBackdrop();
        // $('.offcanvas-backdrop').removeClass("show");
        alert('Selecciona un boleto para poder ver el Carrito');
        // $('#offcanvas-1').removeClass("offcanvas offcanvas-end boletos___buy");
        // $('#offcanvas-1').addClass("display-rip");
        // $("#offcanvas-1").toggleClass("show");
        $('.__cart').css('display', 'none');
        if ($("#offcanvas-1").hasClass("show")) {
            setTimeout(function() {
                $("#offcanvas-1").removeClass("show");
            }, 10);
        }
        // $(".offcanvas-backdrop.fade").remove();
    } else {
        $('.__cart').css('display', 'block');
        // $('#offcanvas-1').addClass("offcanvas offcanvas-end boletos___buy show");
        // $('#offcanvas-1').removeClass("display-rip");
    }

});

// $('.remov_pay').click(function() {
//     var $boletosx = $(".bol__prin").length;
//     if ($boletosx == 0) {
//         $('.offcanvas-backdrop').removeClass("show");
//         alert('Selecciona un boleto para poder ver el Carrito');
//         $('#offcanvas-1').removeClass("offcanvas offcanvas-end boletos___buy");
//         $('#offcanvas-1').addClass("display-rip");
//         $("#offcanvas-1").toggleClass("show");
//         if ($("#offcanvas-1").hasClass("show")) {
//             setTimeout(function() {
//                 $("#offcanvas-1").removeClass("show");
//             }, 10);
//         }
//         $(".offcanvas-backdrop.fade").remove();
//     } else {
//         $('#offcanvas-1').addClass("offcanvas offcanvas-end boletos___buy show");
//         $('#offcanvas-1').removeClass("display-rip");
//     }
// });

// Remueve la pantalla gris que se queda por el Carrito de compras
$("#register__modal").on('hidden.bs.modal', function() {
    var $offcanvas = $('.offcanvas');
    var $offcanvasBackdrop = $('.offcanvas-backdrop');
    var $classBoletosSelection = $('.class__boletosSelection');

    $offcanvas.removeClass("show");
    $offcanvasBackdrop.removeClass("show");
    $classBoletosSelection.remove();
});

// Boton para ir hasta arriba
$(document).ready(function() {
    $('.ir-arriba').click(function() {
        $('html, body').animate({
            scrollTop: $('#ancl').offset().top
        }, 500);
        return false;
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 0) {
            $('.ir-arriba').slideDown(1);
        } else {
            $('.ir-arriba').slideUp(1);
        }
    });

});

// Listo
$('.boletos___buy').css('display', 'none');
$('.qam-form').prop('hidden', true);

// Listo
$("#click__trCart").click(function() {
    console.log('Se dio click');
    $(".payxd__button").trigger("click");
    if ($('.offcanvas.show').length > 0 && !$('#offcanvas-1').is(event.target) && $('#offcanvas-1').has(event.target).length === 0) {
        toggleOffcanvasBackdrop();
    }
});

// Para Maquinita de la suerte
$("#btn-maquis").click(function() {
    $valueMaq = $("#maqX").val();

    if ($valueMaq === null) {
        $('.noResult').text("Selecciona un numero");

    } else {
        $.ajax({
            url: "include/maquinita.php",
            type: 'post',
            data: {
                "maqX": $valueMaq,
                "compiler": str__compiler
            },
            success: function(result) {
                // Mostrar un spinner de carga o algÃºn indicador visual de que se estÃ¡ realizando la peticiÃ³n AJAX
                $('.maquinitaX').prop('hidden', true);
                var img = $('<img>').attr('src', 'assets/img/system/gif.gif').addClass('gif__Maquinita');
                var text = '<h3 class="fs-4 loadBoletos">Generando tus Boletos...</h3>';
                $('#gif-container').html(img);
                $('#gif-container').append(text);

                setTimeout(function() {
                    $('#gif-container').empty();
                    $(".class__boletos___maq").html(result);
                    var maqCount = $(".maq").length;
                    if (maqCount === 0) {
                        $('.maquinitaX').prop('hidden', false);
                        $('.noResult').text("Selecciona un numero");
                        $('.noResult').prop('hidden', false);
                    } else {
                        $('.maquinitaX').prop('hidden', true);
                        $('.qam-form').prop('hidden', false);
                        $('.noResult').prop('hidden', true);
                    }
                    var maqSelected = $("#maqX").val();
                    if (maqCount < 2) {
                        if (maqCount == maqSelected) {
                            $(".styleResulMaqui").text(maqCount + ' Boleto al azar para Ti');

                        } else {
                            $(".styleResulMaqui").text('Ups! solo tenemos libres ' + maqCount + ' Boleto de ' + maqSelected + ' que escogiste');

                        }
                    } else {
                        if (maqCount == maqSelected) {
                            // console.log('Completos');
                            $(".styleResulMaqui").text(maqCount + ' Boletos al azar para Ti');
                        } else {
                            // console.log('Se generaron ' + maqCount + ' de ' + maqSelected);
                            $(".styleResulMaqui").text('Ups! solo tenemos libres ' + maqCount + ' Boletos de ' + maqSelected + ' que escogiste');
                        }
                    }
                }, 2500);
            }
        });

    }
});

$("#selectMaquinita").click(function() {
    $('#gif-container').empty();
    $('.maquinitaX').prop('hidden', false);
    $('.qam-form').prop('hidden', true);
    $('#maqX').prop('selectedIndex', 0);

});

$(".closeMain").click(function() {
    $('#indexPos').empty();
    $('#gif-container').empty();
    $('#maqX').prop('selectedIndex', 0);
    $('.maquinitaX').prop('hidden', false);
    $('.qam-form').prop('hidden', true);

});

$(".xclass").on('click', function() {
    $('#gif-container').empty();
    $('#formBol').empty();

});

// Este codigo esta haciendo mal al codigo, checar si esta causando problemas
// Codigo listo
$(".formUnoX").on('click', function() {
    $("#lengBol")
        .clone()
        .appendTo("#formBol")
        .addClass('class__boletosSelection')
        .css('display', 'none');

    $('#formBol')
        .find('#lengBol')
        .find('.blts')
        .removeClass("slc");

});

// Abrir carrito
const toastLiveExample = document.getElementById('liveToast');

$(document).on('click', '.boleto', function() {
    const toast = new bootstrap.Toast(toastLiveExample);
    toast.show();
    setTimeout(function() {
        toast.hide();
    }, 2500000000);
});

$('#click__trCart').click(function() {
    // $('.liveToastBoletos').removeClass('show');
});

// Nuevo para que agarre los botones creados dinamicamente traidos desde otra pagina
$(document).on('click', '.boleto', function() {
    $(this).prop('hidden', true);
    var $opp = $(this).attr("nu");
    var $boleto = $(this).val();
    var $lengBol = $('#lengBol');

    // console.log($lengBol);
    var $lengExtras = $('#lengExtras');
    var $bolPrin = $('<input/>', {
        'class': 'blts bol__prin fw-bold',
        'type': 'button',
        'name': 'w7qr[' + $boleto + ']',
        'value': $boleto,
        'nu': $opp
    });
    var $bolValue = $('<input/>', {
        'class': 'xd bol__value',
        'name': 'w7qr[]',
        'value': $boleto
    });
    var $bolOpp = $('<input/>', {
        'hidden': '',
        'class': 'btlsOther bol__opp',
        'name': 'bltsPay[' + $boleto + ']',
        'value': $opp + '%0A'
    });
    console.log($bolOpp.val());
    $lengBol.append($bolValue, $bolPrin, $bolOpp);
    $lengExtras.append('<h6 class="extras wita">' + $opp + '</h6>');
    var $boletos = $(".bol__prin").length; // Contado de boletos que existe en el carrito

    // Nuevo para el precio
    let totalSpan = document.querySelector(".tax__numberCliente");
    fetch(`../app/promotions${str_compilerSys}.json`)
        .then(response => response.json())
        .then(promotions => {
            fetch("../app/root.json")
                .then(response => response.json())
                .then(data => {
                    var precio = parseFloat(data[precioSorteo].precio);
                    var cantidadBoletos = $boletos;
                    var payCountBol = promotions[cantidadBoletos] || (precio * cantidadBoletos);

                    totalSpan.textContent = payCountBol;

                })
                .catch(error => {
                    console.error("Error al cargar el precio de los boletos");

                });
        })
        .catch(error => {
            console.error("Error al cargar las promociones");
        });



    var $count = $('.count');
    var $countBoletoSelect = $('.countBoletoSelect');
    var $countCart = $('.countCart');
    var $count2 = $('.count2');
    var $opds = $('.opds');
    var $boletosBuy = $('.boletos___buy');
    var $displayBlock = 'block';
    var $displayNone = 'none';
    $count.addClass('fw-bold');
    $countBoletoSelect.addClass('fw-bold');
    $count.text($boletos + ($boletos == 1 ? ' BOLETO SELECCIONADO' : ' BOLETOS SELECCIONADOS'));
    $countBoletoSelect.text($boletos + ($boletos == 1 ? ' BOLETO SELECCIONADO' : ' BOLETOS SELECCIONADOS'));
    $countCart.text($boletos);
    $count2.text('Para eliminar algún boleto clic sobre 😎');
    if ($boletos === 0) {
        $count.prop('hidden', true);
        $countBoletoSelect.prop('hidden', true);
        $count2.prop('hidden', true);
        $opds.prop('hidden', true);
        $boletosBuy.css('display', $displayNone);
        $countCart.css('display', $displayNone);
    } else {
        $count.prop('hidden', false);
        $countBoletoSelect.prop('hidden', false);
        $count2.prop('hidden', false);
        $opds.prop('hidden', false);
        $boletosBuy.css('display', $displayBlock);
        $countCart.css('display', $displayBlock);
    }
    $(".bol__prin").attr('data-bs-dismiss', $boletos === 1 ? 'offcanvas' : null);
});

// Codigo para Boletos que estan en Carrito
$(document).on('click', '.bol__prin', function() {
    var valButton = $(this).val();
    var valOpp = $(this).attr('nu');
    var $srchVal = $('#numeros .boleto[value="' + valButton + '"]');
    var $srchOpp = $('#lengExtras').find('*').filter(function() {
        return $(this).text() === valOpp;
    });

    var $srchBol = $('#lengBol').find('*').filter(function() {
        return $(this).val() === valButton;
    });

    var $resultsxxx = $('#lengBol').find('.bol__opp').filter(function() {
        return $(this).val() === valOpp + '%0A';
    });

    $resultsxxx.remove();
    $(this).remove();
    $srchVal.prop('hidden', false);
    $srchOpp.remove();
    $srchBol.remove();

    var $boletos = $(".bol__prin").length;
    $('.count').text($boletos + ($boletos == 1 ? " Boleto seleccionado" : " Boletos seleccionados"));
    $('.countBoletoSelect').text($boletos + ($boletos == 1 ? " Boleto seleccionado" : " Boletos seleccionados"));
    $('.countCart').text($boletos);

    if ($boletos > 0) {
        $('.count').prop('hidden', false);
        $('.countBoletoSelect').prop('hidden', false);
        $('.count2, .opds').prop('hidden', false);
        $('.boletos___buy, .countCart').css('display', 'block');

    } else {
        $('.count').prop('hidden', true);
        $('.countBoletoSelect').prop('hidden', true);
        $('.count2, .opds').prop('hidden', true);
        $('.boletos___buy, .countCart').css('display', 'none');

    }

    // Nuevo para el precio
    let totalSpan = document.querySelector(".tax__numberCliente");
    fetch(`../app/promotions${str_compilerSys}.json`)
        .then(response => response.json())
        .then(promotions => {
            fetch("../app/root.json")
                .then(response => response.json())
                .then(data => {
                    var precio = parseFloat(data[precioSorteo].precio);
                    console.log(precio);
                    var cantidadBoletos = $boletos;
                    var payCountBol = promotions[cantidadBoletos] || (precio * cantidadBoletos);
                    totalSpan.textContent = payCountBol;

                })
                .catch(error => {
                    console.error("Error al cargar el precio de los boletos");
                });
        })
        .catch(error => {
            console.error("Error al cargar las promociones");
        });

    $(".bol__prin").attr('data-bs-dismiss', $boletos == 1 ? 'offcanvas' : '');
});

// Codigo para buscar
$(document).ready(function() {
    load(1, str_compilerSys);
    alert(precioSorteo);

    // Capturamos el número en el h3
    let totalRegistro = $('.count__boletos_Final').text();

    // Calculamos la cantidad de dígitos y preparamos la cadena con esa cantidad de ceros
    let ceros = '0'.repeat(totalRegistro.length);

    // Establecemos el valor inicial del input con los ceros y el maxlength
    $('#search').val(ceros).attr('maxlength', totalRegistro.length);

    // Detectamos cuando el usuario escribe en el input
    $('#search').on('input', function() {
        let inputVal = $(this).val();

        // Quitamos ceros de la izquierda mientras el usuario escribe
        let cleanedValue = inputVal.replace(/^0+/, '');

        // Si no se ha ingresado ningún valor, dejamos el input con ceros
        if (cleanedValue === '') {
            $(this).val('0'.repeat(totalRegistro.length));
        } else {
            // Mantenemos la longitud correcta del input, añadiendo ceros si es necesario
            let remainingZeros = totalRegistro.length - cleanedValue.length;
            let newValue = '0'.repeat(Math.max(remainingZeros, 0)) + cleanedValue;
            $(this).val(newValue);

            // Verificamos si el valor actual del input excede el maxlength
            if ($(this).val().length > totalRegistro.length) {
                // Cortamos el valor al maxlength permitido
                $(this).val($(this).val().substring(0, totalRegistro.length));
            }
        }
    });



    $("#mostrarBoletos__List").on('click', function(e) {
        var searchValue = $('#search').val().trim();
        if (searchValue.length === 0) {
            $(".salida").prop('hidden', true);
            return true;
        }

        $(".salida").prop('hidden', false);

        $.ajax({
            data: {
                search: searchValue,
                compiler: str_compilerSys

            },
            url: 'function/buscarBoletos.php',
            type: 'post',
            beforeSend: function() {},
            success: function(response) {
                $(".salida").html(response);
            },
            error: function() {
                alert("error");
            }
        });
    });
    $("#search").on('keypress', function(e) {
        if (e.which !== 13) {
            return;
        }

        var searchValue = $(this).val().trim();

        if (searchValue.length === 0) {
            $(".salida").prop('hidden', true);
            return true;
        }

        $(".salida").prop('hidden', false);

        $.ajax({
            data: {
                search: searchValue,
                compiler: str_compilerSys

            },
            url: 'function/buscarBoletos.php',
            type: 'post',
            beforeSend: function() {},
            success: function(response) {
                $(".salida").html(response);
            },
            error: function() {
                alert("error");
            }
        });
    });
});


function load(page, str_compilerSys) {
    var parametros = {
        "action": "ajax",
        "page": page,
        "compiler": str_compilerSys
    };
    $("#loader").fadeIn('slow');
    $.ajax({
        url: 'function/funcion__Pagi__Boletos.php',
        data: parametros,
        beforeSend: function(objeto) {
            $("#loader").html("<img src='assets/img/loader.gif'>");
        },
        success: function(data) {
            var switchState = localStorage.getItem('switchState');
            if (switchState === 'apagado') {
                setTimeout(function() {
                    var payXElements = document.querySelectorAll('.payX');
                    // console.log("Número de elementos payX:", payXElements.length);
                    payXElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                }, 100);
            }
            $("#numeros").html(data).fadeIn('slow');
            $("#loader").html("");
            if (localStorage.getItem('isPageLoaded') === 'true') {
                $('html, body').animate({
                    scrollTop: $("#option__boletos").offset().top
                }, 1);
            } else {
                localStorage.setItem('isPageLoaded', 'true');
            }
        }
    })
}

$(window).on('beforeunload', function() {
    localStorage.removeItem('isPageLoaded');
});

$(document).ready(function() {
    $(document).on('change', '.visibility_ticks', function() {
        var isChecked = $(this).is(':checked');

        if (isChecked) {
            localStorage.setItem('switchState', 'encendido');
            $('.payX').css('display', '');

        } else {
            localStorage.setItem('switchState', 'apagado');
            $('.payX').css('display', 'none');

        }
    });

    $(document).ready(function() {
        var switchState = localStorage.getItem('switchState');
        if (!switchState || switchState === 'encendido') {
            localStorage.setItem('switchState', 'encendido');
            $('.visibility_ticks').prop('checked', true);
            $('.payX').css('display', 'none');

        } else {
            $('.visibility_ticks').prop('checked', false);
        }
    });


});


document.addEventListener("DOMContentLoaded", function() {
    var switchState = localStorage.getItem('switchState');
    if (switchState === 'apagado') {
        setTimeout(function() {
            var payXElements = document.querySelectorAll('.payX');
            // console.log("Número de elementos payX:", payXElements.length);
            payXElements.forEach(function(element) {
                element.style.display = 'none';
            });

        }, 100);
    }
});