<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $verificacion_id = $_GET['verificacion_id'];

    $consulta = "SELECT id, verificacion_id, verificacion, fecha_verificacion, status_ver FROM verificacion WHERE verificacion_id = ?";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute([$verificacion_id]);
    $accesorios = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($accesorios);
}