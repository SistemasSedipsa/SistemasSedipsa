<?php
require_once 'bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = $_POST['id'] ?? null;
$response = [];

if ($id) {
    try {
        $query = "SELECT id, nombre, correo, producto, alta, seleccion, notas FROM proveedor WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->execute([':id' => $id]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $response = ['error' => "Error: " . $e->getMessage()];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
