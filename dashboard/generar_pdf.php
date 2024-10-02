<?php
// Incluir la clase TCPDF
require_once('../tcpdf/tcpdf.php');

// Configurar parámetros para PDF horizontal
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configurar el documento
$pdf->SetCreator('Registro de Almacen');
$pdf->SetAuthor('');
$pdf->SetTitle('Control de Registro del Almacen');
$pdf->SetSubject('Asunto del documento');
$pdf->SetKeywords('Palabras clave');

// Agregar una página
$pdf->AddPage();

// Conectar a la base de datos y obtener datos
require_once('bd/conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consulta = "SELECT id, num_int, descripcion, metodo, serie, inventario, modelo, marca, accesorios, calibracion, verificacion, ultima, informe, proxima, status_c, ubicacion, prueba, condiciones, observaciones, situacion, bodega, archivo_pdf FROM almacen";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

// Estilo CSS para la tabla
$css = '
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: center;
            font-size: 8px; /* Tamaño de letra ajustado */
            font-family: Arial, sans-serif; /* Fuente elegante */
        }
        th {
            background-color: #f2f2f2;
        }
        .title {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
';

// Crear tabla HTML
$html = '<div class="title">Lista de Almacen en PDF</div>'; // Título centrado
$html .= $css; // Agregar el estilo CSS
$html .= '<table>';
$html .= '<thead><tr>';
$html .= '<th>No. Interno</th>';
$html .= '<th>Descripción</th>';
$html .= '<th>No. Serie</th>';
$html .= '<th>Modelo</th>';
$html .= '<th>Marca</th>';
$html .= '<th>Calibración</th>';
$html .= '<th>Verificación</th>';
$html .= '<th>Fecha Última (Cal/Ver)</th>';
$html .= '<th>Fecha Próxima (Cal/Ver)</th>';
$html .= '<th>Status</th>';
$html .= '<th>Ubicación</th>';
$html .= '<th>Prueba</th>';
$html .= '<th>Condiciones</th>';
$html .= '<th>Observaciones</th>';
$html .= '</tr></thead>';
$html .= '<tbody>';
foreach ($data as $dat) {
    $html .= '<tr>';
    foreach ($dat as $key => $value) {
        if (!empty($value)) {
            $html .= '<td>' . htmlspecialchars($value) . '</td>';
        } else {
            $html .= '<td></td>'; // Agregar una celda vacía si el valor está vacío
        }
    }
    $html .= '</tr>';
}
$html .= '</tbody></table>';

// Agregar contenido HTML al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Generar el PDF (descargar o mostrar en el navegador)
$pdf->Output('RegistroDeAlmacen.pdf', 'I');
