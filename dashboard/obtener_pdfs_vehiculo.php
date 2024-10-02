<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if (isset($_GET['id'])) {
    $vehiculo_id = $_GET['id'];

    $consulta = "SELECT id, archivo_vehiculo FROM archivo_vehiculos WHERE vehiculo_id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->execute([$vehiculo_id]);
    $archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($archivos);
}
?>
