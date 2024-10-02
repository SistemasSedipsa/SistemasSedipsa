<?php require_once "vistas/parte_superior.php" ?>

<link rel="stylesheet" href="./css/estilos.css">

<div class="head">
    <div class="container my-5">
        <div class="row">
            <div class="col text-center mb-4">
                <h2 class="text-uppercase font-weight-bold">Generar Reportes en EXCEL</h2>
            </div>
        </div>

        <!-- Fila para los botones de reportes -->
        <div class="row justify-content-start">
            <div class="col-md-3 mb-3">
                <a href="generar_exel.php" class="btn btn-light btn-lg btn-block shadow-sm text-center"
                    style="color: black;">
                    <img src="./img/Logo1.png" alt="Almacén" class="img-fluid img-btn mb-2">
                    <i class="fas fa-file-excel mr-2"></i> Generar EXCEL Almacén
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="generar_exel_consumibles.php" class="btn btn-light btn-lg btn-block shadow-sm text-center"
                    style="color: black;">
                    <img src="./img/Logo1.png" alt="Consumibles" class="img-fluid img-btn mb-2">
                    <i class="fas fa-file-excel mr-2"></i> Generar EXCEL Consumibles
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="generar_exel_equipos.php" class="btn btn-light btn-lg btn-block shadow-sm text-center"
                    style="color: black;">
                    <img src="./img/Logo1.png" alt="Equipos" class="img-fluid img-btn mb-2">
                    <i class="fas fa-file-excel mr-2"></i> Generar EXCEL Equipos
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="generar_exel_vehiculos.php" class="btn btn-light btn-lg btn-block shadow-sm text-center"
                    style="color: black;">
                    <img src="./img/Logo1.png" alt="Vehículos" class="img-fluid img-btn mb-2">
                    <i class="fas fa-file-excel mr-2"></i> Generar EXCEL Vehículos
                </a>
            </div>
        </div>
        <div class="container my-5">
            <div class="row">
                <div class="col text-center mb-4">
                    <h2 class="text-uppercase font-weight-bold">Listado de Proveedores</h2>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <a href="mostrar_proveedores.php" class="btn btn-light btn-lg btn-block shadow-sm text-center"
                    style="color: black;">
                    <img src="./img/Logo1.png" alt="Proveedores" class="img-fluid img-btn mb-2">
                    <i class="fas fa-users mr-2"></i> Mostrar Proveedores
                </a>
            </div>
        </div>
    </div>
</div>
<?php require_once "vistas/parte_inferior.php" ?>