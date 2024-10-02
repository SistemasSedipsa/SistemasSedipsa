<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir y limpiar los datos del formulario
    $proveedor_id = $_POST['proveedor_id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $producto = $_POST['producto'];
    $alta = $_POST['alta'];
    $seleccion = $_POST['seleccion'];
    $notas = $_POST['notas'];

    // Consulta para insertar los datos en la base de datos en la tabla `proveedor_eq`
    $consulta = "INSERT INTO proveedor_eq (proveedor_id, nombre, correo, producto, alta, seleccion, notas) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $resultado = $conexion->prepare($consulta);

    // Ejecutar la consulta con los datos proporcionados
    if ($resultado->execute([$proveedor_id, $nombre, $correo, $producto, $alta, $seleccion, $notas])) {
        echo json_encode(['success' => true, 'message' => 'Datos agregados correctamente']);
    } else {
        $errorInfo = $resultado->errorInfo(); // Obtener información del error
        echo json_encode(['success' => false, 'message' => 'Error al agregar los datos', 'error' => $errorInfo]);
    }
}
?>
