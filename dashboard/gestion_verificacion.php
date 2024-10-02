<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $verificacion_id = $_POST['verificacion_id'];
    $verificacion = $_POST['verificacion'];
    $fecha_verificacion = $_POST['fecha_verificacion'];
    $status_ver = $_POST['status_ver'];

    $consulta = "INSERT INTO verificacion (verificacion_id, verificacion, fecha_verificacion, status_ver) VALUES (?, ?, ?, ?)";
    $resultado = $conexion->prepare($consulta);

    if ($resultado->execute([$verificacion_id, $verificacion, $fecha_verificacion, $status_ver])) {
        echo json_encode(['success' => true, 'message' => 'Datos de Verificación agregados correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar datos']);
    }
}
?>
