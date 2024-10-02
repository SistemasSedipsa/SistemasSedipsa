<?php
require_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $radiacion_id = $_POST['radiacion_id'];

    // Consulta para obtener la matrícula del vehículo asociado al almacén
    $consulta_num_int = "SELECT num_int FROM equipo_radiacion WHERE id = :radiacion_id";
    $stmt_num_int = $conexion->prepare($consulta_num_int);
    $stmt_num_int->bindParam(':radiacion_id', $radiacion_id, PDO::PARAM_INT);
    $stmt_num_int->execute();
    $resultado_matricula = $stmt_num_int->fetch(PDO::FETCH_ASSOC);

    if ($resultado_matricula) {
        $num_int = $resultado_matricula['num_int'];

        if (isset($_FILES['archivo_pdf'])) {
            $total_files = count($_FILES['archivo_pdf']['name']);
            $duplicados = [];
            $subidos = [];

            // Crear la carpeta usando la matrícula como nombre
            $carpeta_destino = 'pdfs_radiacion/' . $num_int;
            if (!file_exists($carpeta_destino)) {
                mkdir($carpeta_destino, 0777, true);
            }

            for ($i = 0; $i < $total_files; $i++) {
                $nombre_archivo = $_FILES['archivo_pdf']['name'][$i];
                $ruta_archivo = $carpeta_destino . '/' . $nombre_archivo;

                // Consulta para verificar si el archivo ya existe en la base de datos
                $consulta = "SELECT COUNT(*) as count FROM archivo_radiacion WHERE radiacion_id = :radiacion_id AND archivo_pdf = :archivo_pdf";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':radiacion_id', $radiacion_id, PDO::PARAM_INT);
                $stmt->bindParam(':archivo_pdf', $ruta_archivo, PDO::PARAM_STR);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado['count'] > 0) {
                    $duplicados[] = $nombre_archivo;
                } else {
                    if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'][$i], $ruta_archivo)) {
                        // Insertar el nuevo archivo en la base de datos
                        $consulta_insert = "INSERT INTO archivo_radiacion (radiacion_id, archivo_pdf) VALUES (:radiacion_id, :archivo_pdf)";
                        $stmt_insert = $conexion->prepare($consulta_insert);
                        $stmt_insert->bindParam(':radiacion_id', $radiacion_id, PDO::PARAM_INT);
                        $stmt_insert->bindParam(':archivo_pdf', $ruta_archivo, PDO::PARAM_STR);
                        $stmt_insert->execute();

                        $subidos[] = $nombre_archivo;
                    }
                }
            }

            if (count($duplicados) > 0 && count($subidos) > 0) {
                $_SESSION['mensaje'] = 'Archivos subidos correctamente: ' . implode(', ', $subidos) . '. Archivos duplicados no subidos: ' . implode(', ', $duplicados);
            } elseif (count($duplicados) > 0) {
                $_SESSION['mensaje'] = 'Los siguientes archivos ya están registrados: ' . implode(', ', $duplicados);
            } elseif (count($subidos) > 0) {
                $_SESSION['mensaje'] = 'Archivos subidos correctamente: ' . implode(', ', $subidos);
            } else {
                $_SESSION['mensaje'] = 'No se subieron archivos.';
            }
        }
    } else {
        $_SESSION['mensaje'] = 'No se encontró el registro con el ID proporcionado.';
    }

    header('Location: vehiculos.php');
    exit();
}
?>