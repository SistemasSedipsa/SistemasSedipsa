<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $entrada_id = $_GET['entrada_id'];

    $consulta = "SELECT entrada_id, fecha, curies, tbq FROM entrada WHERE entrada_id = ?";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute([$entrada_id]);
    $entradas = $resultado->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($entradas);
}