<div class="container-fluid p-0">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="#" />
        <title>Clientes</title>

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./main.css">
        <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
        <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
            integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    </head>
    <?php
    require_once './bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT id, empresa, atiende, puesto, correo, telefono FROM clientes";

    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <body>
        <div style="height:50px"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Empresa</th>
                                    <th>Atiende</th>
                                    <th>Puesto</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $dat) { ?>
                                    <tr>
                                        <td><?php echo $dat['id'] ?></td>
                                        <td><?php echo $dat['empresa'] ?></td>
                                        <td><?php echo $dat['atiende'] ?></td>
                                        <td><?php echo $dat['puesto'] ?></td>
                                        <td><?php echo $dat['correo'] ?></td>
                                        <td><?php echo $dat['telefono'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class="btn btn-warning btn-sm editBtn">Editar</button>
                                                <button class="btn btn-danger btn-sm deleteBtn">Eliminar</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para agregar nuevo registro -->
        <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRecordModalLabel">Agregar Nuevo Registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addRecordForm">
                            <div class="mb-3">
                                <label for="empresa" class="form-label">Empresa</label>
                                <input type="text" class="form-control" id="empresa"
                                    placeholder="Ingrese el nombre de la empresa">
                            </div>
                            <div class="mb-3">
                                <label for="atiende" class="form-label">Atiende</label>
                                <input type="text" class="form-control" id="atiende"
                                    placeholder="Nombre de la persona que atiende">
                            </div>
                            <div class="mb-3">
                                <label for="puesto" class="form-label">Puesto</label>
                                <input type="text" class="form-control" id="puesto" placeholder="Ingrese el puesto">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo"
                                    placeholder="Ingrese el correo electrónico">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono"
                                    placeholder="Ingrese el número de teléfono">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="saveRecordButton">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script src="popper/popper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="datatables/datatables.min.js"></script>
        <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
        <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
        <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
        <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="main.js"></script>

    </body>
</div>