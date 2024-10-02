$(document).ready(function () {
    var tablaRadiacion = $("#tablaRadiacion").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
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
        $("#formRadiacion").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Equipo de Radiación");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
        $('#pdf-preview').hide(); // Ocultar la vista previa del PDF al crear un nuevo registro
    });

    var fila;

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        num_int = fila.find('td:eq(1)').text();
        descripcion = fila.find('td:eq(2)').text();
        serie = fila.find('td:eq(3)').text();
        modelo = fila.find('td:eq(4)').text();
        marca = fila.find('td:eq(5)').text();
        calibracion = fila.find('td:eq(6)').text();
        verificacion = fila.find('td:eq(7)').text();
        ultima = fila.find('td:eq(8)').text();
        proxima = fila.find('td:eq(9)').text();
        status_c = fila.find('td:eq(10)').text();
        ubicacion = fila.find('td:eq(11)').text();
        prueba = fila.find('td:eq(12)').text();
        condiciones = fila.find('td:eq(13)').text();
        observaciones = fila.find('td:eq(14)').text();
        archivo_pdf = fila.find('td:eq(16)').text();

        $("#num_int").val(num_int);
        $("#descripcion").val(descripcion);
        $("#serie").val(serie);
        $("#modelo").val(modelo);
        $("#marca").val(marca);
        $("#calibracion").val(calibracion);
        $("#verificacion").val(verificacion);
        $("#ultima").val(ultima);
        $("#proxima").val(proxima);
        $("#status_c").val(status_c);
        $("#ubicacion").val(ubicacion);
        $("#prueba").val(prueba);
        $("#condiciones").val(condiciones);
        $("#observaciones").val(observaciones);

        if (archivo_pdf) {
            $('#pdf_view').attr('src', './pdfs_radiacion/' + archivo_pdf);
            $('#pdf-preview').show();
        } else {
            $('#pdf-preview').hide();
        }

        opcion = 2; //editar

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Registro");
        $("#modalCRUD").modal("show");
    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        opcion = 3; //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "./bd/crud_radiacion.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function (data) {
                    if (data.success) {
                        window.location.reload(); // Recargar la página si la eliminación fue exitosa
                    } else {
                        alert('No se pudo eliminar el registro.');
                    }
                },
                error: function () {
                    alert('Error en la solicitud.');
                }
            });
        }
    });

    $("#formRadiacion").submit(function (e) {
        e.preventDefault();
        num_int = $.trim($("#num_int").val());
        descripcion = $.trim($("#descripcion").val());
        serie = $.trim($("#serie").val());
        modelo = $.trim($("#modelo").val());
        marca = $.trim($("#marca").val());
        calibracion = $.trim($("#calibracion").val());
        verificacion = $.trim($("#verificacion").val());
        ultima = $.trim($("#ultima").val());
        proxima = $.trim($("#proxima").val());
        status_c = $.trim($("#status_c").val());
        ubicacion = $.trim($("#ubicacion").val());
        prueba = $.trim($("#prueba").val());
        condiciones = $.trim($("#condiciones").val());
        observaciones = $.trim($("#observaciones").val());
        accesorios = $.trim($("#accesorios").val());
        archivo_pdf = $.trim($("#archivo_pdf").val());

        $.ajax({
            url: "./bd/crud_radiacion.php",
            type: "POST",
            dataType: "json",
            data: { num_int: num_int, descripcion: descripcion, serie: serie, modelo: modelo, marca: marca, calibracion: calibracion, verificacion: verificacion, ultima: ultima, proxima: proxima, status_c: status_c, ubicacion: ubicacion, prueba: prueba, condiciones: condiciones, observaciones: observaciones, accesorios: accesorios, archivo_pdf: archivo_pdf, id: id, opcion: opcion },
            success: function (data) {
                console.log(data);
                id = data[0].id;
                num_int = data[0].num_int;
                descripcion = data[0].descripcion;
                serie = data[0].serie;
                modelo = data[0].modelo;
                marca = data[0].marca;
                calibracion = data[0].calibracion;
                verificacion = data[0].verificacion;
                ultima = data[0].ultima;
                proxima = data[0].proxima;
                status_c = data[0].status_c;
                ubicacion = data[0].ubicacion;
                prueba = data[0].prueba;
                condiciones = data[0].condiciones;
                observaciones = data[0].observaciones;
                accesorios = data[0].accesorios;
                archivo_pdf = data[0].archivo_pdf;
                if (opcion == 1) {
                    tablaRadiacion.row.add([id, num_int, descripcion, serie, modelo, marca, calibracion, verificacion, ultima, proxima, status_c, ubicacion, prueba, condiciones, observaciones, accesorios, archivo_pdf]).draw();
                } else {
                    tablaRadiacion.row(fila).data([id, num_int, descripcion, serie, modelo, marca, calibracion, verificacion, ultima, proxima, status_c, ubicacion, prueba, condiciones, observaciones, accesorios, archivo_pdf]).draw();
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});
