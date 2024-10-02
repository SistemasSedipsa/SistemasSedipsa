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

    $consulta = "SELECT id, fuentes, modelo, marca, serie, contenedor, entrada, salida, decantamiento, documentos_fuente FROM fuentes";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- CRUD 2 -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Fuente Radiológica</h2>
                <div class="container-fluid mb-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <button id="btnNuevo" type="button" class="btn btn-outline-info" data-toggle="modal">
                                <i class="fas fa-plus"></i> Nuevo</button>
                            <a href="generar_exel_fuente.php" class="btn btn-outline-success">
                                <i class="fas fa-file-excel"></i> Generar EXEL
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tablaFuente" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Fuentes</th>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Número de Serie</th>
                                <th>Contenedor</th>
                                <th>Fecha de Entrada</th>
                                <th>Fecha de Salida</th>
                                <th>Decantamiento</th>
                                <th>Documentos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $dat) { ?>
                                <tr>
                                    <td><?php echo $dat['id'] ?></td>
                                    <td><?php echo $dat['fuentes'] ?></td>
                                    <td><?php echo $dat['modelo'] ?></td>
                                    <td><?php echo $dat['marca'] ?></td>
                                    <td><?php echo $dat['serie'] ?></td>
                                    <td><?php echo $dat['contenedor'] ?></td>
                                    <td>
                                        <button class="btn btn-outline-secondary btn-sm manage-entrada"
                                            data-id="<?php echo htmlspecialchars($dat['id']); ?>">
                                            <i class="fas fa-sign-in-alt"></i> Entrada
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-secondary btn-sm manage-salida"
                                            data-id="<?php echo htmlspecialchars($dat['id']); ?>">
                                            <i class="fas fa-sign-out-alt"></i> Salida
                                        </button>
                                    </td>
                                    <td><?php echo $dat['decantamiento'] ?></td>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fuente Radiológica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formFuente" method="POST" action="./bd/crud_fuente.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fuentes" class="col-form-label">Fuente:</label>
                            <input type="text" class="form-control" id="fuentes" name="fuentes" required>
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
                            <label for="serie" class="col-form-label">Número de Serie:</label>
                            <input type="text" class="form-control" id="serie" name="serie" required>
                        </div>
                        <div class="form-group">
                            <label for="contenedor" class="col-form-label">Contenedor:</label>
                            <input type="text" class="form-control" id="contenedor" name="contenedor" required>
                        </div>
                        <div class="form-group">
                            <label for="decantamiento" class="col-form-label">Decantamiento:</label>
                            <input type="text" class="form-control" id="decantamiento" name="decantamiento" required>
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
                    <form id="uploadPdfForm" method="POST" action="subir_pdf_fuente.php"
                        enctype="multipart/form-data">
                        <input type="hidden" name="fuente_id" id="fuente_id">
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
                }, 5000); // Ocultar después de 5 segundos
            }
        });

        $(document).ready(function () {
            // Ver PDFs
            $(document).on('click', '.view-pdf', function () {
                var id = $(this).data('id');

                // Obtener la lista de PDFs
                $.ajax({
                    url: 'obtener_pdfs_fuente.php',
                    type: 'GET',
                    data: { id: id },
                    success: function (response) {
                        var archivos = JSON.parse(response);
                        var html = '';

                        archivos.forEach(function (archivo) {
                            var nombre_fuente = archivo.archivo_pdf.split('/').pop();
                            html += '<div class="pdf-item">';
                            html += '<a href="' + archivo.archivo_pdf + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
                            html += '<span>' + nombre_fuente + '</span>';
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
                $('#fuente_id').val(id);
                $('#uploadPdfModal').modal('show');
            });

            // Reemplazar PDF
            $(document).on('click', '.edit-pdf', function () {
                var fuenteId = $(this).data('id');
                $('#fuente_id').val(fuenteId);
                $('#replacePdfModalFuente').modal('show');
            });

            $(document).ready(function () {
                // Ver PDFs
                $(document).on('click', '.view-pdf', function () {
                    var id = $(this).data('id');

                    // Obtener la lista de PDFs
                    $.ajax({
                        url: 'obtener_pdfs_fuente.php',
                        type: 'GET',
                        data: { id: id },
                        success: function (response) {
                            var archivos = JSON.parse(response);
                            var html = '';
                            archivos.forEach(function (archivo) {
                                var nombre_fuente = archivo.archivo_pdf.split('/').pop();
                                html += '<div class="pdf-item">';
                                html += '<a href="' + archivo.archivo_pdf + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
                                html += '<span>' + nombre_fuente + '</span>';
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
                        url: 'eliminar_pdf_fuentes.php',
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
                    $('#fuente_id').val(id);
                    $('#uploadPdfModal').modal('show');
                });
            });

        });
    </script>

    <!-- Modal para Fecha de Entrada -->
    <div class="modal fade" id="entradaModal" tabindex="-1" role="dialog" aria-labelledby="entradaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="entradaModalLabel">Gestionar entradas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="entradaForm" method="POST" action="manage_entrada.php">
                    <div class="modal-body">
                        <input type="hidden" name="entrada_id" id="entrada_almacen_id">
                        <div class="form-group">
                            <label for="fecha">Fecha de Entrada:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>
                        <div class="form-group">
                            <label for="curies">Curies de Entrada (Ci):</label>
                            <input type="text" class="form-control" id="curies" name="curies">
                        </div>
                        <div class="form-group">
                            <label for="tbq">Terabecquerel de Entrada(TBq):</label>
                            <input type="text" class="form-control" id="tbq" name="tbq">
                        </div>
                        <div id="accessories_entrada_list"></div>
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
            // Gestionar entradas
            $(document).on('click', '.manage-entrada', function () {
                var id = $(this).data('id');
                $('#entrada_almacen_id').val(id);

                $.ajax({
                    url: 'get_entrada.php',
                    type: 'GET',
                    data: { entrada_id: id },
                    success: function (response) {
                        try {
                            var entradas = JSON.parse(response);
                            var html = '<h5>Datos de Entradas</h5><ul>';

                            entradas.forEach(function (entrada) {
                                html += '<li>' + 'Fecha de Entrada: ' + entrada.fecha + '</li>';
                                html += '<li>' + 'Curies (Ci): ' + entrada.curies + '</li>';
                                html += '<li>' + 'Terabecquerel (TBq): ' + entrada.tbq + '</li>';
                            });

                            html += '</ul>';
                            $('#accessories_entrada_list').html(html);
                            $('#entradaModal').modal('show');
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                        }
                    },
                    error: function (error) {
                        console.error('Error fetching accessories:', error);
                    }
                });
            });

            // Enviar formulario de entradas
            $('#entradaForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'manage_entrada.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.success) {
                                alert(data.message);
                                $('#entradaModal').modal('hide');
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

    <div class="modal fade" id="salidaModal" tabindex="-1" role="dialog" aria-labelledby="salidaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="salidaModalLabel">Gestionar Salidas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="salidaForm" method="POST" action="manage_salida.php">
                    <div class="modal-body">
                        <input type="hidden" name="salida_id" id="accessories_salida_id">
                        <div class="form-group">
                            <label for="fecha_salida">Fecha de Salida:</label>
                            <input type="date" class="form-control" id="fecha_salida" name="fecha_salida">
                        </div>
                        <div class="form-group">
                            <label for="curies_salida">Curies de Salida (Ci):</label>
                            <input type="text" class="form-control" id="curies_salida" name="curies_salida">
                        </div>
                        <div class="form-group">
                            <label for="tbq_salida">Terabecquerel de Salida(TBq):</label>
                            <input type="text" class="form-control" id="tbq_salida" name="tbq_salida">
                        </div>
                        <div id="accessories_list_salida"></div>
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
            // Gestionar salidas
            $(document).on('click', '.manage-salida', function () {
                var id = $(this).data('id');
                $('#accessories_salida_id').val(id);

                $.ajax({
                    url: 'get_salida.php',
                    type: 'GET',
                    data: { salida_id: id },
                    success: function (response) {
                        try {
                            var salidas = JSON.parse(response);
                            var html = '<h5>Datos de Salidas</h5><ul>';

                            salidas.forEach(function (salida) {
                                html += '<li>' + 'Fecha de Salida: ' + salida.fecha_salida + '</li>';
                                html += '<li>' + 'Curies (Ci): ' + salida.curies_salida + '</li>';
                                html += '<li>' + 'Terabecquerel (TBq): ' + salida.tbq_salida + '</li>';
                            });

                            html += '</ul>';
                            $('#accessories_list_salida').html(html);
                            $('#salidaModal').modal('show');
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                        }
                    },
                    error: function (error) {
                        console.error('Error fetching accessories:', error);
                    }
                });
            });

            // Enviar formulario de salidas
            $('#salidaForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'manage_salida.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.success) {
                                alert(data.message);
                                $('#salidaModal').modal('hide');
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

    <script type="text/javascript" src="./radiacion/fuente.js"></script>
</div>
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"; ?>