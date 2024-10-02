<?php
require_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$fuenteId = $_GET['id'];

$consulta = "SELECT id, archivo_pdf FROM archivo_fuente WHERE fuente_id = ?";
$stmt = $conexion->prepare($consulta);
$stmt->execute([$fuenteId]);
$archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($archivos);
?>
