<?php
require_once 'bd/conexion.php'; // Asegúrate de que la conexión a la base de datos esté correctamente configurada

$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si el ID del proveedor está presente en la solicitud POST
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];

        try {
            $query = "DELETE FROM proveedor WHERE id = :id";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: mostrar_proveedores.php?mensaje=Proveedor eliminado con éxito");
                exit();
            } else {
                
                header("Location: mostrar_proveedores.php?mensaje=Error al eliminar el proveedor");
                exit();
            }
        } catch (PDOException $e) {
            header("Location: mostrar_proveedores.php?mensaje=Error: " . $e->getMessage());
            exit();
        }
    } else {
        header("Location: mostrar_proveedores.php?mensaje=ID del proveedor no proporcionado");
        exit();
    }
} else {
    header("Location: mostrar_proveedores.php");
    exit();
}
?>
