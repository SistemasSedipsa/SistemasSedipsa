<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$consulta = "SELECT num_int, descripcion, serie, modelo, marca, calibracion, verificacion, ultima, proxima, status_c, ubicacion, prueba, condiciones, observaciones, archivo_pdf FROM almacen WHERE id='$id' ";       
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetch(PDO::FETCH_ASSOC);

// Enviar respuesta JSON con los datos del registro solicitado
header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;
?>
