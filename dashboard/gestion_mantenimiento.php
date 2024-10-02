<?php
require_once 'bd/conexion.php';
header('Content-Type: application/json');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mantenimiento_id = isset($_POST['mantenimiento_id']) ? $_POST['mantenimiento_id'] : '';
    $ultimo_mantenimiento = isset($_POST['ultimo_mantenimiento']) ? $_POST['ultimo_mantenimiento'] : '';
    $proximo_mantenimiento = isset($_POST['proximo_mantenimiento']) ? $_POST['proximo_mantenimiento'] : '';

    if (empty($mantenimiento_id) || empty($ultimo_mantenimiento) || empty($proximo_mantenimiento)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
        exit();
    }

    $consulta = "INSERT INTO mantenimientos (mantenimiento_id, ultimo_mantenimiento, proximo_mantenimiento) VALUES (?, ?, ?)";
    $resultado = $conexion->prepare($consulta);

    if ($resultado->execute([$mantenimiento_id, $ultimo_mantenimiento, $proximo_mantenimiento])) {
        echo json_encode(['success' => true, 'message' => 'Mantenimiento agregado correctamente']);
    } else {
        $errorInfo = $resultado->errorInfo(); // Obtener información sobre el error
        echo json_encode(['success' => false, 'message' => 'Error al agregar mantenimiento', 'error' => $errorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
}
?>