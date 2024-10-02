$(document).ready(function () {
    // Configuración de la tabla
    var tablaConsumibles = $("#tablaConsumibles").DataTable({
        columnDefs: [{
            targets: -1,
            data: null,
            defaultContent: "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Borrar</button></div></div>"
        }],
        language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            processing: "Procesando..."
        }
    });

    $("#btnNuevo").click(function () {
        $("#formConsumibles").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Producto");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; // alta
    });

    var fila;

    // Botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        consumible = fila.find('td:eq(1)').text();
        metodo = fila.find('td:eq(2)').text();
        marca = fila.find('td:eq(3)').text();
        cliente = fila.find('td:eq(4)').text();
        entrada = fila.find('td:eq(5)').text();
        lote = fila.find('td:eq(6)').text();
        modelo = fila.find('td:eq(7)').text();
        unidades = fila.find('td:eq(8)').text();
        accesorios = fila.find('td:eq(9)').text();
        ns = fila.find('td:eq(10)').text();
        inventario = fila.find('td:eq(11)').text();
        precio = fila.find('td:eq(12)').text();
        caducidad = fila.find('td:eq(13)').text();
        fecha = fila.find('td:eq(14)').text();
        salida = fila.find('td:eq(15)').text();
        personal = fila.find('td:eq(16)').text();
        restantes = fila.find('td:eq(17)').text();
        status_con = fila.find('td:eq(18)').text();
        condiciones = fila.find('td:eq(19)').text();
        ubicacion = fila.find('td:eq(20)').text();
        proveedor = fila.find('td:eq(21)').text();

        $("#consumible").val(consumible);
        $("#metodo").val(metodo);
        $("#marca").val(marca);
        $("#cliente").val(cliente);
        $("#entrada").val(entrada);
        $("#lote").val(lote);
        $("#modelo").val(modelo);
        $("#unidades").val(unidades);
        $("#accesorios").val(accesorios);
        $("#ns").val(ns);
        $("#inventario").val(inventario);
        $("#precio").val(precio);
        $("#caducidad").val(caducidad);
        $("#fecha").val(fecha);
        $("#salida").val(salida);
        $("#personal").val(personal);
        $("#restantes").val(restantes);
        $("#status_con").val(status_con);
        $("#condiciones").val(condiciones);
        $("#ubicacion").val(ubicacion);
        $("#proveedor").val(proveedor);

        opcion = 2; // editar

        $(".modal-header").css({ "background-color": "#4e73df", "color": "white" });
        $(".modal-title").text("Editar Consumible");
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
                url: "bd/gestion_consumibles.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function (response) {
                    if (response.status === 'success') {
                        tablaConsumibles.row(fila).remove().draw();
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

    $("#formConsumibles").submit(function (e) {
        e.preventDefault();
        consumible = $.trim($("#consumible").val());
        metodo = $.trim($("#metodo").val());
        marca = $.trim($("#marca").val());
        cliente = $.trim($("#cliente").val());
        entrada = $.trim($("#entrada").val());
        lote = $.trim($("#lote").val());
        modelo = $.trim($("#modelo").val());
        unidades = $.trim($("#unidades").val())
        accesorios = $.trim($("#accesorios").val())
        ns = $.trim($("#ns").val());
        inventario = $.trim($("#inventario").val());
        precio = $.trim($("#precio").val());
        caducidad = $.trim($("#caducidad").val());
        fecha = $.trim($("#fecha").val());
        salida = $.trim($("#salida").val());
        personal = $.trim($("#personal").val());
        restantes = $.trim($("#restantes").val());
        status_con = $.trim($("#status_con").val());
        condiciones = $.trim($("#condiciones").val());
        ubicacion = $.trim($("#ubicacion").val());

        $.ajax({
            url: "bd/gestion_consumibles.php",
            type: "POST",
            dataType: "json",
            data: {
                consumible: consumible,
                metodo: metodo,
                marca: marca,
                cliente: cliente,
                entrada: entrada,
                lote: lote,
                modelo: modelo,
                unidades: unidades,
                accesorios: accesorios,
                ns: ns,
                inventario: inventario,
                precio: precio,
                caducidad: caducidad,
                fecha: fecha,
                salida: salida,
                personal: personal,
                restantes: restantes,
                status_con: status_con,
                condiciones: condiciones,
                ubicacion: ubicacion,
                //proveedor: proveedor,
                id: id,
                opcion: opcion
            },
            success: function (response) {
                if (response.status === 'success') {
                    if (opcion == 1) {
                        var data = response.data[0];
                        tablaConsumibles.row.add([
                            data.id,
                            data.consumible,
                            data.metodo,
                            data.marca,
                            data.cliente,
                            data.entrada,
                            data.lote,
                            data.modelo,
                            data.unidades,
                            data.accesorios,
                            data.ns,
                            data.inventario,
                            data.precio,
                            data.caducidad,
                            data.fecha,
                            data.salida,
                            data.personal,
                            data.restantes,
                            data.status_con,
                            data.condiciones,
                            data.ubicacion,
                            data.proveedor,
                            "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Borrar</button></div></div>"
                        ]).draw();
                    } else {
                        var data = response.data[0];
                        tablaConsumibles.row(fila).data([
                            data.id,
                            data.consumible,
                            data.metodo,
                            data.marca,
                            data.cliente,
                            data.entrada,
                            data.lote,
                            data.modelo,
                            data.unidades,
                            data.accesorios,
                            data.ns,
                            data.inventario,
                            data.precio,
                            data.caducidad,
                            data.fecha,
                            data.salida,
                            data.personal,
                            data.restantes,
                            data.status_con,
                            data.condiciones,
                            data.ubicacion,
                            data.proveedor,
                            "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Borrar</button></div></div>"
                        ]).draw();
                    }
                    $("#modalCRUD").modal("hide");
                    location.reload();
                }
            },
            error: function () {
                alert("Ocurrió un error al procesar la solicitud.");
            }
        });
    });
});
