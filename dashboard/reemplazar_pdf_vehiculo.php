<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehiculo_id = $_POST['vehiculo_id'];
    $archivo_id = $_POST['archivo_id']; // Asegúrate de que esta variable esté en el formulario

    // Obtener la ruta del archivo desde la base de datos
    $consulta = "SELECT archivo_vehiculo FROM archivo_vehiculos WHERE vehiculo_id = ? AND id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->execute([$vehiculo_id, $archivo_id]);
    $archivo_actual = $stmt->fetchColumn();

    // Eliminar el archivo antiguo si existe
    if ($archivo_actual && file_exists($archivo_actual)) {
        unlink($archivo_actual);
    }

    // Actualizar la base de datos para eliminar el archivo
    $consulta = "UPDATE archivo_vehiculos SET archivo_vehiculo = NULL WHERE vehiculo_id = ? AND id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->execute([$vehiculo_id, $archivo_id]);

    $_SESSION['mensaje'] = 'Archivo PDF eliminado correctamente.';

    header('Location: vehiculos.php'); // Redirige a la página principal
}
?>
