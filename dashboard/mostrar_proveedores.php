<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombre, correo, producto, alta, seleccion, notas FROM proveedor";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Proveedores</title>
    <link rel="stylesheet" href="./css/estilos1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <input type="file" id="uploadExcelInput" style="display:none" accept=".xlsx, .xls" />
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
</head>

<body>
    <?php require_once 'vistas/parte_superior.php'; ?>
    <main>
        <h1>Catálogo de Proveedores</h1>
        <div class="table-responsive">
            <table id="example" class="display nowrap table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Contacto (e-mail, tel. otro): </th>
                        <th>Producto: </th>
                        <th>Fecha de Alta: </th>
                        <th>Tipo de Selección: </th>
                        <th>Notas: </th>
                        <th>Acciones: </th>
                    </tr>
                </thead>

                <tbody>
                        <?php foreach ($data as $proveedor): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($proveedor['id']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['correo']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['producto']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['alta']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['seleccion']); ?></td>
                                <td><?php echo htmlspecialchars($proveedor['notas']); ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="btn btn-warning btn-sm editBtn"
                                            data-id="<?php echo $proveedor['id']; ?>">Editar</button>
                                        <button class="btn btn-danger btn-sm deleteBtn"
                                            data-id="<?php echo $proveedor['id']; ?>">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal para agregar registros -->
    <div id="addRecordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addRecordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                <div class="modal-header"
                    style="background: #2e3a46; color: #fff; border-bottom: none; border-radius: 10px 10px 0 0;">
                    <h5 class="modal-title" id="addRecordModalLabel">Agregar Nuevo Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <form id="addRecordForm">
                        <div class="form-group">
                            <label for="nombre">Nombre del Proveedor</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo Electrónico</label>
                            <textarea class="form-control" id="correo" name="correo" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <input type="text" class="form-control" id="producto" name="producto" required>
                        </div>
                        <div class="form-group">
                            <label for="alta">Fecha de Alta</label>
                            <input type="date" class="form-control" id="alta" name="alta">
                        </div>
                        <div class="form-group">
                            <label for="seleccion">Tipo de Selección</label>
                            <select class="form-control" id="seleccion" name="seleccion">
                                <option value="Eval.">Eval.</option>
                                <option value="Auto.">Auto.</option>
                                <option value="Cumpl.">Cumpl.</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="notas">Notas</label>
                            <textarea class="form-control" id="notas" name="notas"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"
                    style="border-top: none; padding: 20px; display: flex; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="border-radius: 5px; background: #6c757d; color: #fff; border: none;">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveRecord"
                        style="border-radius: 5px; background: #007bff; color: #fff; border: none;">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
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
</body>
</html>