<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fechas_id = $_POST['fechas_id'];
    $ultimo_mantenimiento = $_POST['ultimo_mantenimiento'];
    $proximo_mantenimiento = $_POST['proximo_mantenimiento'];
    $kilometraje = $_POST['kilometraje'];
    $status_v = $_POST['status_v'];

    $consulta = "INSERT INTO fechas (fechas_id, ultimo_mantenimiento, proximo_mantenimiento, kilometraje, status_v) VALUES (?, ?, ?, ?, ?)";
    $resultado = $conexion->prepare($consulta);

    if ($resultado->execute([$fechas_id, $ultimo_mantenimiento, $proximo_mantenimiento, $kilometraje, $status_v])) {
        echo json_encode(['success' => true, 'message' => 'Datos de Mantenimiento agregados correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar datos']);
    }
}
?>
