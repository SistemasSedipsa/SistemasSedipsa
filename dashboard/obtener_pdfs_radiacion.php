<?php
require_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$radiacionId = $_GET['id'];

$consulta = "SELECT id, archivo_pdf FROM archivo_radiacion WHERE radiacion_id = ?";
$stmt = $conexion->prepare($consulta);
$stmt->execute([$radiacionId]);
$archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($archivos);
?>
