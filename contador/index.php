<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
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
                        <a href="#" class="nav__link active" id="home-link">
                            <i class='bx bx-home nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>
                    </div>
                    <div class="nav__dropdown">
                        <a href="./clientes/index.php" class="nav__link" id="clientes-link">
                            <i class='bx bx-user nav__icon'></i>
                            <span class="nav__name">Clientes</span>
                        </a>
                    </div>
                    <div class="nav__dropdown">
                        <a href="./catalogo_pruebas/index.php" class="nav__link" id="catalogo-link">
                            <i class='bx bx-file nav__icon'></i>
                            <span class="nav__name">Catálogo</span>
                        </a>
                    </div>
                    <a href="./cotizacion/cotizacion_formulario.php" class="nav__link" id="cotizacion-link">
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

    <main id="main-content">
        <!-- Aquí se cargará el contenido dinámico -->
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
        // Función sencilla para cargar contenido completo en el main
        function loadContent(url) {
            console.log("Cargando contenido desde: " + url); // Esto te ayudará a ver si el archivo se está intentando cargar correctamente.
            document.getElementById('main-content').innerHTML = '<object type="text/html" data="' + url + '" style="width: 100%; height: 100vh;"></object>';
        }

        // Configurar los enlaces para cargar contenido dinámico
        document.getElementById('clientes-link').addEventListener('click', function (event) {
            event.preventDefault();
            loadContent('./clientes/index.php');
        });

        document.getElementById('catalogo-link').addEventListener('click', function (event) {
            event.preventDefault();
            loadContent('./catalogo_pruebas/index.php');
        });

        document.getElementById('cotizacion-link').addEventListener('click', function (event) {
            event.preventDefault();
            loadContent('./cotizacion/cotizacion_formulario.php');
        });

        document.getElementById('home-link').addEventListener('click', function (event) {
            event.preventDefault();
            window.location.reload();
        });

        document.getElementById('logout-link').addEventListener('click', function (event) {
            event.preventDefault();
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