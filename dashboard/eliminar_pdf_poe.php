<?php
require_once 'bd/conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    // Obtener la ruta del archivo PDF
    $consulta = "SELECT archivo_pdf FROM archivo_personal WHERE id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->execute([$id]);
    $archivo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($archivo) {
        $rutaArchivo = $archivo['archivo_pdf'];

        // Eliminar el archivo del servidor
        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        // Eliminar el registro de la base de datos
        $consulta = "DELETE FROM archivo_personal WHERE id = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute([$id]);

        echo json_encode(['success' => true, 'message' => 'Archivo eliminado con éxito']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Archivo no encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
}
?>
