<?php
require_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if (!empty($id)) {
        $consulta = "DELETE FROM clientes WHERE id = :id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':id', $id);

        if ($resultado->execute()) {
            echo 'Cliente eliminado correctamente.';
        } else {
            echo 'Error al eliminar el cliente.';
        }
    } else {
        echo 'ID del cliente no proporcionado.';
    }
} else {
    echo 'Solicitud no válida.';
}
?>
