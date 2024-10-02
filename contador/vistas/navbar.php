<?php
require_once '../../bd/conexion_login.php';  // Corrige la ruta

session_start();
if ($_SESSION['role'] != 'cont') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Incluye SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sistema de Contabilidad</title>
</head>
<style>
    .chart-container {
        width: 300px;
        height: 300px;
        margin: 10px;
        display: inline-block;
    }

    main {
        overflow: hidden;
    }
</style>

<body>
    <header class="header">
        <div class="header__container">
            <img src="assets/img/perfil.jpg" alt="" class="header__img">

            <a href="#" class="header__logo">Cotización</a>

            <div class="header__search">
                <input type="search" placeholder="Search" class="header__input">
                <i class='bx bx-search header__icon'></i>
            </div>

            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
        </div>
    </header>

    <div class="nav" id="navbar">
        <nav class="nav__container">
            <div>
                <a href="#" class="nav__link nav__logo">
                    <i class='bx bxs-disc nav__icon'></i>
                    <span class="nav__logo-name">CONTABILIDAD</span>
                </a>

                <div class="nav__list">
                    <div class="nav__items">
                        <h3 class="nav__subtitle">Menú</h3>

                        <a href="#" class="nav__link active">
                            <i class='bx bx-home nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>

                        <a href="#" class="nav__link">
                            <i class='bx bx-message-rounded nav__icon'></i>
                            <span class="nav__name">Messages</span>
                        </a>
                    </div>

                    <div class="nav__dropdown">
                        <a href="./clientes/index.php" class="nav__link">
                            <i class='bx bx-user nav__icon'></i>
                            <span class="nav__name">Clientes</span>
                        </a>
                    </div>

                    <div class="nav__dropdown">
                        <a href="./catalogo_pruebas/index.php" class="nav__link">
                            <i class='bx bx-file nav__icon'></i>
                            <span class="nav__name">Catálogo</span>
                        </a>
                    </div>


                    <a href="#" class="nav__link">
                        <i class='bx bx-compass nav__icon'></i>
                        <span class="nav__name">Explore</span>
                    </a>
                    <a href="#" class="nav__link">
                        <i class='bx bx-bookmark nav__icon'></i>
                        <span class="nav__name">Saved</span>
                    </a>
                </div>
            </div>

            <a href="logout.php" class="nav__link nav__logout" id="logout-link">
                <i class='bx bx-log-out nav__icon'></i>
                <span class="nav__name">Log Out</span>
            </a>

        </nav>
    </div>
    <main>
        <section>
            <div class="chart-container">
                <canvas id="barChart" class="chart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="lineChart" class="chart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="pieChart" class="chart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="doughnutChart" class="chart"></canvas>
            </div>
        </section>
    </main>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="Chart.js"></script>
    <script>
        document.getElementById('logout-link').addEventListener('click', function (event) {
            event.preventDefault(); // Prevenir el comportamiento por defecto del enlace
            Swal.fire({
                title: '¿Estás seguro de que deseas salir?',
                text: "Tu sesión se cerrará.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, salir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, redirige a la página de logout
                    window.location.href = 'logout.php';
                }
            });
        });
    </script>


    <?php
    if (isset($_GET['mensaje']) && isset($_GET['tipo'])) {
        echo "<script>
            Swal.fire({
                icon: '" . htmlspecialchars($_GET['tipo']) . "',
                title: 'Bienvenido',
                text: '" . htmlspecialchars($_GET['mensaje']) . "',
            }).then(() => {
                // Limpiar los parámetros de la URL después de mostrar la alerta
                const url = new URL(window.location.href);
                url.searchParams.delete('mensaje');
                url.searchParams.delete('tipo');
                window.history.replaceState({}, '', url);
            });
        </script>";
    }
    ?>
</body>

</html>