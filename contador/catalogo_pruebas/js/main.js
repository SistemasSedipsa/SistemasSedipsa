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
        responsive: true,
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

    $(document).on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.ajax({
            url: './db/get_record.php',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function (response) {
                if (response.status === 'success') {
                    var record = response.data;
                    $('#prueba').val(record.prueba);
                    $('#descripcion').val(record.descripcion);
                    $('#unidad').val(record.unidad);
                    $('#precio').val(record.precio);
                    $('#saveRecord').data('id', id);
                    $('#addRecordModal').modal('show');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Error al obtener los datos del registro.', 'error');
            }
        });
    });

    $('#saveRecord').on('click', function () {
        var id = $(this).data('id');
        var prueba = $('#prueba').val();
        var descripcion = $('#descripcion').val();
        var unidad = $('#unidad').val();
        var precio = $('#precio').val();
    
        // Eliminar la referencia a longitud
        if (prueba && descripcion && precio) {
            $.ajax({
                url: './db/guardar_prueba.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    prueba: prueba,
                    descripcion: descripcion,
                    unidad: unidad,
                    precio: precio
                },
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Registro guardado correctamente.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Error al intentar guardar los datos.', 'error');
                }
            });
        } else {
            Swal.fire('Advertencia', 'Por favor, complete todos los campos.', 'warning');
        }
    });
    
    $(document).on('click', '.deleteBtn', function () {
        var id = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás recuperar este registro después de eliminarlo.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: './db/eliminar_prueba.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id },
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Eliminado',
                                text: 'El registro ha sido eliminado.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Error al intentar eliminar el registro.', 'error');
                    }
                });
            }
        });
    });
});