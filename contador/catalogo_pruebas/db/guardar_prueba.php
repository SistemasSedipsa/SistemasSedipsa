<?php
require_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null; // Si id no existe, será null
    $prueba = $_POST['prueba'] ?? ''; // Validar si prueba está presente
    $descripcion = $_POST['descripcion'] ?? ''; // Validar si descripción está presente
    $unidad = $_POST['unidad'] ?? ''; // Agregar unidad al post
    $precio = $_POST['precio'] ?? ''; // Validar si precio está presente

    // Validar que los campos requeridos no estén vacíos
    if (!empty($prueba) && !empty($descripcion) && !empty($unidad) && !empty($precio)) {
        if ($id) {
            // Actualizar registro existente
            $consulta = "UPDATE pruebas SET prueba = :prueba, descripcion = :descripcion, unidad = :unidad, precio = :precio WHERE id = :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            // Insertar nuevo registro
            $consulta = "INSERT INTO pruebas (prueba, descripcion, unidad, precio) VALUES (:prueba, :descripcion, :unidad, :precio)";
            $resultado = $conexion->prepare($consulta);
        }

        // Asignar los parámetros
        $resultado->bindParam(':prueba', $prueba, PDO::PARAM_STR);
        $resultado->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $resultado->bindParam(':unidad', $unidad, PDO::PARAM_STR);
        $resultado->bindParam(':precio', $precio, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($resultado->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar los datos']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Por favor, complete todos los campos obligatorios']);
    }
}
?>
