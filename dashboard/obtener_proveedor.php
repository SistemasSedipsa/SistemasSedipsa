<?php
// Conectar a la base de datos
include 'bd/conexion.php';

if (isset($_GET['proveedor_id'])) {
    $proveedor_id = $_GET['proveedor_id'];

    $stmt = $pdo->prepare("SELECT id, nombre, correo, producto, alta, seleccion, notas FROM proveedor WHERE id = :proveedor_id");
    $stmt->bindParam(':proveedor_id', $proveedor_id, PDO::PARAM_INT);
    $stmt->execute();

    $proveedor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($proveedor) {
        echo json_encode($proveedor);
    } else {
        echo json_encode(['error' => 'Proveedor no encontrado']);
    }
} else {
    echo json_encode(['error' => 'ID del proveedor no especificado']);
}
?>
