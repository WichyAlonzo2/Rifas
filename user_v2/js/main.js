$(document).ready(function() {
    $('#example').DataTable({
        "lengthMenu": [
            [99, 100, 2000, 500, 1000, 1500, 3000, -1],
            [99, 100, 2000, 500, 1000, 1500, 3000, , "All"]
        ],
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        },
        responsive: "true",
        dom: 'Bfrtilp',
        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="fas" style="font-family: arial;font-weight: 500!important;"> Exportar todos los registros a Excel </i> ',
            titleAttr: 'Exportar todos los registros a Excel',
            className: 'btn btn-primary buttons__rad'
        }]
    });
});