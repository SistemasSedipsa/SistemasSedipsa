<?php
require_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $personal_id = $_POST['personal_id'];

    $consulta_cnsns = "SELECT cnsns FROM personal_poe WHERE id = :personal_id";
    $stmt_cnsns = $conexion->prepare($consulta_cnsns);
    $stmt_cnsns->bindParam(':personal_id', $personal_id, PDO::PARAM_INT);
    $stmt_cnsns->execute();
    $resultado_cnsns = $stmt_cnsns->fetch(PDO::FETCH_ASSOC);

    if ($resultado_cnsns) {
        $cnsns = $resultado_cnsns['cnsns'];

        if (isset($_FILES['archivo_pdf'])) {
            $total_files = count($_FILES['archivo_pdf']['name']);
            $duplicados = [];
            $subidos = [];

            $carpeta_destino = 'pdfs_poe/' . $cnsns;
            if (!file_exists($carpeta_destino)) {
                mkdir($carpeta_destino, 0777, true);
            }

            for ($i = 0; $i < $total_files; $i++) {
                $nombre_archivo = $_FILES['archivo_pdf']['name'][$i];
                $ruta_archivo = $carpeta_destino . '/' . $nombre_archivo;

                $consulta = "SELECT COUNT(*) as count FROM archivo_personal WHERE personal_id = :personal_id AND archivo_pdf = :archivo_pdf";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':personal_id', $personal_id, PDO::PARAM_INT);
                $stmt->bindParam(':archivo_pdf', $ruta_archivo, PDO::PARAM_STR);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado['count'] > 0) {
                    $duplicados[] = $nombre_archivo;
                } else {
                    if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'][$i], $ruta_archivo)) {
                        $consulta_insert = "INSERT INTO archivo_personal (personal_id, archivo_pdf) VALUES (:personal_id, :archivo_pdf)";
                        $stmt_insert = $conexion->prepare($consulta_insert);
                        $stmt_insert->bindParam(':personal_id', $personal_id, PDO::PARAM_INT);
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

    header('Location: personal.php');
    exit();
}
?>