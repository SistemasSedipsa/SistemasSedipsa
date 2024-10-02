$(document).ready(function () {
    // Inicialización de la tabla DataTable
    var tablaPersonas = $("#tablaPersonas").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
        }],
        "createdRow": function (row, data, dataIndex) {
            if (data[14] === "VIGENTE") { // Suponiendo que el status_c está en la columna 14
                $(row).addClass('fila-VIGENTE');
            } else if (data[14] === "VENCIDO") {
                $(row).addClass('fila-VENCIDO');
            }
        },
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

    // Botón para nuevo registro
    $("#btnNuevo").click(function () {
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Registro");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; // alta
        $('#pdf-preview').hide(); // Ocultar vista previa del PDF
    });

    var fila; // Captura la fila para editar o borrar el registro

    // Botón EDITAR
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        num_int = fila.find('td:eq(1)').text();
        descripcion = fila.find('td:eq(2)').text();
        metodo = fila.find('td:eq(3)').text();
        serie = fila.find('td:eq(4)').text();
        inventario = fila.find('td:eq(5)').text();
        modelo = fila.find('td:eq(6)').text();
        marca = fila.find('td:eq(7)').text();
        calibracion = fila.find('td:eq(9)').text();
        verificacion = fila.find('td:eq(10)').text();
        ultima = fila.find('td:eq(11)').text();
        informe = fila.find('td:eq(12)').text();
        proxima = fila.find('td:eq(13)').text();
        status_c = fila.find('td:eq(14)').text();
        ubicacion = fila.find('td:eq(15)').text();
        prueba = fila.find('td:eq(16)').text();
        condiciones = fila.find('td:eq(17)').text();
        observaciones = fila.find('td:eq(18)').text();
        situacion = fila.find('td:eq(19)').text();
        bodega = fila.find('td:eq(20)').text();
        archivo_pdf = fila.find('td:eq(21)').text();

        // Rellenar el formulario con los datos
        $("#num_int").val(num_int);
        $("#descripcion").val(descripcion);
        $("#metodo").val(metodo);
        $("#serie").val(serie);
        $("#inventario").val(inventario);
        $("#modelo").val(modelo);
        $("#marca").val(marca);
        $("#calibracion").val(calibracion);
        $("#verificacion").val(verificacion);
        $("#ultima").val(ultima);
        $("#informe").val(informe);
        $("#proxima").val(proxima);
        $("#status_c").val(status_c);
        $("#ubicacion").val(ubicacion);
        $("#prueba").val(prueba);
        $("#condiciones").val(condiciones);
        $("#observaciones").val(observaciones);
        $("#situacion").val(situacion);
        $("#bodega").val(bodega);

        // Mostrar u ocultar la vista previa del PDF
        if (archivo_pdf) {
            $('#pdf_view').attr('src', './uploads/' + archivo_pdf);
            $('#pdf-preview').show();
        } else {
            $('#pdf-preview').hide();
        }

        opcion = 2; // editar

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Registro");
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
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function () {
                    tablaPersonas.row(fila).remove().draw();
                }
            });
        }
    });

    // Manejo del envío del formulario
    $("#formPersonas").submit(function (e) {
        e.preventDefault();

        num_int = $.trim($("#num_int").val());
        descripcion = $.trim($("#descripcion").val());
        metodo = $.trim($("#metodo").val());
        serie = $.trim($("#serie").val());
        inventario = $.trim($("#inventario").val());
        modelo = $.trim($("#modelo").val());
        marca = $.trim($("#marca").val());
        accesorios = $.trim($("#accesorios").val());
        calibracion = $.trim($("#calibracion").val());
        verificacion = $.trim($("#verificacion").val());
        ultima = $.trim($("#ultima").val());
        informe = $.trim($("#informe").val());
        proxima = $.trim($("#proxima").val());
        status_c = $.trim($("#status_c").val());
        ubicacion = $.trim($("#ubicacion").val());
        prueba = $.trim($("#prueba").val());
        condiciones = $.trim($("#condiciones").val());
        observaciones = $.trim($("#observaciones").val());
        situacion = $.trim($("#situacion").val());
        bodega = $.trim($("#bodega").val());

        var formData = new FormData(this);
        formData.append('id', id);
        formData.append('opcion', opcion);

        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                id = data.id;
                num_int = data.num_int;
                descripcion = data.descripcion;
                metodo = data.metodo;
                serie = data.serie;
                inventario = data.inventario;
                modelo = data.modelo;
                marca = data.marca;
                accesorios = data.accesorios;
                calibracion = data.calibracion;
                verificacion = data.verificacion;
                ultima = data.ultima;
                informe = data.informe;
                proxima = data.proxima;
                status_c = data.status_c;
                ubicacion = data.ubicacion;
                prueba = data.prueba;
                condiciones = data.condiciones;
                observaciones = data.observaciones;
                situacion = data.situacion;
                bodega = data.bodega;
                archivo_pdf = data.archivo_pdf;

                if (opcion == 1) {
                    tablaPersonas.row.add([
                        id, num_int, descripcion, metodo, serie, inventario, modelo, marca, accesorios, calibracion, verificacion,
                        ultima, informe, proxima, status_c, ubicacion, prueba, condiciones, observaciones, situacion, bodega, archivo_pdf
                    ]).draw();
                } else {
                    tablaPersonas.row(fila).data([
                        id, num_int, descripcion, metodo, serie, inventario, modelo, marca, accesorios, calibracion, verificacion,
                        ultima, informe, proxima, status_c, ubicacion, prueba, condiciones, observaciones, situacion, bodega, archivo_pdf
                    ]).draw();
                }
                if (status_c === "VIGENTE") {
                    $(tablaPersonas.row(fila).node()).removeClass('fila-VENCIDO').addClass('fila-VIGENTE');
                } else if (status_c === "VENCIDO") {
                    $(tablaPersonas.row(fila).node()).removeClass('fila-VIGENTE').addClass('fila-VENCIDO');
                } else {
                    $(tablaPersonas.row(fila).node()).removeClass('fila-VIGENTE fila-VENCIDO');
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});
