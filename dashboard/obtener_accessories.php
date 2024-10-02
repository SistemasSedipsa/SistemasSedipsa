<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $consumible_id = $_GET['consumible_id'];

    $consulta = "SELECT nombre, modelo, ns, condicion FROM accesorios_consumibles WHERE consumible_id = ?";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute([$consumible_id]);
    $accesorios = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($accesorios);
}