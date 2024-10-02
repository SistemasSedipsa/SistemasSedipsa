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

    $consulta = "SELECT id, personal, dosimetros, cnsns, documentos_poe FROM personal_poe";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- CRUD 3 -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Personal POE</h2>
                <div class="container-fluid mb-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <button id="btnNuevo" type="button" class="btn btn-outline-info" data-toggle="modal">
                                <i class="fas fa-plus"></i> Nuevo</button>
                            <a href="generar_exel_personal.php" class="btn btn-outline-success">
                                <i class="fas fa-file-excel"></i> Generar EXEL
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tablaPOE" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Personal POE</th>
                                <th>Numero de Dosimetro</th>
                                <th>Numero de ID Ante CNSNS</th>
                                <th>Documentos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $dat) { ?>
                                <tr>
                                    <td><?php echo $dat['id'] ?></td>
                                    <td><?php echo $dat['personal'] ?></td>
                                    <td><?php echo $dat['dosimetros'] ?></td>
                                    <td><?php echo $dat['cnsns'] ?></td>
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

    <!-- Modal para CRUD 3 -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Personal POE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formPoe" method="POST" action="./bd/crud_personal.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="personal" class="col-form-label">Personal POE:</label>
                            <input type="text" class="form-control" id="personal" name="personal" required>
                        </div>
                        <div class="form-group">
                            <label for="dosimetros" class="col-form-label">Número de Dosímetro:</label>
                            <input type="text" class="form-control" id="dosimetros" name="dosimetros" required>
                        </div>
                        <div class="form-group">
                            <label for="cnsns" class="col-form-label">Número de ID Ante CNSNS:</label>
                            <input type="text" class="form-control" id="cnsns" name="cnsns" required>
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
                    <form id="uploadPdfForm" method="POST" action="subir_pdf_poe.php" enctype="multipart/form-data">
                        <input type="hidden" name="personal_id" id="personal_id">
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
                    url: 'obtener_pdfs_poe.php',
                    type: 'GET',
                    data: { id: id },
                    success: function (response) {
                        var archivos = JSON.parse(response);
                        var html = '';

                        archivos.forEach(function (archivo) {
                            var nombre_personal = archivo.archivo_pdf.split('/').pop();
                            html += '<div class="pdf-item">';
                            html += '<a href="' + archivo.archivo_pdf + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
                            html += '<span>' + nombre_personal + '</span>';
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
                $('#personal_id').val(id);
                $('#uploadPdfModal').modal('show');
            });

            // Reemplazar PDF
            $(document).on('click', '.edit-pdf', function () {
                var personalId = $(this).data('id');
                $('#personal_id').val(personalId);
                $('#replacePdfModalPOE').modal('show');
            });

            $(document).ready(function () {
                // Ver PDFs
                $(document).on('click', '.view-pdf', function () {
                    var id = $(this).data('id');

                    // Obtener la lista de PDFs
                    $.ajax({
                        url: 'obtener_pdfs_poe.php',
                        type: 'GET',
                        data: { id: id },
                        success: function (response) {
                            var archivos = JSON.parse(response);
                            var html = '';
                            archivos.forEach(function (archivo) {
                                var nombre_personal = archivo.archivo_pdf.split('/').pop();
                                html += '<div class="pdf-item">';
                                html += '<a href="' + archivo.archivo_pdf + '" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>';
                                html += '<span>' + nombre_personal + '</span>';
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
                        url: 'eliminar_pdf_poe.php',
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
                    $('#personal_id').val(id);
                    $('#uploadPdfModal').modal('show');
                });
            });

        });
    </script>

    <script type="text/javascript" src="./radiacion/personal.js"></script>
</div>

<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"; ?>