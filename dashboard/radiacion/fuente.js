$(document).ready(function () {
    var tablaFuente = $("#tablaFuente").DataTable({
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
        $("#formFuente").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Fuente Radiológica");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });

    var fila;

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        fuentes = fila.find('td:eq(1)').text();
        modelo = fila.find('td:eq(2)').text();
        marca = fila.find('td:eq(3)').text();
        serie = fila.find('td:eq(4)').text();
        contenedor = fila.find('td:eq(5)').text();
        decantamiento = fila.find('td:eq(6)').text();
        documentos_fuente = fila.find('td:eq(7)').text();
        
        $("#fuentes").val(fuentes);
        $("#modelo").val(modelo);
        $("#marca").val(marca);
        $("#serie").val(serie);
        $("#contenedor").val(contenedor);
        $("#decantamiento").val(decantamiento);
        $("#documentos_fuente").val(documentos_fuente);

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
                url: "./bd/crud_fuente.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function (data) {
                    if (data.success) {
                        tablaFuente.row(fila).remove().draw();
                    } else {
                        alert("No se pudo eliminar el registro.");
                    }
                }
            });
        }
    });

    $("#formFuente").submit(function (e) {
        e.preventDefault();
        fuentes = $.trim($("#fuentes").val());
        modelo = $.trim($("#modelo").val());
        marca = $.trim($("#marca").val());
        serie = $.trim($("#serie").val());
        contenedor = $.trim($("#contenedor").val());
        decantamiento = $.trim($("#decantamiento").val());
        documentos_fuente = $.trim($("#documentos_fuente").val());

        $.ajax({
            url: "./bd/crud_fuente.php",
            type: "POST",
            dataType: "json",
            data: { fuentes: fuentes, modelo: modelo, marca: marca, serie: serie, contenedor: contenedor, decantamiento: decantamiento, documentos_fuente: documentos_fuente, id: id, opcion: opcion },
            success: function (data) {
                if (data.success) {
                    id = data[0].id;
                    fuentes = data[0].fuentes;
                    modelo = data[0].modelo;
                    marca = data[0].marca;
                    serie = data[0].serie;
                    contenedor = data[0].contenedor;
                    decantamiento = data[0].decantamiento;
                    documentos_fuente = data[0].documentos_fuente;
                    if (opcion == 1) {
                        tablaFuente.row.add([id, fuentes, modelo, marca, serie, contenedor, decantamiento, documentos_fuente]).draw();
                    } else {
                        tablaFuente.row(fila).data([id, fuentes, modelo, marca, serie, contenedor, decantamiento, documentos_fuente]).draw();
                    }
                    $("#modalCRUD").modal("hide");
                } else {
                    alert("No se pudo guardar el registro.");
                }
            }
        });
    });
});
