<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $salida_id = $_GET['salida_id'];

    $consulta = "SELECT salida_id, fecha_salida, curies_salida, tbq_salida FROM salida WHERE salida_id = ?";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute([$salida_id]);
    $salidas = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($salidas);
}