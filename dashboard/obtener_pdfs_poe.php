<?php
require_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$personalId = $_GET['id'];

$consulta = "SELECT id, archivo_pdf FROM archivo_personal WHERE personal_id = ?";
$stmt = $conexion->prepare($consulta);
$stmt->execute([$personalId]);
$archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($archivos);
?>
