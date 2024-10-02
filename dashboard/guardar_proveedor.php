<?php
require_once 'bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = $_POST['editId'] ?? null;
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$producto = $_POST['producto'];
$alta = $_POST['alta'];
$seleccion = $_POST['seleccion'];
$notas = $_POST['notas'];

try {
    if ($id) {
        // Actualizar proveedor
        $query = "UPDATE proveedor SET nombre = :nombre, correo = :correo, producto = :producto, alta = :alta, seleccion = :seleccion, notas = :notas WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':producto' => $producto,
            ':alta' => $alta,
            ':seleccion' => $seleccion,
            ':notas' => $notas,
            ':id' => $id
        ]);
    } else {
        // Crear nuevo proveedor
        $query = "INSERT INTO proveedor (nombre, correo, producto, alta, seleccion, notas) VALUES (:nombre, :correo, :producto, :alta, :seleccion, :notas)";
        $stmt = $conexion->prepare($query);
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':producto' => $producto,
            ':alta' => $alta,
            ':seleccion' => $seleccion,
            ':notas' => $notas
        ]);
    }

    // Redirigir o mostrar mensaje de éxito
    header('Location: mostrar_proveedores.php');
} catch (PDOException $e) {
    // Manejar error
    echo "Error: " . $e->getMessage();
}
?>
