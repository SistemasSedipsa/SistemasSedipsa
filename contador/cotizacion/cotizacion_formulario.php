<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización - SEDIPSA STEEL</title>
    <link rel="stylesheet" href="styles.scss"> <!-- El SCSS ya debería estar compilado a CSS -->
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div id="step-1" class="container">
        <h2>Información del Cliente</h2>
        <form id="cotizacion-form">
            <label for="cliente">Cliente:</label>
            <select id="cliente" name="cliente" required>
                <option value="">Seleccione un cliente</option>
                <?php
                require_once './db/conexion.php';
                $objeto = new Conexion();
                $conexion = $objeto->Conectar();

                $consulta = "SELECT id, empresa FROM clientes";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $clientes = $resultado->fetchAll(PDO::FETCH_ASSOC);

                foreach ($clientes as $cliente) {
                    echo "<option value='{$cliente['id']}'>{$cliente['empresa']}</option>";
                }
                ?>
            </select>

            <div id="informacion-cliente" style="display: none;">
                <ul>
                    <li id="cliente-empresa"></li>
                    <li id="cliente-atiende"></li>
                    <li id="cliente-puesto"></li>
                    <li id="cliente-correo"></li>
                    <li id="cliente-telefono"></li>
                </ul>
            </div>

            <button type="button" id="next-to-step-2">Siguiente</button>
        </form>
    </div>

    <div id="step-2" class="container hidden">
        <h2>Descripción del Proyecto</h2>
        <label for="descripcion">Seleccione una descripción:</label>
        <select id="descripcion" name="descripcion">
            <option value="">Seleccione una descripción</option>
            <?php
            $consulta = "SELECT id, descripcion, unidad, precio FROM pruebas";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $pruebas = $resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach ($pruebas as $prueba) {
                echo "<option value='{$prueba['id']}'>{$prueba['descripcion']}</option>";
            }
            ?>
        </select>

        <section class="form-section">
            <label for="importe">Valor Unitario:</label>
            <input type="number" id="importe" name="importe" min="0">

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" min="0">

            <label for="rendimiento">Rendimiento:</label>
            <input type="text" id="rendimiento" name="rendimiento">
        </section>

        <button type="button" id="agregar-descripcion">Agregar</button>

        <section style="margin-top: 20px;">
            <table class="examinacion" id="tabla-examinacion" border="1" cellpadding="5" cellspacing="0"
                style="width: 100%; text-align: left;">
                <thead>
                    <tr>
                        <th>Partida</th>
                        <th>Descripción</th>
                        <th>Unidad</th>
                        <th>Valor Unitario</th>
                        <th>Cantidad</th>
                        <th>Importe</th>
                        <th>Rendimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-body">
                    <!-- Aquí se agregarán las filas de descripciones seleccionadas -->
                </tbody>
            </table>
        </section>

        <button type="button" id="prev-to-step-1">Anterior</button>
        <button type="button" id="next-to-step-3">Generar Cotización</button>
    </div>

    <div id="step-3" class="container hidden">
        <h2>Vista Previa de la Cotización</h2>
        <div id="vista-previa">
            <!-- Aquí irá la plantilla final generada -->
        </div>
        <button type="button" id="prev-to-step-2">Anterior</button>
        <button type="button" id="finalizar">Descargar Cotización</button>
    </div>
    <script src="formulario.js"></script>
    <script>
        // Cambiar de paso
        document.getElementById('next-to-step-2').addEventListener('click', function () {
            document.getElementById('step-1').classList.add('hidden');
            document.getElementById('step-2').classList.remove('hidden');
        });

        document.getElementById('prev-to-step-1').addEventListener('click', function () {
            document.getElementById('step-2').classList.add('hidden');
            document.getElementById('step-1').classList.remove('hidden');
        });

        document.getElementById('next-to-step-3').addEventListener('click', function () {
            const cliente = document.getElementById('cliente').value;
            const descripcion = document.getElementById('descripcion').value;
            const cantidad = document.getElementById('cantidad').value;
            const importe = document.getElementById('importe').value;
            const rendimiento = document.getElementById('rendimiento').value;

            // Guardar datos en localStorage
            localStorage.setItem('cliente', cliente);
            localStorage.setItem('descripcion', descripcion);
            localStorage.setItem('cantidad', cantidad);
            localStorage.setItem('importe', importe);
            localStorage.setItem('rendimiento', rendimiento);

            // Redirigir al segundo archivo
            window.location.href = 'plantilla_cotizacion.php';  // Cambia 'archivo2.html' por la ruta de tu segundo archivo
        });


        document.getElementById('prev-to-step-2').addEventListener('click', function () {
            document.getElementById('step-3').classList.add('hidden');
            document.getElementById('step-2').classList.remove('hidden');
        });

        document.getElementById('finalizar').addEventListener('click', function () {
            // Aquí puedes agregar la lógica para descargar o imprimir la cotización
            alert("Función de descarga de la cotización no implementada.");
        });
    </script>
</body>

</html>