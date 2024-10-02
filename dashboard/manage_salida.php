<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $salida_id = $_POST['salida_id'];
    $fecha_salida = $_POST['fecha_salida'];
    $curies_salida = $_POST['curies_salida'];
    $tbq_salida = $_POST['tbq_salida'];

    $consulta = "INSERT INTO salida(salida_id, fecha_salida, curies_salida, tbq_salida) VALUES (?, ?, ?, ?)";
    $resultado = $conexion->prepare($consulta);

    if ($resultado->execute([$salida_id, $fecha_salida, $curies_salida, $tbq_salida])) {
        echo json_encode(['success' => true, 'message' => 'Datos agregados correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar datos']);
    }
}
?>
