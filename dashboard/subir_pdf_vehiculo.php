<?php
require_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehiculo_id = $_POST['vehiculo_id'];

    // Consulta para obtener la matrícula del vehículo asociado al almacén
    $consulta_matricula = "SELECT placas FROM vehiculos WHERE id = :vehiculo_id";
    $stmt_matricula = $conexion->prepare($consulta_matricula);
    $stmt_matricula->bindParam(':vehiculo_id', $vehiculo_id, PDO::PARAM_INT);
    $stmt_matricula->execute();
    $resultado_matricula = $stmt_matricula->fetch(PDO::FETCH_ASSOC);

    if ($resultado_matricula) {
        $placas = $resultado_matricula['placas'];

        if (isset($_FILES['archivo_vehiculo'])) {
            $total_files = count($_FILES['archivo_vehiculo']['name']);
            $duplicados = [];
            $subidos = [];

            // Crear la carpeta usando la matrícula como nombre
            $carpeta_destino = 'pdfs_vehiculos/' . $placas;
            if (!file_exists($carpeta_destino)) {
                mkdir($carpeta_destino, 0777, true);
            }

            for ($i = 0; $i < $total_files; $i++) {
                $nombre_archivo = $_FILES['archivo_vehiculo']['name'][$i];
                $ruta_archivo = $carpeta_destino . '/' . $nombre_archivo;

                // Consulta para verificar si el archivo ya existe en la base de datos
                $consulta = "SELECT COUNT(*) as count FROM archivo_vehiculos WHERE vehiculo_id = :vehiculo_id AND archivo_vehiculo = :archivo_vehiculo";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':vehiculo_id', $vehiculo_id, PDO::PARAM_INT);
                $stmt->bindParam(':archivo_vehiculo', $ruta_archivo, PDO::PARAM_STR);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado['count'] > 0) {
                    $duplicados[] = $nombre_archivo;
                } else {
                    if (move_uploaded_file($_FILES['archivo_vehiculo']['tmp_name'][$i], $ruta_archivo)) {
                        // Insertar el nuevo archivo en la base de datos
                        $consulta_insert = "INSERT INTO archivo_vehiculos (vehiculo_id, archivo_vehiculo) VALUES (:vehiculo_id, :archivo_vehiculo)";
                        $stmt_insert = $conexion->prepare($consulta_insert);
                        $stmt_insert->bindParam(':vehiculo_id', $vehiculo_id, PDO::PARAM_INT);
                        $stmt_insert->bindParam(':archivo_vehiculo', $ruta_archivo, PDO::PARAM_STR);
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