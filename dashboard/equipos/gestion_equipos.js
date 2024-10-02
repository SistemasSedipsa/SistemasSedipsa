$(document).ready(function () {
    // Configuración de la tabla
    var tablaEquipos = $("#tablaEquipos").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Borrar</button></div></div>"
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
            "sProcessing": "Procesando..."
        }
    });

    // Botón NUEVO
    $("#btnNuevo").click(function () {
        $("#formEquipos").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Producto");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; // alta
    });

    var fila; // Fila seleccionada

    // Botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        equipo = fila.find('td:eq(1)').text();
        talla = fila.find('td:eq(2)').text();
        entrada = fila.find('td:eq(3)').text();
        unidades = fila.find('td:eq(4)').text();
        precio = fila.find('td:eq(5)').text();
        salida = fila.find('td:eq(6)').text();
        salida_unidad = fila.find('td:eq(7)').text();
        personal = fila.find('td:eq(8)').text();
        restantes = fila.find('td:eq(9)').text();
        proveedor = fila.find('td:eq(10)').text();

        $("#equipo").val(equipo);
        $("#talla").val(talla);
        $("#entrada").val(entrada);
        $("#unidades").val(unidades);
        $("#precio").val(precio);
        $("#salida").val(salida);
        $("#salida_unidad").val(salida_unidad);
        $("#personal").val(personal);
        $("#restantes").val(restantes);
        $("#proveedor").val(proveedor);

        opcion = 2; // editar

        $(".modal-header").css({ "background-color": "#4e73df", "color": "white" });
        $(".modal-title").text("Editar equipo");
        $("#modalCRUD").modal("show");
    });

    // Botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        opcion = 3; // borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "bd/gestion_equipos.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function (response) {
                    if (response.status === 'success') {
                        tablaEquipos.row(fila).remove().draw();
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("Ocurrió un error al procesar la solicitud.");
                }
            });
        }
    });
    
    $("#formEquipos").submit(function (e) {
        e.preventDefault();
        equipo = $.trim($("#equipo").val());
        talla = $.trim($("#talla").val());
        entrada = $.trim($("#entrada").val());
        unidades = $.trim($("#unidades").val());
        precio = $.trim($("#precio").val());
        salida = $.trim($("#salida").val());
        salida_unidad = $.trim($("#salida_unidad").val());
        personal = $.trim($("#personal").val());
        restantes = $.trim($("#restantes").val());
        proveedor = $.trim($("#proveedor").val());

        $.ajax({
            url: "bd/gestion_equipos.php",
            type: "POST",
            dataType: "json",
            data: {
                equipo: equipo,
                talla: talla,
                entrada: entrada,
                unidades: unidades,
                precio: precio,
                salida: salida,
                salida_unidad: salida_unidad,
                personal: personal,
                restantes: restantes,
                proveedor: proveedor,
                id: id,
                opcion: opcion
            },
            success: function (response) {
                if (response.status === 'success') {
                    var data = response.data[0];
                    if (opcion == 1) { // Insertar
                        tablaEquipos.row.add([
                            data.id,
                            data.equipo,
                            data.talla,
                            data.entrada,
                            data.unidades,
                            data.precio,
                            data.salida,
                            data.salida_unidad,
                            data.personal,
                            data.restantes,
                            data.proveedor,
                            "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Borrar</button></div></div>"
                        ]).draw();
                    } else { // Editar
                        tablaEquipos.row(fila).data([
                            data.id,
                            data.equipo,
                            data.talla,
                            data.entrada,
                            data.unidades,
                            data.precio,
                            data.salida,
                            data.salida_unidad,
                            data.personal,
                            data.restantes,
                            data.proveedor,
                            "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Borrar</button></div></div>"
                        ]).draw();
                    }
                    $("#modalCRUD").modal("hide");
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Ocurrió un error al procesar la solicitud.");
            }
        });
    });
});
