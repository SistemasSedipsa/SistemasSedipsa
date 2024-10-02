<?php
require_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $empresa = $_POST['empresa'];
    $atiende = $_POST['atiende'];
    $puesto = $_POST['puesto'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    if (!empty($id) && !empty($empresa) && !empty($atiende) && !empty($puesto) && !empty($correo) && !empty($telefono)) {
        $consulta = "UPDATE clientes SET empresa = :empresa, atiende = :atiende, puesto = :puesto, correo = :correo, telefono = :telefono WHERE id = :id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':id', $id);
        $resultado->bindParam(':empresa', $empresa);
        $resultado->bindParam(':atiende', $atiende);
        $resultado->bindParam(':puesto', $puesto);
        $resultado->bindParam(':correo', $correo);
        $resultado->bindParam(':telefono', $telefono);

        if ($resultado->execute()) {
            echo 'Cliente actualizado correctamente.';
        } else {
            echo 'Error al actualizar el cliente.';
        }
    } else {
        echo 'Por favor, completa todos los campos requeridos.';
    }
} else {
    echo 'Solicitud no válida.';
}
?>
