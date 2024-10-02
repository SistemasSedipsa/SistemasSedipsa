<?php
// Conexión a la base de datos
require_once './db/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Consulta SQL
$consulta = "SELECT id, prueba, descripcion, precio FROM pruebas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

// Devolver los datos como JSON
echo json_encode($datos);
?>