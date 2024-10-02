<?php
require_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null; // ID del proveedor, si está presente
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $producto = $_POST['producto'];
    $alta = $_POST['alta'];
    $seleccion = $_POST['seleccion'];
    $notas = $_POST['notas'];

    if ($id) {
        // Actualizar registro existente
        $consulta = "UPDATE proveedor SET nombre = :nombre, correo = :correo, producto = :producto, alta = :alta, seleccion = :seleccion, notas = :notas WHERE id = :id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':id', $id, PDO::PARAM_INT);
    } else {
        // Crear nuevo registro
        $consulta = "INSERT INTO proveedor (nombre, correo, producto, alta, seleccion, notas) VALUES (:nombre, :correo, :producto, :alta, :seleccion, :notas)";
        $resultado = $conexion->prepare($consulta);
    }

    // Vincular parámetros
    $resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $resultado->bindParam(':correo', $correo, PDO::PARAM_STR);
    $resultado->bindParam(':producto', $producto, PDO::PARAM_STR);
    $resultado->bindParam(':alta', $alta, PDO::PARAM_STR);
    $resultado->bindParam(':seleccion', $seleccion, PDO::PARAM_STR);
    $resultado->bindParam(':notas', $notas, PDO::PARAM_STR);

    // Ejecutar la consulta y verificar el resultado
    if ($resultado->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al guardar los datos']);
    }
}
?>
