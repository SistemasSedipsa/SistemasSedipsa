<?php
// editar_accesorio.php
include 'bd/conexion.php'; // Incluye tu archivo de conexión a la base de datos

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$modelo = $_POST['modelo'];
$ns = $_POST['ns'];
$condicion = $_POST['condicion'];

$query = "UPDATE accesorios SET nombre = ?, modelo = ?, ns = ?, condicion = ? WHERE id = ?";
$stmt = $pdo->prepare($query);
$result = $stmt->execute([$nombre, $modelo, $ns, $condicion, $id]);

if ($result) {
    echo 'Accesorio actualizado correctamente';
} else {
    echo 'Error al actualizar el accesorio';
}
?>
