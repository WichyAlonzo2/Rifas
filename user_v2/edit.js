// ***********************************************************************
// Solo para Editar
// Boton de Formulario


// Boton de Tabla
$(document).on('click', '.bs', function() {
    var datanu = $(this).attr('viewBlt');
    $.get("edit__form.php", {
        nombre: datanu
    }, function(dato) {
        $('.info').html(dato);
        console.log(dato);
    });

    $(this).find(".btnCheck")
        .clone()
        .appendTo(".btnFootter")
        .addClass("btnCheckx")
        .addClass("buttons__rad")
        .text("Guardar cambios");

});

$(document).on('click', '.btnCheckx', function() {
    $(this).remove();
    console.log('se elimino');
});

$("#editModal").on('hidden.bs.modal', function() {
    $('.btnCheckx').remove();
});