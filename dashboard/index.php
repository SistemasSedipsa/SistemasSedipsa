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

    $consulta = $consulta = "SELECT id, num_int, descripcion, metodo, serie, inventario, modelo, marca, accesorios, calibracion, verificacion, ultima, informe, proxima, status_c, ubicacion, prueba, condiciones, observaciones, situacion, bodega, archivo_pdf FROM almacen";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Subir Archivo Excel</h2>
                        <form method="POST" action="procesar.php" enctype="multipart/form-data">
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

    <div class="container-fluid mb-3">
        <div class="row">
            <h2>Almacén</h2>
            <div class="col-lg-12">
                <button id="btnNuevo" type="button" class="btn btn-outline-info" data-toggle="modal">
                    <i class="fas fa-plus"></i> Nuevo
                </button>
                <!-- <a href="generar_pdf.php" class="btn btn-outline-danger">
                    <i class="fas fa-file-pdf"></i> Generar PDF
                </a> -->
                <a href="generar_exel.php" class="btn btn-outline-success">
                    <i class="fas fa-file-excel"></i> Generar EXCEL
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>No.Interno</th>
                                <th>Descripción</th>
                                <th>Metodo</th>
                                <th>No.Serie</th>
                                <th>Ctrl.Inventario</th>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Accesorios</th>
                                <th>Calibración</th>
                                <th>Verificación</th>
                                <th>Fecha Última (Cal/Ver)</th>
                                <th>No.Informe</th>
                                <th>Fecha Próxima (Cal/Ver)</th>
                                <th>Status</th>
                                <th>Ubicación</th>
                                <th>Prueba</th>
                                <th>Condiciones</th>
                                <th>Observaciones</th>
                                <th>Situación de Almacen</th>
                                <th>Ubicacion (Bodega)</th>
                                <th>Documentos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $dat) {
                                $filaClase = '';
                                if ($dat['status_c'] == 'VIGENTE') {
                                    $filaClase = 'fila-VIGENTE';
                                } elseif ($dat['status_c'] == 'VENCIDO') {
                                    $filaClase = 'fila-VENCIDO';
                                }
                                ?>
                                <tr class="<?php echo $filaClase; ?>">
                                    <td><?php echo htmlspecialchars($dat['id']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['num_int']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['descripcion']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['metodo']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['serie']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['inventario']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['modelo']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['marca']); ?></td>
                                    <td>
                                        <button class="btn btn-outline-secondary btn-sm manage-accessories"
                                            data-id="<?php echo htmlspecialchars($dat['id']); ?>">
                                            <i class="fas fa-cogs"></i> Accesorios
                                        </button>
                                    </td>
                                    <td><?php echo htmlspecialchars($dat['calibracion']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['verificacion']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['ultima']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['informe']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['proxima']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['status_c']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['ubicacion']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['prueba']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['condiciones']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['observaciones']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['situacion']); ?></td>
                                    <td><?php echo htmlspecialchars($dat['bodega']); ?></td>
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

    <!-- Modal para CRUD -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formPersonas" method="POST" action="./bd/crud.php" enctype="multipart/form-data">
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
                                    <label for="metodo" class="col-form-label">Metodo:</label>
                                    <input type="text" class="form-control" id="metodo" name="metodo" required>
                                </div>
                                <div class="form-group">
                                    <label for="serie" class="col-form-label">No.Serie:</label>
                                    <input type="text" class="form-control" id="serie" name="serie" required>
                                </div>
                                <div class="form-group">
                                    <label for="inventario" class="col-form-label">Ctrl.Inventario:</label>
                                    <input type="text" class="form-control" id="inventario" name="inventario" required>
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
                                    <label for="calibracion" class="col-form-label">Calibración:</label>
                                    <input type="text" class="form-control" id="calibracion" name="calibracion">
                                </div>
                                <div class="form-group">
                                    <label for="verificacion" class="col-form-label">Verificación:</label>
                                    <input type="text" class="form-control" id="verificacion" name="verificacion">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ultima" class="col-form-label">Fecha Última (Cal/Ver):</label>
                                    <input type="text" class="form-control" id="ultima" name="ultima">
                                </div>
                                <div class="form-group">
                                    <label for="informe" class="col-form-label">No.Informe:</label>
                                    <input type="text" class="form-control" id="informe" name="informe">
                                </div>
                                <div class="form-group">
                                    <label for="proxima" class="col-form-label">Fecha Próxima (Cal/Ver):</label>
                                    <input type="text" class="form-control" id="proxima" name="proxima">
                                </div>
                                <div class="form-group">
                                    <label for="status_c" class="col-form-label">Status:</label>
                                    <input type="text" class="form-control" id="status_c" name="status_c" required>
                                </div>
                                <div class="form-group">
                                    <label for="ubicacion" class="col-form-label">Ubicación:</label>
                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion">
                                </div>
                                <div class="form-group">
                                    <label for="prueba" class="col-form-label">Prueba:</label>
                                    <input type="text" class="form-control" id="prueba" name="prueba">
                                </div>
                                <div class="form-group">
                                    <label for="condiciones" class="col-form-label">Condiciones:</label>
                                    <input type="text" class="form-control" id="condiciones" name="condiciones">
                                </div>
                                <div class="form-group">
                                    <label for="observaciones" class="col-form-label">Observaciones:</label>
                                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                                </div>
                                <div class="form-group">
                                    <label for="situacion" class="col-form-label">Situación de Almacen:</label>
                                    <input type="text" class="form-control" id="situacion" name="situacion">
                                </div>
                                <div class="form-group">
                                    <label for="bodega" class="col-form-label">Ubicación (Bodega):</label>
                                    <input type="text" class="form-control" id="bodega" name="bodega">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Guardar</button>
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
                    <form id="uploadPdfForm" method="POST" action="subir_pdf.php" enctype="multipart/form-data">
                        <input type="hidden" name="almacen_id" id="almacen_id">
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
                    <form id="deletePdfForm" method="POST" action="borrar_pdf.php">
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
                }, 5000); // Ocultar después de 5 segundos
            }
        });

        $(document).ready(function () {
            // Ver PDFs
            $(document).on('click', '.view-pdf', function () {
                var id = $(this).data('id');

                // Obtener la lista de PDFs
                $.ajax({
                    url: 'obtener_pdfs.php',
                    type: 'GET',
                    data: { id: id },
                    success: function (response) {
                        var archivos = JSON.parse(response);
                        var html = '';

                        archivos.forEach(function (archivo) {
                            var nombreArchivo = archivo.archivo_pdf.split('/').pop();
                            html += '<div class="pdf-item">';
                            html += '<a href="' + archivo.archivo_pdf + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
                            html += '<span>' + nombreArchivo + '</span>';
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
                $('#almacen_id').val(id);
                $('#uploadPdfModal').modal('show');
            });

            // Reemplazar PDF
            $(document).on('click', '.edit-pdf', function () {
                var archivoId = $(this).data('id');
                $('#almacen_id').val(archivoId);
                $('#uploadPdfModal').modal('show');
            });

            $(document).ready(function () {
                // Ver PDFs
                $(document).on('click', '.view-pdf', function () {
                    var id = $(this).data('id');

                    // Obtener la lista de PDFs
                    $.ajax({
                        url: 'obtener_pdfs.php',
                        type: 'GET',
                        data: { id: id },
                        success: function (response) {
                            var archivos = JSON.parse(response);
                            var html = '';
                            archivos.forEach(function (archivo) {
                                var nombreArchivo = archivo.archivo_pdf.split('/').pop();
                                html += '<div class="pdf-item">';
                                html += '<a href="' + archivo.archivo_pdf + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
                                html += '<span>' + nombreArchivo + '</span>';
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
                        url: 'borrar_pdf.php',
                        type: 'POST',
                        data: { id: id },
                        success: function (response) {
                            var data = JSON.parse(response);
                            if (data.success) {
                                alert(data.message);
                                $('.view-pdf').click();
                                // location.reload(); // Refresh the list
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
                    $('#almacen_id').val(id);
                    $('#uploadPdfModal').modal('show');
                });
            });

        });
    </script>

    <!-- Modal para Gestionar Accesorios -->
    <div class="modal fade" id="accessoriesModal" tabindex="-1" role="dialog" aria-labelledby="accessoriesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accessoriesModalLabel">Gestionar Accesorios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="accessoriesForm" method="POST" action="manage_accessories.php">
                    <div class="modal-body">
                        <input type="hidden" name="accesorio_id" id="accessories_almacen_id">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input type="text" class="form-control" id="modelo" name="modelo">
                        </div>
                        <div class="form-group">
                            <label for="ns">NS:</label>
                            <input type="text" class="form-control" id="ns" name="ns">
                        </div>
                        <div class="form-group">
                            <label for="condicion">Condición:</label>
                            <input type="text" class="form-control" id="condicion" name="condicion">
                        </div>
                        <div id="accessories_list"></div>
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
            // Gestionar Accesorios
            $(document).on('click', '.manage-accessories', function () {
                var id = $(this).data('id');
                $('#accessories_almacen_id').val(id);

                $.ajax({
                    url: 'get_accessories.php',
                    type: 'GET',
                    data: { accesorio_id: id },
                    success: function (response) {
                        try {
                            var accesorios = JSON.parse(response);
                            var html = '<h5>Accesorios</h5><ul>';

                            accesorios.forEach(function (accesorio) {
                                html += '<li>' + ' Nombre: ' + accesorio.nombre + '</li>';
                                html += '<li>' + ' Modelo: ' + accesorio.modelo + '</li>';
                                html += '<li>' + ' N/S: ' + accesorio.ns + '</li>';
                                html += '<li>' + ' Condición: ' + accesorio.condicion + '</li>';
                            });

                            html += '</ul>';
                            $('#accessories_list').html(html);
                            $('#accessoriesModal').modal('show');
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                        }
                    },
                    error: function (error) {
                        console.error('Error fetching accessories:', error);
                    }
                });
            });

            // Enviar formulario de accesorios
            $('#accessoriesForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'manage_accessories.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.success) {
                                alert(data.message);
                                $('#accessoriesModal').modal('hide');
                                location.reload();
                            } else {
                                alert(data.message);
                            }
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                        }
                    },
                    error: function (error) {
                        console.error('Error submitting form:', error);
                    }
                });
            });
        });
    </script>

</div>
<script type="text/javascript" src="main.js"></script>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"; ?>