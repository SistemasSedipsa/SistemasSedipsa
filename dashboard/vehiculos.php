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

    // Consulta actualizada
    $consulta = "SELECT id, num, placas, marca, modelo, color, motor, serie, trabajador, fecha, servicio, ultima_mant, proxima_mant, kilometraje, status_mant, ultima_ver, proxima_ver, status_ver, tag, gasolina, compania, numero, inicia, termina, carta, factura, otros, archivo_vehiculo FROM vehiculos";
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
                        <form method="POST" action="procesar_vehiculos.php" enctype="multipart/form-data">
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
            <h2>Registro de Vehiculo</h2>
            <div class="col-lg-12" id="container">
                <button id="btnNuevo" type="button" class="btn btn-outline-info" data-toggle="modal">
                    <i class="fas fa-plus"></i> Nuevo
                </button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaVehiculos" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Num</th>
                                <th>Placas</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Color</th>
                                <th>Motor</th>
                                <th>Serie</th>
                                <th>Trabajador</th>
                                <th>Fecha</th>
                                <th>Servicio</th>
                                <th>Último Mantenimiento</th>
                                <th>Próximo Mantenimiento</th>
                                <th>Kilometraje</th>
                                <th>Estado Mantenimiento</th>
                                <th>Última Verificación</th>
                                <th>Próxima Verificación</th>
                                <th>Estado Verificación</th>
                                <th>TAG</th>
                                <th>Gasolina</th>
                                <th>Compañía</th>
                                <th>Número</th>
                                <th>Inicio Póliza</th>
                                <th>Fin Póliza</th>
                                <th>Carta</th>
                                <th>Factura</th>
                                <th>Otros</th>
                                <th>Documentos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $dat) { ?>
                                <tr>
                                    <td><?php echo $dat['id'] ?></td>
                                    <td><?php echo $dat['num'] ?></td>
                                    <td><?php echo $dat['placas'] ?></td>
                                    <td><?php echo $dat['marca'] ?></td>
                                    <td><?php echo $dat['modelo'] ?></td>
                                    <td><?php echo $dat['color'] ?></td>
                                    <td><?php echo $dat['motor'] ?></td>
                                    <td><?php echo $dat['serie'] ?></td>
                                    <td><?php echo $dat['trabajador'] ?></td>
                                    <td><?php echo $dat['fecha'] ?></td>
                                    <td><?php echo $dat['servicio'] ?></td>
                                    <td><?php echo $dat['ultima_mant'] ?></td>
                                    <td><?php echo $dat['proxima_mant'] ?></td>
                                    <td><?php echo $dat['kilometraje'] ?></td>
                                    <td><?php echo $dat['status_mant'] ?></td>
                                    <td><?php echo $dat['ultima_ver'] ?></td>
                                    <td><?php echo $dat['proxima_ver'] ?></td>
                                    <td><?php echo $dat['status_ver'] ?></td>
                                    <td><?php echo $dat['tag'] ?></td>
                                    <td><?php echo $dat['gasolina'] ?></td>
                                    <td><?php echo $dat['compania'] ?></td>
                                    <td><?php echo $dat['numero'] ?></td>
                                    <td><?php echo $dat['inicia'] ?></td>
                                    <td><?php echo $dat['termina'] ?></td>
                                    <td><?php echo $dat['carta'] ?></td>
                                    <td><?php echo $dat['factura'] ?></td>
                                    <td><?php echo $dat['otros'] ?></td>
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
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gestión de Vehículos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formVehiculos" method="POST" action="./bd/gestion_vehiculos.php"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Primera columna -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="num" class="col-form-label">Num.:</label>
                                    <input type="text" class="form-control" id="num" name="num" required>
                                </div>
                                <div class="form-group">
                                    <label for="placas" class="col-form-label">Placas:</label>
                                    <input type="text" class="form-control" id="placas" name="placas" required>
                                </div>
                                <div class="form-group">
                                    <label for="marca" class="col-form-label">Marca:</label>
                                    <input type="text" class="form-control" id="marca" name="marca" required>
                                </div>
                                <div class="form-group">
                                    <label for="modelo" class="col-form-label">Modelo:</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                                </div>
                                <div class="form-group">
                                    <label for="color" class="col-form-label">Color:</label>
                                    <input type="text" class="form-control" id="color" name="color" required>
                                </div>
                                <div class="form-group">
                                    <label for="motor" class="col-form-label">Motor:</label>
                                    <input type="text" class="form-control" id="motor" name="motor" required>
                                </div>
                            </div>
                            <!-- Segunda columna -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="serie" class="col-form-label">Serie:</label>
                                    <input type="text" class="form-control" id="serie" name="serie" required>
                                </div>
                                <div class="form-group">
                                    <label for="trabajador" class="col-form-label">Trabajador:</label>
                                    <input type="text" class="form-control" id="trabajador" name="trabajador" required>
                                </div>
                                <div class="form-group">
                                    <label for="fecha" class="col-form-label">Fecha:</label>
                                    <input type="text" class="form-control" id="fecha" name="fecha" required>
                                </div>
                                <div class="form-group">
                                    <label for="servicio" class="col-form-label">Servicio:</label>
                                    <input type="text" class="form-control" id="servicio" name="servicio" required>
                                </div>
                                <div class="form-group">
                                    <label for="ultima_mant" class="col-form-label">Último Mantenimiento:</label>
                                    <input type="text" class="form-control" id="ultima_mant" name="ultima_mant"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="proxima_mant" class="col-form-label">Próximo Mantenimiento:</label>
                                    <input type="text" class="form-control" id="proxima_mant" name="proxima_mant"
                                        required>
                                </div>
                            </div>
                            <!-- Tercera columna -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kilometraje" class="col-form-label">Kilometraje:</label>
                                    <input type="text" class="form-control" id="kilometraje" name="kilometraje"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="status_mant" class="col-form-label">Estado Mantenimiento:</label>
                                    <input type="text" class="form-control" id="status_mant" name="status_mant"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="ultima_ver" class="col-form-label">Última Verificación:</label>
                                    <input type="text" class="form-control" id="ultima_ver" name="ultima_ver" required>
                                </div>
                                <div class="form-group">
                                    <label for="proxima_ver" class="col-form-label">Próxima Verificación:</label>
                                    <input type="text" class="form-control" id="proxima_ver" name="proxima_ver"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="status_ver" class="col-form-label">Estado Verificación:</label>
                                    <input type="text" class="form-control" id="status_ver" name="status_ver" required>
                                </div>
                                <div class="form-group">
                                    <label for="tag" class="col-form-label">TAG:</label>
                                    <input type="text" class="form-control" id="tag" name="tag" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Cuarta columna -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gasolina" class="col-form-label">Tarjeta de Gasolina:</label>
                                    <input type="text" class="form-control" id="gasolina" name="gasolina" required>
                                </div>
                                <div class="form-group">
                                    <label for="compania" class="col-form-label">Compañía:</label>
                                    <input type="text" class="form-control" id="compania" name="compania" required>
                                </div>
                                <div class="form-group">
                                    <label for="numero" class="col-form-label">Número:</label>
                                    <input type="text" class="form-control" id="numero" name="numero" required>
                                </div>
                                <div class="form-group">
                                    <label for="inicia" class="col-form-label">Inicio Póliza:</label>
                                    <input type="text" class="form-control" id="inicia" name="inicia" required>
                                </div>
                                <div class="form-group">
                                    <label for="termina" class="col-form-label">Fin Póliza:</label>
                                    <input type="text" class="form-control" id="termina" name="termina" required>
                                </div>
                            </div>
                            <!-- Quinta columna -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="carta" class="col-form-label">Carta:</label>
                                    <input type="text" class="form-control" id="carta" name="carta">
                                </div>
                                <div class="form-group">
                                    <label for="factura" class="col-form-label">Factura:</label>
                                    <input type="text" class="form-control" id="factura" name="factura">
                                </div>
                                <div class="form-group">
                                    <label for="otros" class="col-form-label">Otros Documentos:</label>
                                    <input type="text" class="form-control" id="otros" name="otros">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="opcion" name="opcion" value="1">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark" id="guardarBtn">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para ver PDFs -->
    <div class="modal fade" id="pdfViewModal" tabindex="-1" role="dialog" aria-labelledby="pdfViewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfViewModalLabel">Visualizar/Editar PDFs</h5>
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


    <div class="modal fade" id="uploadPdfModal" tabindex="-1" role="dialog" aria-labelledby="uploadPdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadPdfModalLabel">Subir PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="uploadPdfForm" method="POST" action="subir_pdf_vehiculo.php"
                        enctype="multipart/form-data">
                        <input type="hidden" name="vehiculo_id" id="vehiculo_id">
                        <div class="form-group">
                            <label for="archivo_vehiculo" class="col-form-label">Seleccionar Carpeta:</label>
                            <input type="file" class="form-control-file" id="archivo_vehiculo" name="archivo_vehiculo[]"
                                accept=".pdf" multiple webkitdirectory>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir</button>
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
                    url: 'obtener_pdfs_vehiculo.php',
                    type: 'GET',
                    data: { id: id },
                    success: function (response) {
                        var archivosVehi = JSON.parse(response);
                        var html = '';

                        archivosVehi.forEach(function (archivosVehi) {
                            var nombreArchivo = archivosVehi.archivo_vehiculo.split('/').pop();
                            html += '<div class="pdf-item">';
                            html += '<a href="' + archivosVehi.archivo_vehiculo + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
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
                $('#vehiculo_id').val(id);
                $('#uploadPdfModal').modal('show');
            });

            // Reemplazar PDF
            $(document).on('click', '.edit-pdf', function () {
                var vehiculoId = $(this).data('id');
                $('#vehiculo_id').val(vehiculoId);
                $('#replacePdfModalVehiculo').modal('show');
            });

            $(document).ready(function () {
                // Ver PDFs
                $(document).on('click', '.view-pdf', function () {
                    var id = $(this).data('id');

                    // Obtener la lista de PDFs
                    $.ajax({
                        url: 'obtener_pdfs_vehiculo.php',
                        type: 'GET',
                        data: { id: id },
                        success: function (response) {
                            var archivosVehi = JSON.parse(response);
                            var html = '';
                            archivosVehi.forEach(function (archivoVehi) {
                                var nombreArchivo = archivoVehi.archivo_vehiculo.split('/').pop();
                                html += '<div class="pdf-item">';
                                html += '<a href="' + archivoVehi.archivo_vehiculo + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
                                html += '<span>' + nombreArchivo + '</span>';
                                html += '<button class="btn btn-danger btn-sm delete-pdf" data-id="' + archivoVehi.id + '">Eliminar</button>';
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
                        url: 'eliminar_pdf.php',
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
                    $('#vehiculo_id').val(id);
                    $('#uploadPdfModal').modal('show');
                });
            });

        });
    </script>
    <script>
        $(document).ready(function () {
            // Initialize the DataTable only if it has not been initialized already
            if (!$.fn.dataTable.isDataTable('#example')) {
                $('#example').DataTable({
                    responsive: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            }
        });
    </script>
    <script type="text/javascript" src="./vehiculos/gestion_vehiculos.js"></script>
</div>
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"; ?>