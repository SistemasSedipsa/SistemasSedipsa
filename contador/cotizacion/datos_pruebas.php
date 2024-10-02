<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './db/conexion.php';

try {
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT id, descripcion FROM pruebas";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

    $descripciones = $resultado->fetchAll(PDO::FETCH_ASSOC);

    // Limpiar cualquier salida anterior
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($descripciones);

} catch (Exception $e) {
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
