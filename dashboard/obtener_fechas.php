<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $fechas_id = $_GET['fechas_id'];

    $consulta = "SELECT id, fechas_id, ultimo_mantenimiento, proximo_mantenimiento, kilometraje, status_v FROM fechas WHERE fechas_id = ?";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute([$fechas_id]);
    $accesorios = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($accesorios);
}