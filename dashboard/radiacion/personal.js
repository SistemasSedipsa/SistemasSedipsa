$(document).ready(function () {
    var tablaPOE = $("#tablaPOE").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Eliminar</button></div></div>"
        }],
        "language": {
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
        }
    });

    $("#btnNuevo").click(function () {
        $("#formPoe").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Personal POE");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });

    var fila;

    // Botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        personal = fila.find('td:eq(1)').text();
        dosimetros = fila.find('td:eq(2)').text();
        cnsns = fila.find('td:eq(3)').text();
        documentos_poe = fila.find('td:eq(4)').text();
        
        $("#personal").val(personal);
        $("#dosimetros").val(dosimetros);
        $("#cnsns").val(cnsns);
        $("#documentos_poe").val(documentos_poe);
        
        opcion = 2; //editar

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Registro");
        $("#modalCRUD").modal("show");
    });

    // Botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        opcion = 3; //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "./bd/crud_personal.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function (response) {
                    if (response.success) {
                        tablaPOE.row(fila).remove().draw();
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("Error al eliminar el registro.");
                }
            });
        }
    });

    $("#formPoe").submit(function (e) {
        e.preventDefault();
        personal = $.trim($("#personal").val());
        dosimetros = $.trim($("#dosimetros").val());
        cnsns = $.trim($("#cnsns").val());
        documentos_poe = $.trim($("#documentos_poe").val());

        $.ajax({
            url: "./bd/crud_personal.php",
            type: "POST",
            dataType: "json",
            data: { personal: personal, dosimetros: dosimetros, cnsns: cnsns, documentos_poe: documentos_poe, id: id, opcion: opcion },
            success: function (response) {
                if (response.success) {
                    var rowData = [
                        response.data[0].id,
                        response.data[0].personal,
                        response.data[0].dosimetros,
                        response.data[0].cnsns,
                        response.data[0].documentos_poe,
                        "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Eliminar</button></div></div>"
                    ];

                    if (opcion == 1) { // Alta
                        tablaPOE.row.add(rowData).draw();
                    } else { // Modificación
                        tablaPOE.row(fila).data(rowData).draw();
                    }

                    $("#modalCRUD").modal("hide");
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Error al procesar la solicitud.");
            }
        });
    });
});
