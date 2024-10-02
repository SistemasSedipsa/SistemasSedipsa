<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $accesorio_id = $_GET['accesorio_id'];

    $consulta = "SELECT nombre, modelo, ns, condicion FROM accesorios WHERE accesorio_id = ?";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute([$accesorio_id]);
    $accesorios = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($accesorios);
}