<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accesorio_id = $_POST['accesorio_id'];
    $nombre = $_POST['nombre'];
    $modelo = $_POST['modelo'];
    $ns = $_POST['ns'];
    $condicion = $_POST['condicion'];

    $consulta = "INSERT INTO accesorios (accesorio_id, nombre, modelo, ns, condicion) VALUES (?, ?, ?, ?, ?)";
    $resultado = $conexion->prepare($consulta);

    if ($resultado->execute([$accesorio_id, $nombre, $modelo, $ns, $condicion])) {
        echo json_encode(['success' => true, 'message' => 'Accesorio agregado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar accesorio']);
    }
}
?>
