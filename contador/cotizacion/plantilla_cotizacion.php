<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización - SEDIPSA STEEL</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <!-- Parte 1: Contactos y Clientes -->
        <header class="header">
            <div class="header-content">
                <!-- Contenedor de las imágenes -->
                <div class="logo-container">
                    <img src="./img/Logo1.png" alt="Logo SEDIPSA" class="logo">
                    <img src="./img/EMA.png" alt="Logo Alternativo" class="logo">
                    <div class="image-container">
                    </div>
                </div>
                <!-- Contenedor de las líneas -->
                <div class="line-container">
                    <div class="line green"></div>
                    <div class="line orange"></div>
                </div>
                <!-- Caja de contacto -->
                <div class="contact-box">
                    <p><strong>SEDIPSA STEEL, S.A. DE C.V.</strong></p>
                    <p>Blvd. Luis Donaldo Colosio Local 9 Lt</p>
                    <p>Ex Hacienda de Coscotitlan, C.P. 42064</p>
                    <p>Pachuca de Soto, Hgo.</p>
                    <img src="./img/image.png" alt="Contacto" class="contacto">
                </div>
            </div>

            <div class="table-column-container">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Cotización</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <font color="#ff0000">COT-PND-SEDIPSA- /2024</font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Fecha de Emisión</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="fecha-emision"></td>
                        </tr>
                    </tbody>

                </table>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Validez</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <font color="#b3b3b3">30 Dias</font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Atendido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <font color="#b3b3b3">PATRICIA MAQUEDA LOPEZ </font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="contacto">
                    <thead>
                        <tr>
                            <th>Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[Contenido editable]</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tabla de contacto -->
            <!-- Tabla de Cliente -->
            <div class="table-contact-info">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>CLIENTE</th>
                        </tr>
                    </thead>
                    <tbody id="informacion-cliente">
                        <tr>
                            <td>
                                <ul>
                                    <li><span id="cliente-empresa"></span></li>
                                    <li><span id="cliente-atiende"></span></li>
                                    <li><span id="cliente-puesto"></span></li>
                                    <li><span id="cliente-correo"></span></li>
                                    <li><span id="cliente-telefono"></span></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </header>

        <!-- Descripción de la solicitud -->
        <section class="solicitud">
            <p>Con base a la solicitud y a los datos proporcionados, SEDIPSA STEEL S.A. DE C.V. presenta la relación
                de conceptos, unidades y precios unitarios de Pruebas No Destructivas (PND) para su proyecto, que
                incluye servicios de __________.</p>
        </section>

        <!-- Tabla de Productos/Servicios -->
        <!-- Tabla de Productos/Servicios -->
        <div class="seccion1">
            <h2>1. EXAMINACIÓN</h2>
            <p class="text-lowercase">• Teniendo en consideración que la jornada de trabajo es de 6 horas de campo y dos
                horas de gabinete para la elaboración de reportes.</p>
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
        </div>

        <div class="importes">
            <div class="table-importeL-info">
                <table class="table-importeL">
                    <thead>
                        <tr>
                            <th class="importeL">Importe con Letra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[Contenido editable]</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-importe-info">
                <table class="table-importe">
                    <thead>
                        <tr>
                            <th class="importe">Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 5px;"> <!-- Elimina el padding por defecto -->
                                <ul style="list-style-type: none; padding: 0; margin: 0;">
                                    <li style="line-height: .8; padding: 3px 0;">Subtotal $ <span
                                            id="subtotal-span">-</span></li>
                                    <li style="line-height: .8; padding: 3px 0;">IVA 16% $ <span id="iva-span">-</span>
                                    </li>
                                    <li style="line-height: .8; padding: 3px 0;">Total $ <span id="total-span">-</span>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="terminos">
            <h2>TERMINOS COMERCIALES:</h2>
            <ol id="terminos-lista">
                <li><strong>SOLICITUD DE PEDIDO:</strong>
                    En caso de vernos favorecidos con su pedido, se requiere que firmen la presente
                    cotización de aceprtacion adicionando la orden de compra o contrato con al menos 48 horas para
                    realizar los trabajos.
                </li>
                <li><strong>CONDICIONES DE PAGO:</strong>
                    <ol type="a" class="condiciones-pago">
                        <li>Los precios anteriores no incluyen el impuesto al valor agregado (IVA).</li>
                        <li><strong>MONEDA:</strong> El costo de nuestros servicios es en pesos mexicanos y/o dólares
                            americanos.</li>
                        <li><strong>FACTURA:</strong> La factura correspondiente se entregará vía electrónica, al correo
                            asignado por el cliente dentro de los primeros 3 días naturales después de la primer
                            parcialidad realizada a la cuenta de la empresa de SEDIPSA STEEL S.A. DE C.V.</li>
                    </ol>
                </li>
                <li><strong>FORMA DE PAGO:</strong>
                    <ol type="a" class="forma-pago">
                        <li>Servicios menores a la cantidad de $50,000 M.N. serán cubiertos en su totalidad al firmar la
                            cotización de aceptación.</li>
                        <li>Para montos mayores se cubrirá el 30% del monto total de la cotización y el otro 70% se
                            cubrirá con avances de estimaciones quincenales o al término del servicio según sea el caso.
                        </li>
                        <li>El pago se debe efectuar mediante transferencia electrónica a nombre de SEDIPSA STEEL, S.A.
                            DE C.V.
                            BBVA Bancomer CUENTA No. 0117410166 CLABE INTERBANCARIA: 012290001174101661.
                        </li>
                        <li>Si no se realizan los pagos de estimaciones y facturas generadas dentro del plazo
                            establecido, se generará el 1% de intereses moratorios diarios.</li>
                        <li>No se aceptarán ningún tipo de condiciones diferentes a lo estipulado en esta cotización.
                        </li>
                    </ol>
                </li>
                <li><strong>VIGENCIA:</strong>
                    Esta cotización tiene una vigencia de 30 días calendario por la variación del tipo de cambio
                    extranjero, ya que la mayor parte de nuestros consumibles y equipos son comprados en el extranjero.
                </li>
            </ol>
            <h3 class="firma-conformidad">FIRMO DE CONFORMIDAD Y AUTORIZO EL INICIO DE LOS SERVICIOS DESCRITOS EN LA
                PRESENTE COTIZACIÓN.
                EN CASO DE NO CONTAR CON LA COTIZACION FIRMA, SE TOMARA COMO AUTORIZACION LA ORDEN DE COMPRA EN VIADA
                POR LA EMPRESA PARA EL INICIO DE LOS
                SERVICIOS O MEDIANTE LA AUTRIZACION VIA CORREO ELECTRÓNICO</h3>

            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <div class="firma-establecida"
                    style="border: 1px solid transparent;width: 45%; text-align: center; margin: 0 auto;">
                    <img src="./img/FirmaAbel.png" class="firmaAbel"
                        style="max-width: 100px; display: block; margin: 0 auto;">
                    <strong>SEDIPSA STEEL S.A DE CV</strong><br>
                    <strong>ABEL RUIZ FLORES</strong><br>
                    <strong>GERENCIA GENERAL</strong><br>
                    <a
                        href="mailto:gerencia.general@sedipsasteel.com.mx"><strong>gerencia.general@sedipsasteel.com.mx</strong></a><br>
                    <strong>Tel.771 255 9373</strong><br>
                </div>

                <div style="border: 1px solid transparent; padding: 10px; width: 45%;">
                    <textarea class="firma-editable" id="firma-editable-input"
                        style="width: 100%; outline: none; text-align: center; height: auto; resize: none; margin-top: 40px; line-height: 15px; font-size: 12px; border-color: transparent;"
                        rows="5" readonly>
                    </textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="formulario.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Obtener la fecha actual
            var today = new Date();
            var day = String(today.getDate()).padStart(2, '0');
            var month = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
            var year = today.getFullYear();

            // Formato de fecha: DD/MM/YYYY
            var currentDate = day + '/' + month + '/' + year;

            // Insertar la fecha en el campo correspondiente
            document.getElementById('fecha-emision').textContent = currentDate;
        });
    </script>
</body>

</html>