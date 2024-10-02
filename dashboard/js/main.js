$(document).ready(function () {
    var table = $('#example').DataTable({
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            // "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
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
            url: './bd/get_record.php',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function (response) {
                if (response.status === 'success') {
                    var record = response.data;
                    $('#nombre').val(record.nombre);
                    $('#correo').val(record.correo);
                    $('#producto').val(record.producto);
                    $('#alta').val(record.alta);
                    $('#seleccion').val(record.seleccion);
                    $('#notas').val(record.notas);
                    $('#saveRecord').data('id', id); // Establece el ID en el botón de guardar
                    $('#addRecordModal').modal('show'); // Muestra el modal de edición
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
        var nombre = $('#nombre').val();
        var correo = $('#correo').val();
        var producto = $('#producto').val();
        var alta = $('#alta').val();
        var seleccion = $('#seleccion').val();
        var notas = $('#notas').val();
    
        if (nombre && correo && producto && alta && seleccion && notas) {
            $.ajax({
                url: './bd/guardar_prueba.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    nombre: nombre,
                    correo: correo,
                    producto: producto,
                    alta: alta,
                    seleccion: seleccion,
                    notas: notas
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
                    url: './bd/eliminar_prueba.php',
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