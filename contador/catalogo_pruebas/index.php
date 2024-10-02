<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Catálogo de Pruebas No Destructivas</title>
</head>

<?php
require_once './db/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, prueba, descripcion, unidad, precio FROM pruebas";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <main>
        <h1>Catálogo de Pruebas No Destructivas</h1>
        <div class="table-responsive">
            <table id="example" class="display nowrap table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Prueba</th>
                        <th>Descripción: </th>
                        <th>Unidad: </th>
                        <th>Valor Unitario: </th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Tasa de conversión de MXN a USD
                    $tasa_conversion = 20.10; // Ajusta esta tasa según el tipo de cambio actual
                    
                    foreach ($data as $dat) {
                        // Conversión de precio de MXN a USD
                        $precio_mxn = $dat['precio'];
                        $precio_usd = $precio_mxn / $tasa_conversion;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dat['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($dat['prueba'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($dat['descripcion'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($dat['unidad'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo '$' . number_format($precio_mxn, 2, '.', ',') . ' MXN (' . number_format($precio_usd, 2, '.', ',') . ' USD Aprox.)' . ' * m.'; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn btn-warning btn-sm editBtn"
                                        data-id="<?php echo $dat['id']; ?>">Editar</button>
                                    <button class="btn btn-danger btn-sm deleteBtn"
                                        data-id="<?php echo $dat['id']; ?>">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
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
                            <label for="prueba" style="font-weight: 600;">Tipo de Prueba:</label>
                            <input type="text" class="form-control" id="prueba" placeholder="Ingrese el tipo de prueba"
                                required
                                style="border-radius: 5px; border: 1px solid #ccc; box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);">
                        </div>
                        <div class="form-group">
                            <label for="descripcion" style="font-weight: 600;">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion"
                                placeholder="Ingrese la descripción" required
                                style="border-radius: 5px; border: 1px solid #ccc; box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);">
                        </div>
                        <div class="form-group">
                            <label for="unidad" style="font-weight: 600;">Unidad:</label>
                            <input type="text" class="form-control" id="unidad"
                                placeholder="Ingrese la descripción" required
                                style="border-radius: 5px; border: 1px solid #ccc; box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);">
                        </div>
                        <div class="form-group">
                            <label for="precio" style="font-weight: 600;">Valor Unitario:</label>
                            <input type="number" class="form-control" id="precio" placeholder="Ingrese el precio"
                                required
                                style="border-radius: 5px; border: 1px solid #ccc; box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);">
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