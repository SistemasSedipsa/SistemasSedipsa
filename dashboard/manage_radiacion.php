<?php
require_once 'bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $radiacion_id = $_POST['radiacion_id'];
    $nombres = $_POST['nombre'];

    $conexion->beginTransaction();

    try {
        $consulta = "INSERT INTO accesorios_radiacion (radiacion_id, nombre) VALUES (?, ?)";
        $resultado = $conexion->prepare($consulta);

        foreach ($nombres as $nombre) {
            if (!$resultado->execute([$radiacion_id, $nombre])) {
                throw new Exception('Error al agregar accesorio: ' . $nombre);
            }
        }

        $conexion->commit();
        echo json_encode(['success' => true, 'message' => 'Accesorios agregados correctamente']);
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conexion->rollBack();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>