<?php
require_once 'conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$empresa = $_POST['empresa'];
$atiende = $_POST['atiende'];
$puesto = $_POST['puesto'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

$consulta = "INSERT INTO clientes (empresa, atiende, puesto, correo, telefono) VALUES (:empresa, :atiende, :puesto, :correo, :telefono)";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':empresa', $empresa, PDO::PARAM_STR);
$resultado->bindParam(':atiende', $atiende, PDO::PARAM_STR);
$resultado->bindParam(':puesto', $puesto, PDO::PARAM_STR);
$resultado->bindParam(':correo', $correo, PDO::PARAM_STR);
$resultado->bindParam(':telefono', $telefono, PDO::PARAM_STR);
$resultado->execute();

$newId = $conexion->lastInsertId();
echo $newId;
?>
