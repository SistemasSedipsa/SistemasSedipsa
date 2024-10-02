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

    $consulta = "SELECT id, equipo, talla, entrada, unidades, precio, salida, salida_unidad, personal, restantes, proveedor FROM equipos";
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
                        <form method="POST" action="procesar_equipos.php" enctype="multipart/form-data">
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
            <h2>Registro de Equipos</h2>
            <div class="col-lg-12">
                <button id="btnNuevo" type="button" class="btn btn-outline-info" data-toggle="modal">
                    <i class="fas fa-plus"></i> Nuevo</button>
                <a href="generar_exel_equipos.php" class="btn btn-outline-success">
                    <i class="fas fa-file-excel"></i> Generar EXEL
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaEquipos" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Equipo</th>
                                <th>Talla</th>
                                <th>Fecha de Entrada</th>
                                <th>Unidades</th>
                                <th>Precio</th>
                                <th>Fecha de Salida</th>
                                <th>Salida de Unidad</th>
                                <th>Personal</th>
                                <th>Restantes</th>
                                <th>Proveedor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $dat) { ?>
                                <tr>
                                    <td><?php echo $dat['id'] ?></td>
                                    <td><?php echo $dat['equipo'] ?></td>
                                    <td><?php echo $dat['talla'] ?></td>
                                    <td><?php echo $dat['entrada'] ?></td>
                                    <td><?php echo $dat['unidades'] ?></td>
                                    <td><?php echo $dat['precio'] ?></td>
                                    <td><?php echo $dat['salida'] ?></td>
                                    <td><?php echo $dat['salida_unidad'] ?></td>
                                    <td><?php echo $dat['personal'] ?></td>
                                    <td><?php echo $dat['restantes'] ?></td>
                                    <td>
                                        <button class="btn btn-outline-dark btn-sm manage-proveedoreq"
                                            data-id="<?php echo htmlspecialchars($dat['id']); ?>">
                                            <i class="fas fa-store-alt"></i> Proveedor
                                        </button>
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
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEquipos" method="POST" action="./bd/gestion_equipos.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="equipo" class="col-form-label">Equipo:</label>
                                    <input type="text" class="form-control" id="equipo" name="equipo" required>
                                </div>
                                <div class="form-group">
                                    <label for="talla" class="col-form-label">Talla:</label>
                                    <input type="text" class="form-control" id="talla" name="talla" required>
                                </div>
                                <div class="form-group">
                                    <label for="entrada" class="col-form-label">Entrada:</label>
                                    <input type="date" class="form-control" id="entrada" name="entrada" required>
                                </div>
                                <div class="form-group">
                                    <label for="unidades" class="col-form-label">Unidades:</label>
                                    <input type="number" class="form-control" id="unidades" name="unidades" required>
                                </div>
                                <div class="form-group">
                                    <label for="precio" class="col-form-label">Precio:</label>
                                    <input type="number" step="0.01" class="form-control" id="precio" name="precio"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salida" class="col-form-label">Fecha de Salida:</label>
                                    <input type="date" class="form-control" id="salida" name="salida" required>
                                </div>
                                <div class="form-group">
                                    <label for="salida_unidad" class="col-form-label">Salida de Unidad:</label>
                                    <input type="number" class="form-control" id="salida_unidad" name="salida_unidad"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="personal" class="col-form-label">Personal:</label>
                                    <input type="text" class="form-control" id="personal" name="personal" required>
                                </div>
                                <div class="form-group">
                                    <label for="restantes" class="col-form-label">Restantes:</label>
                                    <input type="number" class="form-control" id="restantes" name="restantes" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Gestionar Proveedores -->
    <div class="modal fade" id="ProveedorModal" tabindex="-1" role="dialog" aria-labelledby="ProveedorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ProveedorModalLabel">Gestionar proveedores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="proveedorEqForm" method="POST" action="gestion_proveedor_eq.php">
                    <div class="modal-body">
                        <input type="hidden" name="proveedor_id" id="eq_proveedores_id">
                        <div class="form-group">
                            <label for="nombre">Proveedor:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="correo">Contacto (Correo):</label>
                            <input type="text" class="form-control" id="correo" name="correo">
                        </div>
                        <div class="form-group">
                            <label for="producto">Producto y/o Servicio Suministrado:</label>
                            <input type="text" class="form-control" id="producto" name="producto" required>
                        </div>
                        <div class="form-group">
                            <label for="alta">Fecha de Alta:</label>
                            <input type="date" class="form-control" id="alta" name="alta" required>
                        </div>
                        <div class="form-group">
                            <label for="seleccion">Tipo de Selección:</label>
                            <select class="form-control" id="seleccion" name="seleccion">
                                <option value="Eval.">Eval.</option>
                                <option value="Auto.">Auto.</option>
                                <option value="Cumpl.">Cumpl.</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="notas">Notas</label>
                            <input type="text" class="form-control" id="notas" name="notas" required>
                        </div>
                        <div id="proveedores"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                        <button type="button" id="eliminarProveedorBtn" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.manage-proveedoreq', function () {
                var id = $(this).data('id');
                $('#eq_proveedores_id').val(id);

                $.ajax({
                    url: 'obtener_proveedor_eq.php',
                    type: 'GET',
                    data: { proveedor_id: id },
                    success: function (response) {
                        try {
                            var proveedores = JSON.parse(response);
                            var html = '<h5>Proveedores</h5><ul>';

                            proveedores.forEach(function (proveedor) {
                                html += '<li>' + ' Proveedor: ' + proveedor.nombre + '</li>';
                                html += '<li>' + ' Contacto: ' + proveedor.correo + '</li>';
                                html += '<li>' + ' Producto/Servicio: ' + proveedor.producto + '</li>';
                                html += '<li>' + ' Fecha de Alta: ' + proveedor.alta + '</li>';
                                html += '<li>' + ' Tipo de Selección: ' + proveedor.seleccion + '</li>';
                                html += '<li>' + ' Notas: ' + proveedor.notas + '</li>';
                            });

                            $('#proveedores').html(html);
                            $('#ProveedorModal').modal('show');
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                        }
                    },
                    error: function (error) {
                        console.error('Error fetching accessories:', error);
                    }
                });
            });

            // Enviar formulario de proveedores
            $('#proveedorEqForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'gestion_proveedor_eq.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.success) {
                                alert(data.message);
                                $('#ProveedorModal').modal('hide');
                                location.reload();  // Recargar la página
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

            // Eliminar Proveedor
            $('#eliminarProveedorBtn').on('click', function () {
                var id = $('#eq_proveedores_id').val();

                if (confirm('¿Estás seguro de que quieres eliminar este proveedor?')) {
                    $.ajax({
                        url: 'eliminar_proveedor_eq.php',
                        type: 'POST',
                        data: { proveedor_id: id },
                        success: function (response) {
                            try {
                                var data = JSON.parse(response);
                                if (data.success) {
                                    alert('Proveedor eliminado exitosamente.');
                                    $('#ProveedorModal').modal('hide');
                                    location.reload();  // Recargar la página para reflejar los cambios
                                } else {
                                    alert('Error al eliminar el proveedor: ' + data.message);
                                }
                            } catch (e) {
                                console.error('Error parsing JSON response:', e);
                            }
                        },
                        error: function (error) {
                            console.error('Error deleting provider:', error);
                        }
                    });
                }
            });
        });
    </script>

</div>
<script type="text/javascript" src="equipos/gestion_equipos.js"></script>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"; ?>