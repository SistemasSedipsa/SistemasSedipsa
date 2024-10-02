<?php
require_once 'bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $radiacion_id = $_GET['radiacion_id'];

    $consulta = "SELECT nombre FROM accesorios_radiacion WHERE radiacion_id = ?";
    $resultado = $conexion->prepare($consulta);
    
    if ($resultado->execute([$radiacion_id])) {
        $accesorios = $resultado->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($accesorios);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los accesorios']);
    }
}
?>
