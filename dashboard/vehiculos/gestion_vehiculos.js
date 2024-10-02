$(document).ready(function () {
    var tablaVehiculos = $("#tablaVehiculos").DataTable({
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
            "sProcessing": "Procesando..."
        }
    });

    $("#btnNuevo").click(function () {
        $("#formVehiculos").trigger("reset");
        $(".modal-header").css({ "background-color": "#1cc88a", "color": "white" });
        $(".modal-title").text("Nuevo Registro");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; // alta
        $('#pdf-preview').hide(); // Ocultar la vista previa del PDF al crear un nuevo registro
    });

    var fila; // Capturar la fila para editar o borrar el registro

    // Botón EDITAR
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        $("#num").val(fila.find('td:eq(1)').text());
        $("#placas").val(fila.find('td:eq(2)').text());
        $("#marca").val(fila.find('td:eq(3)').text());
        $("#modelo").val(fila.find('td:eq(4)').text());
        $("#color").val(fila.find('td:eq(5)').text());
        $("#motor").val(fila.find('td:eq(6)').text());
        $("#serie").val(fila.find('td:eq(7)').text());
        $("#trabajador").val(fila.find('td:eq(8)').text());
        $("#fecha").val(fila.find('td:eq(9)').text());
        $("#servicio").val(fila.find('td:eq(10)').text());
        $("#ultima_mant").val(fila.find('td:eq(11)').text());
        $("#proxima_mant").val(fila.find('td:eq(12)').text());
        $("#kilometraje").val(fila.find('td:eq(13)').text());
        $("#status_mant").val(fila.find('td:eq(14)').text());
        $("#ultima_ver").val(fila.find('td:eq(15)').text());
        $("#proxima_ver").val(fila.find('td:eq(16)').text());
        $("#status_ver").val(fila.find('td:eq(17)').text());
        $("#tag").val(fila.find('td:eq(18)').text());
        $("#gasolina").val(fila.find('td:eq(19)').text());
        $("#compania").val(fila.find('td:eq(20)').text());
        $("#numero").val(fila.find('td:eq(21)').text());
        $("#inicia").val(fila.find('td:eq(22)').text());
        $("#termina").val(fila.find('td:eq(23)').text());
        $("#carta").val(fila.find('td:eq(24)').text());
        $("#factura").val(fila.find('td:eq(25)').text());
        $("#otros").val(fila.find('td:eq(26)').text());

        var archivo_vehiculo = fila.find('td:eq(27)').text();
        if (archivo_vehiculo) {
            $('#pdf_view').attr('src', './pdfs_vehiculos/' + archivo_vehiculo);
            $('#pdf-preview').show();
        } else {
            $('#pdf-preview').hide();
        }

        opcion = 2; // editar

        $(".modal-header").css({ "background-color": "#4e73df", "color": "white" });
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
                url: "./bd/gestion_vehiculos.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function (data) {
                    if (data.status === 'success') {
                        location.reload(); // Recargar la página automáticamente
                    } else {
                        alert('Error al eliminar el registro: ' + data.message);
                    }
                },
                error: function () {
                    alert('Error al realizar la solicitud');
                }
            });
        }
    });

    // Botón SUBIR PDF
    $(document).on("click", ".btnSubirPDF", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        $("#idSubirPDF").val(id);
        $("#modalSubirPDF").modal("show");
    });

    // Botón VER PDF
    $(document).on("click", ".btnVerPDF", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        var archivo_vehiculo = fila.find('td:eq(27)').text();
        if (archivo_vehiculo) {
            var urlPDF = './pdfs_vehiculos/' + archivo_vehiculo;
            $('#pdfViewer').attr('src', urlPDF);
            $('#modalVerPDF').modal("show");
        } else {
            alert('No hay PDF disponible para este registro.');
        }
    });

    // Envío del formulario para subir PDF
    $("#formSubirPDF").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'procesar_subida_pdf.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload(); // Recargar la página automáticamente
                } else {
                    alert(res.message);
                }
                $("#modalSubirPDF").modal("hide");
            },
            error: function () {
                alert('Error al subir el archivo');
            }
        });
    });

    // Envío del formulario para CRUD
    $("#formVehiculos").submit(function (e) {
        e.preventDefault();

        var num = $.trim($("#num").val());
        var placas = $.trim($("#placas").val());
        var marca = $.trim($("#marca").val());
        var modelo = $.trim($("#modelo").val());
        var color = $.trim($("#color").val());
        var motor = $.trim($("#motor").val());
        var serie = $.trim($("#serie").val());
        var trabajador = $.trim($("#trabajador").val());
        var fecha = $.trim($("#fecha").val());
        var servicio = $.trim($("#servicio").val());
        var ultima_mant = $.trim($("#ultima_mant").val());
        var proxima_mant = $.trim($("#proxima_mant").val());
        var kilometraje = $.trim($("#kilometraje").val());
        var status_mant = $.trim($("#status_mant").val());
        var ultima_ver = $.trim($("#ultima_ver").val());
        var proxima_ver = $.trim($("#proxima_ver").val());
        var status_ver = $.trim($("#status_ver").val());
        var tag = $.trim($("#tag").val());
        var gasolina = $.trim($("#gasolina").val());
        var compania = $.trim($("#compania").val());
        var numero = $.trim($("#numero").val());
        var inicia = $.trim($("#inicia").val());
        var termina = $.trim($("#termina").val());
        var carta = $.trim($("#carta").val());
        var factura = $.trim($("#factura").val());
        var otros = $.trim($("#otros").val());
        var archivo_vehiculo = $.trim($("#archivo_vehiculo").val());

        $.ajax({
            url: "./bd/gestion_vehiculos.php",
            type: "POST",
            dataType: "json",
            data: {
                num: num, placas: placas, marca: marca, modelo: modelo, color: color, motor: motor, serie: serie, trabajador: trabajador, fecha: fecha, servicio: servicio, ultima_mant: ultima_mant, proxima_mant: proxima_mant, kilometraje: kilometraje, status_mant: status_mant, ultima_ver: ultima_ver, proxima_ver: proxima_ver, status_ver: status_ver, tag: tag, gasolina: gasolina, compania: compania, numero: numero, inicia: inicia, termina: termina, carta: carta, factura: factura, otros: otros, archivo_vehiculo: archivo_vehiculo, id: id, opcion: opcion
            },
            success: function (data) {
                if (data.status === 'success') {
                    location.reload(); // Recargar la página automáticamente
                } else if (data.status === 'error') {
                    alert('Error: ' + data.message);
                } else {
                    console.error('Error: El objeto data no tiene la estructura esperada.', data);
                }
                $("#modalCRUD").modal("hide");
            },
            error: function () {
                alert('Error al realizar la solicitud');
            }
        });
    });

    // Función para exportar tabla a Excel
    function exportTableToExcel() {
        var wb = XLSX.utils.table_to_book(document.getElementById('tablaVehiculos'), { sheet: "Sheet1" });
        XLSX.writeFile(wb, 'tabla_vehiculos.xlsx');
    }

    // Función para exportar tabla a PDF
    function exportTableToPDF() {
        const { jsPDF } = window.jspdf;
        const { autoTable } = window.jspdfAutoTable;
        const doc = new jsPDF();

        var table = $('#tablaVehiculos').DataTable();
        var headers = [];
        var data = [];
        
        // Obtener encabezados de columna
        $('#tablaVehiculos thead th').each(function() {
            headers.push($(this).text());
        });

        // Obtener datos de las filas
        table.rows().every(function(rowIdx, tableLoop, rowLoop) {
            var row = this.data();
            var rowData = [];
            for (var i = 0; i < row.length; i++) {
                rowData.push(row[i]);
            }
            data.push(rowData);
        });

        doc.autoTable({
            head: [headers],
            body: data,
            margin: { top: 10 },
            theme: 'grid'
        });

        doc.save('tabla_vehiculos.pdf');
    }

    // Crear botones de exportación
    $('<button/>', {
        text: 'Exportar a Excel',
        class: 'btn btn-success',
        click: exportTableToExcel
    }).appendTo('#container'); // Asegúrate de tener un contenedor con el id `container`
});
