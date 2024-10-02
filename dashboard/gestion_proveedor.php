<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $producto = $_POST['producto'];
    $alta = $_POST['alta'];
    $seleccion = $_POST['seleccion'];
    $notas = $_POST['notas'];

    $consulta = "INSERT INTO proveedor (nombre, correo, producto, alta, seleccion, notas) VALUES (?, ?, ?, ?, ?, ?)";
    $resultado = $conexion->prepare($consulta);

    if ($resultado->execute([$nombre, $correo, $producto, $alta, $seleccion, $notas])) {
        echo json_encode(['success' => true, 'message' => 'Datos agregados correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar los datos']);
    }
}
?>
