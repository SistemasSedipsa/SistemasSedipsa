<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entrada_id = $_POST['entrada_id'];
    $fecha = $_POST['fecha'];
    $curies = $_POST['curies'];
    $tbq = $_POST['tbq'];

    $consulta = "INSERT INTO entrada(entrada_id, fecha, curies, tbq) VALUES (?, ?, ?, ?)";
    $resultado = $conexion->prepare($consulta);

    if ($resultado->execute([$entrada_id, $fecha, $curies, $tbq])) {
        echo json_encode(['success' => true, 'message' => 'Datos agregados correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar datos']);
    }
}
?>
