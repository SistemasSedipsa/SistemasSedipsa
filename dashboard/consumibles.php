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

    $consulta = "SELECT id, consumible, metodo, marca, cliente, entrada, lote, modelo, unidades, accesorios, ns, inventario, precio, caducidad, fecha, salida, personal, restantes, status_con, condiciones, ubicacion, proveedor FROM consumibles";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Subir archivo Excel</h2>
                        <form method="post" action="procesar_consumibles.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="archivoexcel" class="form-label">Seleccionar archivo Excel (.csv)</label>
                                <input type="file" class="form-control-file" id="archivoexcel" name="archivo_excel" accept=".csv">
                            </div>
                            <button type="submit" class="btn btn-primary">Cargar archivo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2>Registros de Consumibles</h2>
    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-lg-12">
                <button id="btnNuevo" type="button" class="btn btn-outline-info" data-toggle="modal">
                    <i class="fas fa-plus"></i> Nuevo</button>
                <a href="generar_exel_consumibles.php" class="btn btn-outline-success">
                    <i class="fas fa-file-excel"></i> Generar EXCEL
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaConsumibles" class="table table-striped table-bordered table-condensed"
                        style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Consumible</th>
                                <th>Método</th>
                                <th>Marca</th>
                                <th>Alta de Cliente</th>
                                <th>Fecha de Entrada</th>
                                <th>Lote</th>
                                <th>Modelo</th>
                                <th>Unidades</th>
                                <th>Accesorios</th>
                                <th>N/S</th>
                                <th>Ctrl. Inventario</th>
                                <th>Precio</th>
                                <th>Fecha de Caducidad</th>
                                <th>Fecha</th>
                                <th>Salida de Unidades</th>
                                <th>Personal</th>
                                <th>Restantes</th>
                                <th>Status</th>
                                <th>Condiciones</th>
                                <th>Ubicación (Bodega)</th>
                                <th>Proveedor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $dat) { ?>
                                <tr>
                                    <td><?php echo $dat['id'] ?></td>
                                    <td><?php echo $dat['consumible'] ?></td>
                                    <td><?php echo $dat['metodo'] ?></td>
                                    <td><?php echo $dat['marca'] ?></td>
                                    <td><?php echo $dat['cliente'] ?></td>
                                    <td><?php echo $dat['entrada'] ?></td>
                                    <td><?php echo $dat['lote'] ?></td>
                                    <td><?php echo $dat['modelo'] ?></td>
                                    <td><?php echo $dat['unidades'] ?></td>
                                    <td>
                                        <button class="btn btn-outline-secondary btn-sm manage-accessories-con"
                                            data-id="<?php echo htmlspecialchars($dat['id']); ?>">
                                            <i class="fas fa-cogs"></i> Accesorios
                                        </button>
                                    </td>
                                    <td><?php echo $dat['ns'] ?></td>
                                    <td><?php echo $dat['inventario'] ?></td>
                                    <td><?php echo $dat['precio'] ?></td>
                                    <td><?php echo $dat['caducidad'] ?></td>
                                    <td><?php echo $dat['fecha'] ?></td>
                                    <td><?php echo $dat['salida'] ?></td>
                                    <td><?php echo $dat['personal'] ?></td>
                                    <td><?php echo $dat['restantes'] ?></td>
                                    <td><?php echo $dat['status_con'] ?></td>
                                    <td><?php echo $dat['condiciones'] ?></td>
                                    <td><?php echo $dat['ubicacion'] ?></td>
                                    <td>
                                        <button class="btn btn-outline-dark btn-sm manage-proveedor"
                                            data-id="<?php echo htmlspecialchars($dat['id']); ?>" data-toggle="modal"
                                            data-target="#ProveedorModal">
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Consumible</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formConsumibles" method="POST" action="./bd/gestion_consumibles.php"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="consumible" class="col-form-label">Consumible:</label>
                                    <input type="text" class="form-control" id="consumible" name="consumible" required>
                                </div>
                                <div class="form-group">
                                    <label for="metodo" class="col-form-label">Método:</label>
                                    <input type="text" class="form-control" id="metodo" name="metodo" required>
                                </div>
                                <div class="form-group">
                                    <label for="marca" class="col-form-label">Marca:</label>
                                    <input type="text" class="form-control" id="marca" name="marca" required>
                                </div>
                                <div class="form-group">
                                    <label for="cliente" class="col-form-label">Alta de Cliente:</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente" required>
                                </div>
                                <div class="form-group">
                                    <label for="entrada" class="col-form-label">Fecha de Entrada:</label>
                                    <input type="date" class="form-control" id="entrada" name="entrada" required>
                                </div>
                                <div class="form-group">
                                    <label for="lote" class="col-form-label">Lote:</label>
                                    <input type="text" class="form-control" id="lote" name="lote" required>
                                </div>
                                <div class="form-group">
                                    <label for="modelo" class="col-form-label">Modelo:</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unidades" class="col-form-label">Unidades:</label>
                                    <input type="number" class="form-control" id="unidades" name="unidades" required>
                                </div>
                                <div class="form-group">
                                    <label for="ns" class="col-form-label">N/S:</label>
                                    <input type="text" class="form-control" id="ns" name="ns" required>
                                </div>
                                <div class="form-group">
                                    <label for="inventario" class="col-form-label">Ctrl. Inventario:</label>
                                    <input type="text" class="form-control" id="inventario" name="inventario" required>
                                </div>
                                <div class="form-group">
                                    <label for="precio" class="col-form-label">Precio:</label>
                                    <input type="text" class="form-control" id="precio" name="precio" required>
                                </div>
                                <div class="form-group">
                                    <label for="caducidad" class="col-form-label">Fecha de Caducidad:</label>
                                    <input type="date" class="form-control" id="caducidad" name="caducidad" required>
                                </div>
                                <div class="form-group">
                                    <label for="fecha" class="col-form-label">Fecha:</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                                </div>
                                <div class="form-group">
                                    <label for="salida" class="col-form-label">Salida de Unidades:</label>
                                    <input type="number" class="form-control" id="salida" name="salida" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="personal" class="col-form-label">Personal:</label>
                                    <input type="text" class="form-control" id="personal" name="personal" required>
                                </div>
                                <div class="form-group">
                                    <label for="restantes" class="col-form-label">Restantes:</label>
                                    <input type="number" class="form-control" id="restantes" name="restantes" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="status_con" class="col-form-label">Status:</label>
                                    <input type="text" class="form-control" id="status_con" name="status_con" required>
                                </div>
                                <div class="form-group">
                                    <label for="condiciones" class="col-form-label">Condiciones:</label>
                                    <input type="text" class="form-control" id="condiciones" name="condiciones"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="ubicacion" class="col-form-label">Ubicación (Bodega):</label>
                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
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
                <form id="proveedorForm" method="POST" action="guardar_seleccionado.php">
                    <div class="modal-body">
                        <input type="hidden" name="proveedor_id" id="proveedores_id">
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
            $(document).on('click', '.manage-proveedor', function () {
                var id = $(this).data('id');
                $('#proveedores_id').val(id);

                $.ajax({
                    url: 'obtener_datos_guardados.php',
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
            $('#proveedorForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'guardar_seleccionado.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.success) {
                                alert(data.message);
                                $('#ProveedorModal').modal('hide');
                                location.reload();  // Recarga la página automáticamente
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
                var id = $('#proveedores_id').val();

                if (confirm('¿Estás seguro de que quieres eliminar este proveedor?')) {
                    $.ajax({
                        url: 'eliminar_proveedor1.php',
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

    <!-- Modal para Gestionar Accesorios -->
    <div class="modal fade" id="accessoriesModalCon" tabindex="-1" role="dialog"
        aria-labelledby="accessoriesModalConLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accessoriesModalConLabel">Gestionar Accesorios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="accessoriesForm" method="POST" action="gestion_accessories.php">
                    <div class="modal-body">
                        <input type="hidden" name="consumible_id" id="accessories_consumible_id">
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
                        <div id="accessories_list_con"></div>
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
            $(document).on('click', '.manage-accessories-con', function () {
                var id = $(this).data('id');
                $('#accessories_consumible_id').val(id);

                $.ajax({
                    url: 'obtener_accessories.php',
                    type: 'GET',
                    data: { consumible_id: id },
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
                            $('#accessories_list_con').html(html);
                            $('#accessoriesModalCon').modal('show');
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
                    url: 'gestion_accessories.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.success) {
                                alert(data.message);
                                $('#accessoriesModalCon').modal('hide');
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
<script type="text/javascript" src="consumibles/gestion_consumibles.js"></script>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"; ?>