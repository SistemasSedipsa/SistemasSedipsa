$(document).ready(function () {
    var table = $('#example').DataTable({
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
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> ',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info'
            },
            {
                text: '<i class="fa fa-plus"></i> Agregar Registro',
                titleAttr: 'Agregar Registro',
                className: 'btn btn-primary',
                action: function (e, dt, node, config) {
                    $('#addRecordModal').modal('show');
                }
            }
        ]
    });

    // Guardar nuevo registro
    $('#saveRecordButton').on('click', function () {
        var empresa = $('#empresa').val();
        var atiende = $('#atiende').val();
        var puesto = $('#puesto').val();
        var correo = $('#correo').val();
        var telefono = $('#telefono').val();

        $.ajax({
            url: './bd/guardar_cliente.php',
            type: 'POST',
            data: {
                empresa: empresa,
                atiende: atiende,
                puesto: puesto,
                correo: correo,
                telefono: telefono
            },
            success: function (response) {
                var newId = response;

                table.row.add([
                    newId,
                    empresa,
                    atiende,
                    puesto,
                    correo,
                    telefono,
                    '<div class="btn-group" role="group" aria-label="Basic example">' +
                    '<button class="btn btn-warning btn-sm editBtn">Editar</button>' +
                    '<button class="btn btn-danger btn-sm deleteBtn">Eliminar</button>' +
                    '</div>'
                ]).draw();

                $('#addRecordModal').modal('hide');
                $('#addRecordForm')[0].reset();
                Swal.fire('Éxito', 'Nuevo registro agregado con éxito', 'success');
            },
            error: function () {
                Swal.fire('Error', 'Hubo un error al guardar el registro.', 'error');
            }
        });
    });

    // Función para eliminar un registro
    $('#example tbody').on('click', '.deleteBtn', function () {
        var row = $(this).closest('tr');
        var id = row.find('td:eq(0)').text(); // Asume que la primera columna es el ID

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'No podrás revertir esto.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: './bd/eliminar_cliente.php',
                    type: 'POST',
                    data: { id: id },
                    success: function (response) {
                        table.row(row).remove().draw();
                        Swal.fire('Eliminado', 'Registro eliminado con éxito', 'success');
                    },
                    error: function () {
                        Swal.fire('Error', 'Hubo un error al eliminar el registro.', 'error');
                    }
                });
            }
        });
    });

    // Función para editar un registro
    $('#example tbody').on('click', '.editBtn', function () {
        var row = $(this).closest('tr');
        var id = row.find('td:eq(0)').text();
        var empresa = row.find('td:eq(1)').text();
        var atiende = row.find('td:eq(2)').text();
        var puesto = row.find('td:eq(3)').text();
        var correo = row.find('td:eq(4)').text();
        var telefono = row.find('td:eq(5)').text();

        $('#empresa').val(empresa);
        $('#atiende').val(atiende);
        $('#puesto').val(puesto);
        $('#correo').val(correo);
        $('#telefono').val(telefono);
        $('#addRecordModal').modal('show');

        $('#saveRecordButton').off('click').on('click', function () {
            var newEmpresa = $('#empresa').val();
            var newAtiende = $('#atiende').val();
            var newPuesto = $('#puesto').val();
            var newCorreo = $('#correo').val();
            var newTelefono = $('#telefono').val();

            $.ajax({
                url: './bd/editar_cliente.php',
                type: 'POST',
                data: {
                    id: id,
                    empresa: newEmpresa,
                    atiende: newAtiende,
                    puesto: newPuesto,
                    correo: newCorreo,
                    telefono: newTelefono
                },
                success: function (response) {
                    row.find('td:eq(1)').text(newEmpresa);
                    row.find('td:eq(2)').text(newAtiende);
                    row.find('td:eq(3)').text(newPuesto);
                    row.find('td:eq(4)').text(newCorreo);
                    row.find('td:eq(5)').text(newTelefono);

                    $('#addRecordModal').modal('hide');
                    Swal.fire('Éxito', 'Registro actualizado con éxito', 'success');
                },
                error: function () {
                    Swal.fire('Error', 'Hubo un error al actualizar el registro.', 'error');
                }
            });
        });
    });
});
