<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $proveedor_id = $_POST['proveedor_id'];

    $consulta = "DELETE FROM proveedor_eq WHERE id = ?";
    $resultado = $conexion->prepare($consulta);

    if ($resultado->execute([$proveedor_id])) {
        echo json_encode(['success' => true, 'message' => 'Proveedor eliminado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el proveedor.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
