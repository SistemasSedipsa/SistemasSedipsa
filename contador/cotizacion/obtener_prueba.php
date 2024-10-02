<?php
require_once './db/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$idPrueba = $_POST['id'];

$consulta = "SELECT descripcion, unidad, precio FROM pruebas WHERE id = :id";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':id', $idPrueba, PDO::PARAM_INT);
$resultado->execute();
$prueba = $resultado->fetch(PDO::FETCH_ASSOC);

if ($prueba) {
    echo json_encode($prueba);
} else {
    echo json_encode(['error' => 'Prueba no encontrada']);
}
?>
