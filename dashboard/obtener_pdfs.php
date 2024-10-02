<?php
require_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$almacenId = $_GET['id'];

$consulta = "SELECT id, archivo_pdf FROM archivo_almacen WHERE almacen_id = ?";
$stmt = $conexion->prepare($consulta);
$stmt->execute([$almacenId]);
$archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($archivos);
?>
