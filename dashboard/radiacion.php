<?php require_once "vistas/parte_superior.php"; ?>

<!--INICIO del cont principal-->
<div class="container-fluid p-0">
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo '<div id="alerta-mensaje" class="alert alert-info">' . $_SESSION['mensaje'] . '</div>';
        unset($_SESSION['mensaje']);
    }
    ?>
    <link rel="stylesheet" href="./estilos_tabla.css">
    <?php
    require_once './bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    // Consultas para los tres CRUDs
    $consulta = "SELECT id, num_int, descripcion, serie, modelo, marca, calibracion, verificacion, ultima, proxima, status_c, ubicacion, prueba, condiciones, observaciones, archivo_pdf FROM equipo_radiacion";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1 = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Subir Archivo Excel</h2>
                        <form method="POST" action="procesar_radiacion.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="archivoExcel" class="form-label">Seleccionar archivo Excel (.csv)</label>
                                <input type="file" class="form-control-file" id="archivoExcel" name="archivo_excel"
                                    accept=".csv">
                            </div>
                            <button type="submit" class="btn btn-primary">Cargar Archivo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CRUD 1 -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Equipo de Radiación</h2>
                <div class="container-fluid mb-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <button id="btnNuevo" type="button" class="btn btn-outline-info" data-toggle="modal">
                                <i class="fas fa-plus"></i> Nuevo</button>
                            <a href="generar_exel_radiacion.php" class="btn btn-outline-success">
                                <i class="fas fa-file-excel"></i> Generar EXEL
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tablaRadiacion" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>No.Interno</th>
                                <th>Descripción</th>
                                <th>No.Serie</th>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Calibración</th>
                                <th>Verificación</th>
                                <th>Fecha Última (Cal/Ver)</th>
                                <th>Fecha Próxima (Cal/Ver)</th>
                                <th>Status</th>
                                <th>Ubicación</th>
                                <th>Prueba</th>
                                <th>Condiciones</th>
                                <th>Observaciones</th>
                                <th>Accesorios</th>
                                <th>Documentos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data1 as $dat) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($dat['id']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['num_int']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['descripcion']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['serie']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['modelo']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['marca']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['calibracion']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['verificacion']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['ultima']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['proxima']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['status_c']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['ubicacion']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['prueba']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['condiciones']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['observaciones']); ?></td>
                                    <td>
                                        <button class="btn btn-outline-secondary btn-sm manage-accessories-rad"
                                            data-id="<?php echo htmlspecialchars($dat['id']); ?>">
                                            <i class="fas fa-cogs"></i> Accesorios
                                        </button>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-outline-warning btn-sm view-pdf"
                                                data-id="<?php echo htmlspecialchars($dat['id']); ?>">Ver
                                                Documentos</button>
                                            <button class="btn btn-outline-danger btn-sm upload-pdf"
                                                data-id="<?php echo htmlspecialchars($dat['id']); ?>">Subir
                                                Documentos</button>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para CRUD 1 -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Equipo de Radiación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formRadiacion" method="POST" action="./bd/crud_radiacion.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="num_int" class="col-form-label">No. Interno:</label>
                                    <input type="text" class="form-control" id="num_int" name="num_int" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="col-form-label">Descripción:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="serie" class="col-form-label">No. Serie:</label>
                                    <input type="text" class="form-control" id="serie" name="serie" required>
                                </div>
                                <div class="form-group">
                                    <label for="modelo" class="col-form-label">Modelo:</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                                </div>
                                <div class="form-group">
                                    <label for="marca" class="col-form-label">Marca:</label>
                                    <input type="text" class="form-control" id="marca" name="marca" required>
                                </div>
                                <div class="form-group">
                                    <label for="ubicacion" class="col-form-label">Ubicación:</label>
                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="calibracion" class="col-form-label">Calibración:</label>
                                    <input type="text" class="form-control" id="calibracion" name="calibracion"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="verificacion" class="col-form-label">Verificación:</label>
                                    <input type="text" class="form-control" id="verificacion" name="verificacion"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="ultima" class="col-form-label">Fecha Última (Cal/Ver):</label>
                                    <input type="text" class="form-control" id="ultima" name="ultima" required>
                                </div>
                                <div class="form-group">
                                    <label for="proxima" class="col-form-label">Fecha Próxima (Cal/Ver):</label>
                                    <input type="text" class="form-control" id="proxima" name="proxima" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_c" class="col-form-label">Status:</label>
                                    <input type="text" class="form-control" id="status_c" name="status_c" required>
                                </div>
                                <div class="form-group">
                                    <label for="prueba" class="col-form-label">Prueba:</label>
                                    <input type="text" class="form-control" id="prueba" name="prueba" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="condiciones" class="col-form-label">Condiciones:</label>
                                    <input type="text" class="form-control" id="condiciones" name="condiciones"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="observaciones" class="col-form-label">Observaciones:</label>
                                    <input type="text" class="form-control" id="observaciones" name="observaciones"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark" id="guardarBtn">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Para Visualizar PDFs -->
    <div class="modal fade" id="pdfViewModal" tabindex="-1" role="dialog" aria-labelledby="pdfViewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfViewModalLabel">Visualizar Documentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="pdfList"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Para Subir PDFs -->
    <div class="modal fade" id="uploadPdfModal" tabindex="-1" role="dialog" aria-labelledby="uploadPdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadPdfModalLabel">Subir Documentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="uploadPdfForm" method="POST" action="subir_pdf_radiacion.php"
                        enctype="multipart/form-data">
                        <input type="hidden" name="radiacion_id" id="radiacion_id">
                        <div class="form-group">
                            <label for="archivo_pdf" class="col-form-label">Seleccionar Carpeta:</label>
                            <input type="file" class="form-control-file" id="archivo_pdf" name="archivo_pdf[]"
                                accept=".pdf" multiple webkitdirectory>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Eliminar Archivos PDF-->
    <div class="modal fade" id="deletePdfModal" tabindex="-1" role="dialog" aria-labelledby="deletePdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePdfModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deletePdfForm" method="POST" action="eliminar_pdf_fuentes.php">
                        <input type="hidden" name="archivo_id" id="deleteArchivoId">
                        <p>¿Estás seguro de que deseas eliminar este archivo?</p>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var alertaMensaje = document.getElementById("alerta-mensaje");
            if (alertaMensaje) {
                setTimeout(function () {
                    alertaMensaje.style.display = "none";
                }, 5000);
            }
        });

        $(document).ready(function () {
            // Ver PDFs
            $(document).on('click', '.view-pdf', function () {
                var id = $(this).data('id');

                // Obtener la lista de PDFs
                $.ajax({
                    url: 'obtener_pdfs_radiacion.php',
                    type: 'GET',
                    data: { id: id },
                    success: function (response) {
                        var archivos = JSON.parse(response);
                        var html = '';

                        archivos.forEach(function (archivo) {
                            var nombre_radiacion = archivo.archivo_pdf.split('/').pop();
                            html += '<div class="pdf-item">';
                            html += '<a href="' + archivo.archivo_pdf + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
                            html += '<span>' + nombre_radiacion + '</span>';
                            html += '</div>';
                        });

                        $('#pdfList').html(html);
                        $('#pdfViewModal').modal('show');
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            // Subir PDF
            $(document).on('click', '.upload-pdf', function () {
                var id = $(this).data('id');
                $('#radiacion_id').val(id);
                $('#uploadPdfModal').modal('show');
            });

            // Reemplazar PDF
            $(document).on('click', '.edit-pdf', function () {
                var radiacionId = $(this).data('id');
                $('#radiacion_id').val(radiacionId);
                $('#replacePdfModalFuente').modal('show');
            });

            $(document).ready(function () {
                // Ver PDFs
                $(document).on('click', '.view-pdf', function () {
                    var id = $(this).data('id');

                    // Obtener la lista de PDFs
                    $.ajax({
                        url: 'obtener_pdfs_radiacion.php',
                        type: 'GET',
                        data: { id: id },
                        success: function (response) {
                            var archivos = JSON.parse(response);
                            var html = '';
                            archivos.forEach(function (archivo) {
                                var nombre_radiacion = archivo.archivo_pdf.split('/').pop();
                                html += '<div class="pdf-item">';
                                html += '<a href="' + archivo.archivo_pdf + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
                                html += '<span>' + nombre_radiacion + '</span>';
                                html += '<button class="btn btn-danger btn-sm delete-pdf" data-id="' + archivo.id + '">Eliminar</button>';
                                html += '</div>';
                            });

                            $('#pdfList').html(html);
                            $('#pdfViewModal').modal('show');
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });

                // Eliminar PDF
                $(document).on('click', '.delete-pdf', function () {
                    var id = $(this).data('id');

                    $.ajax({
                        url: 'eliminar_pdf_radiacion.php',
                        type: 'POST',
                        data: { id: id },
                        success: function (response) {
                            var data = JSON.parse(response);
                            if (data.success) {
                                alert(data.message);
                                $('.view-pdf').click(); // Refresh the list
                            } else {
                                alert(data.message);
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });

                // Subir PDF
                $(document).on('click', '.upload-pdf', function () {
                    var id = $(this).data('id');
                    $('#radiacion_id').val(id);
                    $('#uploadPdfModal').modal('show');
                });
            });

        });
    </script>

    <!-- Modal para Gestionar Accesorios -->
    <div class="modal fade" id="accessoriesModalRad" tabindex="-1" role="dialog"
        aria-labelledby="accessoriesModalRadLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accessoriesModalRadLabel">Gestionar Accesorios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="radiacionForm" method="POST" action="manage_radiacion.php">
                    <div class="modal-body">
                        <input type="hidden" name="radiacion_id" id="accessories_radiacion_id">
                        <div id="accessoryFields">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre[]">
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-info" id="addAccessoryField"><i
                                class="fas fa-plus"></i> Nuevo accesorio</button>
                        <div id="accessories_list_rad"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Añadir un nuevo campo de nombre de accesorio
            $('#addAccessoryField').on('click', function () {
                var newField = `
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre[]">
                </div>`;
                $('#accessoryFields').append(newField);
            });

            // Gestionar Accesorios
            $(document).on('click', '.manage-accessories-rad', function () {
                var id = $(this).data('id');
                $('#accessories_radiacion_id').val(id);

                $.ajax({
                    url: 'get_radiacion.php',
                    type: 'GET',
                    data: { radiacion_id: id },
                    success: function (response) {
                        try {
                            var accesorios = JSON.parse(response);
                            var html = '<h5>Accesorios</h5><ul>';

                            accesorios.forEach(function (accesorio) {
                                html += '<li>' + accesorio.nombre + '</li>';
                            });

                            html += '</ul>';
                            $('#accessories_list_rad').html(html);
                            $('#accessoriesModalRad').modal('show');
                        } catch (e) {
                            console.error('Error al analizar la respuesta JSON:', e);
                        }
                    },
                    error: function (error) {
                        console.error('Error al obtener los accesorios:', error);
                    }
                });
            });

            // Enviar formulario de accesorios
            $('#radiacionForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'manage_radiacion.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.success) {
                                alert(data.message);
                                $('#accessoriesModalRad').modal('hide');
                                location.reload();
                            } else {
                                alert(data.message);
                            }
                        } catch (e) {
                            console.error('Error al analizar la respuesta JSON:', e);
                        }
                    },
                    error: function (error) {
                        console.error('Error al enviar el formulario:', error);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript" src="./radiacion/radiacion.js"></script>
</div>
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"; ?>