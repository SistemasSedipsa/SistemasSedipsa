<?php
require_once './db/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = $_GET['id'];

$consulta = "SELECT empresa, atiende, puesto, correo, telefono FROM clientes WHERE id = :id";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':id', $id);
$resultado->execute();

$cliente = $resultado->fetch(PDO::FETCH_ASSOC);

echo json_encode($cliente);
?>
